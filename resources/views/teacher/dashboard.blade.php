<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Teacher Dashboard
        </h2>
    </x-slot>

    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Welcome back, {{ Auth::user()->name }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            @php
                $myAnnouncementsCount = \App\Models\Announcement::where('posted_by', Auth::id())->count();
                $totalViews = 1234;
                $totalReactions = 89;
            @endphp

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">My Announcements</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 text-blue-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-2">{{ $myAnnouncementsCount }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Views</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 text-cyan-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                    </svg>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-2">{{ number_format($totalViews) }}</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Total Reactions</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 text-amber-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.094c.55 0 1.02.398 1.11.94l.149.894c.07.424.364.764.765.926a6.573 6.573 0 0 0 2.96.354c.427-.05.847-.156 1.23-.314l.893-.448c.408-.204.74-.61.765-1.07a.755.755 0 0 1 .09-.255h.012l.013-.004.058-.02a1.99 1.99 0 0 1 .523-.142 3.375 3.375 0 0 1 2.726 5.477 3.375 3.375 0 0 1-2.726 1.074H18a4.5 4.5 0 0 0-4.5 4.5v2.256A2.25 2.25 0 0 1 11.25 18H9.75a2.25 2.25 0 0 1-2.25-2.25v-2.256a4.5 4.5 0 0 0-4.5-4.5H6a2.25 2.25 0 0 1-2.25-2.25V6.75A2.25 2.25 0 0 1 6 4.5h2.25A2.25 2.25 0 0 1 10.5 6.75v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-2">{{ $totalReactions }}</p>
            </div>
        </div>

        <div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Announcements</h2>
            <div class="space-y-3">
                @php
                    $recentAnnouncements = \App\Models\Announcement::with('postedBy')->latest()->take(3)->get();
                @endphp
                @forelse($recentAnnouncements as $announcement)
                    <x-announcement-card :announcement="$announcement" :show-reactions="false" />
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">No announcements yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
