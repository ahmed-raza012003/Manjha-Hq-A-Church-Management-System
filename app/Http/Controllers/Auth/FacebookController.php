<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Providers\RouteServiceProvider;

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
            $facebookUser = Socialite::driver('facebook')->stateless()->user();
    
            $user = User::where('email', $facebookUser->getEmail())->first();
    
            if (!$user) {
                session(['social_user' => [
                    'first_name' => $facebookUser->getName(),
                    'email' => $facebookUser->getEmail(),
                    'facebook_id' => $facebookUser->getId(),
                    'provider' => 'facebook',
                ]]);
    
                return redirect()->route('auth.church_name');
            }
    
            if (!$user->facebook_id) {
                $user->update(['facebook_id' => $facebookUser->getId()]);
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
            return redirect()->route('login')->with('error', 'Failed to authenticate with Facebook.');
        }
    }
}
