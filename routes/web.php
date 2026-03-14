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

    // Teacher routes
    Route::get('/teacher/dashboard', function () {
        return view('teacher.dashboard');
    })->name('teacher.dashboard');

    Route::get('/teacher/announcements', function () {
        return view('teacher.announcements');
    })->name('teacher.announcements');

    Route::get('/teacher/my-announcements', function () {
        return view('teacher.my-announcements');
    })->name('teacher.my-announcements');

    // Announcement CRUD (placeholder routes)
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

        $announcement->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category' => $validated['category'] ?? 'General',
            'is_pinned' => $validated['is_pinned'] ?? false,
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
