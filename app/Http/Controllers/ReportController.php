<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display reports for members, contributions, assets, and groups.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Example data for Members with pagination
        $members = \App\Models\Member::paginate(10);  
        $totalmembers = \App\Models\Member::count();  
    
        $activeMembers = \App\Models\Member::where('member_status', 'active')->count();
        $inactiveMembers = \App\Models\Member::where('member_status', 'inactive')->count();
        $newMembersThisMonth = \App\Models\Member::whereMonth('created_at', now()->month)->count();
        $membersUpdatedDate = \App\Models\Member::latest()->first()->updated_at ?? now(); // Last updated date
        
        // Fetch the most recent members for the report table
        $recentMembers = \App\Models\Member::latest()->take(5)->get();
        
        // Contributions data with pagination
        $contributions = \App\Models\Contribution::paginate(10);  
        $totalContributions = \App\Models\Contribution::sum('amount');  // Total contributions across all records
        $averageContribution = \App\Models\Contribution::avg('amount');
        $highestContribution = \App\Models\Contribution::max('amount');
        $lastContribution = \App\Models\Contribution::latest()->first()->amount ?? 0;
        $contributionsUpdatedDate = \App\Models\Contribution::latest()->first()->updated_at ?? now(); // Last updated date
        
        // Fetch the most recent contributions for the report table
        $recentContributions = \App\Models\Contribution::latest()->take(5)->get();
        
        // Assets data with pagination
        $totalassets = \App\Models\Asset::count();  
        $assets = \App\Models\Asset::paginate(10);  
        $currentAssetValue = \App\Models\Asset::sum('price');  // Total current asset value across all records
        $assetsAddedThisMonth = \App\Models\Asset::whereMonth('created_at', now()->month)->count();
        $assetsUpdatedDate = \App\Models\Asset::latest()->first()->updated_at ?? now(); // Last updated date
        
        // Fetch the most recent assets for the report table
        $recentAssets = \App\Models\Asset::latest()->take(5)->get();
        
        // Groups data with pagination
        $groups = \App\Models\Group::paginate(10);  
        $totalgroups = \App\Models\Group::count();  

        $newGroupsThisMonth = \App\Models\Group::whereMonth('created_at', now()->month)->count();
        $totalGroups = \App\Models\Group::count();  // Total groups across all records
        $groupsUpdatedDate = \App\Models\Group::latest()->first()->updated_at ?? now(); // Last updated date
        
        // Fetch the most recent groups for the report table
        $recentGroups = \App\Models\Group::latest()->take(5)->get();
        
        return view('dashboard.reports.index', compact(
            'members', 'activeMembers', 'inactiveMembers', 'newMembersThisMonth', 'membersUpdatedDate',
            'contributions', 'totalContributions', 'averageContribution', 'highestContribution', 'lastContribution', 'contributionsUpdatedDate',
            'assets', 'currentAssetValue', 'assetsAddedThisMonth', 'assetsUpdatedDate',
            'groups', 'newGroupsThisMonth', 'groupsUpdatedDate', 'totalGroups',
            'recentMembers', 'recentContributions', 'recentAssets', 'recentGroups', 'totalmembers', 'totalassets','totalgroups'
        ));
    }
    
    
    public function integrations()
    {
        return view('dashboard.integrations.index');
    }
}
