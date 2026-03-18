<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Announcements
        </h2>
    </x-slot>

    <div class="space-y-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Announcements</h1>

        {{-- Category Filter --}}
        <div class="flex flex-wrap gap-2 mb-6">
            <a
                href="?category=All"
                class="px-3 py-1 rounded-full text-sm font-medium {{ request('category', 'All') === 'All' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
            >
                All
            </a>
            @foreach(['General', 'Academic', 'Events', 'Urgent'] as $cat)
                <a
                    href="?category={{ $cat }}"
                    class="px-3 py-1 rounded-full text-sm font-medium {{ request('category', 'All') === $cat ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}"
                >
                    {{ $cat }}
                </a>
            @endforeach
        </div>

        <div class="space-y-3">
            {{-- Static Announcements --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4 mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold">
                            AD
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Admin</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">2026-03-10 · Urgent</p>
                        </div>
                    </div>
                </div>
                <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Campus Maintenance Notice</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">The campus will undergo scheduled electrical maintenance this Saturday. All buildings will be closed from 8 AM to 5 PM.</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                <div class="flex items-start justify-between gap-4 mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold">
                            PW
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Prof. Westfield</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">2026-03-08 · Events</p>
                        </div>
                    </div>
                </div>
                <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Science Fair 2026</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Join us for the annual Science Fair! Students from all departments are invited to showcase their innovative projects.</p>
            </div>
        </div>
    </div>
</x-app-layout>
