<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;

class COERequestController extends Controller
{
    public function create(Request $request)
    {
        $employees = User::all();
        return view('pages.hr.coe_requests.create', compact('employees'));
    }

    public function store(Request $request)
    {
        
    }

    public function generateCOE(Request $request)
    {
        // Ensure the loan documents directory exists
        $loanDocumentsPath = storage_path('app/coe_documents/' . $request->employee_id);
        if (!file_exists($loanDocumentsPath)) {
            mkdir($loanDocumentsPath, 0755, true);
        }

        // Load the template
        $templatePath = storage_path('template/Certificate-of-Employment.docx');
        if (!file_exists($templatePath)) {
            throw new \Exception('Certificate of Employment template not found');
        }

        $employee = User::find($request->employee_id);

        // Create TemplateProcessor instance
        $templateProcessor = new TemplateProcessor($templatePath);

        // Prepare data to replace placeholders
        $data = [
            'fullname' => $employee->name,
            'position' => $request->position,
            'date' => Carbon::parse($request->date)->format('M d Y'),
            'wage_word' => $request->wage_word,
            'wage_peso' => number_format($request->wage_peso, 2),
            'day' => $request->day,
            'month_year' => $request->month_year,
            'city' => $request->city,
        ];

        // Replace placeholders with actual data
        foreach ($data as $key => $value) {
            $templateProcessor->setValue($key, $value);
        }

        // Save as DOCX first
        $docxPath = $loanDocumentsPath . '/certificate_of_employment.docx';
        $templateProcessor->saveAs($docxPath);

        // Convert to PDF using LibreOffice
        $outputPath = $loanDocumentsPath . '/certificate_of_employment.pdf';
        $command = sprintf(
            'soffice --headless --convert-to pdf --outdir %s %s',
            escapeshellarg($loanDocumentsPath),
            escapeshellarg($docxPath)
        );

        exec($command, $output, $returnVar);
        
        if ($returnVar !== 0) {
            throw new \Exception('Failed to convert document to PDF: ' . implode(', ', $output));
        }

        // Return the PDF file as a download
        if (file_exists($outputPath)) {
            return response()->download($outputPath, 'certificate_of_employment.pdf', [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="certificate_of_employment.pdf"'
            ])->deleteFileAfterSend(true);
        }

        throw new \Exception('Failed to generate PDF file');
    }
}
