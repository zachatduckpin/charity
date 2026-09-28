<x-dashboard.layout :title="$page['title']">
    <x-dashboard.page-header
        :title="$page['title']"
        :eyebrow="$page['eyebrow'] ?? 'GN Central workspace'"
        :description="$page['description'] ?? null"
    />

    @if (! empty($page['metrics']))
        <section class="dashboard-metric-grid dashboard-metric-grid--compact" aria-label="{{ $page['title'] }} summary">
            @foreach ($page['metrics'] as $metric)
                <x-dashboard.metric :label="$metric['label']" :value="$metric['value']" :detail="$metric['detail']" />
            @endforeach
        </section>
    @endif

    @foreach ($page['sections'] ?? [] as $section)
        <section class="dashboard-section">
            @if (($section['type'] ?? null) !== 'notice')
                <div class="dashboard-section-header">
                    <div>
                        <h2>{{ $section['title'] }}</h2>
                        @if (! empty($section['description']))
                            <p>{{ $section['description'] }}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if (($section['type'] ?? null) === 'cards')
                <div
                    class="dashboard-card-grid"
                    @if (! empty($section['columns']))
                        style="grid-template-columns: repeat({{ $section['columns'] }}, minmax(0, 1fr));"
                    @endif
                >
                    @foreach ($section['items'] ?? [] as $item)
                        @php
                            $href = ! empty($item['route']) ? route($item['route'], $item['route_params'] ?? []) : null;
                        @endphp
                        <article class="dashboard-card">
                            @if (! empty($item['badge']))
                                <span class="dashboard-card-badge">{{ $item['badge'] }}</span>
                            @endif
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['body'] }}</p>
                            @if ($href)
                                <a class="dashboard-card-link" href="{{ $href }}">Open workspace &rarr;</a>
                            @endif
                        </article>
                    @endforeach
                </div>
            @elseif (($section['type'] ?? null) === 'steps')
                <div class="dashboard-steps-grid">
                    @foreach ($section['items'] ?? [] as $item)
                        <article class="dashboard-step">
                            <strong>{{ $item['title'] }}</strong>
                            <p>{{ $item['body'] }}</p>
                        </article>
                    @endforeach
                </div>
            @elseif (($section['type'] ?? null) === 'notice')
                <div class="dashboard-notice dashboard-notice--{{ $section['tone'] ?? 'info' }}">
                    <strong>{{ $section['title'] }}</strong>
                    <p>{{ $section['body'] }}</p>
                </div>
            @elseif (($section['type'] ?? null) === 'table')
                <x-dashboard.data-table :caption="$section['title']">
                    <thead>
                        <tr>
                            @foreach ($section['columns'] ?? [] as $column)
                                <th>{{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($section['rows'] ?? [] as $row)
                            <tr>
                                @foreach ($row as $cell)
                                    <td>{{ $cell }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </x-dashboard.data-table>
            @elseif (($section['type'] ?? null) === 'queue')
                <div class="dashboard-queue-stack">
                    @foreach ($section['items'] ?? [] as $item)
                        @php
                            $href = ! empty($item['route']) ? route($item['route']) : null;
                        @endphp
                        <article class="dashboard-queue-card">
                            <div class="dashboard-queue-head">
                                <div>
                                    <h3>{{ $item['title'] }}</h3>
                                    <p>{{ $item['body'] }}</p>
                                </div>
                                <span class="dashboard-queue-status">{{ $item['status'] }}</span>
                            </div>
                            <div class="dashboard-queue-details">
                                @foreach ($item['details'] ?? [] as $detail)
                                    <div class="dashboard-queue-detail">
                                        <span>Queue detail</span>
                                        {{ $detail }}
                                    </div>
                                @endforeach
                            </div>
                            @if ($href)
                                <a class="dashboard-card-link" href="{{ $href }}">Open workspace &rarr;</a>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    @endforeach
</x-dashboard.layout>
