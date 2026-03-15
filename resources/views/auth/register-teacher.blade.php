<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Teacher - EduBoard</title>
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
            <div class="auth-role-badge teacher">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0118 18c-2.305 0-4.408.867-6 2.292m0-14.25v14.25" />
                </svg>
                Teacher
            </div>

            {{-- Header --}}
            <div class="auth-header">
                <h1>Create Teacher Account</h1>
                <p>Register a new teacher</p>
            </div>

            <form method="POST" action="{{ route('teacher.register.store') }}" class="auth-form">
                @csrf

                <input type="hidden" name="role" value="teacher">

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input id="name" name="name" type="text"
                        value="{{ old('name') }}"
                        required autofocus autocomplete="name"
                        placeholder="Your full name">
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input id="email" name="email" type="email"
                        value="{{ old('email') }}"
                        required autocomplete="username"
                        placeholder="your@email.com">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" name="password" type="password"
                        required autocomplete="new-password"
                        placeholder="Create a password">
                    @error('password')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password"
                        required autocomplete="new-password"
                        placeholder="Confirm your password">
                    @error('password_confirmation')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="auth-actions">
                    <a href="{{ route('login') }}?role=teacher" class="auth-link">
                        Already registered? <span>Log in</span>
                    </a>
                    <button type="submit" class="btn-auth">Register</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>