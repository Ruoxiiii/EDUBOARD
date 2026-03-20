<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - EduBoard</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @if(auth()->user()->role === 'admin')
        @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/css/profile.css', 'resources/js/app.js', 'resources/js/admin.js', 'resources/js/profile.js'])
    @else
        @vite(['resources/css/announcements.css', 'resources/css/profile.css', 'resources/js/app.js', 'resources/js/navbar.js', 'resources/js/theme.js', 'resources/js/profile.js'])
    @endif
</head>
<body>

@if(auth()->check())

    {{-- ── Global Layout (Sidebar) for all roles ── --}}
    <div class="admin-layout {{ ($appearance['navPos'] ?? 'left') === 'top' ? 'nav-top' : (($appearance['navPos'] ?? 'left') === 'right' ? 'nav-right' : 'nav-left') }}">
        @if(auth()->user()->role === 'admin')
            <x-admin-sidebar />
        @else
            @include('layouts.sidebar')
        @endif

        <div class="admin-main">
            @if(auth()->user()->role === 'admin')
                <x-admin-topbar title="Profile" />
            @else
                @include('layouts.top-navbar')
            @endif

            <div class="admin-content">
                <div class="profile-content">
                    <div class="profile-layout">
                        @include('profile.partials.profile-body', ['user' => $user])
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif

</body>
</html>