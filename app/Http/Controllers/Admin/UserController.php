<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Get all users with their order count
        $users = User::withCount('orders')->get();

        return view('admin.user.index', compact('users'));
    }
    public function show(User $user)
    {
        $user->loadCount('orders');
        return view('admin.user.view', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20|unique:users,phone,' . $user->id,
            'role' => 'required|in:user,admin,delivery',
            'active' => 'required|boolean',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users', $user->id)->with('success', 'User updated successfully.');
    }
}
