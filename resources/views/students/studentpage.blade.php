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

            {{-- Card 1: Emergency --}}
            <div class="ann-card" id="card-emergency" data-category="emergency" data-for-you="true">
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
                <div class="ann-body">
                    Due to inclement weather, all classes are suspended on March 10, 2026. Please stay safe and monitor official channels for updates.
                </div>
                <div class="reactions">
                    <button class="reaction-btn"><span class="emoji">❤️</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">👍</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">🔥</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">😮</span> 0</button>
                </div>
            </div>

            {{-- Card 2: Events with multiple images --}}
            <div class="ann-card" id="card-events" data-category="events" data-for-you="true">
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
                <div class="ann-body">
                    Join us for the 50th Foundation Day celebration on March 15! Activities include a parade, cultural performances, and a grand alumni homecoming.
                </div>

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

                <div class="reactions">
                    <button class="reaction-btn"><span class="emoji">❤️</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">👍</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">🔥</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">😮</span> 0</button>
                </div>
            </div>

            {{-- Card 3: Administrative --}}
            <div class="ann-card" id="card-administrative" data-category="administrative">
                <div class="ann-meta-top">
                    <span class="tag administrative">Administrative</span>
                </div>
                <div class="ann-title">Library Extended Hours</div>
                <div class="ann-author">
                    <span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                        </svg>
                        Library Services
                    </span>
                    <span>
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        2026-03-05
                    </span>
                </div>
                <div class="ann-body">
                    The university library will extend its operating hours from 7 AM to 10 PM starting March 10 until the end of midterm examinations.
                </div>
                <div class="reactions">
                    <button class="reaction-btn"><span class="emoji">❤️</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">👍</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">🔥</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">😮</span> 0</button>
                </div>
            </div>

            {{-- Card 4: Mixed media (video + image) --}}
            <div class="ann-card" id="card-video" data-category="events">
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
                <div class="ann-body">
                    Watch the highlights from this year's Foundation Day celebration. Relive the parade, performances, and memorable moments from the event.
                </div>

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

                <div class="reactions">
                    <button class="reaction-btn"><span class="emoji">❤️</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">👍</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">🔥</span> 0</button>
                    <button class="reaction-btn"><span class="emoji">😮</span> 0</button>
                </div>
            </div>

        </div>
    </div>

</body>
</html>