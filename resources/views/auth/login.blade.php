<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - EduBoard</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/auth.css', 'resources/js/app.js', 'resources/js/theme.js'])
</head>
<body>
    @php $role = request('role', 'student'); @endphp

    <div class="auth-wrapper">

        {{-- Brand --}}
        <a href="{{ url('/') }}" class="auth-brand">
            <div class="auth-brand-icon">
                <svg fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 4.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm3 10.5H9v-4h6v4z"/>
                </svg>
            </div>
            <span class="auth-brand-name">EduBoard</span>
        </a>

        <div class="auth-card">

            {{-- Role Badge --}}
            <div class="auth-role-badge {{ $role }}">
                @if($role === 'admin')
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                    </svg>
                    Admin
                @elseif($role === 'teacher')
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                    </svg>
                    Teacher
                @else
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147L12 14.63l7.74-4.483m-15.48 0L12 5.667l7.74 4.48m-15.48 0v6.331c0 .603.346 1.154.894 1.442L12 21.35l7.106-3.73a1.5 1.5 0 00.894-1.442V10.147m-15.48 0L12 14.63l7.74-4.483" />
                    </svg>
                    Student
                @endif
            </div>

            {{-- Header --}}
            <div class="auth-header">
                <h1>Welcome back</h1>
                <p>Sign in to your {{ ucfirst($role) }} account</p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="auth-status" style="margin-bottom: 16px;">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email"
                        value="{{ old('email') }}"
                        required autofocus autocomplete="username"
                        placeholder="your@email.com">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password"
                        required autocomplete="current-password"
                        placeholder="Enter your password">
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-remember">
                    <input id="remember_me" type="checkbox" name="remember">
                    <label for="remember_me">Remember me</label>
                </div>

                <div class="auth-actions">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="auth-link">
                            Forgot your password?
                        </a>
                    @endif
                    <button type="submit" class="btn-auth">Log In</button>
                </div>

                {{-- Register link based on role --}}
                <div style="text-align: center; margin-top: 8px;">
                    @if($role === 'student' && Route::has('register'))
                        <a href="{{ route('register') }}?role=student" class="auth-link">
                            Don't have an account? <span>Register</span>
                        </a>
                    @elseif($role === 'admin')
                        <a href="{{ route('admin.register') }}" class="auth-link">
                            New admin account? <span>Register</span>
                        </a>
                    @elseif($role === 'teacher')
                        <a href="{{ route('teacher.register') }}" class="auth-link">
                            New teacher account? <span>Register</span>
                        </a>
                    @endif
                </div>

            </form>
        </div>
    </div>
</body>
</html>