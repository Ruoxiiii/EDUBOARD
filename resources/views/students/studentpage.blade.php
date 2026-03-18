<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Announcements - Westfield Academy</title>
    {{-- Prevent dark mode flash --}}
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/announcements.css', 'resources/js/app.js', 'resources/js/navbar.js', 'resources/js/studentpage.js', 'resources/js/theme.js', 'resources/js/datefilter.js'])
</head>
<body>

    {{-- Navbar --}}
    <x-navbar />
    

    {{-- Content --}}
    <div class="content">

        {{-- Page Header --}}
        <div class="page-header">
            <h1>Announcements</h1>
            <p>Stay updated with the latest from Westfield Academy</p>
        </div>

        {{-- Tabs --}}
        <div class="tabs">
            <button class="tab active">General</button>
            <button class="tab">For You</button>
        </div>

        {{-- Category Pills --}}
        <div class="categories">
            <button class="pill all active">All</button>
            <button class="pill academic">Academic</button>
            <button class="pill events">Events</button>
            <button class="pill administrative">Administrative</button>
            <button class="pill student-affairs">Student Affairs</button>
            <button class="pill emergency">Emergency</button>
            <button class="pill general">General</button>
        </div>

        {{-- Date Filter --}}
        <div class="date-filter">
            <div class="date-filter-inner">
                <div class="date-input-group">
                    <label for="dateFrom">From</label>
                    <input type="date" id="dateFrom" class="date-input">
                </div>
                <div class="date-separator">—</div>
                <div class="date-input-group">
                    <label for="dateTo">To</label>
                    <input type="date" id="dateTo" class="date-input">
                </div>
                <button class="date-filter-btn" id="applyDateFilter">Apply</button>
                <button class="date-filter-clear" id="clearDateFilter">Clear</button>
            </div>
        </div>

        {{-- Announcement Cards --}}
        <div class="space-y-4">
            
            {{-- ── EXAMPLE ANNOUNCEMENT WITH ADMIN/TEACHER DESIGN ── --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-all" data-category="events">
                <div class="flex items-start justify-between gap-4 mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 overflow-hidden flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold">
                            SA
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">System Admin</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ now()->format('M d, Y') }} · Events</p>
                        </div>
                    </div>
                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase rounded-md tracking-wider">Pinned</span>
                </div>
                <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">Welcome to Westfield Academy: Highlights & Resources</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                    Welcome students! Check out our campus highlights and official logo. We are excited to have you here at Westfield Academy. Watch the video below to see our latest events!
                </p>

                {{-- Photo Display (Grid Layout like Admin/Teacher) --}}
                <div class="grid grid-cols-2 gap-3 mt-4">
                    <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                        <img src="{{ asset('images/Logo.jpg') }}" alt="Westfield Logo" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                        <video class="w-full h-full object-cover" controls preload="metadata">
                            <source src="{{ asset('video/simple.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>

                <div class="flex items-center gap-3 mt-4">
                    <button class="flex items-center gap-1 px-3 py-1 rounded-full bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">❤️ 12</button>
                    <button class="flex items-center gap-1 px-3 py-1 rounded-full bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">👍 8</button>
                    <button class="flex items-center gap-1 px-3 py-1 rounded-full bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors">🔥 5</button>
                </div>
            </div>

            @php
                $announcements = \App\Models\Announcement::with('postedBy')->orderBy('is_pinned', 'desc')->orderBy('pinned_at', 'desc')->latest()->get();
            @endphp

            @forelse($announcements as $announcement)
                @php
                    $mediaPaths = is_array($announcement->media_paths) ? $announcement->media_paths : json_decode($announcement->media_paths ?? '[]', true) ?? [];
                    $mediaCount = count($mediaPaths);
                    $authorInitial = strtoupper(substr($announcement->postedBy?->name ?? 'S', 0, 1));
                    $categoryClass = match(strtolower($announcement->category)) {
                        'emergency' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
                        'events' => 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400',
                        'academic' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                        'administrative' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400',
                        default => 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'
                    };
                    $avatarClass = match(strtolower($announcement->category)) {
                        'emergency' => 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400',
                        'events' => 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400',
                        'academic' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400',
                        'administrative' => 'bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400',
                        default => 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400'
                    };
                @endphp
                <div class="ann-card bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm hover:shadow-md transition-all" id="card-{{ $announcement->id }}" data-category="{{ strtolower($announcement->category) }}">
                    <div class="flex items-start justify-between gap-4 mb-3">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full {{ $avatarClass }} overflow-hidden flex items-center justify-center font-bold">
                                {{ $authorInitial }}
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $announcement->postedBy?->name ?? 'System' }}</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $announcement->created_at->format('M d, Y') }} · {{ $announcement->category }}</p>
                            </div>
                        </div>
                        @if($announcement->is_pinned)
                            <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase rounded-md tracking-wider">Pinned</span>
                        @endif
                    </div>
                    
                    <h3 class="text-base font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $announcement->title }}</h3>
                    
                    <div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed {{ $mediaCount > 0 ? 'mb-4' : '' }}">
                        {{ $announcement->content }}
                    </div>

                    @if($mediaCount > 0)
                        {{-- Photo Display (Grid Layout like Admin/Teacher) --}}
                        <div class="grid {{ $mediaCount > 1 ? 'grid-cols-2' : 'grid-cols-1' }} gap-3 mt-4">
                            @foreach($mediaPaths as $path)
                                @php
                                    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                                    $isVideo = in_array($extension, ['mp4', 'mov', 'avi']);
                                @endphp
                                <div class="rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 aspect-video">
                                    @if($isImage)
                                        <img src="{{ asset('storage/'.$path) }}" alt="{{ $announcement->title }}" class="w-full h-full object-cover">
                                    @elseif($isVideo)
                                        <video class="w-full h-full object-cover" controls preload="metadata">
                                            <source src="{{ asset('storage/'.$path) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex items-center gap-3 mt-4">
                        <button class="flex items-center gap-1 px-3 py-1 rounded-full bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">❤️ {{ $announcement->heart_count ?? 0 }}</button>
                        <button class="flex items-center gap-1 px-3 py-1 rounded-full bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">👍 {{ $announcement->like_count ?? 0 }}</button>
                        <button class="flex items-center gap-1 px-3 py-1 rounded-full bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors">🔥 {{ $announcement->fire_count ?? 0 }}</button>
                        <button class="flex items-center gap-1 px-3 py-1 rounded-full bg-gray-50 dark:bg-gray-700/50 text-xs font-semibold text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">😮 {{ $announcement->sad_count ?? 0 }}</button>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="display: flex;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                    </svg>
                    <p>No announcements found.</p>
                </div>
            @endforelse
        </div>
    </div>

</body>
</html>
