<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog; // Import the AuditLog model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('users.create');
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the action
        $this->logAction('create', User::class, $user->id);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    // Show the form for editing the specified user
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update the specified user in storage
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Log the action
        $this->logAction('update', User::class, $user->id);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from storage
    public function destroy(User $user)
    {
        $user->delete();

        // Log the action
        $this->logAction('delete', User::class, $user->id);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    // Log action method
    protected function logAction($action, $modelType, $modelId)
    {
        $log = new AuditLog();
        $log->user_id = auth()->id(); // Assuming user is authenticated
        $log->action = $action;
        $log->model_type = $modelType;
        $log->model_id = $modelId;
        $log->save();
    }
}