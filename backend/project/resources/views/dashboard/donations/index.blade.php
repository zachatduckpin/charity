<x-dashboard.layout title="Donations">
    <x-dashboard.page-header
        title="Donations"
        eyebrow="Contribution tracking"
        description="Review recent contributions, narrow the list by donor or transaction ID, and keep the donation ledger inside the GN-aligned dashboard."
    />

    <section class="dashboard-metric-grid dashboard-metric-grid--compact" aria-label="Donation summary">
        <x-dashboard.metric label="All donations" :value="$summary['all']" detail="Recorded contribution rows" />
        <x-dashboard.metric label="Approved" :value="$summary['yes']" detail="Visible contribution records" />
        <x-dashboard.metric label="Hidden" :value="$summary['no']" detail="Currently hidden from dashboard reporting" />
    </section>

    <section class="dashboard-section">
        <div class="dashboard-section-header">
            <div>
                <h2>Donation ledger</h2>
                <p>Search by transaction ID, donor name, email, or campaign slug.</p>
            </div>
        </div>

        <x-dashboard.filter-bar :action="route('dashboard.donations.index')">
            <label class="dashboard-field">
                <span>Search</span>
                <input
                    type="text"
                    name="search"
                    value="{{ $filters['search'] }}"
                    placeholder="Transaction ID, donor, email, or campaign"
                >
            </label>

            <label class="dashboard-field">
                <span>Status</span>
                <select name="status">
                    <option value="all" @selected($filters['status'] === 'all')>All statuses</option>
                    <option value="yes" @selected($filters['status'] === 'yes')>Approved</option>
                    <option value="no" @selected($filters['status'] === 'no')>Hidden</option>
                </select>
            </label>

            <div class="dashboard-filter-actions">
                <button class="dashboard-primary-button" type="submit">Apply filters</button>
                @if ($filters['search'] !== '' || $filters['status'] !== 'all')
                    <a class="dashboard-secondary-button" href="{{ route('dashboard.donations.index') }}">Reset</a>
                @endif
            </div>
        </x-dashboard.filter-bar>

        <x-dashboard.data-table caption="Donation ledger">
            <thead>
                <tr>
                    <th>Donor</th>
                    <th>Campaign</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($donations as $donation)
                    <tr>
                        <td>
                            <strong>{{ $donation->name ?: 'Anonymous donor' }}</strong>
                            <div class="dashboard-table-subtext">
                                {{ $donation->email ?: 'No email provided' }}
                                @if ($donation->txn_id)
                                    <span class="dashboard-divider">•</span>{{ $donation->txn_id }}
                                @endif
                            </div>
                        </td>
                        <td>{{ $donation->campaign?->title ?: 'Unavailable campaign' }}</td>
                        <td>
                            <strong>{{ showAdminAmount($donation->total) }}</strong>
                            @if ($donation->tips)
                                <div class="dashboard-table-subtext">Tips {{ showAdminAmount($donation->tips) }}</div>
                            @endif
                        </td>
                        <td>{{ optional($donation->created_at)->format('M j, Y') ?: 'Unknown' }}</td>
                        <td>
                            <x-dashboard.badge :tone="$donation->status ? 'success' : 'danger'">
                                {{ $donation->status ? 'Approved' : 'Hidden' }}
                            </x-dashboard.badge>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="dashboard-empty">No donations match the current filters.</td>
                    </tr>
                @endforelse
            </tbody>
        </x-dashboard.data-table>

        <x-dashboard.pagination :paginator="$donations" />
    </section>
</x-dashboard.layout>
