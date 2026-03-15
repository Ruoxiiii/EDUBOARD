<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ── Admin Register ──
Route::get('/admin/register', function () {
    return view('auth.register-admin');
})->name('admin.register');

Route::post('/admin/register', [RegisteredUserController::class, 'storeAdmin'])
    ->name('admin.register.store');

// ── Teacher Register ──
Route::get('/teacher/register', function () {
    return view('auth.register-teacher');
})->name('teacher.register');

Route::post('/teacher/register', [RegisteredUserController::class, 'storeTeacher'])
    ->name('teacher.register.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Student Routes ──
    Route::get('/students/studentpage', function () {
        return view('students.studentpage');
    })->name('student.page');

    // ── Teacher Routes ──
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');

    // ── Admin Routes ──
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

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