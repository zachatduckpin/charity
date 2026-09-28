<x-dashboard.layout title="Campaigns">
    <x-dashboard.page-header
        title="Campaigns"
        eyebrow="Fundraising operations"
        description="Review current campaign volume, filter the active pipeline, and track fundraising activity from the GN-aligned dashboard."
    />

    <section class="dashboard-metric-grid dashboard-metric-grid--compact" aria-label="Campaign summary">
        <x-dashboard.metric label="All campaigns" :value="$summary['all']" detail="Total records in Charity" />
        <x-dashboard.metric label="Pending" :value="$summary['pending']" detail="Awaiting launch or review" />
        <x-dashboard.metric label="Running" :value="$summary['running']" detail="Currently active fundraisers" />
        <x-dashboard.metric label="Closed" :value="$summary['closed']" detail="Completed or closed records" />
    </section>

    <section class="dashboard-section">
        <div class="dashboard-section-header">
            <div>
                <h2>Campaign directory</h2>
                <p>Filter by status or search by title, slug, or location.</p>
            </div>
        </div>

        <x-dashboard.filter-bar :action="route('dashboard.campaigns.index')">
            <label class="dashboard-field">
                <span>Search</span>
                <input
                    type="text"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Title, slug, or location"
                >
            </label>

            <label class="dashboard-field">
                <span>Status</span>
                <select name="status">
                    <option value="all" @selected($filters['status'] === 'all')>All statuses</option>
                    <option value="pending" @selected($filters['status'] === 'pending')>Pending</option>
                    <option value="running" @selected($filters['status'] === 'running')>Running</option>
                    <option value="closed" @selected($filters['status'] === 'closed')>Closed</option>
                </select>
            </label>

            <div class="dashboard-filter-actions">
                <button class="dashboard-primary-button" type="submit">Apply filters</button>
                @if ($filters['search'] !== '' || $filters['status'] !== 'all')
                    <a class="dashboard-secondary-button" href="{{ route('dashboard.campaigns.index') }}">Reset</a>
                @endif
            </div>
        </x-dashboard.filter-bar>

        <x-dashboard.data-table caption="Campaign directory">
            <thead>
                <tr>
                    <th>Campaign</th>
                    <th>Category</th>
                    <th>Goal / raised</th>
                    <th>Owner</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($campaigns as $campaign)
                    <tr>
                        <td>
                            <strong>{{ $campaign->title }}</strong>
                            <div class="dashboard-table-subtext">
                                {{ $campaign->slug }}@if($campaign->location), {{ $campaign->location }}@endif
                            </div>
                        </td>
                        <td>{{ $campaign->category?->name ?: 'Uncategorized' }}</td>
                        <td>
                            <strong>{{ showAdminAmount($campaign->goal) }}</strong>
                            <div class="dashboard-table-subtext">Raised {{ showAdminAmount($campaign->raised) }}</div>
                        </td>
                        <td>
                            {{ $campaign->user_id ? ($campaign->user?->username ?: 'Member record missing') : 'Admin' }}
                            @if ($campaign->is_feature)
                                <div><x-dashboard.badge tone="teal">Featured</x-dashboard.badge></div>
                            @endif
                        </td>
                        <td><x-dashboard.status :value="$campaign->status" /></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="dashboard-empty">No campaigns match the current filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </x-dashboard.data-table>

        <x-dashboard.pagination :paginator="$campaigns" />
    </section>
</x-dashboard.layout>
