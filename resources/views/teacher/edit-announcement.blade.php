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

    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-sm">
            <form method="POST" action="{{ route('announcements.update', $announcement->id) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Title</label>
                    <input
                        name="title"
                        value="{{ $announcement->title }}"
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
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $announcement->category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Content</label>
                    <textarea
                        name="content"
                        rows="4"
                        required
                        class="w-full px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"
                    >{{ $announcement->content }}</textarea>
                </div>

                {{-- Current Media --}}
                @if($mediaPaths && count($mediaPaths))
                    <div>
                        <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Current Media</label>
                        <div class="space-y-2">
                            @foreach($mediaPaths as $index => $path)
                                <div class="flex items-center gap-3 p-2 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    @php
                                        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                                        $isVideo = in_array($extension, ['mp4', 'mov', 'avi']);
                                    @endphp
                                    @if($isImage)
                                        <img src="{{ asset('storage/'.$path) }}" alt="Current media" class="h-16 w-16 object-cover rounded" />
                                    @elseif($isVideo)
                                        <div class="h-16 w-16 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center text-xs text-gray-500">Video</div>
                                    @endif
                                    <div class="flex-1 text-sm text-gray-600 dark:text-gray-400 truncate">{{ basename($path) }}</div>
                                    <button type="button" onclick="removeMedia({{ $index }}, this)" class="text-red-600 hover:text-red-700 text-sm font-medium">Remove</button>
                                </div>
                                <input type="hidden" name="remove_media[]" value="{{ $index }}" id="remove_media_{{ $index }}" disabled />
                            @endforeach
                        </div>
                    </div>
                @endif

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
                    <input type="checkbox" name="is_pinned" id="is_pinned" value="1" {{ $announcement->is_pinned ? 'checked' : '' }} class="h-4 w-4 rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500 bg-white dark:bg-gray-900">
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

    <script>
        function removeMedia(index, button) {
            const input = document.getElementById('remove_media_' + index);
            if (input) {
                input.disabled = false;
                button.closest('.flex').style.display = 'none';
            }
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
