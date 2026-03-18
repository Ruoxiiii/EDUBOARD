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

    <form id="teacherAnnouncementForm" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Title</label>
            <input
                id="annTitle"
                name="title"
                placeholder="Announcement title..."
                required
                class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Category</label>
            <select
                id="annCategory"
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
                id="annContent"
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
                    id="annMedia"
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
            <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-3">Options</label>
            <div class="flex flex-col gap-2">
                <label class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        x-model="targetAll"
                        class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500"
                    />
                    <span class="text-sm text-gray-900 dark:text-gray-100">All Students (School-wide)</span>
                </label>
                <label class="flex items-center gap-2">
                    <input
                        type="checkbox"
                        id="annPinned"
                        class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500"
                    />
                    <span class="text-sm text-gray-900 dark:text-gray-100 font-semibold text-red-600 dark:text-red-400">Pin this announcement</span>
                </label>
            </div>
            
            <div x-show="!targetAll" class="mt-3 grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="block text-xs text-gray-500 dark:text-gray-400 mb-1">Program</label>
                    <select
                        id="annProgram"
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
                        id="annYear"
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
                        id="annSection"
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

    <script>
        document.getElementById('teacherAnnouncementForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const title = document.getElementById('annTitle').value;
            const category = document.getElementById('annCategory').value;
            const content = document.getElementById('annContent').value;
            const isPinned = document.getElementById('annPinned').checked;
            const mediaFiles = document.getElementById('annMedia').files;
            
            // Handle Media
            let mediaHtml = '';
            if (mediaFiles.length > 0) {
                const mediaUrls = Array.from(mediaFiles).map(file => ({
                    url: URL.createObjectURL(file),
                    type: file.type.startsWith('video') ? 'video' : 'image'
                }));

                if (mediaUrls.length === 1) {
                    const item = mediaUrls[0];
                    if (item.type === 'video') {
                        mediaHtml = `
                            <div class="mt-4 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video bg-black">
                                <video class="w-full h-full" controls src="${item.url}"></video>
                            </div>`;
                    } else {
                        mediaHtml = `
                            <div class="mt-4 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                                <img src="${item.url}" class="w-full h-auto max-h-[400px] object-cover">
                            </div>`;
                    }
                } else if (mediaUrls.length >= 2) {
                    mediaHtml = `<div class="mt-4 grid grid-cols-2 gap-3">`;
                    mediaUrls.slice(0, 2).forEach(item => {
                        if (item.type === 'video') {
                            mediaHtml += `
                                <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video bg-black">
                                    <video class="w-full h-full" controls src="${item.url}"></video>
                                </div>`;
                        } else {
                            mediaHtml += `
                                <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                    <img src="${item.url}" class="w-full h-full object-cover">
                                </div>`;
                        }
                    });
                    mediaHtml += `</div>`;
                }
            }
            
            // Create a static announcement card
            const announcementList = document.getElementById('announcements-list');
            if (announcementList) {
                const newCard = document.createElement('div');
                newCard.className = 'relative group';
                newCard.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 overflow-hidden flex items-center justify-center">
                                    <img src="/images/download.jpg" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">${document.body.dataset.userName || 'User'}</h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">${new Date().toISOString().split('T')[0]} · ${category}</p>
                                </div>
                            </div>
                            ${isPinned ? '<span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 text-[10px] font-bold uppercase rounded-md tracking-wider">Pinned</span>' : ''}
                        </div>
                        <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">${title}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">${content}</p>
                        ${mediaHtml}
                    </div>
                    <div class="absolute top-4 right-4 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                        <button class="p-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                            </svg>
                        </button>
                        <button 
                            type="button" 
                            onclick="this.closest('.relative.group').remove();"
                            class="p-1.5 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </div>
                `;
                announcementList.prepend(newCard);
            }
            
            // Hide form and reset
            document.getElementById('new-announcement-form').classList.add('hidden');
            this.reset();
            
            // Show custom success modal
            const alpineData = document.querySelector('[x-data]').__x.$data;
            alpineData.showSuccess('Announcement published successfully');
        });
    </script>
</div>
