<?php

namespace App\Http\Requests;

use App\Models\GlobalNetworkApplication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StoreGlobalNetworkApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isSubmit = $this->input('intent') === 'submit';
        $required = $isSubmit ? 'required' : 'nullable';
        $countries = array_merge(config('global-network-countries', []), ['Other']);

        return [
            'intent' => ['required', Rule::in(['draft', 'submit'])],

            'organization_name' => [$required, 'string', 'max:255'],
            'acronym' => ['nullable', 'string', 'max:80'],
            'contact_name' => [$required, 'string', 'max:255'],
            'primary_contact_name' => [$required, 'string', 'max:255'],
            'secondary_contact_name' => ['nullable', 'string', 'max:255'],
            'contact_position' => ['nullable', 'string', 'max:255'],
            'address' => [$required, 'string', 'max:5000'],
            'country' => [$required, 'string', Rule::in($countries)],
            'country_other' => ['required_if:country,Other', 'nullable', 'string', 'max:120'],
            'telephone' => [$required, 'string', 'max:80'],
            'additional_phone_numbers' => ['nullable', 'string', 'max:2000'],
            'email' => [$required, 'email', 'max:255'],
            'primary_contact_email' => [$required, 'email', 'max:255'],
            'secondary_contact_email' => ['nullable', 'email', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],

            'year_established' => ['nullable', 'integer', 'min:1800', 'max:' . now()->year],
            'governance_structure' => ['nullable', 'string'],
            'organization_structure_type' => ['nullable', Rule::in(['ngo', 'non_profit', 'charity', 'other'])],
            'has_nonprofit_status' => ['nullable', 'boolean'],
            'has_formal_bylaws' => ['nullable', 'boolean'],
            'annual_operating_budget_usd' => ['nullable', 'numeric', 'min:0', 'max:999999999999.99'],
            'has_annual_report' => ['nullable', 'boolean'],
            'receives_government_funding' => ['nullable', 'boolean'],
            'is_ida_member' => ['nullable', 'boolean'],

            'is_membership_organization' => ['nullable', 'boolean'],
            'current_member_count' => ['nullable', 'integer', 'min:0'],
            'membership_categories' => ['nullable', 'string', 'max:5000'],
            'annual_membership_dues_usd' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'has_recruitment_material' => ['nullable', 'boolean'],
            'supports_branches_or_chapters' => ['nullable', 'boolean'],
            'branches_or_chapters_details' => ['nullable', 'string'],

            'mission' => ['nullable', 'string'],
            'offers_public_activities' => ['nullable', 'boolean'],
            'public_activities_details' => ['nullable', 'string'],
            'has_annual_conference' => ['nullable', 'boolean'],

            'country_dyslexia_definition' => ['nullable', 'string'],
            'supports_country_definition' => ['nullable', 'boolean'],
            'organization_dyslexia_definition' => ['nullable', 'string'],
            'instructional_approaches_country' => ['nullable', 'string'],
            'remediation_programs_country' => ['nullable', 'string'],
            'supports_instructional_approaches' => ['nullable', 'boolean'],
            'advocated_approaches_programs' => ['nullable', 'string'],

            'signature_name' => [$isSubmit ? 'required' : 'nullable', 'string', 'max:255'],
            'documents.*' => ['nullable', 'array', 'max:12'],
            'documents.*.*' => ['nullable', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png', 'max:10240'],
            'photos.applicant_contact' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'photos.primary_contact' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'photos.secondary_contact' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'photos.organization' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
            'photos.organization_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:10240'],
            'photos.activity_examples' => ['nullable', 'array', 'max:8'],
            'photos.activity_examples.*' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:6144'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if ($this->input('intent') !== 'submit') {
                return;
            }

            foreach ([
                'applicant_contact' => 'Please upload a photo of the person completing the application.',
                'primary_contact' => 'Please upload a photo of the primary contact.',
                'organization' => 'Please upload a photo of the organization.',
            ] as $photoType => $message) {
                if (!$this->hasUploadedOrSavedPhoto($photoType)) {
                    $validator->errors()->add("photos.{$photoType}", $message);
                }
            }

            if (($this->filled('secondary_contact_name') || $this->filled('secondary_contact_email')) && !$this->hasUploadedOrSavedPhoto('secondary_contact')) {
                $validator->errors()->add('photos.secondary_contact', 'Please upload a photo of the secondary contact.');
            }
        });
    }

    protected function prepareForValidation(): void
    {
        foreach ($this->booleanFields() as $field) {
            if ($this->has($field)) {
                $this->merge([$field => filter_var($this->input($field), FILTER_VALIDATE_BOOL, FILTER_NULL_ON_FAILURE)]);
            }
        }
    }

    private function booleanFields(): array
    {
        return [
            'has_nonprofit_status',
            'has_formal_bylaws',
            'has_annual_report',
            'receives_government_funding',
            'is_ida_member',
            'is_membership_organization',
            'has_recruitment_material',
            'supports_branches_or_chapters',
            'offers_public_activities',
            'has_annual_conference',
            'supports_country_definition',
            'supports_instructional_approaches',
        ];
    }

    private function hasUploadedOrSavedPhoto(string $photoType): bool
    {
        if ($this->hasFile("photos.{$photoType}")) {
            return true;
        }

        $application = $this->route('application');

        return $application instanceof GlobalNetworkApplication
            && $application->documents()->where('document_type', "photo_{$photoType}")->exists();
    }
}
