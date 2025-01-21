<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    /**
     * Redirect to Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google callback for login and signup.
     */
    public function handleGoogleCallback()
    {
        try {
            // Retrieve user information from Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user already exists in your database
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'church_name' => 'Your Default Church Name', // Replace if necessary
                    'first_name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(uniqid()), // Temporary password
                ]);
            } else {
                // Update existing user with Google ID if not already set
                if (!$user->google_id) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                    ]);
                }
            }
            

            // Log the user in
            Auth::login($user);

            // Redirect to home or dashboard
            return redirect()->route('/');
        } catch (\Exception $e) {
            // Handle error and redirect to login page with an error message
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google.');
        }
    }
}
