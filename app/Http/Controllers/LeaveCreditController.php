<?php

namespace App\Http\Controllers;

use App\Models\LeaveCredit;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $query = User::with(['leaveCredits' => function($q) use ($filters) {
            if ($filters['start_date']) {
                $q->where('start_date', '>=', $filters['start_date']);
            }
            if ($filters['end_date']) {
                $q->where('end_date', '<=', $filters['end_date']);
            }
            if ($filters['leave_type']) {
                $q->where('leave_type', $filters['leave_type']);
            }
        }])->withCount([
            'leaveCredits as total_credits' => function($q) use ($filters) {
                if ($filters['start_date']) {
                    $q->where('start_date', '>=', $filters['start_date']);
                }
                if ($filters['end_date']) {
                    $q->where('end_date', '<=', $filters['end_date']);
                }
                if ($filters['leave_type']) {
                    $q->where('leave_type', $filters['leave_type']);
                }
            },
            'leaveCredits as total_used_credits' => function($q) use ($filters) {
                if ($filters['start_date']) {
                    $q->where('start_date', '>=', $filters['start_date']);
                }
                if ($filters['end_date']) {
                    $q->where('end_date', '<=', $filters['end_date']);
                }
                if ($filters['leave_type']) {
                    $q->where('leave_type', $filters['leave_type']);
                }
                $q->where('used_credits', '>', 0);
            }
        ]);

        // Apply filters
        if ($filters['department']) {
            $query->whereHas('department', function($q) use ($filters) {
                $q->where('name', $filters['department']);
            });
        }

        // Get the data
        $users = $query->get();

        // Process each user's leave credits
        $employees = [];
        $summary = $this->calculateSummary($users);

        foreach ($users as $user) {
            $leaveCredits = $user->leaveCredits;
            $totalCredits = $user->total_credits;
            $totalUsedCredits = $user->total_used_credits;
            $totalRemainingCredits = $totalCredits - $totalUsedCredits;
            $percentageUsed = $totalCredits > 0 ? ($totalUsedCredits / $totalCredits) * 100 : 0;

            // Calculate status
            $status = $this->getCreditStatus($totalCredits, $totalRemainingCredits);

            // Process leave types
            $leaveTypes = collect($leaveCredits)->groupBy('leave_type')->map(function($group) {
                $totalCredits = $group->sum('total_credits');
                $usedCredits = $group->sum('used_credits');
                $remainingCredits = $totalCredits - $usedCredits;
                $percentageUsed = $totalCredits > 0 ? ($usedCredits / $totalCredits) * 100 : 0;
                $typeStatus = $this->getCreditStatus($totalCredits, $remainingCredits);
                
                return [
                    'leave_type' => $group[0]->leave_type,
                    'total_credits' => $totalCredits,
                    'used_credits' => $usedCredits,
                    'remaining_credits' => $remainingCredits,
                    'percentage_used' => $percentageUsed,
                    'status' => $typeStatus
                ];
            })->values()->toArray();

            $employees[] = [
                'id' => $user->id,
                'name' => $user->name,
                'department' => $user->department ? $user->department->name : 'No Department',
                'total_credits' => $totalCredits,
                'used_credits' => $totalUsedCredits,
                'remaining_credits' => $totalRemainingCredits,
                'percentage_used' => $percentageUsed,
                'status' => $status,
                'leave_types' => $leaveTypes
            ];
        }

        // Sort the results
        $sort = $request->input('sort', 'name');
        $direction = $request->input('direction', 'asc');

        $employees = collect($employees)->sortBy($sort, SORT_REGULAR, $direction === 'desc')
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
            'Leave Types'
        ];
        $headerRow = 4;
        foreach ($headers as $index => $header) {
            $sheet->setCellValueByColumnAndRow($index + 1, $headerRow, $header);
        }

        // Style headers
        $sheet->getStyle('A4:H4')->applyFromArray([
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
                $leaveTypes .= $type['leave_type'] . ': ' . $type['remaining_credits'] . ' (' . $type['status'] . ')\n';
            }
            $sheet->setCellValueByColumnAndRow(8, $row, $leaveTypes);
            
            // Style data rows
            $sheet->getStyle('A' . $row . ':H' . $row)->applyFromArray([
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
            'Used Credits' => $summary['used_credits'],
            'Remaining Credits' => $summary['remaining_credits'],
            'Overall Usage Rate' => $summary['percentage_used'] . '%',
            'Employees with Low Credits' => $summary['low_credit_employees'],
            'Employees with No Credits' => $summary['no_credit_employees'],
            'Employees with Overdrawn Credits' => $summary['overdrawn_employees']
        ];

        foreach ($summaryMetrics as $metric => $value) {
            $sheet->setCellValue('A' . $row, $metric . ':');
            $sheet->setCellValue('B' . $row, $value);
            $sheet->getStyle('A' . $row . ':B' . $row)->applyFromArray([
                'font' => ['bold' => true],
            ]);
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'H') as $columnID) {
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
                    $leaveTypes .= $type['leave_type'] . ': ' . $type['remaining_credits'] . ' (' . $type['status'] . ')\n';
                }
                $sheet->setCellValue('H' . $row, $leaveTypes);
                
                $row++;
            }

            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'leave_credits_report_' . date('Y-m-d') . '.xlsx', $headers);
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

    private function getCreditStatus(int $totalCredits, int $remainingCredits): string
    {
        // If total credits is 0, we can't calculate percentage
        if ($totalCredits === 0) {
            return 'No credits assigned';
        }

        // Calculate percentage remaining
        $percentageRemaining = ($remainingCredits / $totalCredits) * 100;

        // Handle edge cases where remaining credits might be negative
        if ($remainingCredits < 0) {
            return 'Overdrawn credits';
        }

        // Handle cases where all credits are used
        if ($remainingCredits === 0) {
            return 'No credits remaining';
        }

        // Low credits warning threshold
        if ($percentageRemaining <= 20) {
            return 'Low credits remaining';
        }

        // Normal case
        return 'Credits available';
    }
}
