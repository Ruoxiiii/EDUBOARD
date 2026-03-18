<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Announcements - EduBoard Admin</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>

<div class="admin-layout">

    <x-admin-sidebar />

    <div class="admin-main">

        <x-admin-topbar title="My Announcements" />

        <div class="admin-content" x-data="{ 
            confirmingDeletion: false, 
            showingSuccess: false,
            successMessage: '',
            successIcon: null,
            showSuccess(msg, icon = null) {
                this.successMessage = msg;
                this.successIcon = icon;
                this.showingSuccess = true;
            }
        }">

            {{-- Page Header --}}
            <div class="flex items-center justify-between flex-wrap gap-3 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">My Announcements</h1>
                    <p class="text-gray-500 dark:text-gray-400">Manage your own published announcements</p>
                </div>
                <button
                    onclick="document.getElementById('new-announcement-form').classList.toggle('hidden')"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-all shadow-sm"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    New Announcement
                </button>
            </div>

            {{-- New Announcement Form --}}
            <div id="new-announcement-form" class="hidden mb-8">
                <x-announcement-form />
            </div>

            <div id="announcements-list" class="space-y-4">
                {{-- Static Announcement with 2 Photos Example --}}
                <div class="relative group">
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 overflow-hidden flex items-center justify-center">
                                    <img src="{{ asset('images/download.jpg') }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2026-03-18 · Academic</p>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Workshop on Digital Literacy</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4">We successfully conducted the Digital Literacy workshop today. Thank you to all the participants for making it a success! Here are some highlights from the session.</p>
                        
                        {{-- 2 Photos Display --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                <img src="{{ asset('images/download.jpg') }}" alt="Workshop highlight 1" class="w-full h-full object-cover">
                            </div>
                            <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                <img src="{{ asset('images/download.jpg') }}" alt="Workshop highlight 2" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="p-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                            </svg>
                        </button>
                        <button 
                            type="button" 
                            @click="confirmingDeletion = true"
                            class="p-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Static Announcement with Photo Example --}}
                <div class="relative group">
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-all">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 overflow-hidden flex items-center justify-center">
                                    <img src="{{ asset('images/download.jpg') }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ Auth::user()->name }}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2026-03-18 · Events</p>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Sports Festival 2026</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4">We are excited to announce the upcoming Sports Festival! Get ready for a week of competition, sportsmanship, and fun. Check out the official poster below.</p>
                        
                        {{-- Photo Display --}}
                        <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                            <img src="{{ asset('images/download.jpg') }}" alt="Sports Festival Poster" class="w-full h-auto max-h-[400px] object-cover">
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="p-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                            </svg>
                        </button>
                        <button 
                            type="button" 
                            @click="confirmingDeletion = true"
                            class="p-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </div>
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
                        <div class="p-6 text-center">
                            <template x-if="successIcon">
                                <div class="mb-4">
                                    <img :src="successIcon" class="w-20 h-20 rounded-xl object-cover mx-auto border-4 border-green-50 dark:border-green-900/30 shadow-sm">
                                </div>
                            </template>
                            <template x-if="!successIcon">
                                <svg class="animated-check" viewBox="0 0 52 52">
                                    <circle class="animated-check-circle" cx="26" cy="26" r="25" fill="none" />
                                    <path class="animated-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                                </svg>
                            </template>
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
                            <button @click="confirmingDeletion = false; showSuccess('Announcement deleted successfully')" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-bold hover:bg-red-700 transition-all">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </template>

        </div>
    </div>
</div>

<script>
    document.body.dataset.userName = "{{ Auth::user()->name }}";
    
    // Listen for form success
    window.addEventListener('announcement-published', (e) => {
        const alpineData = document.querySelector('[x-data]').__x.$data;
        alpineData.showSuccess(e.detail.message || 'Announcement published successfully');
        document.getElementById('new-announcement-form').classList.add('hidden');
    });
</script>

</body>
</html>