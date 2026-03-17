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
    @vite(['resources/css/announcements.css', 'resources/js/app.js', 'resources/js/navbar.js', 'resources/js/studentpage.js', 'resources/js/theme.js', 'resources/js/datefilter.js'])
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
        <div class="announcements">
            @php
                $announcements = \App\Models\Announcement::with('postedBy')->orderBy('is_pinned', 'desc')->orderBy('pinned_at', 'desc')->latest()->get();
            @endphp

            @forelse($announcements as $announcement)
                @php
                    $mediaPaths = is_array($announcement->media_paths) ? $announcement->media_paths : json_decode($announcement->media_paths ?? '[]', true) ?? [];
                    $mediaCount = count($mediaPaths);
                @endphp
                <div class="ann-card" id="card-{{ $announcement->id }}" data-category="{{ strtolower($announcement->category) }}">
                    <div class="ann-meta-top">
                        @if($announcement->is_pinned)
                            <span class="pinned-label">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                                </svg>
                                Pinned
                            </span>
                        @endif
                        <span class="tag {{ strtolower($announcement->category) }}">{{ $announcement->category }}</span>
                    </div>
                    <div class="ann-title">{{ $announcement->title }}</div>
                    <div class="ann-author">
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                            </svg>
                            {{ $announcement->postedBy?->name ?? 'System' }}
                        </span>
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            {{ $announcement->created_at->format('Y-m-d') }}
                        </span>
                    </div>
                    <div class="ann-body">
                        {{ $announcement->content }}
                    </div>

                    @if($mediaCount > 0)
                        {{-- Media Gallery --}}
                        <div class="ann-gallery" data-total="{{ $mediaCount }}">
                            <div class="gallery-track">
                                @foreach($mediaPaths as $path)
                                    @php
                                        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                                        $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
                                        $isVideo = in_array($extension, ['mp4', 'mov', 'avi']);
                                    @endphp
                                    <div class="gallery-item">
                                        @if($isImage)
                                            <img src="{{ asset('storage/'.$path) }}" alt="{{ $announcement->title }}" class="ann-image">
                                        @elseif($isVideo)
                                            <video class="ann-video ann-image" preload="metadata">
                                                <source src="{{ asset('storage/'.$path) }}" type="video/mp4">
                                            </video>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            @if($mediaCount > 1)
                                <button class="gallery-btn gallery-prev" aria-label="Previous">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                    </svg>
                                </button>
                                <button class="gallery-btn gallery-next" aria-label="Next">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                                <div class="gallery-counter">1 / {{ $mediaCount }}</div>
                            @endif
                        </div>
                    @endif

                    <div class="reactions">
                        <button class="reaction-btn"><span class="emoji">❤️</span> {{ $announcement->heart_count ?? 0 }}</button>
                        <button class="reaction-btn"><span class="emoji">👍</span> {{ $announcement->like_count ?? 0 }}</button>
                        <button class="reaction-btn"><span class="emoji">🔥</span> {{ $announcement->fire_count ?? 0 }}</button>
                        <button class="reaction-btn"><span class="emoji">😮</span> {{ $announcement->sad_count ?? 0 }}</button>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted py-10">No announcements found.</p>
            @endforelse
        </div>
    </div>

</body>
</html>