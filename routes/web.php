<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

        // Announcement CRUD
        Route::post('/announcements', function () {
            // Validate and store
            $validated = request()->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category' => 'nullable|string',
                'target_program' => 'nullable|string',
                'target_year' => 'nullable|string',
                'target_section' => 'nullable|string',
            ]);

            $mediaPaths = [];
            if (request()->hasFile('media')) {
                foreach (request()->file('media') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('announcements', 'public');
                        $mediaPaths[] = $path;
                    }
                }
            }

            \App\Models\Announcement::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'category' => $validated['category'] ?? 'General',
                'posted_by' => auth()->id(),
                'media_paths' => $mediaPaths,
            ]);

            return back()->with('success', 'Announcement posted!');
        })->name('announcements.store');

        Route::get('/announcements/{id}/edit', function ($id) {
            $announcement = \App\Models\Announcement::where('posted_by', auth()->id())->findOrFail($id);
            return view('teacher.edit-announcement', ['announcement' => $announcement]);
        })->name('announcements.edit');

        Route::put('/announcements/{id}', function ($id) {
            $announcement = \App\Models\Announcement::where('posted_by', auth()->id())->findOrFail($id);
            
            $validated = request()->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category' => 'nullable|string',
                'is_pinned' => 'nullable|boolean',
            ]);

            // Handle media removal
            $currentMedia = $announcement->media_paths ?? [];
            $removeIndices = request('remove_media', []);
            
            foreach ($removeIndices as $index) {
                if (isset($currentMedia[$index])) {
                    \Storage::disk('public')->delete($currentMedia[$index]);
                    unset($currentMedia[$index]);
                }
            }
            $currentMedia = array_values($currentMedia); // re-index array

            // Handle new media uploads
            if (request()->hasFile('media')) {
                foreach (request()->file('media') as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('announcements', 'public');
                        $currentMedia[] = $path;
                    }
                }
            }

            $isPinned = (bool)($validated['is_pinned'] ?? false);
            $pinnedAt = $announcement->pinned_at;

            if ($isPinned && !$announcement->is_pinned) {
                $pinnedAt = now();
            } elseif (!$isPinned) {
                $pinnedAt = null;
            }

            $announcement->update([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'category' => $validated['category'] ?? 'General',
                'is_pinned' => $isPinned,
                'pinned_at' => $pinnedAt,
                'media_paths' => $currentMedia,
            ]);

            return redirect()->route('teacher.my-announcements')->with('success', 'Announcement updated!');
        })->name('announcements.update');

        Route::delete('/announcements/{id}', function ($id) {
            $announcement = \App\Models\Announcement::where('posted_by', auth()->id())->findOrFail($id);
            
            // Delete media files if they exist
            if ($announcement->media_paths) {
                foreach ($announcement->media_paths as $path) {
                    \Storage::disk('public')->delete($path);
                }
            }
            
            $announcement->delete();
            return back()->with('success', 'Announcement deleted!');
        })->name('announcements.destroy');
    });

    // ── Admin Routes ──
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('announcements', function () {
            return view('announcements');
        })->name('announcements');

        Route::get('user-management', function () {
            return view('user-management');
        })->name('user.management');

        Route::get('categories', function () {
            return view('categories');
        })->name('categories');

        Route::get('subscriptions', function () {
            return view('subscriptions');
        })->name('subscriptions');

        Route::get('settings', function () {
            return view('settings');
        })->name('settings');
    });
});

require __DIR__.'/auth.php';
