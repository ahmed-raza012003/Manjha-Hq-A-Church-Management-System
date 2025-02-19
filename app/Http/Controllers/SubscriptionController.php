<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Package;
use App\Models\Subscription;

use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function checkout(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $user = Auth::user();
        $package = Package::findOrFail($request->package_id);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'customer_email' => $user->email,
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => $package->name],
                    'unit_amount' => $package->price * 100,
                    'recurring' => ['interval' => 'month'], // Subscription-based
                ],
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => route('subscription.success', ['package_id' => $package->id]),
            'cancel_url' => route('subscription.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $user = Auth::user();
        $user->subscription()->updateOrCreate([], [
            'package_id' => $request->package_id,
            'status' => 'active',
            'expires_at' => now()->addMonth(),
        ]);

        return redirect()->route(route: 'dashboard')->with('success', 'Subscription successful!');
    }
}
