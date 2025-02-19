<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckPlan;
use App\Http\Middleware\CheckSubscription;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AssettrackingController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\CheckMemberManagementPackage;
use App\Http\Controllers\ChurchNameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::post('/auto-login', function (Request $request) {
    $user = User::where('email', $request->email)->first();

    if ($user) {
        Auth::login($user);
        return redirect()->route('dashboard'); // Change 'dashboard' to your actual dashboard route
    }

    return redirect()->route('login')->with('error', 'Login failed. Please try again.');
})->name('auto.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/checkout/{packageId}', [PackageController::class, 'checkout'])->name('packages.checkout');
    Route::get('/payment-success/{packageId}', [PackageController::class, 'paymentSuccess'])->name('payment.success');
});
Route::get('/welcome', function () {
    return view('welcome', [
        'user' => session('user_credentials')
    ]);
})->name('welcome');

Route::get('auth/church-name', [ChurchNameController::class, 'showForm'])->name('auth.church_name');
Route::post('auth/church-name', [ChurchNameController::class, 'store'])->name('auth.church_name.store');


// Facebook OAuth Routes
Route::get('login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// Google OAuth Routes
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Public Routes
Route::get('/', function () {
    return view('dashboard/home');
})->name('');
Route::get('/pricing', function () {
    return view('dashboard/pricing');
});

// Protected Routes with Middleware
Route::middleware(['auth', 'verified',  CheckSubscription::class])->group(function () {

    // Dashboard Route
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:super admin'])->group(function () {
    Route::resource('users', UserController::class);
    });
    // 🛠️ Manage Users

    Route::middleware(['role:super admin|church administrator', CheckMemberManagementPackage::class])->group(function () {
        Route::get('/members', [MemberController::class, 'index'])->name('members.index');
        Route::get('/members/create', [MemberController::class, 'create'])->name('members.create');
        Route::post('/members', [MemberController::class, 'store'])->name('members.store');
        Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
        Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('members.destroy');
        Route::put('/members/update-draft/{id}', [MemberController::class, 'updateDraft'])->name('members.updateDraft');
        Route::post('/members/save-draft', [MemberController::class, 'saveDraft'])->name('members.saveDraft');
        Route::get('/members/export', [MemberController::class, 'export'])->name('members.export');
    });
    

    // 🔹 Group Management
    Route::middleware(['role:super admin|volunteer coordinator'])->group(function () {
        Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
        Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
        Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
        Route::get('/groups/{id}/edit', [GroupController::class, 'edit'])->name('groups.edit');
        Route::put('/groups/{id}', [GroupController::class, 'update'])->name('groups.update');
        Route::delete('/groups/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');
        Route::get('/groups/export', [GroupController::class, 'export'])->name('groups.export');
    });

    // 🔹 Asset Management
    Route::middleware(['can:manage assets'])->group(function () {
        Route::get('/assettracking', [AssettrackingController::class, 'index'])->name('assets.index');
        Route::get('/assettracking/create', [AssettrackingController::class, 'create'])->name('assets.create')->middleware('can:manage assets');
        Route::post('/assettracking', [AssettrackingController::class, 'store'])->name('assets.store')->middleware('can:manage assets');
        Route::get('/assettracking/{asset}/edit', [AssettrackingController::class, 'edit'])->name('assets.edit');
        Route::put('/assets/{asset}', [AssettrackingController::class, 'update'])->name('assets.update');
        Route::delete('/assets/{asset}', [AssettrackingController::class, 'destroy'])->name('assets.destroy');
        Route::get('/assets/export', [AssettrackingController::class, 'export'])->name('assets.export');
    });

    // 💰 Contributions Management
    Route::middleware(['role:super admin|financial officer'])->group(function () {
        Route::get('/contributions/success', [ContributionController::class, 'success'])->name('contributions.success');
    
        Route::get('/contributions', [ContributionController::class, 'index'])->name('contributions.index');
        Route::get('/contributions/create', [ContributionController::class, 'create'])->name('contributions.create');
        Route::post('/contributions', [ContributionController::class, 'store'])->name('contributions.store');
        Route::get('/contributions/{id}/edit', [ContributionController::class, 'edit'])->name('contributions.edit');
        Route::put('/contributions/{id}', [ContributionController::class, 'update'])->name('contributions.update');
        Route::delete('/contributions/{id}', [ContributionController::class, 'destroy'])->name('contributions.destroy');
    });

    // 📩 Messaging
    Route::middleware(['can:send messages'])->group(function () {
        Route::post('/send-email', [MessageController::class, 'sendEmail'])->name('sendEmail');
        Route::post('/send-sms', [MessageController::class, 'sendSMS'])->name('send.sms');
    });

    // 🎉 Event Management
    Route::middleware(['role:super admin|event manager'])->group(function () {
        Route::get('/events', [EventController::class, 'index'])->name('events.index');
        Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
        Route::get('/events/export', [EventController::class, 'export'])->name('events.export');
    });

    // 📊 Reports
    Route::middleware(['role:super admin|financial officer'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/integrations', [ReportController::class, 'integrations'])->name('integrations.index');
    });

});

// Authentication Routes
require __DIR__ . '/auth.php';
