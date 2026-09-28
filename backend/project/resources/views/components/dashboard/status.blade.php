@props(['value'])
@php
    $styles = [1 => 'success', 2 => 'danger'];
    $labels = [1 => 'Running', 2 => 'Closed'];
    $style = $styles[$value] ?? 'warning';
    $label = $labels[$value] ?? 'Pending';
@endphp
<span {{ $attributes->merge(['class' => "dashboard-status dashboard-status--{$style}"]) }}>{{ $label }}</span>
