@props(['label', 'value', 'detail'])
<article class="dashboard-metric">
    <span>{{ $label }}</span>
    <strong>{{ $value }}</strong>
    <small>{{ $detail }}</small>
</article>
