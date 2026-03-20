<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnnouncements = Announcement::count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalStudents = User::where('role', 'student')->count();
        $pendingApprovalsCount = User::whereNull('email_verified_at')->count();

        $recentAnnouncements = Announcement::with('postedBy')
            ->orderBy('is_pinned', 'desc')
            ->orderBy('pinned_at', 'desc')
            ->latest()
            ->take(5)
            ->get();

        $recentPendingUsers = User::whereNull('email_verified_at')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalAnnouncements',
            'totalTeachers',
            'totalStudents',
            'pendingApprovalsCount',
            'recentAnnouncements',
            'recentPendingUsers'
        ));
    }
}
