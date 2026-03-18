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
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js', 'resources/js/settings.js'])
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
                <p>Customize your EduBoard environment and branding.</p>
            </div>

            <div class="settings-grid-layout">
                {{-- Left: Theme & Appearance --}}
                <div class="settings-main-col">
                    <div class="settings-card-modern">
                        <div class="settings-card-header">
                            <div class="settings-card-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                            </div>
                            <div>
                                <h3>Appearance</h3>
                                <p>Customize how EduBoard looks on your screen.</p>
                            </div>
                        </div>
                        <div class="settings-card-body">
                            <div class="theme-selector-grid">
                                <label class="theme-option">
                                    <input type="radio" name="color-theme" value="light" checked>
                                    <div class="theme-preview light">
                                        <div class="preview-sidebar"></div>
                                        <div class="preview-content">
                                            <div class="preview-line"></div>
                                            <div class="preview-line short"></div>
                                        </div>
                                    </div>
                                    <span>Light Mode</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="color-theme" value="dark">
                                    <div class="theme-preview dark">
                                        <div class="preview-sidebar"></div>
                                        <div class="preview-content">
                                            <div class="preview-line"></div>
                                            <div class="preview-line short"></div>
                                        </div>
                                    </div>
                                    <span>Dark Mode</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="color-theme" value="system">
                                    <div class="theme-preview system">
                                        <div class="preview-split"></div>
                                    </div>
                                    <span>System Default</span>
                                </label>
                                <label class="theme-option">
                                    <input type="radio" name="color-theme" value="custom">
                                    <div class="theme-preview custom">
                                        <div class="preview-dots">
                                            <div class="dot color-1"></div>
                                            <div class="dot color-2"></div>
                                            <div class="dot color-3"></div>
                                        </div>
                                    </div>
                                    <span>Custom</span>
                                </label>
                            </div>

                            {{-- Custom Theme Controls (Hidden by default) --}}
                            <div id="customThemeControls" class="mt-8 space-y-4" style="display: none;">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="form-group-modern">
                                        <label>Primary Color</label>
                                        <div class="color-picker-wrapper">
                                            <input type="color" id="primaryColorPicker" value="#0d9488" class="color-input">
                                            <span class="color-hex" id="primaryHex">#0D9488</span>
                                        </div>
                                    </div>
                                    <div class="form-group-modern">
                                        <label>Topbar Background</label>
                                        <div class="color-picker-wrapper">
                                            <input type="color" id="topbarColorPicker" value="#ffffff" class="color-input">
                                            <span class="color-hex" id="topbarHex">#FFFFFF</span>
                                        </div>
                                    </div>
                                    <div class="form-group-modern">
                                        <label>Sidebar Background</label>
                                        <div class="color-picker-wrapper">
                                            <input type="color" id="sidebarColorPicker" value="#111827" class="color-input">
                                            <span class="color-hex" id="sidebarHex">#111827</span>
                                        </div>
                                    </div>
                                    <div class="form-group-modern">
                                        <label>Sidebar Text</label>
                                        <div class="color-picker-wrapper">
                                            <input type="color" id="sidebarTextColorPicker" value="#9ca3af" class="color-input">
                                            <span class="color-hex" id="sidebarTextHex">#9CA3AF</span>
                                        </div>
                                    </div>
                                    <div class="form-group-modern">
                                        <label>Sidebar Active</label>
                                        <div class="color-picker-wrapper">
                                            <input type="color" id="sidebarActiveColorPicker" value="#0d9488" class="color-input">
                                            <span class="color-hex" id="sidebarActiveHex">#0D9488</span>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-[11px] text-muted italic">Note: Custom theme colors will be applied across the entire EduBoard interface.</p>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card-modern">
                        <div class="settings-card-header">
                            <div class="settings-card-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            </div>
                            <div>
                                <h3>General Settings</h3>
                                <p>Basic configuration for your EduBoard instance.</p>
                            </div>
                        </div>
                        <div class="settings-card-body">
                            <form id="generalSettingsForm">
                                <div class="form-group-modern">
                                    <label>Site Name</label>
                                    <input type="text" class="form-control-modern" value="EduBoard" placeholder="Enter site name">
                                </div>
                                <div class="form-group-modern">
                                    <label>Site Description</label>
                                    <textarea class="form-control-modern" rows="3" placeholder="Enter description">A modern learning management system for Westfield Academy.</textarea>
                                </div>
                                <div class="settings-actions">
                                    <button type="submit" class="btn-save-settings">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Right: Branding & Logo --}}
                <div class="settings-side-col">
                    <div class="settings-card-modern">
                        <div class="settings-card-header">
                            <div class="settings-card-icon">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <h3>Branding</h3>
                                <p>Upload your institution's logo.</p>
                            </div>
                        </div>
                        <div class="settings-card-body">
                            <div class="logo-upload-container">
                                <div class="logo-preview-box" id="logoPreviewBox">
                                    <img src="{{ asset('images/Logo.jpg') }}" alt="Current Logo" id="currentLogoPreview">
                                    <div class="logo-overlay">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                        <span>Change Logo</span>
                                    </div>
                                    <input type="file" id="logoInput" accept="image/*" class="hidden-input">
                                </div>
                                <p class="upload-tip">Recommended: PNG or JPG, square aspect ratio, at least 200x200px.</p>
                                <button type="button" class="btn-outline-settings" id="resetLogoBtn">Reset to Default</button>
                            </div>
                        </div>
                    </div>

                    <div class="settings-card-modern danger">
                        <div class="settings-card-header">
                            <div class="settings-card-icon red">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-red-600">Danger Zone</h3>
                                <p>Irreversible actions.</p>
                            </div>
                        </div>
                        <div class="settings-card-body">
                            <button type="button" class="btn-danger-settings w-full">Reset All System Data</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Success Modal --}}
<div class="admin-modal" id="successModal">
    <div class="admin-modal-overlay" id="successModalOverlay"></div>
    <div class="admin-modal-box" style="max-width:400px;">
        <div class="admin-modal-header">
            <h3>Success</h3>
            <button class="admin-modal-close" id="closeSuccessModalTop">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="admin-modal-form">
            <div id="successModalIcon" style="text-align:center; display:none;">
                <svg class="animated-check" viewBox="0 0 52 52">
                    <circle class="animated-check-circle" cx="26" cy="26" r="25" fill="none" />
                    <path class="animated-check-path" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
            </div>
            <p id="successModalMessage" style="font-size:14px; color:var(--muted); text-align:center; line-height:1.6; margin-bottom:8px;">
                Action completed successfully.
            </p>
            <div class="admin-modal-actions">
                <button type="button" class="btn-save" id="closeSuccessModalBtn">Done</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const successModal = document.getElementById('successModal');
        const closeModal = () => successModal.classList.remove('show');
        
        document.getElementById('closeSuccessModalBtn')?.addEventListener('click', closeModal);
        document.getElementById('closeSuccessModalTop')?.addEventListener('click', closeModal);
        document.getElementById('successModalOverlay')?.addEventListener('click', closeModal);
    });
</script>

</body>
</html>
