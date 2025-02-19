<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            $request->session()->regenerate();
        
            $user = Auth::user();
    
            if (!$user->church_name) {
                return redirect()->route('auth.church_name')->with('error', 'Please provide a church name to continue.');
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
            return redirect()->route(route: 'welcome')->with('success', 'Welcome to your dashboard!');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Failed to authenticate.');
        }
    }
    


    

    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
