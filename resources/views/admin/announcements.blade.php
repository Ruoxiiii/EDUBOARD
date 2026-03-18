<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Announcements - EduBoard Admin</title>
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

        <x-admin-topbar title="All Announcements" />

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
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">All Announcements</h1>
                    <p class="text-gray-500 dark:text-gray-400">View and manage all announcements across the platform</p>
                </div>
            </div>

            <div id="announcements-list" class="space-y-4">
                {{-- Static Announcement 1 --}}
                <div class="relative group">
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
                </div>

                {{-- Static Announcement 2 --}}
                <div class="relative group">
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
                        </div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Upcoming Seminar: Career Opportunities in IT</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4">Join us for an insightful seminar featuring industry experts discussing the latest trends and career paths in the Information Technology sector. Open to all students.</p>
                        
                        {{-- Photo Display --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                <img src="{{ asset('images/download.jpg') }}" alt="IT Seminar 1" class="w-full h-full object-cover">
                            </div>
                            <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                <img src="{{ asset('images/download.jpg') }}" alt="IT Seminar 2" class="w-full h-full object-cover">
                            </div>
                        </div>
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

</body>
</html>