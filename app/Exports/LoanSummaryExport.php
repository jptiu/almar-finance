<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoanSummaryExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Loan::with(['customer', 'details'])
            ->whereBetween('date_of_loan', [
                $this->startDate, // Dates are already in mm/dd/yyyy format
                $this->endDate
            ])
            ->get();
    }

    public function headings(): array
    {
        return [
            'Loan ID',
            'Customer Name',
            'Customer Type',
            'Loan Date',
            'Principal Amount',
            'Payable Amount',
            'Status',
        ];
    }

    public function map($loan): array
    {
        return [
            $loan->id,
            $loan->customer->first_name . ' ' . $loan->customer->last_name,
            $loan->customer->customerType->description,
            $loan->date_of_loan,
            $loan->principal_amount,
            $loan->payable_amount,
            $loan->status,
        ];
    }
}
