<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditRequestStoreRequest;
use App\Models\EditRequest;
use App\Models\Loan;
use App\Services\LoanEditService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EditRequestController extends Controller
{
    protected $loanEditService;

    public function __construct(LoanEditService $loanEditService)
    {
        $this->loanEditService = $loanEditService;
    }

    public function store(Request $request, $loanId)
    {
        try {
            abort_unless(Gate::allows('loan_access'), 403);

            $validator = Validator::make($request->all(), [
                'date' => 'required|date',
                'time' => 'required|date_format:H:i',
                'reason' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $loan = Loan::findOrFail($loanId);

            $editRequest = EditRequest::create([
                'loan_id' => $loanId,
                'user_id' => auth()->id(),
                'requested_date' => $request->date,
                'requested_time' => $request->time,
                'reason' => $request->reason,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Edit request submitted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request: ' . $e->getMessage()
            ], 500);
        }
    }

    public function index()
    {
        abort_unless(Gate::allows('admin_access'), 403);

        $editRequests = EditRequest::with(['loan', 'user'])
            ->where('status', 'pending')
            ->get();

        return view('pages.loan.edit-requests.index', compact('editRequests'));
    }

    public function approve(Request $request, $id)
    {
        abort_unless(Gate::allows('admin_access'), 403);

        $validator = Validator::make($request->all(), [
            'principal_amount' => 'nullable|numeric|min:0',
            'interest' => 'nullable|numeric|min:0',
            'months_to_pay' => 'nullable|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $editRequest = EditRequest::findOrFail($id);
            
            // Get the loan updates from the request
            $updates = $request->only(['principal_amount', 'interest', 'months_to_pay']);
            
            // Process the edit request
            $this->loanEditService->processEditRequest($editRequest, $updates);

            return redirect()->back()->with('success', 'Edit request approved and loan updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to process edit request: ' . $e->getMessage());
        }
    }

    public function decline(Request $request, $id)
    {
        abort_unless(Gate::allows('admin_access'), 403);

        $editRequest = EditRequest::findOrFail($id);
        $editRequest->update([
            'status' => 'declined',
            'declined_reason' => $request->input('declined_reason', 'No reason provided')
        ]);

        return redirect()->back()->with('success', 'Edit request declined successfully');
    }
}
