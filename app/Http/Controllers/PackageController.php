<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Subscription;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('authentication.package', compact('packages'));
    }

    public function checkout($packageId)
    {
        $user = Auth::user();
        $package = Package::findOrFail($packageId);
    
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        // Ensure Stripe customer exists
        if (!$user->stripe_customer_id) {
            $customer = \Stripe\Customer::create([
                'email' => $user->email,
                'name' => $user->first_name,
            ]);
            $user->update(['stripe_customer_id' => $customer->id]);
        }
    
        // Create the Stripe Subscription Price
        $price = \Stripe\Price::create([
            'unit_amount' => $package->price * 100, // Price in cents
            'currency' => 'usd',
            'recurring' => ['interval' => 'month'], // Monthly subscription
            'product_data' => [
                'name' => $package->name,
            ],
        ]);

        // Build success URL with session ID placeholder
        $successUrl = route('payment.success', ['packageId' => $package->id]);
        $successUrl .= '?session_id={CHECKOUT_SESSION_ID}';
    
        // Create Checkout Session
        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'customer' => $user->stripe_customer_id,
            'line_items' => [[
                'price' => $price->id,
                'quantity' => 1,
            ]],
            'mode' => 'subscription',
            'success_url' => $successUrl,
            'cancel_url' => route('packages.index'),
        ]);
    
        return redirect($checkoutSession->url);
    }
    
    public function paymentSuccess(Request $request, $packageId)
    {
        Log::info('Payment Success endpoint hit', ['request' => $request->all()]);
    
        $user = Auth::user();
        $sessionId = $request->query('session_id');
    
        if (!$sessionId) {
            Log::error('Session ID missing', ['request' => $request->all()]);
            return redirect()->route('dashboard')->with('error', 'Session ID is missing.');
        }
    
        if (!$packageId) {
            Log::error('Package ID missing', ['request' => $request->all()]);
            return redirect()->route('dashboard')->with('error', 'Package ID is missing.');
        }
    
        Stripe::setApiKey(env('STRIPE_SECRET'));
    
        try {
            DB::beginTransaction();
    
            Log::info("Retrieving Stripe session", ['session_id' => $sessionId]);
    
            // Retrieve Stripe session
            $session = Session::retrieve($sessionId);
    
            // Retrieve the subscription details
            $stripeSubscription = \Stripe\Subscription::retrieve($session->subscription);
    
            Log::info('Stripe data retrieved', [
                'subscription_id' => $stripeSubscription->id,
                'period_end' => $stripeSubscription->current_period_end
            ]);
    
            // Update user with subscription info
            $user->update([
                'stripe_subscription_id' => $stripeSubscription->id,
                'package_id' => $packageId,
                'subscription_ends_at' => Carbon::createFromTimestamp($stripeSubscription->current_period_end)
            ]);
    
            Log::info('User updated with subscription details', ['user_id' => $user->id]);
    
            // Create or update subscription record
            $subscription = Subscription::updateOrCreate(
                ['user_id' => $user->id, 'package_id' => $packageId],
                [
                    'status' => 'active',
                    'expires_at' => Carbon::createFromTimestamp($stripeSubscription->current_period_end),
                ]
            );
    
            Log::info('Subscription record created/updated', [
                'subscription_id' => $subscription->id,
                'user_id' => $user->id,
                'package_id' => $packageId
            ]);
    
            DB::commit();
    
            // Store user credentials for auto-login
            session(['user_credentials' => [
                'email' => $user->email,
                'password_placeholder' => '(Use your existing password)' // Placeholder message
            ]]);
    
            // Log the user in
            Auth::login($user);
            if ($user->roles->isEmpty()) {
                $user->assignRole('super admin');
            }
            return redirect()->route('welcome')->with('success', 'Welcome to your dashboard!');
        } catch (\Exception $e) {
            DB::rollBack();
    
            Log::error('Subscription process failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $user->id,
                'session_id' => $sessionId,
                'package_id' => $packageId
            ]);
    
            return redirect()->route('packages')
                ->with('error', 'Failed to activate subscription. Please contact support.');
        }
    }
    

}