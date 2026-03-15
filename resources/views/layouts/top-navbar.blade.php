<nav 
    x-data="{ 
        theme: localStorage.getItem('theme') || 'light',
        toggleTheme() {
            this.theme = this.theme === 'light' ? 'dark' : 'light';
            localStorage.setItem('theme', this.theme);
            if (this.theme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.removeAttribute('data-theme');
            }
        }
    }"
    class="bg-slate-900 border-b border-slate-800 px-6 py-3"
>
    <div class="flex items-center justify-between">
        <div class="text-lg font-semibold text-white">
            {{ request()->routeIs('teacher.dashboard') ? 'Dashboard' : (request()->routeIs('teacher.announcements') ? 'Announcements' : (request()->routeIs('teacher.my-announcements') ? 'My Announcements' : 'Westfield Academy')) }}
        </div>

        <div class="flex items-center gap-2 sm:gap-4">
            {{-- Dark mode --}}
            <button 
                @click="toggleTheme()" 
                class="p-2 text-slate-400 hover:text-white transition-colors"
                title="Toggle theme"
            >
                <template x-if="theme === 'light'">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                </template>
                <template x-if="theme === 'dark'">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                </template>
            </button>

            {{-- Notifications --}}
            <div class="relative" x-data="{ open: false }">
                <button 
                    @click="open = !open" 
                    class="relative p-2 rounded-full transition-all duration-200"
                    :class="open ? 'text-white bg-slate-800/50' : 'text-slate-400 hover:text-white hover:bg-slate-800/50'"
                    title="Notifications"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                    </svg>
                    <span class="absolute top-2 right-2 h-2.5 w-2.5 bg-red-500 rounded-full border-2 border-slate-900"></span>
                </button>

                <div 
                    x-show="open" 
                    @click.away="open = false" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-80 bg-slate-900 border border-slate-800 rounded-xl shadow-xl overflow-hidden z-50"
                    x-cloak
                >
                    <div class="px-4 py-3 border-b border-slate-800 flex items-center justify-between bg-slate-800/50">
                        <span class="text-sm font-semibold text-white">Notifications</span>
                        <span class="text-[10px] font-bold px-1.5 py-0.5 bg-blue-900/30 text-blue-400 rounded-full">3 NEW</span>
                    </div>

                    <div class="max-h-96 overflow-y-auto">
                        {{-- Emergency Notif --}}
                        <div class="px-4 py-3 hover:bg-slate-800/50 cursor-pointer border-b border-slate-800 transition-colors">
                            <div class="flex gap-3">
                                <div class="h-8 w-8 rounded-full bg-red-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="h-4 w-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-white truncate">Classes Suspended on March 10</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Emergency announcement from Dr. Santos</p>
                                    <p class="text-[10px] text-slate-500 mt-1">2 hours ago</p>
                                </div>
                                <div class="h-1.5 w-1.5 bg-blue-600 rounded-full mt-1"></div>
                            </div>
                        </div>

                        {{-- Event Notif --}}
                        <div class="px-4 py-3 hover:bg-slate-800/50 cursor-pointer border-b border-slate-800 transition-colors">
                            <div class="flex gap-3">
                                <div class="h-8 w-8 rounded-full bg-green-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="h-4 w-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-white truncate">Foundation Day Celebration</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Events Committee posted a new announcement</p>
                                    <p class="text-[10px] text-slate-500 mt-1">5 hours ago</p>
                                </div>
                                <div class="h-1.5 w-1.5 bg-blue-600 rounded-full mt-1"></div>
                            </div>
                        </div>

                        {{-- Administrative Notif --}}
                        <div class="px-4 py-3 hover:bg-slate-800/50 cursor-pointer border-b border-slate-800 transition-colors">
                            <div class="flex gap-3">
                                <div class="h-8 w-8 rounded-full bg-blue-900/30 flex items-center justify-center flex-shrink-0">
                                    <svg class="h-4 w-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-semibold text-white truncate">Library Extended Hours</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Library Services posted an administrative notice</p>
                                    <p class="text-[10px] text-slate-500 mt-1">1 day ago</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="px-4 py-2 bg-slate-800/80 border-t border-slate-800 text-center">
                        <a href="#" class="text-[10px] font-bold text-blue-400 hover:text-blue-300 uppercase tracking-wider">View all notifications</a>
                    </div>
                </div>
            </div>

            {{-- User Profile Dropdown --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 p-1.5 text-slate-400 hover:text-white transition-colors">
                    <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-xs font-bold text-white shadow-sm ring-2 ring-blue-500/20">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </button>

                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 mt-2 w-56 bg-slate-900 border border-slate-800 rounded-xl shadow-xl py-1.5 z-50 overflow-hidden" x-cloak>
                    <div class="px-4 py-3 border-b border-slate-800 bg-slate-800/50">
                        <div class="text-sm font-bold text-white">{{ Auth::user()->name }}</div>
                        <div class="text-[10px] text-slate-400 mt-0.5">{{ Auth::user()->email }}</div>
                    </div>
                    
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-xs font-medium text-slate-300 hover:bg-slate-800 transition-colors">
                        <svg class="h-4 w-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profile
                    </a>

                    <div class="border-t border-slate-800 my-1"></div>
                    
                    <form method="POST" action="{{ route('logout') }}" @submit="open = false">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-xs font-medium text-red-400 hover:bg-red-900/20 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
