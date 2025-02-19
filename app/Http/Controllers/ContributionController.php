<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Contribution;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ContributionController extends Controller
{
    public function create()
{
    $user = auth()->user(); // Get the logged-in user
    $members = Member::where('user_id', $user->id)->get(); // Fetch members related to this user

   
    return view('dashboard.contributions.create', compact('members'));
}

    

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

    // Ensure user has a church name
    $user = auth()->user();
    if (!$user->church_name) {
        return back()->withErrors(['church_name' => 'You must have a church name to proceed.']);
    }

    // Attach church_name to each contribution
    $contributions = array_map(function ($contribution) use ($user) {
        $contribution['church_name'] = $user->church_name;
        return $contribution;
    }, $validated['contributions']);

    Stripe::setApiKey(env('STRIPE_SECRET'));

    // Prepare Stripe line items
    $lineItems = [];
    foreach ($contributions as $contribution) {
        $lineItems[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => ['name' => $contribution['fund']],
                'unit_amount' => $contribution['amount'] * 100,
            ],
            'quantity' => 1,
        ];
    }

    // Create a Stripe Checkout Session
    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items' => $lineItems,
        'mode' => 'payment',
        'success_url' => route('contributions.success', [], true) . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('contributions.create'),
    ]);

    // Store contributions in session
    session(['pending_contributions' => $contributions]);

    return redirect($session->url);
}


public function success(Request $request)
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $session = Session::retrieve($request->session_id);
    $pendingContributions = session('pending_contributions', []);
    $user = auth()->user();

    foreach ($pendingContributions as $contribution) {
        Contribution::create([
            'member_id' => $contribution['member_id'] ?? null,
            'church_name' => $contribution['church_name'] ?? $user->church_name, // Ensure it's set
            'payment_method' => 'Stripe',
            'date' => $contribution['date'],
            'amount' => $contribution['amount'],
            'fund' => $contribution['fund'],
            'stripe_payment_id' => $session->payment_intent,
        ]);
    }
    

    session()->forget('pending_contributions');

    return redirect()->route('contributions.index')->with('success', 'Contributions added successfully!');
}


    public function index(Request $request)
    {
        $query = Contribution::with('member');

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

        $totalAmount = $query->sum('amount');
        $totalContributors = $query->distinct('member_id')->count('member_id');

        $contributions = $query->paginate(10);

        return view('dashboard.contributions.index', compact('contributions', 'totalAmount', 'totalContributors'));
    }
}
