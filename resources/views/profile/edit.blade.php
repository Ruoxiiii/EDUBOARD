<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile - Westfield Academy</title>
    {{-- Prevent dark mode flash --}}
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/announcements.css', 'resources/css/profile.css', 'resources/js/app.js', 'resources/js/navbar.js', 'resources/js/theme.js'])
</head>
<body>

    {{-- Navbar --}}
    <x-navbar />

    {{-- Content --}}
    <div class="profile-content">
        <div class="profile-layout">

            {{-- Left Column: Profile Header --}}
            <div class="profile-header">
                <div class="profile-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="profile-info">
                    <h1>{{ auth()->user()->name }}</h1>
                    <p>{{ auth()->user()->email }}</p>
                    @php
                        $roleClass = match(auth()->user()->role) {
                            'admin'   => 'role-admin',
                            'teacher' => 'role-teacher',
                            default   => 'role-student',
                        };
                    @endphp
                    <span class="profile-role {{ $roleClass }}">{{ ucfirst(auth()->user()->role) }}</span>

                    {{-- Student info --}}
                    @if(auth()->user()->role === 'student')
                        <div class="profile-student-info">
                            @if(auth()->user()->course)
                                <span>{{ auth()->user()->course }}</span>
                            @endif
                            @if(auth()->user()->year_level || auth()->user()->section)
                                <span>
                                    {{ auth()->user()->year_level }}
                                    {{ auth()->user()->year_level && auth()->user()->section ? '·' : '' }}
                                    {{ auth()->user()->section ? 'Section ' . auth()->user()->section : '' }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right Column: Forms --}}
            <div class="profile-sections">

                {{-- Profile Information --}}
                <div class="profile-card">
                    <div class="profile-card-header">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                        </svg>
                        <div>
                            <h2>Profile Information</h2>
                            <p>Update your name and email address</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="profile-form">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input id="name" name="name" type="text"
                                value="{{ old('name', $user->name) }}"
                                required autofocus autocomplete="name"
                                placeholder="Your full name">
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input id="email" name="email" type="email"
                                value="{{ old('email', $user->email) }}"
                                required autocomplete="username"
                                placeholder="your@email.com">
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Student-only fields --}}
                        @if(auth()->user()->role === 'student')
                            <div class="form-group">
                                <label for="course">Course</label>
                                <input id="course" name="course" type="text"
                                    value="{{ old('course', $user->course) }}"
                                    placeholder="e.g. Bachelor of Science in Computer Science">
                                @error('course')
                                    <span class="form-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="year_level">Year Level</label>
                                    <select id="year_level" name="year_level">
                                        <option value="">Select year level</option>
                                        @foreach(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'] as $year)
                                            <option value="{{ $year }}" {{ old('year_level', $user->year_level) === $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('year_level')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="section">Section</label>
                                    <input id="section" name="section" type="text"
                                        value="{{ old('section', $user->section) }}"
                                        placeholder="e.g. A, B, C or Section 1">
                                    @error('section')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Save Changes
                            </button>
                            @if (session('status') === 'profile-updated')
                                <span class="form-success">Saved successfully!</span>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Update Password --}}
                <div class="profile-card">
                    <div class="profile-card-header">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        <div>
                            <h2>Update Password</h2>
                            <p>Use a long, random password to stay secure</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="profile-form">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input id="current_password" name="current_password" type="password"
                                autocomplete="current-password"
                                placeholder="Enter current password">
                            @error('current_password', 'updatePassword')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" name="password" type="password"
                                autocomplete="new-password"
                                placeholder="Enter new password">
                            @error('password', 'updatePassword')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                autocomplete="new-password"
                                placeholder="Confirm new password">
                            @error('password_confirmation', 'updatePassword')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                                Update Password
                            </button>
                            @if (session('status') === 'password-updated')
                                <span class="form-success">Password updated!</span>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Delete Account --}}
                <div class="profile-card profile-card--danger">
                    <div class="profile-card-header">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                        <div>
                            <h2>Delete Account</h2>
                            <p>Permanently delete your account and all data</p>
                        </div>
                    </div>

                    <p class="danger-desc">
                        Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.
                    </p>

                    <button class="btn-danger" id="deleteAccountBtn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                        </svg>
                        Delete Account
                    </button>

                    {{-- Delete Confirm Modal --}}
                    <div class="delete-modal" id="deleteModal">
                        <div class="delete-modal-overlay" id="deleteModalOverlay"></div>
                        <div class="delete-modal-box">
                            <h3>Are you sure?</h3>
                            <p>Once deleted, all your data will be permanently removed. Please enter your password to confirm.</p>
                            <form method="post" action="{{ route('profile.destroy') }}" class="profile-form">
                                @csrf
                                @method('delete')
                                <div class="form-group">
                                    <label for="delete_password">Password</label>
                                    <input id="delete_password" name="password" type="password" placeholder="Enter your password">
                                    @error('password', 'userDeletion')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="delete-modal-actions">
                                    <button type="button" class="btn-cancel" id="cancelDeleteBtn">Cancel</button>
                                    <button type="submit" class="btn-danger">Delete Account</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            {{-- End Right Column --}}

        </div>
        {{-- End Profile Layout --}}
    </div>

</body>
</html>