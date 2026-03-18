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

            <div class="about-section">
                <div class="about-grid">
                    <div class="about-info">
                        <h2>What is EduBoard?</h2>
                        <p>EduBoard is a comprehensive school communication platform designed to streamline announcements and updates within educational institutions. It provides a centralized hub where administrators, teachers, and students can interact in a secure, multi-tenant environment.</p>
                        <ul class="feature-list">
                            <li>
                                <div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg></div>
                                <span>Real-time school-wide announcements</span>
                            </li>
                            <li>
                                <div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
                                <span>Role-based access (Admin, Teacher, Student)</span>
                            </li>
                            <li>
                                <div class="feature-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg></div>
                                <span>Secure user approval workflow</span>
                            </li>
                        </ul>
                    </div>
                    <div class="about-cards">
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
                </div>
            </div>

            <div class="subscription-section">
                <div class="subscription-header">
                    <h2>Simple, Transparent Subscription</h2>
                    <p>Choose the plan that fits your school's needs.</p>
                </div>
                <div class="pricing-grid">
                    {{-- Basic --}}
                    <div class="price-card">
                        <div class="price-header">
                            <h3>Basic</h3>
                            <div class="price"><span>₱</span>0<span>/mo</span></div>
                        </div>
                        <ul class="price-features">
                            <li>1 Admin & 5 Teachers</li>
                            <li>Image uploads only</li>
                            <li>Pin announcements</li>
                            <li>Custom logo</li>
                            <li>Light and Dark mode</li>
                        </ul>
                        <button class="price-btn">Get Started</button>
                    </div>

                    {{-- Pro --}}
                    <div class="price-card popular">
                        <div class="popular-badge">Most Popular</div>
                        <div class="price-header">
                            <h3>Pro</h3>
                            <div class="price"><span>₱</span>199<span>/mo</span></div>
                        </div>
                        <ul class="price-features">
                            <li>5 Admins & 15 Teachers</li>
                            <li>Image & video uploads</li>
                            <li>Announcement categories</li>
                            <li>Theme customization</li>
                            <li>Priority support</li>
                        </ul>
                        <button class="price-btn">Upgrade Now</button>
                    </div>

                    {{-- Ultimate --}}
                    <div class="price-card">
                        <div class="price-header">
                            <h3>Ultimate</h3>
                            <div class="price"><span>₱</span>299<span>/mo</span></div>
                        </div>
                        <ul class="price-features">
                            <li>10 Admins & Unlimited Teachers</li>
                            <li>Full multimedia support</li>
                            <li>Custom branding & categories</li>
                            <li>Pre-built templates</li>
                            <li>24/7 dedicated support</li>
                        </ul>
                        <button class="price-btn">Contact Sales</button>
                    </div>
                </div>
            </div>

            <div class="footer-note">Demo for Westfield Academy &nbsp;•&nbsp; Ready to get started?</div>
        </main>
    </div>
</body>
</html>