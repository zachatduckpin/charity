<x-dashboard.layout title="Events">
    <x-dashboard.page-header
        title="Events"
        eyebrow="Programs and outreach"
        description="Track scheduled events in the new dashboard and monitor publishing readiness, schedules, and outreach details."
    />

    <section class="dashboard-metric-grid dashboard-metric-grid--compact" aria-label="Event summary">
        <x-dashboard.metric label="All events" :value="$summary['all']" detail="Scheduled and archived records" />
        <x-dashboard.metric label="Active" :value="$summary['active']" detail="Visible events in the current dataset" />
        <x-dashboard.metric label="Inactive" :value="$summary['inactive']" detail="Hidden or disabled events" />
        <x-dashboard.metric label="Online" :value="$summary['online']" detail="Events marked as online" />
    </section>

    <section class="dashboard-section">
        <div class="dashboard-section-header">
            <div>
                <h2>Event directory</h2>
                <p>Search by title, type, location, or organizer details.</p>
            </div>
        </div>

        <x-dashboard.filter-bar :action="route('dashboard.events.index')">
            <label class="dashboard-field">
                <span>Search</span>
                <input
                    type="text"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Title, type, location, or organizer"
                >
            </label>

            <label class="dashboard-field">
                <span>Status</span>
                <select name="status">
                    <option value="all" @selected($filters['status'] === 'all')>All statuses</option>
                    <option value="active" @selected($filters['status'] === 'active')>Active</option>
                    <option value="inactive" @selected($filters['status'] === 'inactive')>Inactive</option>
                </select>
            </label>

            <div class="dashboard-filter-actions">
                <button class="dashboard-primary-button" type="submit">Apply filters</button>
                @if ($filters['search'] !== '' || $filters['status'] !== 'all')
                    <a class="dashboard-secondary-button" href="{{ route('dashboard.events.index') }}">Reset</a>
                @endif
            </div>
        </x-dashboard.filter-bar>

        <x-dashboard.data-table caption="Event directory">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Schedule</th>
                    <th>Type</th>
                    <th>Organizer</th>
                    <th>Status</th>
                    <th class="dashboard-table-actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>
                            <strong>{{ $event->title }}</strong>
                            <div class="dashboard-table-subtext">
                                {{ $event->event_location ?: 'No location provided' }}
                            </div>
                        </td>
                        <td>
                            <strong>{{ $event->date ? \Illuminate\Support\Carbon::parse($event->date)->format('M j, Y') : 'Unknown date' }}</strong>
                            <div class="dashboard-table-subtext">
                                {{ trim(collect([$event->start_time ?? null, $event->end_time ?? null])->filter()->join(' - ')) ?: ($event->time ?? 'Time not set') }}
                            </div>
                        </td>
                        <td>
                            <x-dashboard.badge :tone="strtolower((string) $event->event_type) === 'online' ? 'teal' : 'neutral'">
                                {{ ucfirst($event->event_type ?: 'Unknown') }}
                            </x-dashboard.badge>
                        </td>
                        <td>
                            <strong>{{ $event->organizar_name ?: 'No organizer listed' }}</strong>
                            <div class="dashboard-table-subtext">
                                {{ $event->organizar_email ?: ($event->organizar_phone ?: 'No contact details') }}
                            </div>
                        </td>
                        <td>
                            <x-dashboard.badge :tone="$event->status ? 'success' : 'danger'">
                                {{ $event->status ? 'Active' : 'Inactive' }}
                            </x-dashboard.badge>
                        </td>
                        <td class="dashboard-table-actions">
                            @if ($event->event_link)
                                <a class="dashboard-table-link" href="{{ $event->event_link }}" target="_blank" rel="noreferrer">Open</a>
                            @else
                                <span class="dashboard-table-subtext">No external event link</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="dashboard-empty">No events match the current filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </x-dashboard.data-table>

        <x-dashboard.pagination :paginator="$events" />
    </section>
</x-dashboard.layout>
