<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Event;
use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $package = $user->package();
    
        // Fetch events and format start and end times
        $events = Event::all()->map(function ($event) {
            $event->start_time = Carbon::parse($event->start_time);
            $event->end_time = Carbon::parse($event->end_time);
            return $event;
        });
    
        // Fetch counts for members, users, and groups
        $membersCount = Member::where('user_id', $user->id)->count();
        $usersCount = User::count();
        $groupsCount = Group::where('user_id', $user->id)->count();
    
        // Fetch max limits based on the user's package
        $maxMembers = $user->maxLimit('max_members');
        $maxGroups = $user->maxLimit('max_groups');
    
        // Check if the user can manage members
        $canManageMembers = $user->hasFeature('can_manage_members');
    
        // Fetch total contributions
        $totalContribution = Contribution::sum('amount');
    
        // Fetch last month's total contribution
        $lastMonthContribution = Contribution::whereMonth('created_at', now()->subMonth()->month)->sum('amount');
    
        return view('dashboard.dashboard_main', compact(
            'events', 
            'membersCount', 
            'usersCount', 
            'groupsCount', 
            'maxMembers', 
            'maxGroups', 
            'canManageMembers', 
            'totalContribution', 
            'lastMonthContribution'
        ));
    }
    
}
