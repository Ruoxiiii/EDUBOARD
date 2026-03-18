@php
    $categories = ['General', 'Academic', 'Events', 'Urgent'];
    $programs = ['BSIT', 'BSEMC'];
    $yearLevels = [1, 2, 3, 4];
    $sections = ['A', 'B', 'C', 'D', 'E', 'F'];
    $mediaPaths = is_array($announcement->media_paths) ? $announcement->media_paths : json_decode($announcement->media_paths ?? '[]', true) ?? [];
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Announcement
        </h2>
    </x-slot>

    <div class="space-y-6" x-data="{ 
        showingSuccess: false,
        successMessage: '',
        showSuccess(msg) {
            this.successMessage = msg;
            this.showingSuccess = true;
        }
    }">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <form id="editAnnouncementForm" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Title</label>
                    <input
                        id="editAnnTitle"
                        name="title"
                        value="Midterm Examination Schedule"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Category</label>
                    <select
                        id="editAnnCategory"
                        name="category"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $cat === 'Academic' ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Content</label>
                    <textarea
                        id="editAnnContent"
                        name="content"
                        rows="4"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                    >The midterm exams will start next week. Please check your portals for the specific schedule and room assignments.</textarea>
                </div>

                {{-- New Media Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Upload New Media</label>
                    <div class="relative group">
                        <input
                            type="file"
                            name="media[]"
                            multiple
                            accept="image/*,video/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                            onchange="previewNewMedia(this)"
                        />
                        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center group-hover:border-blue-500/50 group-hover:bg-blue-50/5 dark:group-hover:bg-blue-900/10 transition-all duration-200">
                            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6 text-blue-600 dark:text-blue-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Click to add more images/videos</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG, MP4 or MOV up to 10MB</p>
                        </div>
                    </div>
                    <div id="new_media_preview" class="grid grid-cols-2 sm:grid-cols-4 gap-3 mt-4"></div>
                </div>

                <div class="flex items-center gap-2 py-2">
                    <input type="checkbox" name="is_pinned" id="is_pinned" value="1" class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 bg-white dark:bg-gray-900">
                    <label for="is_pinned" class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">Pin this announcement to top</label>
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <button type="submit" class="flex-1 sm:flex-none px-6 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/20 transition-all active:scale-95">
                        Update Announcement
                    </button>
                    <a href="{{ route('teacher.my-announcements') }}" class="flex-1 sm:flex-none px-6 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg text-sm font-bold hover:bg-gray-200 dark:hover:bg-gray-600 text-center transition-all">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Custom Success Modal --}}
    <template x-teleport="body">
        <div 
            x-show="showingSuccess" 
            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
            x-cloak
        >
            {{-- Backdrop --}}
            <div 
                x-show="showingSuccess"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"
            ></div>

            {{-- Modal Content --}}
            <div 
                x-show="showingSuccess"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative w-full max-w-md bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-700"
            >
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">Success</h3>
                    <button @click="window.location.href = '{{ route('teacher.my-announcements') }}'" class="p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="p-6">
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed" x-text="successMessage"></p>
                </div>
                <div class="bg-gray-50 dark:bg-gray-800/50 px-6 py-4 flex justify-end">
                    <button @click="window.location.href = '{{ route('teacher.my-announcements') }}'" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-bold hover:bg-blue-700 transition-all">
                        Return to List
                    </button>
                </div>
            </div>
        </div>
    </template>
    </div>

    <script>
        document.getElementById('editAnnouncementForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const alpineData = document.querySelector('[x-data]').__x.$data;
            alpineData.showSuccess('Announcement updated successfully');
        });

        function removeMedia(index, button) {
            button.closest('.flex').style.display = 'none';
        }

        function previewNewMedia(input) {
            const preview = document.getElementById('new_media_preview');
            preview.innerHTML = '';
            
            if (input.files) {
                Array.from(input.files).forEach((file) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.className = 'relative aspect-video rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 shadow-sm';
                        
                        if (file.type.startsWith('image/')) {
                            div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                        } else if (file.type.startsWith('video/')) {
                            div.innerHTML = `
                                <video class="w-full h-full object-cover">
                                    <source src="${e.target.result}" type="${file.type}">
                                </video>
                                <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.333-5.89a1.5 1.5 0 000-2.538L6.3 2.841z" />
                                    </svg>
                                </div>
                            `;
                        }
                        preview.appendChild(div);
                    }
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</x-app-layout>
