<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    // Display form to create contributions
    public function create()
    {
        $members = Member::all(); // Fetch all members
        return view('dashboard.contributions.create', compact('members'));
    }

    // Store contributions in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'contributions' => 'required|array|min:1',
            'contributions.*.member_id' => 'nullable|exists:members,id',
            'contributions.*.payment_method' => 'required|string',
            'contributions.*.date' => 'required|date',
            'contributions.*.amount' => 'required|numeric|min:0.01',
            'contributions.*.fund' => 'required|string',
        ]);

        // Generate a unique batch ID
        $batchId = uniqid('batch_');

        foreach ($validated['contributions'] as $contribution) {
            Contribution::create([
                'member_id' => $contribution['member_id'],
                'payment_method' => $contribution['payment_method'],
                'date' => $contribution['date'],
                'amount' => $contribution['amount'],
                'fund' => $contribution['fund'],
                'batch_id' => $batchId,
            ]);
        }

        return redirect()->route('contributions.index')->with('success', 'Contributions added successfully!');
    }

    // Display all contributions with filters
    public function index(Request $request)
    {
        $query = Contribution::with('member');

        // Apply filters if present
        if ($request->filled('search')) {
            $query->whereHas('member', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('fund')) {
            $query->where('fund', $request->fund);
        }

        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('date', [$request->from, $request->to]);
        }

        // Get total amount and contributors count
        $totalAmount = $query->sum('amount');
        $totalContributors = $query->distinct('member_id')->count('member_id');

        // Paginate results
        $contributions = $query->paginate(10);

        return view('dashboard.contributions.index', compact('contributions', 'totalAmount', 'totalContributors'));
    }
}
