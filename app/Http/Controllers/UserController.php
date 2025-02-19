<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'super admin')->pluck('name', 'id');
        $churchName = auth()->user()->church_name;  
        return view('users.create', compact('roles', 'churchName'));
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:8',
        'role' => 'required|exists:roles,id',
    ]);

    $authUser = Auth::user(); // Get the logged-in user

    // Create a new user
    $user = User::create([
        'first_name' => $request->first_name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'stripe_customer_id' => $authUser->stripe_customer_id,
        'stripe_subscription_id' => $authUser->stripe_subscription_id,
        'package_id' => $authUser->package_id,
        'subscription_ends_at' => $authUser->subscription_ends_at,
        'church_name' => $authUser->church_name,
    ]);

    // Assign Role using Spatie Role System
    $role = Role::find($request->role);
    if ($role) {
        $user->assignRole($role->name);
    }

    // Store the subscription details in the subscriptions table
    \DB::table('subscriptions')->insert([
        'user_id' => $user->id,
        'package_id' => $authUser->package_id,
        'status' => 'active', // Assuming new users get an active subscription
        'expires_at' => $authUser->subscription_ends_at,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully!');
}

    public function edit(User $user)
    {
        $roles = Role::where('name', '!=', 'super admin')->pluck('name', 'id');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,id',
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'email' => $request->email,
        ]);

        // Update role correctly
        $role = Role::find($request->role);
        if ($role) {
            $user->syncRoles($role->name);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
