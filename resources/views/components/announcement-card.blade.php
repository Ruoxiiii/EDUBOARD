@php
    $categoryColors = [
        'General' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
        'Academic' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
        'Events' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
        'Urgent' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
    ];
    $reactionEmojis = ['heart' => '❤️', 'like' => '👍', 'fire' => '🔥', 'sad' => '😢'];
    $mediaPaths = is_array($announcement->media_paths) ? $announcement->media_paths : json_decode($announcement->media_paths ?? '[]', true) ?? [];
@endphp

<div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-4 shadow-sm">
    <div class="flex items-start justify-between gap-3">
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 flex-wrap mb-2">
                @if($announcement->is_pinned ?? false)
                    <span class="inline-flex items-center gap-1 text-xs font-medium text-blue-600 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5v16M3 12h16.5m-16.5 0L7.5 7.5m-4.5 4.5L7.5 16.5" />
                        </svg>
                        Pinned
                    </span>
                @endif
                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium {{ $categoryColors[$announcement->category ?? 'General'] ?? $categoryColors['General'] }}">
                    {{ $announcement->category ?? 'General' }}
                </span>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 leading-tight">{{ $announcement->title }}</h3>
        </div>
    </div>

    <div class="flex items-center gap-3 mt-2 text-xs text-gray-500 dark:text-gray-400">
        <span class="inline-flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            {{ $announcement->postedBy?->name ?? 'System' }}
        </span>
        <span class="inline-flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0h18M12 12.75h.008v.008H12v-.008Z" />
            </svg>
            {{ $announcement->created_at->diffForHumans() }}
        </span>
    </div>

    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400 leading-relaxed line-clamp-3">{{ Str::limit($announcement->content, 200) }}</p>

    {{-- Display uploaded media --}}
    @if($mediaPaths && count($mediaPaths))
        @php
            $mediaCount = count($mediaPaths);
            $isSingle = $mediaCount === 1;
        @endphp
        <div class="mt-3 {{ $isSingle ? 'space-y-2' : 'grid grid-cols-2 gap-2' }}">
            @foreach($mediaPaths as $path)
                @php
                    $isImage = in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']);
                    $isVideo = in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['mp4', 'mov', 'avi']);
                @endphp
                @if($isImage)
                    <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 cursor-pointer hover:opacity-90 transition-opacity {{ $isSingle ? '' : 'aspect-video' }}">
                        <img 
                            src="{{ asset('storage/'.$path) }}" 
                            alt="{{ $announcement->title }}" 
                            class="w-full h-full object-cover"
                            onclick="openImageModal('{{ asset('storage/'.$path) }}')"
                        />
                    </div>
                @elseif($isVideo)
                    <div class="rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 {{ $isSingle ? '' : 'aspect-video' }}">
                        <video controls class="w-full h-full object-cover bg-gray-50 dark:bg-gray-900">
                            <source src="{{ asset('storage/'.$path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                @endif
            @endforeach
        </div>
    @endif

    @if($showReactions ?? true)
        <div class="flex items-center gap-2 mt-4 flex-wrap">
            @foreach($reactionEmojis as $type => $emoji)
                <button
                    type="button"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium border transition-all bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600"
                >
                    {{ $emoji }} {{ $announcement->{$type.'_count'} ?? 0 }}
                </button>
            @endforeach
        </div>
    @endif
</div>

{{-- Image Modal --}}
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4" onclick="closeImageModal()">
    <div class="relative max-w-4xl max-h-full">
        <img id="modalImage" src="" alt="Full size image" class="max-w-full max-h-full object-contain rounded-lg" />
        <button onclick="closeImageModal()" class="absolute top-2 right-2 bg-white text-gray-800 rounded-full p-2 hover:bg-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>

<script>
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
