<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialLoanRequestStoreRequest;
use App\Models\SocialLoanRequest;
use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Gate;

class SocialLoanRequestController extends Controller
{
    public function index()
    {
        $requests = SocialLoanRequest::with(['user', 'approvedBy', 'rejectedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('social_loan_requests.index', compact('requests'));
    }

    public function create()
    {
        return view('social_loan_requests.create');
    }

    public function store(SocialLoanRequestStoreRequest $request)
    {
        $validated = $request->validated();

        $loanRequest = SocialLoanRequest::create([
            'user_id' => auth()->user()->id,
            'loan_type' => $validated['loan_type'],
            'amount_requested' => $validated['amount_requested'],
            'purpose' => $validated['purpose'],
            'status' => 'pending'
        ]);

        $log = new ActivityLog();
        $log->user_id = auth()->user()->id;
        $log->description = auth()->user()->name . ' submitted a social loan request.';
        $log->save();

        return redirect()->route('social_loan_requests.index')
            ->with('success', 'Loan request submitted successfully');
    }

    public function approve(Request $request, SocialLoanRequest $socialLoanRequest)
    {
        if (!Gate::check('hr_access')) {
            abort(403);
        }

        $socialLoanRequest->update([
            'status' => 'approved',
            'approved_by' => auth()->id(),
            'remarks' => $request->remarks
        ]);

        $log = new ActivityLog();
        $log->user_id = auth()->id();
        $log->description = auth()->user()->name . ' approved social loan request #' . $socialLoanRequest->id;
        $log->save();

        return redirect()->route('social_loan_requests.index')
            ->with('success', 'Loan request approved successfully');
    }

    public function reject(Request $request, SocialLoanRequest $socialLoanRequest)
    {
        if (!Gate::check('hr_access')) {
            abort(403);
        }

        $socialLoanRequest->update([
            'status' => 'rejected',
            'rejected_by' => auth()->id(),
            'remarks' => $request->remarks
        ]);

        $log = new ActivityLog();
        $log->user_id = auth()->id();
        $log->description = auth()->user()->name . ' rejected social loan request #' . $socialLoanRequest->id;
        $log->save();

        return redirect()->route('social_loan_requests.index')
            ->with('success', 'Loan request rejected successfully');
    }
}
