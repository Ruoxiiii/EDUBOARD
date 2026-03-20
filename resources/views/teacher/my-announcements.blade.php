<x-app-layout>
    <div class="page-header flex items-center justify-between flex-wrap gap-4">
        <div>
            <h1>My Announcements</h1>
            <p>Manage and track the announcements you've posted</p>
        </div>
        <button
            onclick="document.getElementById('new-announcement-form').classList.toggle('hidden')"
            class="px-5 py-2.5 bg-[var(--teal)] text-white rounded-xl text-sm font-bold hover:opacity-90 transition-all flex items-center gap-2 shadow-sm"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            New Announcement
        </button>
    </div>

    <div x-data="{ 
        confirmingDeletion: false, 
        showingSuccess: false,
        successMessage: '',
        deleteUrl: '',
        confirmDeletion(url) {
            this.confirmingDeletion = true;
        },
        showSuccess(msg) {
            this.successMessage = msg;
            this.showingSuccess = true;
        }
    }">
        {{-- New Announcement Form --}}
        <div id="new-announcement-form" class="hidden mb-8">
            <x-announcement-form />
        </div>

        <div id="announcements-list" class="announcements space-y-4">
            @php
                $myAnnouncements = \App\Models\Announcement::with('postedBy')->where('posted_by', Auth::id())->latest()->get();
            @endphp

            @forelse($myAnnouncements as $announcement)
                <div class="relative group">
                    <x-announcement-card :announcement="$announcement" :show-reactions="true" />
                    
                    {{-- Edit/Delete Actions --}}
                    <div class="absolute top-4 right-4 flex gap-1.5 opacity-0 group-hover:opacity-100 transition-all">
                        <button class="p-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                            </svg>
                        </button>
                        <button 
                            type="button" 
                            @click="confirmDeletion()"
                            class="p-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 transition-colors"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-gray-900/50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 dark:text-gray-400 font-medium text-lg">You haven't posted any announcements yet.</p>
                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Click the "New Announcement" button to get started.</p>
                </div>
            @endforelse
        </div>

        {{-- Custom Success Modal --}}
        <template x-teleport="body">
            <div x-show="showingSuccess" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="showingSuccess = false"></div>
                <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Success</h3>
                        <button @click="showingSuccess = false" class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed" x-text="successMessage"></p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 flex justify-end">
                        <button @click="showingSuccess = false" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition-all">
                            Done
                        </button>
                    </div>
                </div>
            </div>
        </template>

        {{-- Custom Delete Confirmation Modal --}}
        <template x-teleport="body">
            <div x-show="confirmingDeletion" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
                <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" @click="confirmingDeletion = false"></div>
                <div class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Delete Announcement</h3>
                        <button @click="confirmingDeletion = false" class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                            Are you sure you want to delete this announcement? This action cannot be undone.
                        </p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 flex items-center justify-end gap-3">
                        <button @click="confirmingDeletion = false" class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-bold hover:bg-gray-50 dark:hover:bg-gray-700">
                            Cancel
                        </button>
                        <button @click="confirmingDeletion = false; $dispatch('announcement-deleted')" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 transition-all">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    <script>
        document.body.dataset.userName = "{{ Auth::user()->name }}";
        
        // Listen for internal events to show custom success modal
        window.addEventListener('announcement-deleted', () => {
            const alpineData = document.querySelector('[x-data]').__x.$data;
            alpineData.showSuccess('Announcement deleted successfully');
        });
    </script>
</x-app-layout>