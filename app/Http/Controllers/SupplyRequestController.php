<?php

namespace App\Http\Controllers;

use App\Models\SupplyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class SupplyRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = SupplyRequest::query()
            ->with('user')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search . '%')
                        ->orWhere('description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->status_filter, function ($query) use ($request) {
                $query->where('status', $request->status_filter);
            })
            ->where('branch_id', auth()->user()->branch_id);

        $sortMap = [
            'created_at_desc' => ['created_at', 'desc'],
            'created_at_asc' => ['created_at', 'asc'],
            'amount_desc' => ['amount', 'desc'],
            'amount_asc' => ['amount', 'asc'],
        ];

        $sort = $request->sort_by ?? 'created_at_desc';
        [$column, $direction] = $sortMap[$sort];
        $query->orderBy($column, $direction);

        $requests = $query->paginate(10);

        return view('pages.supply-request.index', compact('requests'));
    }

    public function create()
    {
        return view('pages.supply-request.create');
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
        ])->validate();

        SupplyRequest::create([
            'user_id' => Auth::id(),
            'branch_id' => Auth::user()->branch_id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'amount' => $validated['amount'],
            'status' => 'pending',
        ]);

        return redirect()->route('supply-request.index')->with('success', 'Supply request submitted successfully');
    }

    public function approve(SupplyRequest $supplyRequest)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('admin_access'), 404);

        $supplyRequest->update([
            'status' => 'approved',
            'approval_notes' => request()->get('approval_notes')
        ]);

        return redirect()->route('supply-request.index')->with('success', 'Supply request approved successfully');
    }

    public function reject(SupplyRequest $supplyRequest)
    {
        abort_unless(Gate::allows('loan_access') || Gate::allows('admin_access'), 404);

        $supplyRequest->update([
            'status' => 'rejected',
            'approval_notes' => request()->get('rejection_notes')
        ]);

        return redirect()->route('supply-request.index')->with('success', 'Supply request rejected successfully');
    }
}
