<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Roles that should NOT be checked for a subscription
        $excludedRoles = ['event manager', 'financial officer', 'volunteer coordinator', 'church administrator'];

        // If user has one of the excluded roles, allow access without checking subscription
        if ($user->hasAnyRole($excludedRoles)) {
            return $next($request);
        }

        // If the user is a superadmin, check for an active subscription
        if ($user->hasRole('superadmin') && !$user->hasActiveSubscription()) {
            return redirect()->route('packages.index')->with('error', 'Superadmin must have an active subscription to access the dashboard.');
        }

        // If the user has NO roles, check for an active subscription
        if ($user->roles->isEmpty() || $user->roles == null) {
            if (!$user->hasActiveSubscription()) {
                return redirect()->route('packages.index')->with('error', 'You must purchase a package to access the dashboard.');
            }
        }

        return $next($request);
    }
}
