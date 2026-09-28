<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class DashboardMemberProfile extends Model
{
    protected $fillable = [
        'user_id',
        'profile_type',
        'slug',
        'organization_name',
        'membership_level',
        'level_label',
        'country',
        'region',
        'flag_emoji',
        'phone',
        'hero_asset_path',
        'hero_asset_alt',
        'hero_asset_mode',
        'is_wide_logo',
        'primary_contact_name',
        'primary_contact_role',
        'email',
        'website_url',
        'profile_heading',
        'profile_subheading',
        'record_title',
        'record_summary',
        'organization_logo_path',
        'representative_name',
        'representative_role',
        'representative_image_path',
        'leader_bio',
        'organization_profile',
        'impact_title',
        'impact_metrics',
        'social_links',
        'profile_links',
        'directory_card_title',
        'directory_location',
        'directory_address',
        'directory_description',
        'directory_image_path',
        'directory_image_alt',
        'region_code',
        'latitude',
        'longitude',
        'map_zoom',
        'highlight_radius',
        'summary',
        'status',
        'display_order',
    ];

    protected $casts = [
        'is_wide_logo' => 'boolean',
        'impact_metrics' => 'array',
        'social_links' => 'array',
        'profile_links' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
        'map_zoom' => 'integer',
        'highlight_radius' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDirectoryMembers($query)
    {
        return $query
            ->where('profile_type', 'member')
            ->where('status', 'active')
            ->orderBy('display_order')
            ->orderBy('organization_name');
    }

    public function tierSlug(): string
    {
        return Str::slug((string) $this->membership_level);
    }

    public function levelDisplay(): string
    {
        return $this->level_label ?: ($this->membership_level ?: 'Member');
    }

    public function flagDisplay(): string
    {
        $flag = trim((string) $this->flag_emoji);

        if ($flag === '') {
            return '🌐';
        }

        if (mb_strlen($flag) === 2 && ctype_alpha($flag)) {
            $flag = strtoupper($flag);
            $offset = 127397;

            return mb_chr(ord($flag[0]) + $offset).mb_chr(ord($flag[1]) + $offset);
        }

        return $flag;
    }

    public function displayLocation(): string
    {
        return $this->directory_location
            ?: $this->directory_address
            ?: $this->country
            ?: $this->region
            ?: '';
    }

    public function websiteLabel(): ?string
    {
        if (! $this->website_url) {
            return null;
        }

        $host = parse_url($this->website_url, PHP_URL_HOST);

        if (! is_string($host) || $host === '') {
            return $this->website_url;
        }

        return preg_replace('/^www\./i', '', $host) ?: $host;
    }

    public function cardImageUrl(): ?string
    {
        return $this->normalizeAssetPath(
            $this->directory_image_path
            ?: $this->hero_asset_path
            ?: $this->organization_logo_path
            ?: $this->representative_image_path
        );
    }

    public function heroImageUrl(): ?string
    {
        return $this->normalizeAssetPath(
            $this->hero_asset_path
            ?: $this->directory_image_path
            ?: $this->organization_logo_path
            ?: $this->representative_image_path
        );
    }

    public function organizationLogoUrl(): ?string
    {
        return $this->normalizeAssetPath(
            $this->organization_logo_path
            ?: $this->directory_image_path
            ?: $this->hero_asset_path
        );
    }

    public function representativeImageUrl(): ?string
    {
        return $this->normalizeAssetPath($this->representative_image_path);
    }

    public function socialLinksList(): array
    {
        return collect($this->social_links ?? [])
            ->filter(fn ($item) => is_array($item) && filled($item['url'] ?? null))
            ->map(function (array $item): array {
                $platform = Str::lower((string) ($item['platform'] ?? 'link'));

                return [
                    'platform' => $platform,
                    'label' => $item['label'] ?? Str::headline($platform),
                    'url' => $item['url'],
                ];
            })
            ->values()
            ->all();
    }

    public function impactMetricsList(): array
    {
        return collect($this->impact_metrics ?? [])
            ->filter(fn ($item) => is_array($item) && (filled($item['value'] ?? null) || filled($item['label'] ?? null)))
            ->values()
            ->all();
    }

    public function profileLinksList(): array
    {
        return collect($this->profile_links ?? [])
            ->filter(fn ($item) => is_array($item) && filled($item['url'] ?? null))
            ->values()
            ->all();
    }

    public function searchText(): string
    {
        return Str::lower(collect([
            $this->organization_name,
            $this->directory_card_title,
            $this->country,
            $this->region,
            $this->primary_contact_name,
            $this->primary_contact_role,
            $this->email,
        ])->filter()->implode(' '));
    }

    public function toDirectoryPayload(): array
    {
        return [
            'id' => $this->slug,
            'name' => $this->organization_name,
            'cardTitle' => $this->directory_card_title,
            'location' => $this->displayLocation(),
            'tier' => $this->membership_level,
            'detailTier' => $this->level_label,
            'image' => $this->cardImageUrl(),
            'address' => $this->directory_address ?: $this->displayLocation(),
            'description' => $this->directory_description ?: $this->summary,
            'phone' => $this->phone,
            'email' => $this->email,
            'website' => $this->websiteLabel(),
            'websiteUrl' => $this->website_url,
            'socialLinks' => $this->socialLinksList(),
            'regionCode' => $this->region_code ?: Str::upper((string) $this->flag_emoji),
            'lat' => $this->latitude,
            'lng' => $this->longitude,
            'mapZoom' => $this->map_zoom,
            'highlightRadius' => $this->highlight_radius,
        ];
    }

    private function normalizeAssetPath(?string $path): ?string
    {
        if (! filled($path)) {
            return null;
        }

        $path = trim((string) $path);

        if (Str::startsWith($path, ['http://', 'https://', '//', '/'])) {
            return $path;
        }

        return asset($path);
    }
}
