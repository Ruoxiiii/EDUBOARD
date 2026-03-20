<x-app-layout>
    <div class="page-header">
        <h1>Announcements</h1>
        <p>Stay updated with the latest news and notices</p>
    </div>

    {{-- Category Filter matching Admin/Student style --}}
    <div class="flex flex-wrap gap-2 mb-6">
        @php
            $currentCategory = request('category', 'All');
            $categories = ['All', 'General', 'Academic', 'Events', 'Administrative', 'Emergency'];
        @endphp
        @foreach($categories as $cat)
            <a href="{{ route('teacher.announcements', ['category' => $cat]) }}" 
               class="tag {{ $currentCategory === $cat ? 'active-tag' : 'bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700' }}"
               style="text-decoration: none; padding: 6px 14px; border-radius: 100px; font-size: 13px; font-weight: 600; transition: all 0.2s;">
                {{ $cat }}
            </a>
        @endforeach
    </div>

    <div class="announcements space-y-4">
        @php
            $query = \App\Models\Announcement::with('postedBy');
            if($currentCategory !== 'All') {
                $query->where('category', $currentCategory);
            }
            $announcements = $query->orderBy('is_pinned', 'desc')->orderBy('pinned_at', 'desc')->latest()->get();
        @endphp

        @forelse($announcements as $announcement)
            <x-announcement-card :announcement="$announcement" :show-reactions="true" />
        @empty
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">No announcements found in this category.</p>
            </div>
        @endforelse
    </div>

    <style>
        .active-tag {
            background: var(--teal) !important;
            color: white !important;
        }
    </style>
</x-app-layout>
