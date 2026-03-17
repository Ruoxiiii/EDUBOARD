<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EduBoard - Multi-Tenant School Bulletin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/welcome.css', 'resources/js/app.js'])
</head>
<body>
    <div class="page">
        {{-- Floating particles --}}
        <div class="particles">
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
            <span></span><span></span><span></span>
        </div>

        <header>
            <a href="#" class="logo">
                <div class="logo-icon">
                    <svg fill="currentColor" viewBox="0 0 24 24"><path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 4.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm3 10.5H9v-4h6v4z"/></svg>
                </div>
                <span class="logo-text">EduBoard</span>
            </a>
            <nav>
                <a href="{{ route('login') }}">Login</a>
            </nav>
        </header>

        <main>
            <div class="hero">
                <h1>Welcome to <span>EduBoard</span></h1>
                <p>Multi-Tenant School Bulletin &amp; Announcement System</p>
            </div>

            <div class="cards">
                {{-- Admin --}}
                <a href="{{ route('admin.register') }}" class="card card--admin">
                    <div class="card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <h3>Admin</h3>
                    <p>Manage announcements, users, categories, and school settings</p>
                    <div class="card-enter">Register <span class="arrow">→</span></div>
                </a>

                {{-- Teacher --}}
                <a href="{{ route('teacher.register') }}" class="card card--teacher">
                    <div class="card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                    <h3>Teacher</h3>
                    <p>Create and manage your announcements for students</p>
                    <div class="card-enter">Register <span class="arrow">→</span></div>
                </a>

                {{-- Student --}}
                <a href="{{ route('register') }}?role=student" class="card card--student">
                    <div class="card-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147L12 14.63l7.74-4.483m-15.48 0L12 5.667l7.74 4.48m-15.48 0v6.331c0 .603.346 1.154.894 1.442L12 21.35l7.106-3.73a1.5 1.5 0 00.894-1.442V10.147m-15.48 0L12 14.63l7.74-4.483" />
                        </svg>
                    </div>
                    <h3>Student</h3>
                    <p>View announcements and react to updates</p>
                    <div class="card-enter">Register <span class="arrow">→</span></div>
                </a>
            </div>

            <div class="footer-note">Demo for Westfield Academy &nbsp;•&nbsp; Select a role to register</div>
        </main>
    </div>
</body>
</html>