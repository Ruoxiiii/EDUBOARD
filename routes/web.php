<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::get('/announcements', function () {
        return view('announcements');
    })->name('announcements');

    Route::get('/user-management', function () {
        return view('user-management');
    })->name('user.management');

    Route::get('/categories', function () {
        return view('categories');
    })->name('categories');

    Route::get('/subscriptions', function () {
        return view('subscriptions');
    })->name('subscriptions');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

require __DIR__.'/auth.php';
