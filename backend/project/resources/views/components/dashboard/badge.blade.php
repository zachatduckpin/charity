@props([
    'tone' => 'neutral',
])

<span {{ $attributes->merge(['class' => "dashboard-badge dashboard-badge--{$tone}"]) }}>
    {{ $slot }}
</span>
