<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Announcements
        </h2>
    </x-slot>

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Announcements</h1>

        {{-- Category Filter (simple version) --}}
        <div class="flex flex-wrap gap-2">
            <button
                class="px-3 py-1 rounded-full text-sm font-medium bg-blue-600 text-white"
                onclick="window.location.href='?category=All'"
            >
                All
            </button>
            @foreach(['General', 'Academic', 'Events', 'Urgent'] as $cat)
                <button
                    class="px-3 py-1 rounded-full text-sm font-medium bg-gray-200 text-gray-700 hover:bg-gray-300"
                    onclick="window.location.href='?category={{ $cat }}'"
                >
                    {{ $cat }}
                </button>
            @endforeach
        </div>

        <div class="space-y-3">
            @php
                $filter = request('category', 'All');
                $announcements = $filter === 'All'
                    ? \App\Models\Announcement::with('postedBy')->latest()->get()
                    : \App\Models\Announcement::with('postedBy')->where('category', $filter)->latest()->get();
            @endphp

            @forelse($announcements as $announcement)
                <x-announcement-card :announcement="$announcement" />
            @empty
                <p class="text-sm text-gray-500 dark:text-gray-400">No announcements found.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
