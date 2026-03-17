<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Settings - EduBoard</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'])
</head>
<body>

<div class="admin-layout">

    {{-- Left Sidebar --}}
    <x-admin-sidebar />

    {{-- Main --}}
    <div class="admin-main">

        {{-- Top Navbar --}}
        <x-admin-topbar title="Settings" />

        {{-- Content --}}
        <div class="admin-content">

            <div class="page-header">
                <h1>Settings</h1>
                <p>Manage your application settings here.</p>
            </div>

            {{-- Settings Content --}}
            <div class="settings-container">
                <div class="settings-card">
                    <div class="card-header">
                        <h3>General Settings</h3>
                        <p>Update your application's general settings.</p>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="site-name">Site Name</label>
                                <input type="text" id="site-name" class="form-control" value="EduBoard">
                            </div>
                            <div class="form-group">
                                <label for="site-description">Site Description</label>
                                <textarea id="site-description" class="form-control" rows="3">A modern learning management system.</textarea>
                            </div>
                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <select id="timezone" class="form-control">
                                    <option selected>(UTC-08:00) Pacific Time (US & Canada)</option>
                                    <option>(UTC-07:00) Mountain Time (US & Canada)</option>
                                    <option>(UTC-06:00) Central Time (US & Canada)</option>
                                    <option>(UTC-05:00) Eastern Time (US & Canada)</option>
                                </select>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="settings-card">
                    <div class="card-header">
                        <h3>Maintenance Mode</h3>
                        <p>Control the availability of your application.</p>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="toggle-switch">
                                <input type="checkbox" id="maintenance-mode" class="toggle-input">
                                <label for="maintenance-mode" class="toggle-label">
                                    <span class="toggle-handle"></span>
                                </label>
                                <div class="toggle-text">
                                    <div class="toggle-label-on">Enable Maintenance Mode</div>
                                    <div class="toggle-label-off">Maintenance mode is currently disabled.</div>
                                </div>
                            </div>
                            <p class="form-text">When enabled, your application will be unavailable to regular users.</p>
                        </div>
                    </div>
                </div>

                <div class="settings-card">
                    <div class="card-header">
                        <h3>Danger Zone</h3>
                        <p>These actions are irreversible. Please be certain.</p>
                    </div>
                    <div class="card-body">
                        <div class="danger-zone-item">
                            <div>
                                <h4>Reset All Settings</h4>
                                <p>This will restore all settings to their default values.</p>
                            </div>
                            <button class="btn btn-danger">Reset Settings</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
