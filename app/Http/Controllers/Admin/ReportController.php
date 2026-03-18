<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', Carbon::now()->year);
        $month = $request->input('month');
        $day = $request->input('day');

        $query = Announcement::query();
        $userQuery = User::query();

        if ($year) {
            $query->whereYear('created_at', $year);
            $userQuery->whereYear('created_at', $year);
        }

        if ($month) {
            $query->whereMonth('created_at', $month);
            $userQuery->whereMonth('created_at', $month);
        }

        if ($day) {
            $query->whereDay('created_at', $day);
            $userQuery->whereDay('created_at', $day);
        }

        $announcements = $query->with('postedBy')->latest()->get();
        $users = $userQuery->latest()->get();

        $announcementYears = Announcement::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');

        $userYears = User::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->pluck('year');

        $availableYears = $announcementYears->merge($userYears)->unique()->sortDesc();

        if ($availableYears->isEmpty()) {
            $availableYears = collect([Carbon::now()->year]);
        }

        return view('admin.reports', compact('announcements', 'users', 'year', 'month', 'day', 'availableYears'));
    }
}
