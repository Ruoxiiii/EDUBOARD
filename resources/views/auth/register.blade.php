<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - EduBoard</title>
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
            <div class="auth-role-badge student">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147L12 14.63l7.74-4.483m-15.48 0L12 5.667l7.74 4.48m-15.48 0v6.331c0 .603.346 1.154.894 1.442L12 21.35l7.106-3.73a1.5 1.5 0 00.894-1.442V10.147m-15.48 0L12 14.63l7.74-4.483" />
                </svg>
                Student
            </div>

            {{-- Header --}}
            <div class="auth-header">
                <h1>Create account</h1>
                <p>Register as a new student</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                {{-- Hidden role --}}
                <input type="hidden" name="role" value="student">

                {{-- Account Info --}}
                <div class="form-divider-label">Account Information</div>

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

                {{-- Student Info --}}
                <div class="form-divider-label" style="margin-top: 8px;">Student Information</div>

                <div class="form-group">
                    <label for="course">Course</label>
                    <input id="course" name="course" type="text"
                        value="{{ old('course') }}"
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
                                <option value="{{ $year }}" {{ old('year_level') === $year ? 'selected' : '' }}>
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
                            value="{{ old('section') }}"
                            placeholder="e.g. A, B, C">
                        @error('section')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="auth-actions">
                    <a href="{{ route('login') }}?role=student" class="auth-link">
                        Already registered? <span>Log in</span>
                    </a>
                    <button type="submit" class="btn-auth">Register</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>