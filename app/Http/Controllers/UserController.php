<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('super_access'), 404);
        $users = User::get();

        return view('users.index', compact('users'));
    }


    public function store(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'status' => 'required|string',
            'file' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Handle file upload and encode to Base64
        $signatureBase64 = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $signatureBase64 = base64_encode(file_get_contents($file));
        }

        // Create user with role
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'signature' => $signatureBase64, // Save Base64 string
        ]);

        if($request->status == 'Super Admin'){
            User::findOrFail($user->id)->roles()->sync(1);
        }else if($request->status == 'Admin'){
            User::findOrFail($user->id)->roles()->sync(2);
        }else if($request->status == 'HR'){
            User::findOrFail($user->id)->roles()->sync(3);
        }else if($request->status == 'Branch Manager'){
            User::findOrFail($user->id)->roles()->sync(4);
        }else if($request->status == 'Loan Officer'){
            User::findOrFail($user->id)->roles()->sync(5);
        }else if($request->status == 'Auditor'){
            User::findOrFail($user->id)->roles()->sync(6);
        }else {
            User::findOrFail($user->id)->roles()->sync(7);
        }

        return redirect()->route('useracc.index')->with('success', 'User created successfully!');
    }
}
