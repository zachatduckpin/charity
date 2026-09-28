<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DashboardMemberProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MemberController extends Controller
{
    public function index(): View
    {
        $directoryMembers = DashboardMemberProfile::query()
            ->directoryMembers()
            ->get();

        $tierCounts = collect(['associate', 'contributor', 'partner'])
            ->mapWithKeys(fn (string $tier): array => [
                $tier => $directoryMembers->filter(
                    fn (DashboardMemberProfile $member): bool => Str::lower((string) $member->membership_level) === $tier
                )->count(),
            ]);

        return view('dashboard.members.index', [
            'members' => $directoryMembers,
            'tierCounts' => $tierCounts,
        ]);
    }

    public function create(): View
    {
        $member = new DashboardMemberProfile([
            'profile_type' => 'member',
            'status' => 'active',
            'membership_level' => 'Associate',
            'display_order' => 0,
        ]);

        return view('dashboard.members.form', $this->formViewData(
            member: $member,
            pageTitle: 'Add Member',
            formAction: route('dashboard.members.store'),
            submitLabel: 'Create member',
        ));
    }

    public function store(Request $request): RedirectResponse
    {
        $member = DashboardMemberProfile::query()->create($this->validatedPayload($request));

        return redirect()
            ->route('dashboard.members.edit', $member)
            ->with('success', "{$member->organization_name} was added to the member directory.");
    }

    public function edit(DashboardMemberProfile $member): View
    {
        abort_unless($member->profile_type === 'member', 404);

        return view('dashboard.members.form', $this->formViewData(
            member: $member,
            pageTitle: 'Edit Member',
            formAction: route('dashboard.members.update', $member),
            submitLabel: 'Save changes',
            formMethod: 'PATCH',
        ));
    }

    public function update(Request $request, DashboardMemberProfile $member): RedirectResponse
    {
        abort_unless($member->profile_type === 'member', 404);

        $member->fill($this->validatedPayload($request, $member));
        $member->save();

        return redirect()
            ->route('dashboard.members.edit', $member)
            ->with('success', "{$member->organization_name} was updated.");
    }

    public function destroy(DashboardMemberProfile $member): RedirectResponse
    {
        abort_unless($member->profile_type === 'member', 404);

        $organizationName = $member->organization_name;
        $member->delete();

        return redirect()
            ->route('dashboard.members.index')
            ->with('success', "{$organizationName} was deleted from the member directory.");
    }

    private function formViewData(
        DashboardMemberProfile $member,
        string $pageTitle,
        string $formAction,
        string $submitLabel,
        string $formMethod = 'POST',
    ): array {
        return [
            'member' => $member,
            'pageTitle' => $pageTitle,
            'formAction' => $formAction,
            'formMethod' => $formMethod,
            'submitLabel' => $submitLabel,
            'impactMetricsText' => old('impact_metrics_text', $this->impactMetricsText($member)),
            'profileLinksText' => old('profile_links_text', $this->profileLinksText($member)),
            'socialLinksText' => old('social_links_text', $this->socialLinksText($member)),
        ];
    }

    private function validatedPayload(Request $request, ?DashboardMemberProfile $member = null): array
    {
        $validated = $request->validate([
            'organization_name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('dashboard_member_profiles', 'slug')->ignore($member?->id),
            ],
            'membership_level' => ['required', 'string', Rule::in(['Associate', 'Contributor', 'Partner'])],
            'level_label' => ['nullable', 'string', 'max:120'],
            'country' => ['nullable', 'string', 'max:120'],
            'region' => ['nullable', 'string', 'max:120'],
            'flag_emoji' => ['nullable', 'string', 'max:16'],
            'primary_contact_name' => ['nullable', 'string', 'max:160'],
            'primary_contact_role' => ['nullable', 'string', 'max:200'],
            'email' => ['nullable', 'string', 'max:190'],
            'phone' => ['nullable', 'string', 'max:80'],
            'website_url' => ['nullable', 'string', 'max:255'],
            'profile_heading' => ['nullable', 'string', 'max:160'],
            'profile_subheading' => ['nullable', 'string', 'max:255'],
            'record_title' => ['nullable', 'string', 'max:255'],
            'record_summary' => ['nullable', 'string'],
            'organization_logo_path' => ['nullable', 'string', 'max:255'],
            'representative_name' => ['nullable', 'string', 'max:160'],
            'representative_role' => ['nullable', 'string', 'max:255'],
            'representative_image_path' => ['nullable', 'string', 'max:255'],
            'leader_bio' => ['nullable', 'string'],
            'organization_profile' => ['nullable', 'string'],
            'impact_title' => ['nullable', 'string', 'max:255'],
            'hero_asset_path' => ['nullable', 'string', 'max:255'],
            'hero_asset_alt' => ['nullable', 'string', 'max:255'],
            'directory_card_title' => ['nullable', 'string', 'max:255'],
            'directory_location' => ['nullable', 'string', 'max:255'],
            'directory_address' => ['nullable', 'string', 'max:255'],
            'directory_description' => ['nullable', 'string'],
            'directory_image_path' => ['nullable', 'string', 'max:255'],
            'directory_image_alt' => ['nullable', 'string', 'max:255'],
            'region_code' => ['nullable', 'string', 'max:12'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'map_zoom' => ['nullable', 'integer', 'between:1,20'],
            'highlight_radius' => ['nullable', 'integer', 'min:0'],
            'summary' => ['nullable', 'string'],
            'status' => ['required', 'string', Rule::in(['active', 'draft', 'inactive'])],
            'display_order' => ['nullable', 'integer', 'min:0'],
            'impact_metrics_text' => ['nullable', 'string'],
            'profile_links_text' => ['nullable', 'string'],
            'social_links_text' => ['nullable', 'string'],
        ]);

        $validated['profile_type'] = 'member';
        $validated['slug'] = $this->resolveSlug(
            slug: $validated['slug'] ?? null,
            organizationName: $validated['organization_name'],
            currentMemberId: $member?->id,
        );
        $validated['website_url'] = $this->normalizeUrl($validated['website_url'] ?? null);
        $validated['is_wide_logo'] = $request->boolean('is_wide_logo');
        $validated['impact_metrics'] = $this->parseMetrics($validated['impact_metrics_text'] ?? null);
        $validated['profile_links'] = $this->parseLabelUrlPairs($validated['profile_links_text'] ?? null);
        $validated['social_links'] = $this->parseSocialLinks($validated['social_links_text'] ?? null);

        unset($validated['impact_metrics_text'], $validated['profile_links_text'], $validated['social_links_text']);

        return $validated;
    }

    private function resolveSlug(?string $slug, string $organizationName, ?int $currentMemberId = null): string
    {
        $baseSlug = Str::slug($slug ?: $organizationName);

        if ($baseSlug === '') {
            $baseSlug = 'member-profile';
        }

        $candidate = $baseSlug;
        $suffix = 2;

        while (
            DashboardMemberProfile::query()
                ->where('slug', $candidate)
                ->when($currentMemberId, fn ($query) => $query->whereKeyNot($currentMemberId))
                ->exists()
        ) {
            $candidate = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $candidate;
    }

    private function normalizeUrl(?string $url): ?string
    {
        if (! filled($url)) {
            return null;
        }

        $url = trim((string) $url);

        if (! Str::startsWith($url, ['http://', 'https://'])) {
            $url = 'https://'.$url;
        }

        return $url;
    }

    private function parseMetrics(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->map(function (string $line): array {
                [$metricValue, $label] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');

                return [
                    'value' => $metricValue,
                    'label' => $label,
                ];
            })
            ->filter(fn (array $metric): bool => filled($metric['value']) || filled($metric['label']))
            ->values()
            ->all();
    }

    private function parseLabelUrlPairs(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->map(function (string $line): array {
                [$label, $url] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');

                return [
                    'label' => $label,
                    'url' => $this->normalizeUrl($url),
                ];
            })
            ->filter(fn (array $link): bool => filled($link['url']))
            ->values()
            ->all();
    }

    private function parseSocialLinks(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value))
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->map(function (string $line): array {
                [$platform, $url] = array_pad(array_map('trim', explode('|', $line, 2)), 2, '');
                $platform = Str::lower($platform ?: 'link');

                return [
                    'platform' => $platform,
                    'label' => Str::headline($platform),
                    'url' => $this->normalizeUrl($url),
                ];
            })
            ->filter(fn (array $link): bool => filled($link['url']))
            ->values()
            ->all();
    }

    private function impactMetricsText(DashboardMemberProfile $member): string
    {
        return $this->linesFromCollection(
            collect($member->impactMetricsList())
                ->map(fn (array $metric): string => trim(($metric['value'] ?? '').' | '.($metric['label'] ?? '')))
        );
    }

    private function profileLinksText(DashboardMemberProfile $member): string
    {
        return $this->linesFromCollection(
            collect($member->profileLinksList())
                ->map(fn (array $link): string => trim(($link['label'] ?? 'Open link').' | '.($link['url'] ?? '')))
        );
    }

    private function socialLinksText(DashboardMemberProfile $member): string
    {
        return $this->linesFromCollection(
            collect($member->socialLinksList())
                ->map(fn (array $link): string => trim(($link['platform'] ?? 'link').' | '.($link['url'] ?? '')))
        );
    }

    private function linesFromCollection(Collection $lines): string
    {
        return $lines
            ->filter(fn (string $line): bool => trim($line) !== '|')
            ->implode(PHP_EOL);
    }
}
