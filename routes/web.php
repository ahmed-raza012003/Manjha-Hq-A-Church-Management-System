<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\MemberController;


// Facebook OAuth Routes
Route::get('login/facebook', [FacebookController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

// Google OAuth Routes
Route::get('login/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/', function () {
    return view('dashboard/members');
});
Route::get('/create', function () {
    return view('dashboard/members/create');
});
Route::get('members/export', [MemberController::class, 'export'])->name('members.export');

Route::get('/dashboard', function () {
    return view('dashboard/dashboard_main');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('members', MemberController::class);
    Route::put('/members/update-draft/{id}', [MemberController::class, 'updateDraft'])->name('members.updateDraft');
    Route::post('/members/save-draft', [MemberController::class, 'saveDraft'])->name('members.saveDraft');
    

});

require __DIR__.'/auth.php';
