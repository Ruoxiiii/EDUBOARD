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
                                    <button type="button" onclick="removeMedia({{ $index }})" class="text-red-600 hover:text-red-700 text-sm">Remove</button>
                                </div>
                                <input type="hidden" name="remove_media[]" value="{{ $index }}" id="remove_media_{{ $index }}" style="display:none;" />
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- New Media Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-900 dark:text-gray-100 mb-1.5">Upload New Media</label>
                    <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-blue-500/50 transition-colors cursor-pointer">
                        <input
                            type="file"
                            name="media[]"
                            multiple
                            accept="image/*,video/*"
                            class="w-full opacity-0 cursor-pointer"
                            onchange="previewNewMedia(this)"
                        />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-8 w-8 mx-auto text-gray-500 dark:text-gray-400 mb-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Click to add more images/videos</p>
                    </div>
                    <div id="new_media_preview" class="grid grid-cols-2 sm:grid-cols-3 gap-2 mt-2"></div>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_pinned" value="1" {{ $announcement->is_pinned ? 'checked' : '' }} class="rounded border-gray-300 dark:border-gray-600 text-blue-600 focus:ring-blue-500">
                    <label class="text-sm text-gray-900 dark:text-gray-100">Pin this announcement</label>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700">
                        Update Announcement
                    </button>
                    <a href="{{ route('teacher.my-announcements') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function removeMedia(index) {
            document.getElementById('remove_media_' + index).style.display = 'block';
            event.target.closest('.flex').style.display = 'none';
        }

        function previewNewMedia(input) {
            const preview = document.getElementById('new_media_preview');
            preview.innerHTML = '';
            
            Array.from(input.files).forEach((file, index) => {
                const div = document.createElement('div');
                div.className = 'relative group';
                
                if (file.type.startsWith('image/')) {
                    const img = document.createElement('img');
                    img.src = URL.createObjectURL(file);
                    img.className = 'w-full h-20 object-cover rounded';
                    div.appendChild(img);
                } else if (file.type.startsWith('video/')) {
                    const video = document.createElement('video');
                    video.src = URL.createObjectURL(file);
                    video.className = 'w-full h-20 object-cover rounded';
                    video.controls = true;
                    div.appendChild(video);
                }
                
                preview.appendChild(div);
            });
        }
    </script>
</x-app-layout>
