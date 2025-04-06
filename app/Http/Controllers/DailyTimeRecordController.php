<?php

namespace App\Http\Controllers;

use App\Models\DailyTimeRecord;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DailyTimeRecordController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $employeeId = $request->get('employee_id');
        
        $startDate = Carbon::parse($month)->startOfMonth();
        $endDate = Carbon::parse($month)->endOfMonth();
        
        $query = DailyTimeRecord::with(['employee.salaries' => function($query) use ($endDate) {
            $query->where('status', 'active')
                  ->where('effective_date', '<=', $endDate)
                  ->orderBy('effective_date', 'desc');
        }])->whereBetween('attendance_date', [$startDate, $endDate]);
            
        if ($employeeId) {
            $query->where('employee_id', $employeeId);
        }
        
        $records = $query->orderBy('attendance_date')->get();
        
        // Calculate net amounts based on salary records
        $records->each(function($record) {
            $record->calculateNetAmount();
            $record->save();
        });
        
        // Group records by employee
        $groupedRecords = $records->groupBy('employee_id');
        
        return view('pages.hr.dtr.index', [
            'records' => $groupedRecords,
            'month' => $month,
            'employees' => User::orderBy('name')->get()
        ]);
    }
    
    public function generatePdf(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $employeeId = $request->get('employee_id');
        
        if (!$employeeId) {
            return back()->with('error', 'Employee is required');
        }
        
        $startDate = Carbon::parse($month)->startOfMonth();
        $endDate = Carbon::parse($month)->endOfMonth();
        
        $employee = User::with(['salaries' => function($query) use ($endDate) {
            $query->where('status', 'active')
                  ->where('effective_date', '<=', $endDate)
                  ->orderBy('effective_date', 'desc');
        }])->findOrFail($employeeId);
        
        $records = DailyTimeRecord::where('employee_id', $employeeId)
            ->whereBetween('attendance_date', [$startDate, $endDate])
            ->orderBy('attendance_date')
            ->get();
            
        // Calculate net amounts based on salary records
        $records->each(function($record) {
            $record->calculateNetAmount();
            $record->save();
        });
            
        $pdf = PDF::loadView('pages.hr.dtr.pdf', [
            'employee' => $employee,
            'records' => $records,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalLateMinutes' => $records->sum('late_minutes'),
            'totalUndertimeMinutes' => $records->sum('undertime_minutes'),
            'totalDeductions' => $records->sum('deductions'),
            'totalNetAmount' => $records->sum('net_amount')
        ]);
        
        return $pdf->download("dtr_{$employee->id}_{$month}.pdf");
    }
}
