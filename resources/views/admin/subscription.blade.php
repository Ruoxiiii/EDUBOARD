<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Subscription - EduBoard Admin</title>
    @vite(['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js', 'resources/js/subscription.js'])
    @include('partials.appearance-script')
</head>
<body>

<div class="admin-layout {{ ($appearance['navPos'] ?? 'left') === 'top' ? 'nav-top' : (($appearance['navPos'] ?? 'left') === 'right' ? 'nav-right' : 'nav-left') }}">
    <x-admin-sidebar />
    <div class="admin-main">
        <x-admin-topbar title="Subscription" />
        <div class="admin-content">

            {{-- Page Header --}}
            <div class="page-header">
                <h1>Subscription Plan</h1>
                <p>Manage your current plan and billing</p>
            </div>

            {{-- Current Plan Card --}}
            <div class="current-plan-card">
                <div class="current-plan-left">
                    <div class="current-plan-label">Current Plan</div>
                    <div class="current-plan-name">Pro</div>
                    <div class="current-plan-features">
                        <span class="plan-feature">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            5 Admins
                        </span>
                        <span class="plan-feature">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            15 Teachers
                        </span>
                        <span class="plan-feature">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Image & Video uploads
                        </span>
                        <span class="plan-feature">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Announcement categories
                        </span>
                        <span class="plan-feature">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                            Theme customization
                        </span>
                    </div>
                </div>
                <div style="display: flex; gap: 12px; align-items: center;">
                    <button class="btn-new-ann" id="viewPlansBtn" style="background: var(--surface); color: var(--text); border: 1px solid var(--border);">View Plans</button>
                    <button class="btn-new-ann" id="upgradeBtn">Upgrade</button>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Plans Modal (full screen overlay) --}}
<div class="plans-overlay" id="plansOverlay">
    <div class="plans-page">

        {{-- Plans Header --}}
        <div class="plans-header">
            <div class="plans-brand">
                <div class="sidebar-brand-icon" style="width:32px;height:32px;border-radius:8px;">
                    <svg fill="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;color:white;">
                        <path d="M12 3L2 12h3v8h14v-8h3L12 3zm0 4.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5-1.5-.67-1.5-1.5.67-1.5 1.5-1.5zm3 10.5H9v-4h6v4z"/>
                    </svg>
                </div>
                <span style="font-family:'Sora',sans-serif; font-weight:700; font-size:17px; color:var(--text);">EduBoard</span>
            </div>
            <button class="plans-back-btn" id="closePlansBtn">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back
            </button>
        </div>

        {{-- Plans Hero --}}
        <div class="plans-hero">
            <h1>Simple, transparent pricing</h1>
            <p>Choose the plan that fits your school</p>
        </div>

        {{-- Pricing Cards --}}
        <div class="pricing-grid">
            <x-subscription.basic-plan />
            <x-subscription.pro-plan />
            <x-subscription.ultimate-plan />
        </div>
    </div>
</div>

</body>
</html>