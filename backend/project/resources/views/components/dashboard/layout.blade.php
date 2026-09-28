@props(['title' => 'Dashboard'])
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }} · {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/gn-central/preview-assets/gn-central-navigation.css') }}">
</head>
<body>
    @php
        $admin = auth('admin')->user();
    @endphp

    <div class="shell">
        <aside class="sidebar" aria-label="Primary navigation">
            <div class="brand">
                <img class="brand-logo" src="{{ asset('assets/dashboard/gn-central/preview-assets/ida-global-network-logo.png') }}" alt="IDA Global Network logo">
                <div>
                    <strong>Global Network Central</strong>
                    <span>International Dyslexia Association</span>
                </div>
            </div>

            <x-dashboard.flat-nav />

            <div class="sidebar-note">
                Signed in as <strong>{{ $admin?->name }}</strong>.
                Access across the Global Network workspace follows GN Central permissions and page-specific visibility rules.
            </div>
        </aside>

        <div class="dashboard-main main">
            <header class="dashboard-topbar topbar">
                <div>
                    <strong>{{ $title }}</strong>
                    <p>GN Central workspace powered by Charity backend data, permissions, and seeded member records.</p>
                </div>
                <div class="dashboard-topbar-actions">
                    <a class="dashboard-secondary-button" href="{{ route('admin.logout') }}">Sign out</a>
                </div>
            </header>

            <main class="dashboard-content content">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
