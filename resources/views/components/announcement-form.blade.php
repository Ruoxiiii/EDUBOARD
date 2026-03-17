@php
    $categories = ['General', 'Academic', 'Events', 'Urgent'];
    $programs = ['BSIT', 'BSEMC'];
    $yearLevels = [1, 2, 3, 4];
    $sections = ['A', 'B', 'C', 'D', 'E', 'F'];
@endphp

<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 space-y-5" x-data="{ targetAll: true, targetProgram: '', targetYear: '', targetSection: '' }">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Create Announcement</h3>
        <button onclick="document.getElementById('new-announcement-form').classList.add('hidden')" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <form method="POST" action="{{ route('announcements.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Title</label>
            <input
                name="title"
                placeholder="Announcement title..."
                required
                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Category</label>
            <select
                name="category"
                required
                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <option value="">Select category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}">{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Content</label>
            <textarea
                name="content"
                placeholder="Write your announcement..."
                rows="4"
                required
                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
            ></textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Media Upload</label>
            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-blue-500/50 transition-colors">
                <input
                    type="file"
                    name="media[]"
                    multiple
                    accept="image/*,video/*"
                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                />
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-8 w-8 mx-auto text-gray-500 dark:text-gray-400 mb-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="text-sm text-gray-500 dark:text-gray-400">Click to select images/videos</p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">Target Audience</label>
            <label class="flex items-center gap-2 mb-3">
                <input
                    type="checkbox"
                    x-model="targetAll"
                    class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500"
                />
                <span class="text-sm text-gray-900 dark:text-gray-100">All Students (School-wide)</span>
            </label>
            <div x-show="!targetAll" class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Program</label>
                    <select
                        name="target_program"
                        x-model="targetProgram"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm"
                    >
                        <option value="">All Programs</option>
                        @foreach($programs as $p)
                            <option value="{{ $p }}">{{ $p }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Year Level</label>
                    <select
                        name="target_year"
                        x-model="targetYear"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm"
                    >
                        <option value="">All Years</option>
                        @foreach($yearLevels as $y)
                            <option value="{{ $y }}">Year {{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Section</label>
                    <select
                        name="target_section"
                        x-model="targetSection"
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm"
                    >
                        <option value="">All Sections</option>
                        @foreach($sections as $s)
                            <option value="{{ $s }}">Section {{ $s }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 transition-opacity">
                Publish Announcement
            </button>
            <button type="button" onclick="document.getElementById('new-announcement-form').classList.add('hidden')" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300">
                Cancel
            </button>
        </div>
    </form>
</div>
