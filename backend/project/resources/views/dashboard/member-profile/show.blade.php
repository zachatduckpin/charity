<x-dashboard.layout :title="$profile->organization_name">
    @php
        $tier = strtolower((string) $profile->membership_level);
        $heroImage = $profile->heroImageUrl();
        $organizationLogo = $profile->organizationLogoUrl();
        $representativeImage = $profile->representativeImageUrl();
        $contactName = $profile->primary_contact_name ?: $profile->representative_name ?: 'Contact pending';
        $contactRole = $profile->primary_contact_role ?: $profile->representative_role;
        $profileLinks = $profile->profileLinksList();
        $impactMetrics = $profile->impactMetricsList();
        $socialLinks = $profile->socialLinksList();
        $heading = $profile->profile_heading ?: ($profile->profile_type === 'friend' ? 'Global Network Friend Profile' : 'Network Member Profile');
        $subheading = $profile->profile_subheading ?: 'Current Global Network roster record.';
        $locationLabel = collect([$profile->country, $profile->region])->filter()->implode(' · ');
    @endphp

    <style>
        .member-profile-page {
            display: grid;
            gap: 20px;
        }

        .member-profile-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            padding: 10px 14px;
            border-radius: 999px;
            background: #f1f6fb;
            color: #2367a6;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
        }

        .member-profile-hero,
        .member-profile-panel,
        .member-profile-detail-card,
        .member-profile-related-card {
            border: 1px solid #dde7f0;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 18px 44px rgba(15, 58, 95, 0.08);
        }

        .member-profile-hero {
            display: grid;
            grid-template-columns: minmax(96px, 220px) minmax(0, 1fr) auto;
            gap: 20px;
            align-items: center;
            padding: 24px;
        }

        .member-profile-mark {
            display: grid;
            place-items: center;
            width: 100%;
            min-height: 108px;
            border-radius: 18px;
            border: 1px solid rgba(15, 58, 95, 0.12);
            background: linear-gradient(145deg, #ffffff, #eff7fb);
            overflow: hidden;
            font-size: 48px;
            line-height: 1;
        }

        .member-profile-mark img {
            width: 100%;
            height: 100%;
            display: block;
            object-fit: cover;
            object-position: 50% 24%;
        }

        .member-profile-mark.is-logo img {
            object-fit: contain;
            object-position: center;
            padding: 10px 14px;
            background: #ffffff;
        }

        .member-profile-mark.is-wide-logo img {
            padding: 12px 18px;
        }

        .member-profile-title h1 {
            margin: 0;
            color: #16345b;
            font-size: clamp(28px, 4vw, 42px);
            line-height: 1.08;
        }

        .member-profile-title p {
            margin: 8px 0 0;
            color: #647286;
            font-size: 15px;
            line-height: 1.65;
        }

        .member-profile-level {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 132px;
            padding: 10px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            background: #edf5fb;
            color: #16345b;
        }

        .member-profile-level.level-associate {
            background: #e7f7f5;
            color: #0f6f70;
        }

        .member-profile-level.level-contributor {
            background: #eaf2fb;
            color: #2367a6;
        }

        .member-profile-level.level-partner {
            background: #fff5dc;
            color: #946714;
        }

        .member-profile-level.level-friend {
            background: rgba(99, 73, 151, 0.12);
            color: #634997;
        }

        .member-profile-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
        }

        .member-profile-detail-card {
            padding: 18px;
        }

        .member-profile-detail-card span,
        .member-profile-panel span,
        .member-profile-related-card span {
            display: block;
            margin-bottom: 8px;
            color: #647286;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .member-profile-detail-card strong,
        .member-profile-detail-card a {
            color: #16345b;
            font-size: 18px;
            line-height: 1.35;
            text-decoration: none;
            overflow-wrap: anywhere;
        }

        .member-profile-detail-card a {
            color: #2367a6;
        }

        .member-profile-detail-card small {
            display: block;
            margin-top: 6px;
            color: #647286;
            font-size: 12px;
            line-height: 1.5;
        }

        .member-profile-representative-image,
        .member-profile-organization-logo {
            display: block;
            width: 72px;
            height: 72px;
            margin-bottom: 12px;
            border-radius: 18px;
            object-fit: cover;
            object-position: 50% 24%;
            box-shadow: 0 10px 22px rgba(15, 58, 95, 0.14);
        }

        .member-profile-organization-logo {
            width: 100%;
            max-width: 164px;
            height: 106px;
            padding: 8px;
            border-radius: 16px;
            background: #ffffff;
            object-fit: contain;
            object-position: center;
        }

        .member-profile-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .member-profile-panel {
            padding: 22px;
        }

        .member-profile-panel h2,
        .member-profile-panel h3 {
            margin: 0 0 12px;
            color: #16345b;
            font-size: 20px;
            line-height: 1.25;
        }

        .member-profile-panel p {
            margin: 0;
            color: #40566b;
            font-size: 14px;
            line-height: 1.7;
        }

        .member-profile-panel.full-width {
            grid-column: 1 / -1;
        }

        .member-profile-impact-grid,
        .member-profile-links,
        .member-profile-social-links,
        .member-profile-related-grid {
            display: grid;
            gap: 12px;
        }

        .member-profile-impact-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            margin-top: 16px;
        }

        .member-profile-impact-stat {
            padding: 15px;
            border: 1px solid rgba(15, 58, 95, 0.08);
            border-radius: 16px;
            background: linear-gradient(145deg, #f8fbfd, #eef7f7);
        }

        .member-profile-impact-stat strong {
            display: block;
            color: #1f9a9c;
            font-size: 24px;
            line-height: 1.1;
        }

        .member-profile-impact-stat small {
            display: block;
            margin-top: 6px;
            color: #40566b;
            font-size: 12px;
            line-height: 1.5;
        }

        .member-profile-links,
        .member-profile-social-links {
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            margin-top: 16px;
        }

        .member-profile-link {
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 11px 14px;
            border: 1px solid rgba(35, 103, 166, 0.14);
            border-radius: 14px;
            background: #f5f9fc;
            color: #2367a6;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
        }

        .member-profile-related-grid {
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            margin-top: 16px;
        }

        .member-profile-related-card {
            padding: 18px;
        }

        .member-profile-related-card h3 {
            margin: 0 0 8px;
            color: #16345b;
            font-size: 18px;
            line-height: 1.3;
        }

        .member-profile-related-card p {
            margin: 0;
            color: #647286;
            font-size: 13px;
            line-height: 1.6;
        }

        .member-profile-related-card a {
            display: inline-flex;
            margin-top: 12px;
            color: #2367a6;
            font-size: 12px;
            font-weight: 900;
            text-decoration: none;
        }

        .gn-level-inline {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .gn-level-inline--associate {
            background: #e7f7f5;
            color: #0f6f70;
        }

        .gn-level-inline--contributor {
            background: #eaf2fb;
            color: #2367a6;
        }

        .gn-level-inline--partner {
            background: #fff5dc;
            color: #946714;
        }

        .gn-level-inline--friend {
            background: rgba(99, 73, 151, 0.12);
            color: #634997;
        }

        @media (max-width: 980px) {
            .member-profile-hero,
            .member-profile-grid {
                grid-template-columns: 1fr;
            }

            .member-profile-level {
                width: fit-content;
            }
        }
    </style>

    <div class="member-profile-page">
        <a class="member-profile-back" href="{{ route('dashboard.index') }}">Back to dashboard</a>

        <section class="member-profile-hero" aria-label="Profile summary">
            <div class="member-profile-mark @if($heroImage) is-logo @endif @if($profile->is_wide_logo) is-wide-logo @endif">
                @if ($heroImage)
                    <img src="{{ $heroImage }}" alt="{{ $profile->hero_asset_alt ?: $profile->organization_name }}">
                @else
                    {{ $profile->flagDisplay() }}
                @endif
            </div>

            <div class="member-profile-title">
                <span class="dashboard-eyebrow">{{ $profile->profile_type === 'friend' ? 'Global Network Friend' : 'Global Network Member' }}</span>
                <h1>{{ $heading }}</h1>
                <p>
                    {{ $profile->organization_name }}
                    @if ($locationLabel)
                        · {{ $locationLabel }}
                    @endif
                </p>
                <p>{{ $subheading }}</p>
            </div>

            <div class="member-profile-level level-{{ $tier }}">{{ $profile->levelDisplay() }}</div>
        </section>

        <section class="member-profile-details" aria-label="Profile details">
            <article class="member-profile-detail-card">
                <span>Country</span>
                <strong>{{ $profile->country ?: 'Pending' }}</strong>
                @if ($profile->region)
                    <small>{{ $profile->region }}</small>
                @endif
            </article>

            <article class="member-profile-detail-card">
                <span>Main Contact</span>
                <strong>{{ $contactName }}</strong>
                @if ($contactRole)
                    <small>{{ $contactRole }}</small>
                @endif
            </article>

            <article class="member-profile-detail-card">
                <span>Email</span>
                @if ($profile->email)
                    <a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a>
                @else
                    <strong>Pending</strong>
                @endif
            </article>

            <article class="member-profile-detail-card">
                <span>Website</span>
                @if ($profile->website_url)
                    <a href="{{ $profile->website_url }}" target="_blank" rel="noreferrer">{{ $profile->websiteLabel() }}</a>
                @else
                    <strong>Not listed</strong>
                @endif
            </article>

            @if ($organizationLogo)
                <article class="member-profile-detail-card">
                    <span>Organization Logo</span>
                    <img class="member-profile-organization-logo" src="{{ $organizationLogo }}" alt="{{ $profile->organization_name }} logo">
                    <small>Shared dashboard asset used across member listings.</small>
                </article>
            @endif

            @if ($profile->representative_name || $representativeImage)
                <article class="member-profile-detail-card">
                    <span>Featured Representative</span>
                    @if ($representativeImage)
                        <img class="member-profile-representative-image" src="{{ $representativeImage }}" alt="Portrait of {{ $profile->representative_name ?: $contactName }}">
                    @endif
                    <strong>{{ $profile->representative_name ?: $contactName }}</strong>
                    @if ($profile->representative_role)
                        <small>{{ $profile->representative_role }}</small>
                    @endif
                </article>
            @endif
        </section>

        <section class="member-profile-panel">
            <span>Membership Record</span>
            <h2>{{ $profile->record_title ?: ($profile->organization_name.' membership profile') }}</h2>
            <p>{!! $profile->record_summary ?: e($profile->organization_name.' is part of the current Global Network profile set.') !!}</p>
        </section>

        <section class="member-profile-grid" aria-label="Profile narrative">
            @if ($profile->leader_bio)
                <article class="member-profile-panel">
                    <span>Leadership Profile</span>
                    <h3>{{ $profile->representative_name ?: $contactName }}</h3>
                    <p>{{ $profile->leader_bio }}</p>
                </article>
            @endif

            @if ($profile->organization_profile)
                <article class="member-profile-panel">
                    <span>About the Organization</span>
                    <h3>{{ $profile->organization_name }}</h3>
                    <p>{{ $profile->organization_profile }}</p>
                </article>
            @endif

            @if (! empty($impactMetrics) || ! empty($profileLinks) || ! empty($socialLinks))
                <article class="member-profile-panel full-width">
                    <span>Reach and Impact</span>
                    <h3>{{ $profile->impact_title ?: 'Member reach and impact' }}</h3>

                    @if (! empty($impactMetrics))
                        <div class="member-profile-impact-grid">
                            @foreach ($impactMetrics as $metric)
                                <div class="member-profile-impact-stat">
                                    <strong>{{ $metric['value'] ?? '' }}</strong>
                                    <small>{{ $metric['label'] ?? '' }}</small>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if (! empty($profileLinks))
                        <div class="member-profile-links">
                            @foreach ($profileLinks as $link)
                                <a class="member-profile-link" href="{{ $link['url'] }}" target="_blank" rel="noreferrer">
                                    <span>{{ $link['label'] ?? 'Open link' }}</span>
                                    <span aria-hidden="true">↗</span>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if (! empty($socialLinks))
                        <div class="member-profile-social-links">
                            @foreach ($socialLinks as $link)
                                <a class="member-profile-link" href="{{ $link['url'] }}" target="_blank" rel="noreferrer">
                                    <span>{{ $link['label'] ?? ucfirst($link['platform'] ?? 'Link') }}</span>
                                    <span aria-hidden="true">↗</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </article>
            @endif
        </section>

        @if ($relatedProfiles->isNotEmpty())
            <section class="member-profile-panel">
                <span>More Profiles</span>
                <h2>{{ $profile->profile_type === 'friend' ? 'Other Global Network friends' : 'Related member profiles' }}</h2>
                <div class="member-profile-related-grid">
                    @foreach ($relatedProfiles as $relatedProfile)
                        <article class="member-profile-related-card">
                            <span>{{ $relatedProfile->levelDisplay() }}</span>
                            <h3>{{ $relatedProfile->organization_name }}</h3>
                            <p>{{ $relatedProfile->displayLocation() ?: $relatedProfile->country ?: 'Location pending' }}</p>
                            <a href="{{ route('dashboard.member-profile.show', ['member' => $relatedProfile->slug]) }}">Open profile</a>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-dashboard.layout>
