<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Providers\RouteServiceProvider;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() 
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();
    
            if (!$user) {
                session(['social_user' => [
                    'first_name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'provider' => 'google',
                ]]);
    
                return redirect()->route('auth.church_name');
            }
    
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }
    
            if (!$user->church_name) {
                session(['user_id' => $user->id]);
                return redirect()->route('auth.church_name');
            }
    
            if (!$user->hasActiveSubscription()) {
                return redirect()->route('packages.index')->with('error', 'You need a subscription to access the dashboard.');
            }
            Auth::login($user);

            if ($user->roles->isEmpty()) {
                $user->assignRole('super admin');
            }

            // Store user credentials for auto-login
            session(['user_credentials' => [
                'email' => $user->email
            ]]);

            Auth::login($user);

            return redirect()->route('welcome')->with('success', 'Subscription successful! Welcome to your dashboard.');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate with Google.');
        }
    }
}
