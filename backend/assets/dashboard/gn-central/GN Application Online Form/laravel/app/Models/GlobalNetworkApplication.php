<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GlobalNetworkApplication extends Model
{
    use HasFactory;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_SUBMITTED = 'submitted';
    public const STATUS_UNDER_REVIEW = 'under_review';
    public const STATUS_NEEDS_INFORMATION = 'needs_information';
    public const STATUS_RECOMMENDED = 'recommended';
    public const STATUS_NOT_RECOMMENDED = 'not_recommended';
    public const STATUS_BOARD_APPROVED = 'board_approved';
    public const STATUS_BOARD_DECLINED = 'board_declined';
    public const STATUS_WITHDRAWN = 'withdrawn';

    protected $fillable = [
        'user_id',
        'status',
        'organization_name',
        'acronym',
        'contact_name',
        'primary_contact_name',
        'secondary_contact_name',
        'contact_position',
        'address',
        'country',
        'country_other',
        'telephone',
        'additional_phone_numbers',
        'email',
        'primary_contact_email',
        'secondary_contact_email',
        'website_url',
        'year_established',
        'governance_structure',
        'organization_structure_type',
        'has_nonprofit_status',
        'has_formal_bylaws',
        'annual_operating_budget_usd',
        'has_annual_report',
        'receives_government_funding',
        'is_ida_member',
        'is_membership_organization',
        'current_member_count',
        'membership_categories',
        'annual_membership_dues_usd',
        'has_recruitment_material',
        'supports_branches_or_chapters',
        'branches_or_chapters_details',
        'mission',
        'offers_public_activities',
        'public_activities_details',
        'has_annual_conference',
        'country_dyslexia_definition',
        'supports_country_definition',
        'organization_dyslexia_definition',
        'instructional_approaches_country',
        'remediation_programs_country',
        'supports_instructional_approaches',
        'advocated_approaches_programs',
        'signature_name',
        'submitted_at',
        'review_notes',
    ];

    protected $casts = [
        'has_nonprofit_status' => 'boolean',
        'has_formal_bylaws' => 'boolean',
        'has_annual_report' => 'boolean',
        'receives_government_funding' => 'boolean',
        'is_ida_member' => 'boolean',
        'is_membership_organization' => 'boolean',
        'has_recruitment_material' => 'boolean',
        'supports_branches_or_chapters' => 'boolean',
        'offers_public_activities' => 'boolean',
        'has_annual_conference' => 'boolean',
        'supports_country_definition' => 'boolean',
        'supports_instructional_approaches' => 'boolean',
        'annual_operating_budget_usd' => 'decimal:2',
        'annual_membership_dues_usd' => 'decimal:2',
        'submitted_at' => 'datetime',
        'review_notes' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(GlobalNetworkApplicationDocument::class);
    }

    public function isSubmitted(): bool
    {
        return $this->status !== self::STATUS_DRAFT && $this->submitted_at !== null;
    }
}
