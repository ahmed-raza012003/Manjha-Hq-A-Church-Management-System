<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\EventController;

use App\Http\Controllers\AssettrackingController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\GroupController;

// Facebook OAuth Routes
Route::get('login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// Google OAuth Routes
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('dashboard/home');
});

Route::get('/pricing', function () {
    return view('dashboard/pricing');
});



Route::get('/dashboard', function () {
    return view('dashboard/dashboard_main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('members', MemberController::class)->except(['show']);
    Route::put('/members/update-draft/{id}', [MemberController::class, 'updateDraft'])->name('members.updateDraft');
    Route::post('/members/save-draft', [MemberController::class, 'saveDraft'])->name('members.saveDraft');
    Route::get('/members/export', [MemberController::class, 'export'])->name('members.export');
        Route::get('groups/export', [GroupController::class, 'export'])->name('groups.export');
       // Display all assets
Route::get('/assettracking', [AssettrackingController::class, 'index'])->name('assets.index');

// Show form to create a new asset
Route::get('/assettracking/create', [AssettrackingController::class, 'create'])->name('assets.create');

// Store a new asset
Route::post('/assettracking', [AssettrackingController::class, 'store'])->name('assets.store');

// Show the form to edit an asset
Route::get('/assettracking/{asset}/edit', [AssettrackingController::class, 'edit'])->name('assets.edit');

// Update an asset
Route::put('/assets/{asset}', [AssettrackingController::class, 'update'])->name('assets.update');

// Delete an asset
Route::delete('/assets/{asset}', [AssettrackingController::class, 'destroy'])->name('assets.destroy');

        Route::get('/assets/export', [AssettrackingController::class, 'export'])->name('assets.export');

    Route::resource('groups', GroupController::class);
  

Route::get('/contributions/create', [ContributionController::class, 'create'])->name('contributions.create');
Route::post('/contributions', [ContributionController::class, 'store'])->name('contributions.store');
Route::get('/contributions', [ContributionController::class, 'index'])->name('contributions.index');
Route::get('/dashboard', [MemberController::class, 'home'])->name('dashboard.index');
Route::get('/integrations', [ReportController::class, 'integrations'])->name('integrations.index');
Route::post('/send-email', [MessageController::class, 'sendEmail'])->name('sendEmail');
Route::post('/send-sms', [MessageController::class, 'sendSMS'])->name('send.sms');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

// Display the list of events
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Show the form to create a new event
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');

// Store the newly created event
Route::post('/events', [EventController::class, 'store'])->name('events.store');

// Show the form to edit an existing event
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');

// Update the event
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');

// Delete the event
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

// Export events (if you want this feature)
Route::get('/events/export', [EventController::class, 'export'])->name('events.export');

});

require __DIR__.'/auth.php';
