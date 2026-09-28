@props(['action' => null, 'method' => 'get'])

<form
    method="{{ $method }}"
    action="{{ $action }}"
    {{ $attributes->merge(['class' => 'dashboard-filter-bar']) }}
>
    {{ $slot }}
</form>
