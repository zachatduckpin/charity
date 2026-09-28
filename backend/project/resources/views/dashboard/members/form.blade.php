<x-dashboard.layout :title="$pageTitle">
    <style>
        .dashboard-member-form-shell {
            display: grid;
            gap: 20px;
        }

        .dashboard-member-form-card {
            padding: 24px;
        }

        .dashboard-member-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .dashboard-member-form-grid--single {
            grid-template-columns: 1fr;
        }

        .dashboard-field textarea {
            min-height: 120px;
            width: 100%;
            padding: 12px 13px;
            border: 1px solid var(--dash-line);
            border-radius: 12px;
            color: var(--dash-ink);
            background: var(--dash-white);
            font: inherit;
            resize: vertical;
            box-shadow: 0 7px 18px rgba(15, 58, 95, 0.04);
        }

        .dashboard-field textarea:focus {
            outline: 2px solid rgba(35, 103, 166, 0.16);
            border-color: var(--dash-blue);
        }

        .dashboard-field small {
            color: var(--dash-muted);
            font-size: 12px;
            line-height: 1.5;
        }

        .dashboard-checkbox {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--dash-navy);
            font-size: 14px;
            font-weight: 700;
        }

        .dashboard-checkbox input {
            width: 18px;
            height: 18px;
        }

        .dashboard-form-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        @media (max-width: 860px) {
            .dashboard-member-form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="dashboard-member-form-shell">
        <div class="dashboard-page-header">
            <div>
                <span class="dashboard-eyebrow">Member Directory</span>
                <h1>{{ $pageTitle }}</h1>
                <p class="dashboard-page-description">
                    Maintain the shared record used by the dashboard member directory and the public-facing member profile screen.
                </p>
            </div>
            <div class="dashboard-page-actions">
                <a class="dashboard-secondary-button" href="{{ route('dashboard.members.index') }}">Back to members</a>
                @if ($member->exists && $member->slug)
                    <a class="dashboard-secondary-button" href="{{ route('dashboard.member-profile.show', ['member' => $member->slug]) }}">Preview profile</a>
                @endif
            </div>
        </div>

        <form action="{{ $formAction }}" method="POST" class="dashboard-panel dashboard-member-form-card">
            @csrf
            @if ($formMethod !== 'POST')
                @method($formMethod)
            @endif

            <div class="dashboard-member-form-grid">
                <label class="dashboard-field">
                    <span>Organization name</span>
                    <input type="text" name="organization_name" value="{{ old('organization_name', $member->organization_name) }}" required>
                </label>

                <label class="dashboard-field">
                    <span>Slug</span>
                    <input type="text" name="slug" value="{{ old('slug', $member->slug) }}" placeholder="Auto-generated if left blank">
                    <small>Used in the profile URL.</small>
                </label>

                <label class="dashboard-field">
                    <span>Membership level</span>
                    <select name="membership_level" required>
                        @foreach (['Associate', 'Contributor', 'Partner'] as $level)
                            <option value="{{ $level }}" @selected(old('membership_level', $member->membership_level) === $level)>{{ $level }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="dashboard-field">
                    <span>Level label</span>
                    <input type="text" name="level_label" value="{{ old('level_label', $member->level_label) }}" placeholder="Optional custom label">
                </label>

                <label class="dashboard-field">
                    <span>Status</span>
                    <select name="status" required>
                        @foreach (['active' => 'Active', 'draft' => 'Draft', 'inactive' => 'Inactive'] as $value => $label)
                            <option value="{{ $value }}" @selected(old('status', $member->status ?: 'active') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="dashboard-field">
                    <span>Display order</span>
                    <input type="number" name="display_order" min="0" value="{{ old('display_order', $member->display_order ?? 0) }}">
                </label>

                <label class="dashboard-field">
                    <span>Country</span>
                    <input type="text" name="country" value="{{ old('country', $member->country) }}">
                </label>

                <label class="dashboard-field">
                    <span>Region</span>
                    <input type="text" name="region" value="{{ old('region', $member->region) }}">
                </label>

                <label class="dashboard-field">
                    <span>Flag emoji or ISO code</span>
                    <input type="text" name="flag_emoji" value="{{ old('flag_emoji', $member->flag_emoji) }}" placeholder="GH or 🇬🇭">
                </label>

                <label class="dashboard-field">
                    <span>Region code</span>
                    <input type="text" name="region_code" value="{{ old('region_code', $member->region_code) }}" placeholder="Optional map code">
                </label>
            </div>

            <div class="dashboard-member-form-grid" style="margin-top:16px">
                <label class="dashboard-field">
                    <span>Primary contact name</span>
                    <input type="text" name="primary_contact_name" value="{{ old('primary_contact_name', $member->primary_contact_name) }}">
                </label>

                <label class="dashboard-field">
                    <span>Primary contact role</span>
                    <input type="text" name="primary_contact_role" value="{{ old('primary_contact_role', $member->primary_contact_role) }}">
                </label>

                <label class="dashboard-field">
                    <span>Email</span>
                    <input type="text" name="email" value="{{ old('email', $member->email) }}">
                </label>

                <label class="dashboard-field">
                    <span>Phone</span>
                    <input type="text" name="phone" value="{{ old('phone', $member->phone) }}">
                </label>

                <label class="dashboard-field">
                    <span>Website URL</span>
                    <input type="text" name="website_url" value="{{ old('website_url', $member->website_url) }}" placeholder="https://example.org">
                </label>

                <label class="dashboard-field">
                    <span>Directory card title</span>
                    <input type="text" name="directory_card_title" value="{{ old('directory_card_title', $member->directory_card_title) }}">
                </label>
            </div>

            <div class="dashboard-member-form-grid" style="margin-top:16px">
                <label class="dashboard-field">
                    <span>Profile heading</span>
                    <input type="text" name="profile_heading" value="{{ old('profile_heading', $member->profile_heading) }}">
                </label>

                <label class="dashboard-field">
                    <span>Profile subheading</span>
                    <input type="text" name="profile_subheading" value="{{ old('profile_subheading', $member->profile_subheading) }}">
                </label>

                <label class="dashboard-field">
                    <span>Record title</span>
                    <input type="text" name="record_title" value="{{ old('record_title', $member->record_title) }}">
                </label>

                <label class="dashboard-field">
                    <span>Impact section title</span>
                    <input type="text" name="impact_title" value="{{ old('impact_title', $member->impact_title) }}">
                </label>
            </div>

            <div class="dashboard-member-form-grid dashboard-member-form-grid--single" style="margin-top:16px">
                <label class="dashboard-field">
                    <span>Summary</span>
                    <textarea name="summary">{{ old('summary', $member->summary) }}</textarea>
                </label>

                <label class="dashboard-field">
                    <span>Directory description</span>
                    <textarea name="directory_description">{{ old('directory_description', $member->directory_description) }}</textarea>
                </label>

                <label class="dashboard-field">
                    <span>Record summary</span>
                    <textarea name="record_summary">{{ old('record_summary', $member->record_summary) }}</textarea>
                </label>

                <label class="dashboard-field">
                    <span>Leader bio</span>
                    <textarea name="leader_bio">{{ old('leader_bio', $member->leader_bio) }}</textarea>
                </label>

                <label class="dashboard-field">
                    <span>Organization profile</span>
                    <textarea name="organization_profile">{{ old('organization_profile', $member->organization_profile) }}</textarea>
                </label>
            </div>

            <div style="margin-top:16px">
                <p class="dashboard-page-description" style="margin:0 0 12px">
                    These fields power the public <code>/directory</code> member cards and the world map markers.
                </p>
            </div>

            <div class="dashboard-member-form-grid">
                <label class="dashboard-field">
                    <span>Directory location</span>
                    <input type="text" name="directory_location" value="{{ old('directory_location', $member->directory_location) }}">
                </label>

                <label class="dashboard-field">
                    <span>Directory address</span>
                    <input type="text" name="directory_address" value="{{ old('directory_address', $member->directory_address) }}">
                </label>

                <label class="dashboard-field">
                    <span>Representative name</span>
                    <input type="text" name="representative_name" value="{{ old('representative_name', $member->representative_name) }}">
                </label>

                <label class="dashboard-field">
                    <span>Representative role</span>
                    <input type="text" name="representative_role" value="{{ old('representative_role', $member->representative_role) }}">
                </label>

                <label class="dashboard-field">
                    <span>Hero asset path</span>
                    <input type="text" name="hero_asset_path" value="{{ old('hero_asset_path', $member->hero_asset_path) }}" placeholder="assets/dashboard/... or full URL">
                </label>

                <label class="dashboard-field">
                    <span>Hero image alt text</span>
                    <input type="text" name="hero_asset_alt" value="{{ old('hero_asset_alt', $member->hero_asset_alt) }}">
                </label>

                <label class="dashboard-field">
                    <span>Organization logo path</span>
                    <input type="text" name="organization_logo_path" value="{{ old('organization_logo_path', $member->organization_logo_path) }}">
                </label>

                <label class="dashboard-field">
                    <span>Representative image path</span>
                    <input type="text" name="representative_image_path" value="{{ old('representative_image_path', $member->representative_image_path) }}">
                </label>

                <label class="dashboard-field">
                    <span>Directory image path</span>
                    <input type="text" name="directory_image_path" value="{{ old('directory_image_path', $member->directory_image_path) }}">
                    <small>Use the same public asset path shown on the live directory when you want the shared logo to match.</small>
                </label>

                <label class="dashboard-field">
                    <span>Directory image alt text</span>
                    <input type="text" name="directory_image_alt" value="{{ old('directory_image_alt', $member->directory_image_alt) }}">
                </label>

                <label class="dashboard-field">
                    <span>Latitude</span>
                    <input type="number" name="latitude" step="0.000001" value="{{ old('latitude', $member->latitude) }}">
                    <small>Controls the member pin location on the directory map.</small>
                </label>

                <label class="dashboard-field">
                    <span>Longitude</span>
                    <input type="number" name="longitude" step="0.000001" value="{{ old('longitude', $member->longitude) }}">
                    <small>Use decimal coordinates to keep the existing map layout aligned.</small>
                </label>

                <label class="dashboard-field">
                    <span>Map zoom</span>
                    <input type="number" name="map_zoom" min="1" max="20" value="{{ old('map_zoom', $member->map_zoom) }}">
                </label>

                <label class="dashboard-field">
                    <span>Highlight radius</span>
                    <input type="number" name="highlight_radius" min="0" value="{{ old('highlight_radius', $member->highlight_radius) }}">
                </label>
            </div>

            <div style="margin-top:18px">
                <label class="dashboard-checkbox">
                    <input type="checkbox" name="is_wide_logo" value="1" @checked((bool) old('is_wide_logo', $member->is_wide_logo))>
                    Treat the hero/logo asset as a wide logo
                </label>
            </div>

            <div class="dashboard-member-form-grid dashboard-member-form-grid--single" style="margin-top:20px">
                <label class="dashboard-field">
                    <span>Impact metrics</span>
                    <textarea name="impact_metrics_text" placeholder="5000+ | Educators trained&#10;38 | Countries represented">{{ $impactMetricsText }}</textarea>
                    <small>One metric per line in the format: <code>Value | Label</code></small>
                </label>

                <label class="dashboard-field">
                    <span>Profile links</span>
                    <textarea name="profile_links_text" placeholder="Website | https://example.org&#10;Annual Report | https://example.org/report">{{ $profileLinksText }}</textarea>
                    <small>One link per line in the format: <code>Label | URL</code></small>
                </label>

                <label class="dashboard-field">
                    <span>Social links</span>
                    <textarea name="social_links_text" placeholder="linkedin | https://linkedin.com/company/example&#10;youtube | https://youtube.com/@example">{{ $socialLinksText }}</textarea>
                    <small>One social link per line in the format: <code>Platform | URL</code></small>
                </label>
            </div>

            <div class="dashboard-form-actions">
                <button class="dashboard-primary-button" type="submit">{{ $submitLabel }}</button>
                <a class="dashboard-secondary-button" href="{{ route('dashboard.members.index') }}">Cancel</a>
            </div>
        </form>
    </div>
</x-dashboard.layout>
