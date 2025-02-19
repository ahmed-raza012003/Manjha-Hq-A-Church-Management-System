<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  // Import User model

class CheckMemberManagementPackage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the currently authenticated user and cast it to User model
        $user = Auth::user();

        if ($user instanceof User) { // Ensure it's an instance of the User model
            // Check if the user has a package that allows member management
            if (!$this->canManageMembers($user)) {
                // If the user doesn't have the right package, redirect them or return an error
                return redirect()->route('packages.index')->with('error', 'Your package does not allow member management.');
            }
        }

        return $next($request);
    }

    /**
     * Check if the user’s package allows member management.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    protected function canManageMembers(User $user)
    {
        $allowedPackages = ['Small', 'Medium', 'Large', 'Unlimited'];
    
        // Ensure the user has an active subscription and a package
        if ($user->package) {
            return in_array($user->package->name, $allowedPackages);
        }
    
        return false;
    }
    
    
}
