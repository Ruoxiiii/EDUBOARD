<aside class="w-72 bg-slate-900 text-slate-200 min-h-screen flex flex-col sticky top-0 border-r border-slate-800 transition-colors duration-300" style="height: 100vh;">
    <div class="px-5 py-4 border-b border-slate-800">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="h-9 w-9 rounded-lg bg-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 text-white">
                    <path d="M3 12l9-9 9 9" />
                    <path d="M9 21V9h6v12" />
                </svg>
            </div>
            <div class="leading-tight">
                <div class="text-sm font-bold text-white">EduBoard</div>
                <div class="text-[10px] font-semibold uppercase tracking-wider text-slate-500">{{ auth()->user()->role }} Portal</div>
            </div>
        </a> 
    </div>

    <nav class="px-3 py-4 flex-1 space-y-1 overflow-y-auto">
        @php
            $linkBase = 'group flex items-center gap-3 rounded-xl px-3 py-2.5 text-xs font-semibold transition-all duration-200';
            $linkInactive = 'text-slate-400 hover:bg-slate-800/50 hover:text-white';
            $linkActive = 'bg-blue-900/20 text-blue-400 shadow-sm shadow-blue-500/10';
        @endphp

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('dashboard') }}" class="{{ $linkBase }} {{ request()->routeIs('dashboard') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M3 3h7v7H3z" />
                    <path d="M14 3h7v7h-7z" />
                    <path d="M14 14h7v7h-7z" />
                    <path d="M3 14h7v7H3z" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('announcements') }}" class="{{ $linkBase }} {{ request()->routeIs('announcements') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M4 4h16v16H4z" />
                    <path d="M8 8h8" />
                    <path d="M8 12h8" />
                    <path d="M8 16h5" />
                </svg>
                <span>Announcements</span>
            </a>
            <a href="{{ route('user.management') }}" class="{{ $linkBase }} {{ request()->routeIs('user.management') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                    <circle cx="9" cy="7" r="4" />
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                </svg>
                <span>User Management</span>
            </a>
            <a href="{{ route('categories') }}" class="{{ $linkBase }} {{ request()->routeIs('categories') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M20 7h-7l-2-2H4a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                </svg>
                <span>Categories</span>
            </a>
            <a href="{{ route('subscriptions') }}" class="{{ $linkBase }} {{ request()->routeIs('subscriptions') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <rect x="3" y="4" width="18" height="16" rx="2" />
                    <path d="M7 8h10" />
                    <path d="M7 12h10" />
                </svg>
                <span>Subscriptions</span>
            </a>
            <a href="{{ route('settings') }}" class="{{ $linkBase }} {{ request()->routeIs('settings') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M12 15.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                    <path d="M19.4 15a1.8 1.8 0 0 0 .36 1.98l.04.04a2.2 2.2 0 0 1-1.56 3.76h-.08a1.8 1.8 0 0 0-1.72 1.24 2.2 2.2 0 0 1-4.2 0A1.8 1.8 0 0 0 10.5 21h-1a1.8 1.8 0 0 0-1.72 1.24 2.2 2.2 0 0 1-4.2 0A1.8 1.8 0 0 0 1.86 20H1.8A2.2 2.2 0 0 1 .24 16.24l.04-.04A1.8 1.8 0 0 0 .64 14.2 2.2 2.2 0 0 1 2.2 10.44h.08A1.8 1.8 0 0 0 4 9.2a2.2 2.2 0 0 1 4.2 0A1.8 1.8 0 0 0 9.92 10.44h1.16A1.8 1.8 0 0 0 12.8 9.2a2.2 2.2 0 0 1 4.2 0A1.8 1.8 0 0 0 18.72 10.44h.08A2.2 2.2 0 0 1 21 12.64" />
                </svg>
                <span>Settings</span>
            </a>
        @elseif(auth()->user()->role === 'teacher')
            <a href="{{ route('teacher.dashboard') }}" class="{{ $linkBase }} {{ request()->routeIs('teacher.dashboard') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M3 3h7v7H3z" />
                    <path d="M14 3h7v7h-7z" />
                    <path d="M14 14h7v7h-7z" />
                    <path d="M3 14h7v7H3z" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('teacher.announcements') }}" class="{{ $linkBase }} {{ request()->routeIs('teacher.announcements') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M4 4h16v16H4z" />
                    <path d="M8 8h8" />
                    <path d="M8 12h8" />
                    <path d="M8 16h5" />
                </svg>
                <span>Announcements</span>
            </a>
            <a href="{{ route('teacher.my-announcements') }}" class="{{ $linkBase }} {{ request()->routeIs('teacher.my-announcements') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M21 15a4 4 0 0 1-4 4H7l-4 4V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4z" />
                    <path d="M8 9h8" />
                    <path d="M8 13h6" />
                </svg>
                <span>My Announcements</span>
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="{{ $linkBase }} {{ request()->routeIs('dashboard') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M3 3h7v7H3z" />
                    <path d="M14 3h7v7h-7z" />
                    <path d="M14 14h7v7h-7z" />
                    <path d="M3 14h7v7H3z" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('announcements') }}" class="{{ $linkBase }} {{ request()->routeIs('announcements') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M4 4h16v16H4z" />
                    <path d="M8 8h8" />
                    <path d="M8 12h8" />
                    <path d="M8 16h5" />
                </svg>
                <span>Announcements</span>
            </a>
            <a href="{{ route('profile.edit') }}" class="{{ $linkBase }} {{ request()->routeIs('profile.edit') ? $linkActive : $linkInactive }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                <span>Profile</span>
            </a>
        @endif
    </nav>

    <div class="px-5 py-4 border-t border-slate-800">
        <div class="text-xs text-slate-500">Logged in as</div>
        <div class="text-sm text-slate-200 truncate">{{ Auth::user()->name }}</div>
    </div>
</aside>