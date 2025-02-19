<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class ChurchNameController extends Controller
{
    public function showForm()
    {
        return view('auth.church_name');
    }

    public function store(Request $request)
    {
        $request->validate([
            'church_name' => 'required|string|max:255|unique:users,church_name'
        ]);

        if (session()->has('social_user')) {
            // Retrieve stored social user details
            $data = session('social_user');

            // Determine provider-specific field
            $providerIdField = $data['provider'] . '_id';
            $providerIdValue = $data['provider'] === 'google' ? $data['google_id'] : $data['facebook_id'];

            // Create new user with social details
            $user = User::create([
                'first_name' => $data['first_name'],
                'email' => $data['email'],
                'church_name' => $request->church_name,
                $providerIdField => $providerIdValue,
                'password' => bcrypt(uniqid()), // Temporary password
            ]);

            session()->forget('social_user');
        } else {
            // Retrieve existing user from session
            $user = User::find(session('user_id'));

            if (!$user) {
                return redirect()->route('login')->with('error', 'User not found. Please log in again.');
            }

            // Update existing user with church name
            $user->update(['church_name' => $request->church_name]);

            session()->forget('user_id');
        }

        // Assign 'super admin' role if no role exists
        if ($user->roles->isEmpty()) {
            $user->assignRole('super admin');
        }

        // Auto-login the user
        Auth::login($user);

        // Redirect based on subscription status
        if (!$user->hasActiveSubscription()) {
            return redirect()->route('packages.index')->with('error', 'You need a subscription to access the dashboard.');
        }

        return redirect()->route('welcome')->with('success', 'Welcome! Your registration is complete.');
    }
}
