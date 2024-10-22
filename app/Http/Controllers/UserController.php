<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of the users
     public function index()
    {
        // Fetch all users
        $users = User::all(); // or you can paginate with User::paginate(10);

        // Pass the $users variable to the view
        return view('users.index', compact('users'));
    }
    // Show the form for creating a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|string',  // Example role field
            'is_active' => 'boolean'
        ]);

        // Create a new user instance and save it to the database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Encrypt the password
            'role' => $request->role,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing a specific user
    public function edit($id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // Update the specified user in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ignore current user's email
            'password' => 'nullable|min:8|confirmed',
            'role' => 'required|string',
            'is_active' => 'boolean'
        ]);

        // Find the user and update its data
        $user = User::findOrFail($id);

        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->is_active = $request->has('is_active') ? 1 : 0;

        // If a new password is provided, hash it and save
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the changes to the user
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete the specified user from the database
    public function destroy($id)
    {
        // Find the user and delete it
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
