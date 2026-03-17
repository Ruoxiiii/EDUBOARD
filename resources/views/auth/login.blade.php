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

            {{-- Header --}}
            <div class="auth-header">
                <h1>Welcome back</h1>
                <p>Sign in to your account to continue</p>
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

                <div style="text-align: center; margin-top: 8px;">
                    <a href="{{ url('/') }}" class="auth-link">
                        ← Back to home
                    </a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>