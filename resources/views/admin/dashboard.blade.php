<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - EduBoard</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
</head>
<body>

<div class="admin-layout">

    {{-- Left Sidebar --}}
    <x-admin-sidebar />

    {{-- Main --}}
    <div class="admin-main">

        {{-- Top Navbar --}}
        <x-admin-topbar title="Dashboard" />

        {{-- Content --}}
        <div class="admin-content">

            <div class="page-header">
                <h1>Dashboard</h1>
                <p>Welcome back, {{ auth()->user()->name }}</p>
            </div>

            {{-- Stats --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Total Announcements</div>
                        <div class="stat-value">8</div>
                    </div>
                    <div class="stat-icon teal">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Total Teachers</div>
                        <div class="stat-value">5</div>
                    </div>
                    <div class="stat-icon blue">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Total Students</div>
                        <div class="stat-value">5</div>
                    </div>
                    <div class="stat-icon amber">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147L12 14.63l7.74-4.483m-15.48 0L12 5.667l7.74 4.48m-15.48 0v6.331c0 .603.346 1.154.894 1.442L12 21.35l7.106-3.73a1.5 1.5 0 00.894-1.442V10.147m-15.48 0L12 14.63l7.74-4.483" />
                        </svg>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <div class="stat-label">Engagement Rate</div>
                        <div class="stat-value">87%</div>
                    </div>
                    <div class="stat-icon green">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Recent Announcements --}}
            <div class="section-header">
                <h2>Recent Announcements</h2>
                <a href="{{ route('admin.announcements') }}" class="section-link">View all →</a>
            </div>

            <div class="announcements">
                <div class="ann-card" id="ann-card-1">
                    <div class="ann-meta-top">
                        <span class="pinned-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                            </svg>
                            Pinned
                        </span>
                        <span class="tag emergency">Emergency</span>
                    </div>
                    <div class="ann-title">Classes Suspended on March 10</div>
                    <div class="ann-author">
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                            </svg>
                            Dr. Santos
                        </span>
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            2026-03-08
                        </span>
                    </div>
                    <div class="ann-body">Due to inclement weather, all classes are suspended on March 10, 2026. Please stay safe and monitor official channels for updates.</div>
                </div>

                <div class="ann-card" id="ann-card-2">
                    <div class="ann-meta-top">
                        <span class="pinned-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                            </svg>
                            Pinned
                        </span>
                        <span class="tag events">Events</span>
                    </div>
                    <div class="ann-title">Foundation Day Celebration</div>
                    <div class="ann-author">
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                            </svg>
                            Events Committee
                        </span>
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            2026-03-07
                        </span>
                    </div>
                    <div class="ann-body">Join us for the 50th Foundation Day celebration on March 15! Activities include a parade, cultural performances, and a grand alumni homecoming.</div>

                    {{-- Media Gallery --}}
                    <div class="ann-gallery" data-total="4">
                        <div class="gallery-track">
                            <div class="gallery-item">
                                <img src="{{ asset('images/download.jpg') }}" alt="Foundation Day 1" class="ann-image">
                            </div>
                            <div class="gallery-item">
                                <img src="{{ asset('images/download.jpg') }}" alt="Foundation Day 2" class="ann-image">
                            </div>
                            <div class="gallery-item">
                                <img src="{{ asset('images/download.jpg') }}" alt="Foundation Day 3" class="ann-image">
                            </div>
                            <div class="gallery-item">
                                <img src="{{ asset('images/download.jpg') }}" alt="Foundation Day 4" class="ann-image">
                            </div>
                        </div>
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
                        <div class="gallery-counter">1 / 4</div>
                    </div>
                </div>

                <div class="ann-card" id="ann-card-3">
                    <div class="ann-meta-top">
                        <span class="tag events">Events</span>
                    </div>
                    <div class="ann-title">Foundation Day Highlights Video</div>
                    <div class="ann-author">
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                            </svg>
                            Events Committee
                        </span>
                        <span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                            2026-03-14
                        </span>
                    </div>
                    <div class="ann-body">Watch the highlights from this year's Foundation Day celebration. Relive the parade, performances, and memorable moments from the event.</div>

                    {{-- Mixed Media Gallery --}}
                    <div class="ann-gallery" data-total="2">
                        <div class="gallery-track">
                            <div class="gallery-item">
                                <video class="ann-video ann-image" preload="metadata">
                                    <source src="{{ asset('video/simple.mp4') }}" type="video/mp4">
                                </video>
                            </div>
                            <div class="gallery-item">
                                <img src="{{ asset('images/download.jpg') }}" alt="Event Photo" class="ann-image">
                            </div>
                        </div>
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
                        <div class="gallery-counter">1 / 2</div>
                    </div>
                </div>





            </div>

        </div>
    </div>
</div>

</body>
</html>