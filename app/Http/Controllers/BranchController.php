<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::with('users')->get();
        return view('pages.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('pages.branches.add.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        Branch::create($request->only(['name', 'location', 'type']));
        return redirect()->route('branches.index')->with('success', 'Branch created successfully.');
    }

    public function assignUser(Request $request, Branch $branch)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);
        $user->branch_id = $branch->id;
        $user->save();

        return redirect()->route('branches.index')->with('success', 'User assigned to branch.');
    }
}
