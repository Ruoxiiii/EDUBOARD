<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - EduBoard</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
</head>
<body>

<div class="admin-layout">

    {{-- Left Sidebar --}}
    <x-admin-sidebar />

    {{-- Main --}}
    <div class="admin-main">

        {{-- Top Navbar --}}
        <x-admin-topbar title="Dashboard" />

        {{-- Content --}}
        <div class="admin-content">

            <div class="page-header">
                <h1>Dashboard</h1>
                <p>Welcome back, {{ auth()->user()->name }}</p>
            </div>

            {{-- Stats --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Total Announcements</div>
                        <div class="stat-value">8</div>
                    </div>
                    <div class="stat-icon teal">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Total Teachers</div>
                        <div class="stat-value">5</div>
                    </div>
                    <div class="stat-icon blue">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Total Students</div>
                        <div class="stat-value">5</div>
                    </div>
                    <div class="stat-icon amber">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147L12 14.63l7.74-4.483m-15.48 0L12 5.667l7.74 4.48m-15.48 0v6.331c0 .603.346 1.154.894 1.442L12 21.35l7.106-3.73a1.5 1.5 0 00.894-1.442V10.147m-15.48 0L12 14.63l7.74-4.483" />
                        </svg>
                    </div>
                </div>

                <a href="{{ route('admin.users') }}?tab=pending" class="stat-card hover:border-red-400 transition-colors">
                    <div class="stat-info">
                        <div class="stat-label">Pending Approvals</div>
                        <div class="stat-value text-red-500">2</div>
                    </div>
                    <div class="stat-icon red" style="background: #fef2f2; color: #ef4444;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                {{-- Left: Recent Announcements --}}
                <div class="lg:col-span-2">
                    <div class="section-header">
                        <h2>Recent Announcements</h2>
                        <a href="{{ route('admin.announcements') }}" class="view-all">View All</a>
                    </div>

                    <div class="space-y-4">
                        {{-- Card 1 --}}
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/30 overflow-hidden flex items-center justify-center text-red-600 dark:text-red-400 font-bold">
                                        AS
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Admin System</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">2026-03-10 · Emergency</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-[10px] font-bold uppercase rounded-md tracking-wider">Pinned</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Classes Suspended on March 10</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Due to inclement weather, all classes are suspended on March 10, 2026. Please stay safe and monitor official channels for updates.</p>
                        </div>

                        {{-- Card 2 --}}
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start justify-between gap-4 mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 overflow-hidden flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold">
                                        EC
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Events Committee</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">2026-03-07 · Events</p>
                                    </div>
                                </div>
                                <span class="px-2 py-1 bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-[10px] font-bold uppercase rounded-md tracking-wider">Pinned</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Foundation Day Celebration</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4">Join us for the 50th Foundation Day celebration on March 15! Activities include a parade, cultural performances, and a grand alumni homecoming.</p>
                            
                            {{-- Photo Display --}}
                            <div class="grid grid-cols-2 gap-3">
                                <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                    <img src="{{ asset('images/download.jpg') }}" alt="Foundation Day 1" class="w-full h-full object-cover">
                                </div>
                                <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                    <img src="{{ asset('images/download.jpg') }}" alt="Foundation Day 2" class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Pending Approvals Reference --}}
                <div class="lg:col-span-1">
                    <div class="section-header">
                        <h2>Pending Approvals</h2>
                        <a href="{{ route('admin.users') }}?tab=pending" class="view-all">Manage</a>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                        <div class="divide-y divide-gray-100 dark:divide-gray-700">
                            {{-- Pending User 1 --}}
                            <div class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-400 font-bold text-xs">
                                        KP
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Kevin Park</p>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-400">COT · BSIT</p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 text-[10px] font-medium rounded-full border border-amber-100 dark:border-amber-900/30">Pending</span>
                            </div>

                            {{-- Pending User 2 --}}
                            <div class="p-4 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-400 font-bold text-xs">
                                        SC
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Sarah Chen</p>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-400">COB · BSBA</p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 text-[10px] font-medium rounded-full border border-amber-100 dark:border-amber-900/30">Pending</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('admin.users') }}?tab=pending" class="block p-3 text-center text-xs font-medium text-blue-600 dark:text-blue-400 bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            View All Pending Requests
                        </a>
                    </div>

                    {{-- Quick Tip --}}
                    <div class="mt-4 p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 border border-blue-100 dark:border-blue-900/30">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-[12px] text-blue-700 dark:text-blue-300 leading-relaxed">
                                New student registrations require admin approval before they can access their portal.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>