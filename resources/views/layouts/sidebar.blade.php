<aside class="w-64 bg-white dark:bg-gray-800 shadow-md min-h-screen">
    <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Navigation</h2>
        <nav class="space-y-2">
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('dashboard') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Dashboard</a>
                <a href="{{ route('announcements') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('announcements') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Announcements</a>
                <a href="{{ route('user.management') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('user.management') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">User Management</a>
                <a href="{{ route('categories') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('categories') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Categories</a>
                <a href="{{ route('subscriptions') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('subscriptions') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Subscriptions</a>
                <a href="{{ route('settings') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('settings') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Settings</a>
            @elseif(auth()->user()->role === 'teacher')
                <a href="{{ route('announcements') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('announcements') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Announcements</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('profile.edit') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Profile</a>
            @else
                <a href="{{ route('announcements') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('announcements') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Announcements</a>
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded {{ request()->routeIs('profile.edit') ? 'bg-gray-200 dark:bg-gray-600' : '' }}">Profile</a>
            @endif
        </nav>
    </div>
</aside>