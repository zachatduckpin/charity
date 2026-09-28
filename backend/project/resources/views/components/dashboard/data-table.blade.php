@props([
    'caption' => null,
])

<div {{ $attributes->merge(['class' => 'dashboard-panel dashboard-table-wrap']) }}>
    <table class="dashboard-table">
        @if ($caption)
            <caption class="sr-only">{{ $caption }}</caption>
        @endif

        {{ $slot }}
    </table>
</div>
