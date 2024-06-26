<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\NotificationSeenController;
use App\Http\Controllers\RealtorListingImageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\RealtorListingAcceptOfferController;

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/show', [IndexController::class, 'show'])->name('show');
Route::resource('listing', ListingController::class)->only(['index', 'show']);
Route::resource('listing.offer', ListingOfferController::class)->only(['store'])->middleware(['auth', 'verified']);
Route::resource('notification', NotificationController::class)->only(['index'])->middleware(['auth', 'verified']);
Route::put('notification/{notification}/read', NotificationSeenController::class)->name('notification.read')->middleware(['auth', 'verified']);

Route::get('/login', [AuthController::class, 'create'])->name('login');
Route::post('/login', [AuthController::class, 'store'])->name('login.store');
Route::delete('/logout', [AuthController::class, 'destroy'])->name('logout');
Route::get('/email/verify', function () {
    return inertia('Auth/VerifyEmail');
})->name('verification.notice')->middleware('auth');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('listing.index')->with('success', 'Email was verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return redirect()->back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::resource('account', UserAccountController::class)->only(['create', 'store']);

Route::prefix('realtor')->name('realtor.')->middleware(['auth', 'verified'])->group(function () {
    Route::put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])->name('listing.restore');
    Route::resource('listing', RealtorListingController::class);
    Route::put('offer/{offer}/accept', RealtorListingAcceptOfferController::class)->name('offer.accept');
    Route::resource('listing.image', RealtorListingImageController::class)->only(['create', 'store', 'destroy']);
});
