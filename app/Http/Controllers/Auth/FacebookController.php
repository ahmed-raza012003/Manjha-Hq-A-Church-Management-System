<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class FacebookController extends Controller
{
    /**
     * Redirect to Facebook authentication page.
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Handle Facebook callback for login and signup.
     */
    public function handleFacebookCallback()
    {
        try {
            // Retrieve user information from Facebook
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            // Check if the user already exists in your database
            $user = User::where('email', $facebookUser->getEmail())->first();

            if (!$user) {
                // User does not exist, create a new user
                $user = User::create([
                    'church_name' => 'Your Default Church Name', // Replace with dynamic value if needed
                    'first_name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'google_id' => null,
                    'facebook_id' => $facebookUser->getId(),
                    'password' => Hash::make(uniqid()), // Temporary password
                ]);
            }

            // Log the user in
            Auth::login($user);

            // Redirect to home or dashboard
            return redirect()->route('home');
        } catch (\Exception $e) {
            // Handle error and redirect to login page with an error message
            return redirect()->route('login')->with('error', 'Failed to authenticate with Facebook.');
        }
    }
}
