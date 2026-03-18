<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reports - EduBoard Admin</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
</head>
<body>

<div class="admin-layout">
    <x-admin-sidebar />

    <div class="admin-main">
        <x-admin-topbar title="Reports" />

        <div class="admin-content">
            <div class="page-header">
                <h1>System Reports</h1>
                <p>Generate and view activity reports by date</p>
            </div>

            <form action="{{ route('admin.reports') }}" method="GET" class="user-filters">
                <div class="user-filter-group">
                    <label for="year">Year</label>
                    <select name="year" id="year">
                        @foreach($availableYears as $y)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="user-filter-group">
                    <label for="month">Month</label>
                    <select name="month" id="month">
                        <option value="">All Months</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="user-filter-group">
                    <label for="day">Day</label>
                    <input type="number" name="day" id="day" min="1" max="31" value="{{ $day }}" placeholder="e.g. 15" class="form-control" style="width: 100px; padding: 8px 12px; height: 38px;">
                </div>

                <div style="display: flex; gap: 8px;">
                    <button type="submit" class="btn btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" style="width: 15px; height: 15px;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('admin.reports') }}" class="btn" style="background: var(--bg); color: var(--text); border: 1.5px solid var(--border);">Reset</a>
                </div>
            </form>

            <div style="display: flex; flex-direction: column; gap: 32px; mt-8">
                {{-- Announcements Report --}}
                <div>
                    <div class="section-header">
                        <h2>Announcements Report ({{ $announcements->count() }})</h2>
                    </div>
                    <div class="users-table-wrap">
                        <table class="users-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Posted By</th>
                                    <th>Date</th>
                                    <th>Engagement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($announcements as $announcement)
                                    <tr>
                                        <td><div class="user-name-cell">{{ $announcement->title }}</div></td>
                                        <td>
                                            @php
                                                $categoryClass = match(strtolower($announcement->category)) {
                                                    'emergency' => 'tag emergency',
                                                    'events' => 'tag events',
                                                    'academic' => 'tag academic',
                                                    'administrative' => 'tag administrative',
                                                    default => 'tag general'
                                                };
                                            @endphp
                                            <span class="{{ $categoryClass }}">{{ ucfirst($announcement->category) }}</span>
                                        </td>
                                        <td>
                                            <div class="user-name-cell">
                                                <div class="user-avatar-sm">
                                                    {{ strtoupper(substr($announcement->postedBy->name ?? '?', 0, 1)) }}
                                                </div>
                                                {{ $announcement->postedBy->name ?? 'Deleted User' }}
                                            </div>
                                        </td>
                                        <td class="text-muted">{{ $announcement->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div style="display: flex; gap: 12px; color: var(--muted); font-size: 12px; font-weight: 600;">
                                                <span style="display: flex; align-items: center; gap: 4px;">❤️ {{ $announcement->likes }}</span>
                                                <span style="display: flex; align-items: center; gap: 4px;">💬 {{ $announcement->comments }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 48px; color: var(--muted);">
                                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" style="width: 48px; height: 48px; opacity: 0.2;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                                </svg>
                                                No announcements found for this period.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Users Report --}}
                <div>
                    <div class="section-header">
                        <h2>New Registrations ({{ $users->count() }})</h2>
                    </div>
                    <div class="users-table-wrap">
                        <table class="users-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Joined Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>
                                            <div class="user-name-cell">
                                                <div class="user-avatar-sm">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td class="text-muted">{{ $user->email }}</td>
                                        <td>
                                            <span class="status-badge inactive" style="background: var(--bg); color: var(--text); border: 1px solid var(--border);">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                        <td class="text-muted">{{ $user->created_at->format('M d, Y') }}</td>
                                        <td>
                                            @if($user->email_verified_at)
                                                <span class="status-badge active">Verified</span>
                                            @else
                                                <span class="status-badge" style="background: #fef2f2; color: #ef4444;">Unverified</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="text-align: center; padding: 48px; color: var(--muted);">
                                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5" style="width: 48px; height: 48px; opacity: 0.2;">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                                </svg>
                                                No new users found for this period.
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
