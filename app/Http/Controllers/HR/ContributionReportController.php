<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Models\ContributionReport;
use App\Models\Payslip;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class ContributionReportController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);
        
        $reports = ContributionReport::with(['employee'])
            ->orderBy('report_date', 'desc')
            ->paginate(20);

        return view('pages.hr.contributions.index', compact('reports'));
    }

    public function generate(Request $request)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);

        $validated = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020|max:' . date('Y'),
        ]);

        $month = $validated['month'];
        $year = $validated['year'];
        
        // Get all payslips for the given month and year
        $startDate = Carbon::create($year, $month, 1);
        $endDate = $startDate->copy()->endOfMonth();

        $payslips = Payslip::whereBetween('pay_period_end', [$startDate, $endDate])
            ->where('status', 'approved')
            ->with(['employee', 'employee.benefits'])
            ->get();

        // Debug: Check if we found any payslips
        if ($payslips->isEmpty()) {
            return redirect()->back()
                ->with('error', 'No approved payslips found for the selected month and year.');
        }

        // Delete existing reports for this month to avoid duplicates
        ContributionReport::whereBetween('report_date', [$startDate, $endDate])
            ->delete();

        // Generate contribution reports for each payslip
        $reportsGenerated = 0;
        foreach ($payslips as $payslip) {
            $report = new ContributionReport();
            $report->employee_id = $payslip->employee_id;
            
            // Get the latest active benefit numbers
            $benefits = $payslip->employee->benefits()->where('status', 'active')
                ->where(function($query) use ($startDate) {
                    $query->whereNull('expiration_date')
                        ->orWhere('expiration_date', '>=', $startDate);
                })
                ->get();

            $report->sss_number = $benefits->where('benefit_type', 'sss')->first()?->amount;
            $report->philhealth_number = $benefits->where('benefit_type', 'philhealth')->first()?->amount;
            $report->pagibig_number = $benefits->where('benefit_type', 'pagibig')->first()?->amount;
            $report->report_date = $startDate;
            
            // Debug: Check if we have all required employee data
            if (!$report->sss_number || !$report->philhealth_number || !$report->pagibig_number) {
                continue; // Skip this employee if we don't have all required data
            }
            
            // Calculate contributions based on payslip data
            $report->calculateContributions($payslip->basic_salary);
            
            // Debug: Check if contributions were calculated
            if ($report->total_contribution <= 0) {
                continue; // Skip if no contributions were calculated
            }
            
            $report->save();
            $reportsGenerated++;
        }

        // Debug: Check if any reports were actually generated
        if ($reportsGenerated === 0) {
            return redirect()->back()
                ->with('error', 'No contribution reports could be generated. Please check employee data and payslip information.');
        }

        return redirect()->route('hr.contributions.index')
            ->with('success', 'Contribution reports generated successfully for ' . Carbon::create($year, $month, 1)->format('F Y') . 
            ' (Generated: ' . $reportsGenerated . ' reports)');
    }

    public function print($id)
    {
        abort_unless(Gate::allows('hr_access') || Gate::allows('admin_access') || Gate::allows('super_access'), 403);
        
        $report = ContributionReport::with(['employee'])->findOrFail($id);
        return view('pages.hr.contributions.print', compact('report'));
    }
}
