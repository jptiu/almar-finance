<?php

namespace App\Http\Controllers;

use App\Models\LeaveCredit;
use App\Models\User;
use App\Models\Department;
use App\Models\ServiceIncentiveLog;
use App\Models\EmployeeSalary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LeaveCreditController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $leaveCredits = LeaveCredit::where('employee_id', $user->id)
            ->get()
            ->map(function ($credit) {
                return [
                    'leave_type' => $credit->leave_type,
                    'total_credits' => $credit->total_credits,
                    'used_credits' => $credit->used_credits,
                    'remaining_credits' => $credit->remaining_credits,
                    'effective_date' => $credit->effective_date,
                    'status' => $this->getCreditStatus($credit->total_credits, $credit->remaining_credits)
                ];
            });

        return view('pages.hr.leave_credits.index', compact('leaveCredits'));
    }

    public function companyReport(Request $request, $returnData = false)
    {
        $filters = [
            'leave_type' => $request->input('leave_type'),
            'department' => $request->input('department'),
            'status' => $request->input('status'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ];

        // Get all departments
        $departments = Department::orderBy('name')->get();

        // Build query
        $query = User::with([
            'leaveCredits' => function($q) use ($filters) {
                if ($filters['start_date']) {
                    $q->where('effective_date', '>=', $filters['start_date']);
                }
                if ($filters['end_date']) {
                    $q->where('effective_date', '<=', $filters['end_date']);
                }
            }
        ]);

        // Apply filters
        if ($filters['department']) {
            $query->whereHas('department', function ($q) use ($filters) {
                $q->where('id', $filters['department']);
            });
        }

        // Get users and their leave credits
        $users = $query->get();
        $employees = [];
        $summary = [
            'total_employees' => 0,
            'total_credits' => 0,
            'total_used' => 0,
            'total_remaining' => 0,
            'total_sil_days' => 0,
            'total_sil_value' => 0,
            'percentage_used' => 0,
            'status' => []
        ];

        foreach ($users as $user) {
            $totalCredits = 0;
            $totalUsedCredits = 0;
            $leaveCredits = $user->leaveCredits;

            // Calculate totals for all leave types
            foreach ($leaveCredits as $credit) {
                $totalCredits += $credit->total_credits;
                $totalUsedCredits += $credit->used_credits;
            }

            $totalRemainingCredits = $totalCredits - $totalUsedCredits;
            $percentageUsed = $totalCredits > 0 ? ($totalUsedCredits / $totalCredits) * 100 : 0;

            // Get SIL balance and value
            $silCredit = $leaveCredits->where('leave_type', 'service_incentive')->first();
            $silBalance = $silCredit ? $silCredit->remaining_credits : 0;
            $currentSalary = EmployeeSalary::getCurrentSalary($user->id);
            
            // Debugging
            \Log::info('SIL Debug for user ' . $user->id);
            \Log::info('Sil Credit: ' . json_encode($silCredit));
            \Log::info('Sil Balance: ' . $silBalance);
            \Log::info('Current Salary: ' . json_encode($currentSalary));
            \Log::info('Daily Rate: ' . ($currentSalary ? $currentSalary->daily_rate : 'No salary'));
            
            $silValue = $silCredit ? $silCredit->calculateSILValue($currentSalary) : 0;

            // Get leave types with status
            $leaveTypes = $leaveCredits->map(function ($credit) {
                $status = $this->getCreditStatus($credit->total_credits, $credit->remaining_credits);
                return [
                    'type' => $credit->leave_type,
                    'total' => $credit->total_credits,
                    'used' => $credit->used_credits,
                    'remaining' => $credit->remaining_credits,
                    'status' => $status
                ];
            })->toArray();

            // Calculate overall status for the employee
            $overallStatus = $this->getOverallStatus($leaveTypes);

            $employees[] = [
                'id' => $user->id,
                'name' => $user->name,
                'department' => $user->department ? $user->department->name : 'No Department',
                'total_credits' => $totalCredits,
                'used_credits' => $totalUsedCredits,
                'remaining_credits' => $totalRemainingCredits,
                'sil_balance' => $silBalance,
                'sil_value' => $silValue,
                'percentage_used' => $percentageUsed,
                'status' => $overallStatus,
                'leave_types' => $leaveTypes
            ];

            // Update summary
            $summary['total_employees']++;
            $summary['total_credits'] += $totalCredits;
            $summary['total_used'] += $totalUsedCredits;
            $summary['total_remaining'] += $totalRemainingCredits;
            $summary['total_sil_days'] += $silBalance;
            $summary['total_sil_value'] += $silValue;
            if ($summary['total_credits'] > 0) {
                $summary['percentage_used'] = ($summary['total_used'] / $summary['total_credits']) * 100;
            }
        }

        // Sort the results
        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $employees = collect($employees)
            ->sortBy($sort, SORT_REGULAR, $direction === 'desc')
            ->values()
            ->toArray();

        if ($returnData) {
            return [
                'employees' => $employees,
                'summary' => $summary
            ];
        }

        return view('pages.hr.leave_credits.report', compact('employees', 'summary', 'filters', 'sort', 'direction', 'departments'));
    }

    public function export(Request $request)
    {
        $filters = [
            'leave_type' => $request->input('leave_type'),
            'department' => $request->input('department'),
            'status' => $request->input('status'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ];

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Add title
        $sheet->setCellValue('A1', 'Leave Credits Report');
        $sheet->mergeCells('A1:H1');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Add date range if specified
        if ($filters['start_date'] || $filters['end_date']) {
            $dateRange = [];
            if ($filters['start_date']) {
                $dateRange[] = date('F j, Y', strtotime($filters['start_date']));
            }
            if ($filters['end_date']) {
                $dateRange[] = date('F j, Y', strtotime($filters['end_date']));
            }
            $sheet->setCellValue('A2', 'Date Range: ' . implode(' to ', $dateRange));
            $sheet->mergeCells('A2:H2');
            $sheet->getStyle('A2')->getFont()->setBold(true);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        }

        // Add headers
        $headers = [
            'Employee',
            'Department',
            'Total Credits',
            'Used Credits',
            'Remaining Credits',
            'Usage %',
            'Status',
            'Leave Types',
            'SIL Balance',
            'SIL Value'
        ];
        $headerRow = 4;
        foreach ($headers as $index => $header) {
            $sheet->setCellValueByColumnAndRow($index + 1, $headerRow, $header);
        }

        // Style headers
        $sheet->getStyle('A4:J4')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => 'E5E5E5'],
            ],
        ]);

        // Get report data
        $data = $this->companyReport($request, true);
        $employees = $data['employees'];
        $summary = $data['summary'];

        // Add data rows
        $row = 5;
        foreach ($employees as $employee) {
            $sheet->setCellValueByColumnAndRow(1, $row, $employee['name']);
            $sheet->setCellValueByColumnAndRow(2, $row, $employee['department']);
            $sheet->setCellValueByColumnAndRow(3, $row, $employee['total_credits']);
            $sheet->setCellValueByColumnAndRow(4, $row, $employee['used_credits']);
            $sheet->setCellValueByColumnAndRow(5, $row, $employee['remaining_credits']);
            $sheet->setCellValueByColumnAndRow(6, $row, $employee['percentage_used'] . '%');
            $sheet->setCellValueByColumnAndRow(7, $row, $employee['status']);
            
            // Format leave types as string
            $leaveTypes = '';
            foreach ($employee['leave_types'] as $type) {
                $leaveTypes .= $type['type'] . ': ' . $type['remaining'] . ' (' . $type['status'] . ')\n';
            }
            $sheet->setCellValueByColumnAndRow(8, $row, $leaveTypes);
            
            $sheet->setCellValueByColumnAndRow(9, $row, $employee['sil_balance']);
            $sheet->setCellValueByColumnAndRow(10, $row, $employee['sil_value']);
            
            // Style data rows
            $sheet->getStyle('A' . $row . ':J' . $row)->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                    ],
                ],
            ]);
            
            $row++;
        }

        // Add summary section
        $sheet->setCellValue('A' . $row, 'Summary:');
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => ['bold' => true],
        ]);
        $row++;

        // Add summary metrics
        $summaryMetrics = [
            'Total Employees' => $summary['total_employees'],
            'Total Credits' => $summary['total_credits'],
            'Used Credits' => $summary['total_used'],
            'Remaining Credits' => $summary['total_remaining'],
            'Overall Usage Rate' => $summary['total_credits'] > 0 ? ($summary['total_used'] / $summary['total_credits']) * 100 . '%' : '0%',
            'Total SIL Days' => $summary['total_sil_days'],
            'Total SIL Value' => $summary['total_sil_value']
        ];

        foreach ($summaryMetrics as $metric => $value) {
            $sheet->setCellValue('A' . $row, $metric . ':');
            $sheet->setCellValue('B' . $row, $value);
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray([
                'font' => ['bold' => true],
            ]);
            $row++;
        }

        // Add status summary
        $sheet->setCellValue('A' . $row, 'Status Summary:');
        $sheet->getStyle('A' . $row)->applyFromArray([
            'font' => ['bold' => true],
        ]);
        $row++;

        foreach ($summary['status'] as $type => $status) {
            $sheet->setCellValue('A' . $row, $type . ':');
            $sheet->setCellValue('B' . $row, $status['total'] . ' credits');
            $sheet->setCellValue('C' . $row, $status['used'] . ' credits used');
            $sheet->setCellValue('D' . $row, $status['remaining'] . ' credits remaining');
            $sheet->setCellValue('E' . $row, $status['status']);
            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray([
                'font' => ['bold' => true],
            ]);
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'J') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Set row height for leave types column
        $sheet->getRowDimension(4)->setRowHeight(20);
        foreach (range(5, $row - 1) as $r) {
            $sheet->getRowDimension($r)->setRowHeight(40);
        }

        // Set vertical alignment for leave types column
        $sheet->getStyle('H5:H' . ($row - 1))->getAlignment()->setVertical(Alignment::VERTICAL_TOP);

        // Create writer and save to temporary file
        $writer = new Xlsx($spreadsheet);
        $filename = 'leave_credits_report_' . date('Y-m-d_H-i-s') . '.xlsx';
        $tempFile = sys_get_temp_dir() . '/' . $filename;
        $writer->save($tempFile);

        // Return file for download
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }

    public function exportReport(Request $request)
    {
        $employees = $this->companyReport($request)->original['employees'];
        $summary = $this->calculateSummary($employees);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename=leave_credits_report_' . date('Y-m-d') . '.xlsx',
        ];

        return response()->streamDownload(function () use ($employees, $summary) {
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Add summary
            $sheet->setCellValue('A1', 'Report Summary');
            $sheet->setCellValue('A2', 'Total Employees: ' . $summary['total_employees']);
            $sheet->setCellValue('A3', 'Total Credits: ' . $summary['total_credits']);
            $sheet->setCellValue('A4', 'Used Credits: ' . $summary['used_credits']);
            $sheet->setCellValue('A5', 'Remaining Credits: ' . $summary['remaining_credits']);
            $sheet->setCellValue('A6', 'Usage Percentage: ' . number_format($summary['percentage_used'], 1) . '%');
            $sheet->setCellValue('A7', 'Employees with Low Credits: ' . $summary['low_credit_employees'] . ' (' . number_format($summary['percentage_low_credits'], 1) . '%)');
            $sheet->setCellValue('A8', 'Employees with No Credits: ' . $summary['no_credit_employees'] . ' (' . number_format($summary['percentage_no_credits'], 1) . '%)');
            $sheet->setCellValue('A9', 'Employees with Overdrawn Credits: ' . $summary['overdrawn_employees'] . ' (' . number_format($summary['percentage_overdrawn'], 1) . '%)');

            // Add headers
            $headers = ['Employee', 'Department', 'Total Credits', 'Used Credits', 'Remaining Credits', 'Usage %', 'Status', 'Leave Types'];
            $sheet->fromArray([$headers], null, 'A11');

            // Add data
            $row = 12;
            foreach ($employees as $employee) {
                $sheet->setCellValue('A' . $row, $employee['name']);
                $sheet->setCellValue('B' . $row, $employee['department']);
                $sheet->setCellValue('C' . $row, $employee['total_credits']);
                $sheet->setCellValue('D' . $row, $employee['used_credits']);
                $sheet->setCellValue('E' . $row, $employee['remaining_credits']);
                $sheet->setCellValue('F' . $row, number_format($employee['percentage_used'], 1) . '%');
                $sheet->setCellValue('G' . $row, $employee['status']);
                
                // Add leave types as a string
                $leaveTypes = '';
                foreach ($employee['leave_types'] as $type) {
                    $leaveTypes .= $type['type'] . ': ' . $type['remaining'] . ' (' . $type['status'] . ')\n';
                }
                $sheet->setCellValue('H' . $row, $leaveTypes);
                
                $row++;
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'leave_credits_report_' . date('Y-m-d') . '.xlsx', $headers);
    }

    public function updateSIL(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'days_taken' => 'required|integer|min:1',
            'date' => 'required|date'
        ]);

        $employee = User::findOrFail($validated['employee_id']);
        $credit = LeaveCredit::where('employee_id', $employee->id)
            ->where('leave_type', 'service_incentive')
            ->first();

        if (!$credit || $credit->remaining_credits < $validated['days_taken']) {
            return response()->json([
                'error' => 'Insufficient SIL days remaining'
            ], 422);
        }

        // Update credit
        $credit->updateSIL($validated['days_taken']);

        // Create log
        ServiceIncentiveLog::create([
            'employee_id' => $validated['employee_id'],
            'date_taken' => $validated['date'],
            'days_taken' => $validated['days_taken'],
            'amount_paid' => $credit->calculateSILValue()
        ]);

        return response()->json([
            'message' => 'SIL updated successfully',
            'remaining_days' => $credit->remaining_credits
        ]);
    }

    public function companyReportSIL(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'nullable|exists:departments,id',
            'date_range' => 'nullable|array',
            'date_range.*' => 'date',
            'status' => 'nullable|string',
            'sort_by' => 'nullable|string',
            'order' => 'nullable|string|in:asc,desc'
        ]);

        $query = User::query()->with(['leaveCredits']);

        if ($validated['department_id']) {
            $query->whereHas('department', function ($q) use ($validated) {
                $q->where('id', $validated['department_id']);
            });
        }

        if (isset($validated['date_range'])) {
            $query->whereHas('leaveCredits', function ($q) use ($validated) {
                $q->whereBetween('effective_date', $validated['date_range']);
            });
        }

        $users = $query->get();
        $employees = [];

        foreach ($users as $user) {
            $leaveCredits = $user->leaveCredits;
            $totalCredits = $user->total_credits;
            $totalUsedCredits = $user->total_used_credits;
            $totalRemainingCredits = $totalCredits - $totalUsedCredits;
            $percentageUsed = $totalCredits > 0 ? ($totalUsedCredits / $totalCredits) * 100 : 0;

            // Get SIL balance
            $silCredit = $leaveCredits->where('leave_type', 'service_incentive')->first();
            $silBalance = $silCredit ? $silCredit->remaining_credits : 0;
            $silValue = $silCredit ? $silCredit->calculateSILValue() : 0;

            $employees[] = [
                'id' => $user->id,
                'name' => $user->name,
                'department' => $user->department ? $user->department->name : 'No Department',
                'total_credits' => $totalCredits,
                'used_credits' => $totalUsedCredits,
                'remaining_credits' => $totalRemainingCredits,
                'sil_balance' => $silBalance,
                'sil_value' => $silValue,
                'percentage_used' => $percentageUsed,
                'leave_types' => $leaveCredits->map(function ($credit) {
                    return [
                        'type' => $credit->leave_type,
                        'total' => $credit->total_credits,
                        'used' => $credit->used_credits,
                        'remaining' => $credit->remaining_credits
                    ];
                })
            ];
        }

        return response()->json([
            'employees' => $employees,
            'total_employees' => count($employees)
        ]);
    }

    public function checkCredits(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id',
            'leave_type' => 'required|in:sick,vacation,maternity,paternity'
        ]);

        $credit = LeaveCredit::where('employee_id', $validated['employee_id'])
            ->where('leave_type', $validated['leave_type'])
            ->first();

        if (!$credit) {
            return response()->json([
                'error' => 'No leave credit record found'
            ], 404);
        }

        return response()->json([
            'total_credits' => $credit->total_credits,
            'used_credits' => $credit->used_credits,
            'remaining_credits' => $credit->remaining_credits,
            'status' => $this->getCreditStatus($credit->total_credits, $credit->remaining_credits)
        ]);
    }

    private function calculateSummary($employees)
    {
        $totalCredits = 0;
        $usedCredits = 0;
        $remainingCredits = 0;
        $lowCredits = 0;
        $noCredits = 0;
        $overdrawn = 0;

        foreach ($employees as $employee) {
            $totalCredits += $employee['total_credits'];
            $usedCredits += $employee['used_credits'];
            $remainingCredits += $employee['remaining_credits'];

            if ($employee['status'] === 'Low credits remaining') {
                $lowCredits++;
            }
            if ($employee['status'] === 'No credits assigned') {
                $noCredits++;
            }
            if ($employee['status'] === 'Overdrawn credits') {
                $overdrawn++;
            }
        }

        $totalEmployees = count($employees);
        $percentageUsed = $totalCredits > 0 ? ($usedCredits / $totalCredits) * 100 : 0;
        $percentageLowCredits = $totalEmployees > 0 ? ($lowCredits / $totalEmployees) * 100 : 0;
        $percentageNoCredits = $totalEmployees > 0 ? ($noCredits / $totalEmployees) * 100 : 0;
        $percentageOverdrawn = $totalEmployees > 0 ? ($overdrawn / $totalEmployees) * 100 : 0;

        return [
            'total_employees' => $totalEmployees,
            'total_credits' => $totalCredits,
            'used_credits' => $usedCredits,
            'remaining_credits' => $remainingCredits,
            'percentage_used' => $percentageUsed,
            'percentage_low_credits' => $percentageLowCredits,
            'percentage_no_credits' => $percentageNoCredits,
            'percentage_overdrawn' => $percentageOverdrawn,
            'low_credit_employees' => $lowCredits,
            'no_credit_employees' => $noCredits,
            'overdrawn_employees' => $overdrawn
        ];
    }

    private function getOverallStatus(array $leaveTypes): string
    {
        foreach ($leaveTypes as $type) {
            if ($type['status'] === 'Low credits remaining') {
                return 'low';
            }
        }
        return 'normal';
    }

    private function getCreditStatus(int $totalCredits, int $remainingCredits): string
    {
        if ($totalCredits === 0) {
            return 'No credits assigned';
        }

        $percentageRemaining = ($remainingCredits / $totalCredits) * 100;

        if ($percentageRemaining < 20) {
            return 'Low credits remaining';
        }

        return 'Normal';
    }
}
