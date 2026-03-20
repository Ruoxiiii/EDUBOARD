<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;
    
    return match($role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'teacher' => redirect()->route('teacher.dashboard'),
        'student' => redirect()->route('student.page'),
        default   => view('dashboard'),
    };
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

    // ── Profile ──
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Student Routes ──
    Route::middleware('role:student')->group(function () {
        Route::get('/students/studentpage', function () {
            return view('students.studentpage');
        })->name('student.page');
    });

    // ── Teacher Routes ──
    Route::middleware('role:teacher')->group(function () {
        Route::get('/teacher/dashboard', function () {
            return view('teacher.dashboard');
        })->name('teacher.dashboard');

        Route::get('/teacher/announcements', function () {
            return view('teacher.announcements');
        })->name('teacher.announcements');

        Route::get('/teacher/my-announcements', function () {
            return view('teacher.my-announcements');
        })->name('teacher.my-announcements');
    });

    // ── Shared Announcement CRUD (Admin & Teacher) ──
    Route::middleware('role:admin,teacher')->group(function () {
        // Announcement CRUD
        Route::post('/announcements', function () {
            return back()->with('success', 'Announcement posted!');
        })->name('announcements.store');

        Route::get('/announcements/{id}/edit', function ($id) {
            return view('teacher.edit-announcement');
        })->name('announcements.edit');

        Route::put('/announcements/{id}', function ($id) {
            return redirect()->route('teacher.my-announcements')->with('success', 'Announcement updated!');
        })->name('announcements.update');

        Route::delete('/announcements/{id}', function ($id) {
            return back()->with('success', 'Announcement deleted!');
        })->name('announcements.destroy');
    });

    // ── Admin Routes ──
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/announcements', function () {
            return view('admin.announcements');
        })->name('announcements');

        Route::get('/my-announcements', function () {
            return view('admin.my-announcements');
        })->name('my-announcements');

        Route::get('/categories', function () {
            return view('admin.categories');
        })->name('categories');

        Route::get('/users', function () {
            return view('admin.users');
        })->name('users');


        Route::get('/subscription', function () {
            return view('admin.subscription');
        })->name('subscription');

        Route::get('/settings', function () {
            return view('admin.settings');
        })->name('settings');

        Route::get('/reports', [ReportController::class, 'index'])->name('reports');

        Route::post('/settings/appearance', [SettingController::class, 'updateAppearance'])->name('settings.appearance.update');
        Route::post('/settings/logo/reset', [SettingController::class, 'resetLogo'])->name('settings.logo.reset');
        Route::get('/settings/appearance', [SettingController::class, 'getAppearance'])->name('settings.appearance.get');
    });

    // ── Legacy / Shared Routes ──
    Route::get('/announcements', function () {
        return view('announcements');
    })->name('announcements');
});

// ── Subscription Plans (public) ──
Route::get('/plans', function () {
    return view('subscription.plans');
})->name('plans');

require __DIR__.'/auth.php';