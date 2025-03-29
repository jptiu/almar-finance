<?php

namespace App\Exports;

use App\Models\Loan;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;

class LoanSummaryExport
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function generate()
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        
        $section->addText(
            'ALMAR FREEMILE FINANCING CORPORATION',
            ['bold' => true, 'size' => 16]
        );

        $section->addText(
            auth()->user()->branch->location,
            ['bold' => true, 'size' => 16]
        );

        $section->addText(
            'Loan Summary Report',
            ['bold' => true, 'size' => 12, 'align' => 'right']
        );
        
        // Add date range
        $section->addText(
            'Date Range: ' . $this->startDate . ' to ' . $this->endDate,
            ['bold' => true, 'size' => 12, 'align' => 'right']
        );
        
        // Add table
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999']);
        
        // Add headings
        $table->addRow();
        $headings = [
            'Trans #',
            'Customer Name',
            'Customer Type',
            'Mos',
            'Type',
            'Address',
            'Loan Amount',
            'Interest Rate',
            'Interest Amount',
            'Net Release',
        ];
        
        foreach ($headings as $heading) {
            $table->addCell(2000)->addText($heading, ['bold' => true]);
        }
        
        // Add data
        $loans = Loan::with(['customer', 'customer.customerType'])
            ->whereBetween('date_of_loan', [
                $this->startDate,
                $this->endDate
            ])
            ->get();
        
        foreach ($loans as $loan) {
            $table->addRow();
            $table->addCell(2000)->addText($loan->id, ['size' => 10]);
            $table->addCell(2000)->addText($loan->customer->first_name . ' ' . $loan->customer->last_name, ['size' => 10]);
            $table->addCell(2000)->addText($loan->customer->customerType->description, ['size' => 10]);
            $table->addCell(2000)->addText($loan->months_to_pay, ['size' => 10]);
            $table->addCell(2000)->addText($loan->transaction_type, ['size' => 10]);
            $table->addCell(2000)->addText(
                $loan->customer->house . ', ' .
                $loan->customer->street . ', ' .
                $loan->customer->barangay_name . ', ' .
                $loan->customer->city_town,
                ['size' => 10]
            );
            $table->addCell(2000)->addText(number_format($loan->principal_amount, 2), ['size' => 10]);
            $table->addCell(2000)->addText($loan->interest_rate, ['size' => 10]);
            $table->addCell(2000)->addText(number_format($loan->interest_amount, 2), ['size' => 10]);
            $table->addCell(2000)->addText(number_format($loan->principal_amount - $loan->interest_amount, 2), ['size' => 10]);
        }
        
        return $phpWord;
    }
}
