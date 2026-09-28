<x-dashboard.layout title="Members Directory">
    @php
        $tierPalette = [
            'associate' => '#1f9a9c',
            'contributor' => '#2367a6',
            'partner' => '#d7a642',
        ];
    @endphp

    <style>
        .dashboard-member-mark {
            overflow: hidden;
            font-size: 30px;
        }

        .dashboard-member-mark img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .dashboard-member-mark.is-wide img {
            width: 225%;
            height: 225%;
            max-width: none;
        }

        .dashboard-member-card-foot {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 12px;
        }

        .dashboard-member-card-actions {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-end;
            gap: 10px 14px;
        }

        .dashboard-member-card-actions form {
            margin: 0;
        }

        .dashboard-member-card-foot .dashboard-card-link,
        .dashboard-member-card-foot .dashboard-card-link-button {
            margin-top: 0;
            font-size: 12px;
            font-weight: 800;
        }

        .dashboard-card-link-button {
            padding: 0;
            border: 0;
            background: transparent;
            color: var(--dash-link);
            cursor: pointer;
        }

        .dashboard-card-link-button:hover {
            color: var(--dash-link-hover);
        }

        .dashboard-member-empty {
            grid-column: 1 / -1;
        }
    </style>

    <div class="dashboard-page-header">
        <div>
            <span class="dashboard-eyebrow">Global Network Members</span>
            <h1>Members Directory</h1>
            <p class="dashboard-page-description">
                Explore all current organizations across the Associate, Contributor, and Partner levels.
                Each card now reads from the shared member profile records used by the GN Central dashboard.
            </p>
        </div>
        @can('members.create')
            <div class="dashboard-page-actions">
                <a class="dashboard-primary-button" href="{{ route('dashboard.members.create') }}">Add member</a>
            </div>
        @endcan
    </div>    

    <div class="dashboard-directory-toolbar">
        <input
            class="dashboard-search"
            id="memberSearch"
            type="search"
            placeholder="Search by organization, country, region, or contact"
            aria-label="Search members"
        >
        <div class="dashboard-pill-filters" aria-label="Filter members by membership level">
            <button class="dashboard-pill-filter is-active" type="button" data-tier="all">All</button>
            <button class="dashboard-pill-filter" type="button" data-tier="associate">Associate</button>
            <button class="dashboard-pill-filter" type="button" data-tier="contributor">Contributor</button>
            <button class="dashboard-pill-filter" type="button" data-tier="partner">Partner</button>
        </div>
        <span class="dashboard-directory-summary" id="memberSummary">{{ $members->count() }} members</span>
    </div>

    <section class="dashboard-card-grid dashboard-member-grid" id="memberGrid" aria-label="Current Global Network members">
        @forelse ($members as $member)
            @php
                $tier = strtolower((string) $member->membership_level);
                $memberColor = $tierPalette[$tier] ?? '#2367a6';
                $memberImage = $member->cardImageUrl();
                $memberContact = trim(collect([$member->primary_contact_name, $member->primary_contact_role])->filter()->implode(' · '));
            @endphp
            <article
                class="dashboard-card dashboard-member-card"
                data-tier="{{ $tier }}"
                data-search="{{ e($member->searchText()) }}"
                style="--member-color: {{ $memberColor }}"
            >
                <span class="dashboard-member-mark @if($member->is_wide_logo) is-wide @endif">
                    @if ($memberImage)
                        <img src="{{ $memberImage }}" alt="{{ $member->directory_image_alt ?: $member->hero_asset_alt ?: $member->organization_name }}">
                    @else
                        {{ $member->flagDisplay() }}
                    @endif
                </span>
                <div>
                    <h3>{{ $member->organization_name }}</h3>
                    <span class="dashboard-member-meta">{{ $member->displayLocation() ?: $member->country ?: 'Location pending' }}</span>
                    <span class="dashboard-member-meta">{{ $memberContact ?: 'Primary contact pending' }}</span>
                    <div class="dashboard-member-card-foot">
                        <span class="dashboard-tier-badge">{{ $member->levelDisplay() }}</span>
                        <div class="dashboard-member-card-actions">
                            <a class="dashboard-card-link" href="{{ route('dashboard.member-profile.show', ['member' => $member->slug]) }}">
                                Open profile
                            </a>
                            @can('members.update')
                                <a class="dashboard-card-link" href="{{ route('dashboard.members.edit', $member) }}">
                                    Edit
                                </a>
                            @endcan
                            @can('members.delete')
                                <form action="{{ route('dashboard.members.destroy', $member) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="dashboard-card-link-button" type="submit" onclick="return confirm('Delete {{ addslashes($member->organization_name) }}?');">
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <article class="dashboard-card dashboard-member-empty">
                <h3>No members found</h3>
                <p>Seed or publish member profiles to populate the GN Central members directory.</p>
            </article>
        @endforelse

        <article class="dashboard-card dashboard-member-empty" id="memberEmptyState" hidden>
            <h3>No matching members</h3>
            <p>Try a different search term or switch back to the full member list.</p>
        </article>
    </section>

    <script>
        (() => {
            const search = document.getElementById('memberSearch');
            const summary = document.getElementById('memberSummary');
            const emptyState = document.getElementById('memberEmptyState');
            const filters = Array.from(document.querySelectorAll('.dashboard-pill-filter'));
            const cards = Array.from(document.querySelectorAll('.dashboard-member-card'));
            let activeTier = 'all';

            function updateMembersDirectory() {
                const query = (search?.value || '').trim().toLowerCase();
                let visibleCount = 0;

                cards.forEach((card) => {
                    const matchesTier = activeTier === 'all' || card.dataset.tier === activeTier;
                    const matchesSearch = !query || (card.dataset.search || '').includes(query);
                    const visible = matchesTier && matchesSearch;

                    card.hidden = !visible;

                    if (visible) {
                        visibleCount += 1;
                    }
                });

                if (summary) {
                    summary.textContent = `${visibleCount} ${visibleCount === 1 ? 'member' : 'members'}`;
                }

                if (emptyState) {
                    emptyState.hidden = visibleCount !== 0;
                }
            }

            search?.addEventListener('input', updateMembersDirectory);

            filters.forEach((button) => {
                button.addEventListener('click', () => {
                    activeTier = button.dataset.tier || 'all';
                    filters.forEach((item) => item.classList.toggle('is-active', item === button));
                    updateMembersDirectory();
                });
            });
        })();
    </script>
</x-dashboard.layout>
