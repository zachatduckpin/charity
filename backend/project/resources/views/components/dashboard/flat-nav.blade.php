@php
    $navigation = \App\Support\Dashboard\GnCentralCatalog::flatNavigation();
    $canAccess = function (?string $permission): bool {
        if ($permission === null) {
            return true;
        }

        return (bool) auth('admin')->user()?->can($permission);
    };
    $isActive = function (array $patterns): bool {
        foreach ($patterns as $pattern) {
            if (request()->routeIs($pattern)) {
                return true;
            }
        }

        return false;
    };
@endphp

<nav class="nav">
    @foreach ($navigation as $item)
        @if ($canAccess($item['permission'] ?? null))
            <a
                class="{{ $isActive($item['patterns'] ?? []) ? 'active' : '' }}"
                data-icon="{{ $item['icon'] }}"
                href="{{ route($item['route']) }}"
            >{{ $item['label'] }}</a>
        @endif
    @endforeach
</nav>
