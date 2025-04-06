<?php

namespace App\Http\Controllers;

use App\Models\ConcernLetter;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConcernLetterController extends Controller
{
    public function index()
    {
        $letters = ConcernLetter::with(['user', 'issuer', 'approver'])
            ->when(request('status'), function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when(request('type'), function ($query, $type) {
                return $query->where('type', $type);
            })
            ->orderBy('date_issued', 'desc')
            ->paginate(10);

        return view('pages.hr.concern_letters.index', [
            'letters' => $letters,
            'types' => ['warning', 'suspension', 'termination']
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        return view('pages.hr.concern_letters.create', compact('user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'return_date' => 'nullable|date'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['issued_by'] = Auth::id();
        $validated['status'] = 'pending'; // Automatically set to pending
        $validated['date_issued'] = now(); // Automatically set current date

        ConcernLetter::create($validated);

        return redirect()->route('concern-letters.index')->with('success', 'Concern submitted successfully.');
    }

    public function show(ConcernLetter $letter)
    {
        return view('pages.hr.concern_letters.show', compact('letter'));
    }

    public function edit(ConcernLetter $letter)
    {
        return view('pages.hr.concern_letters.edit', compact('letter'));
    }

    public function update(Request $request, ConcernLetter $letter)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'return_date' => 'nullable|date'
        ]);

        $letter->update($validated);

        return redirect()->route('concern-letters.index')->with('success', 'Concern updated successfully.');
    }

    public function approve(ConcernLetter $letter)
    {
        $letter->update([
            'status' => 'accepted',
            'approved_by' => Auth::id()
        ]);

        return redirect()->route('concern-letters.index')->with('success', 'Concern approved successfully.');
    }

    public function reject(ConcernLetter $letter)
    {
        $letter->update([
            'status' => 'rejected',
            'approved_by' => Auth::id()
        ]);

        return redirect()->route('concern-letters.index')->with('success', 'Concern rejected successfully.');
    }

    public function generatePdf(ConcernLetter $letter)
    {
        $pdf = Pdf::loadView('pages.hr.concern_letters.pdf', [
            'letter' => $letter,
            'user' => $letter->user,
            'issuer' => $letter->issuer,
            'approver' => $letter->approver
        ]);

        return $pdf->download('concern_' . $letter->id . '.pdf');
    }
}
