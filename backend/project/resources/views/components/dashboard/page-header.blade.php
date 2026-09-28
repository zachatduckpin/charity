@props([
    'title',
    'eyebrow' => 'Charity operations',
    'description' => null,
])

<header class="dashboard-page-header">
    <div>
        <span class="dashboard-eyebrow">{{ $eyebrow }}</span>
        <h1>{{ $title }}</h1>
        @if ($description)
            <p class="dashboard-page-description">{{ $description }}</p>
        @endif
    </div>

    @if (trim($slot) !== '')
        <div class="dashboard-page-actions">
            {{ $slot }}
        </div>
    @endif
</header>
