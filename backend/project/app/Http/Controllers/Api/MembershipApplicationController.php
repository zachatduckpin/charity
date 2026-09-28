<?php

namespace App\Http\Controllers\Api;

use App\Models\MembershipApplication;
use App\Models\MembershipApplicationAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MembershipApplicationController extends ApiController
{
    public function store(Request $request)
    {
        $submissionStatus = $request->input('submission_status') === 'draft' ? 'draft' : 'submitted';

        $validator = Validator::make(
            $request->all(),
            $this->rules($submissionStatus),
            $this->messages()
        );

        $validator->after(function ($validator) use ($request, $submissionStatus) {
            if ($submissionStatus !== 'submitted') {
                return;
            }

            $this->validateConditionalUploads($request, $validator);
        });

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please review the highlighted application fields.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $application = new MembershipApplication();
        $application->reference = $this->generateReference();
        $application->submission_status = $submissionStatus;
        $application->client_ip = $request->ip();
        $application->user_agent = (string) $request->userAgent();
        $application->submitted_at = $submissionStatus === 'submitted' ? now() : null;

        foreach ($this->stringFields() as $field) {
            $application->{$field} = $this->normalizeString($request->input($field));
        }

        foreach ($this->numericFields() as $field) {
            $application->{$field} = $this->normalizeNumber($request->input($field));
        }

        $application->save();
        $this->storeAttachments($request, $application);

        return $this->sendResponse([
            'id' => $application->id,
            'reference' => $application->reference,
            'submission_status' => $application->submission_status,
        ], $submissionStatus === 'draft'
            ? 'Application draft saved successfully.'
            : 'Application submitted successfully.');
    }

    private function rules(string $submissionStatus): array
    {
        $required = $submissionStatus === 'submitted' ? 'required' : 'nullable';
        $currentYear = (int) date('Y');

        return [
            'submission_status' => ['nullable', Rule::in(['draft', 'submitted'])],

            'organization_name' => [$required, 'string', 'max:255'],
            'acronym' => ['nullable', 'string', 'max:50'],
            'contact_name' => [$required, 'string', 'max:255'],
            'contact_position' => [$required, 'string', 'max:255'],
            'primary_contact_name' => [$required, 'string', 'max:255'],
            'secondary_contact_name' => ['nullable', 'string', 'max:255'],
            'address' => [$required, 'string'],
            'country' => [$required, 'string', 'max:120'],
            'country_other' => ['nullable', 'required_if:country,Other', 'string', 'max:120'],
            'telephone' => [$required, 'string', 'max:100'],
            'additional_phone_numbers' => ['nullable', 'string', 'max:255'],
            'email' => [$required, 'email', 'max:255'],
            'primary_contact_email' => [$required, 'email', 'max:255'],
            'secondary_contact_email' => ['nullable', 'email', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],

            'year_established' => [$required, 'integer', 'min:1800', 'max:' . $currentYear],
            'organization_structure_type' => [$required, 'string', 'max:120'],
            'governance_structure' => [$required, 'string'],
            'has_nonprofit_status' => [$required, Rule::in(['yes', 'no'])],
            'has_formal_bylaws' => [$required, Rule::in(['yes', 'no'])],
            'has_annual_report' => [$required, Rule::in(['yes', 'no'])],
            'receives_government_funding' => [$required, Rule::in(['yes', 'no'])],
            'is_ida_member' => [$required, Rule::in(['yes', 'no'])],
            'annual_operating_budget_usd' => ['nullable', 'numeric', 'min:0'],

            'is_membership_organization' => [$required, Rule::in(['yes', 'no'])],
            'has_recruitment_material' => [$required, Rule::in(['yes', 'no'])],
            'supports_branches_or_chapters' => [$required, Rule::in(['yes', 'no'])],
            'current_member_count' => ['nullable', 'required_if:is_membership_organization,yes', 'integer', 'min:0'],
            'annual_membership_dues_usd' => ['nullable', 'numeric', 'min:0'],
            'membership_categories' => ['nullable', 'required_if:is_membership_organization,yes', 'string'],
            'branches_or_chapters_details' => ['nullable', 'required_if:supports_branches_or_chapters,yes', 'string'],

            'mission' => [$required, 'string'],
            'offers_public_activities' => [$required, Rule::in(['yes', 'no'])],
            'has_annual_conference' => [$required, Rule::in(['yes', 'no'])],
            'public_activities_details' => ['nullable', 'required_if:offers_public_activities,yes', 'string'],
            'country_dyslexia_definition' => [$required, 'string'],
            'supports_country_definition' => [$required, Rule::in(['yes', 'no'])],
            'supports_instructional_approaches' => [$required, Rule::in(['yes', 'no'])],
            'organization_dyslexia_definition' => ['nullable', 'string'],
            'instructional_approaches_country' => [$required, 'string'],
            'remediation_programs_country' => [$required, 'string'],
            'advocated_approaches_programs' => ['nullable', 'required_if:supports_instructional_approaches,yes', 'string'],

            'signature_name' => [$required, 'string', 'max:255'],

            'documents_nonprofit_status' => ['nullable', 'array'],
            'documents_nonprofit_status.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,webp,zip', 'max:10240'],
            'documents_bylaws' => ['nullable', 'array'],
            'documents_bylaws.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,webp,zip', 'max:10240'],
            'documents_annual_report' => ['nullable', 'array'],
            'documents_annual_report.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,webp,zip', 'max:10240'],
            'documents_recruitment_material' => ['nullable', 'array'],
            'documents_recruitment_material.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,webp,zip', 'max:10240'],
            'documents_additional_context' => ['nullable', 'array'],
            'documents_additional_context.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,webp,zip', 'max:10240'],
            'documents_additional_files' => ['nullable', 'array'],
            'documents_additional_files.*' => ['file', 'mimes:pdf,doc,docx,xls,xlsx,zip,rar,jpg,jpeg,png,webp', 'max:10240'],

            'photo_applicant_contact' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'photo_primary_contact' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'photo_secondary_contact' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'photo_organization' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'photo_organization_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:5120'],
            'photo_activity_examples' => ['nullable', 'array'],
            'photo_activity_examples.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ];
    }

    private function messages(): array
    {
        return [
            'country_other.required_if' => 'Please specify the country when you select Other.',
            'current_member_count.required_if' => 'Please provide the current member count for membership organizations.',
            'membership_categories.required_if' => 'Please describe the membership categories.',
            'branches_or_chapters_details.required_if' => 'Please describe the branches or chapters.',
            'public_activities_details.required_if' => 'Please describe the public activities offered by the organization.',
            'advocated_approaches_programs.required_if' => 'Please describe the approaches or programs your organization advocates.',
        ];
    }

    private function validateConditionalUploads(Request $request, $validator): void
    {
        $requiredUploads = [
            'has_nonprofit_status' => ['field' => 'documents_nonprofit_status', 'message' => 'Please upload nonprofit status documents.'],
            'has_formal_bylaws' => ['field' => 'documents_bylaws', 'message' => 'Please upload the formal bylaws files.'],
            'has_annual_report' => ['field' => 'documents_annual_report', 'message' => 'Please upload the annual operating or financial report.'],
            'has_recruitment_material' => ['field' => 'documents_recruitment_material', 'message' => 'Please upload the recruitment material sample.'],
        ];

        foreach ($requiredUploads as $sourceField => $config) {
            if ($request->input($sourceField) === 'yes' && !$request->hasFile($config['field'])) {
                $validator->errors()->add($config['field'], $config['message']);
            }
        }

        foreach ([
            'photo_applicant_contact' => 'Please upload a photo of the applicant or person completing the form.',
            'photo_primary_contact' => 'Please upload a photo of the primary contact.',
            'photo_organization' => 'Please upload an organization photo.',
        ] as $field => $message) {
            if (!$request->hasFile($field)) {
                $validator->errors()->add($field, $message);
            }
        }
    }

    private function storeAttachments(Request $request, MembershipApplication $application): void
    {
        $definitions = [
            'documents_nonprofit_status' => ['category' => 'documents_nonprofit_status', 'type' => 'document', 'multiple' => true],
            'documents_bylaws' => ['category' => 'documents_bylaws', 'type' => 'document', 'multiple' => true],
            'documents_annual_report' => ['category' => 'documents_annual_report', 'type' => 'document', 'multiple' => true],
            'documents_recruitment_material' => ['category' => 'documents_recruitment_material', 'type' => 'document', 'multiple' => true],
            'documents_additional_context' => ['category' => 'documents_additional_context', 'type' => 'document', 'multiple' => true],
            'documents_additional_files' => ['category' => 'documents_additional_files', 'type' => 'document', 'multiple' => true],
            'photo_applicant_contact' => ['category' => 'photo_applicant_contact', 'type' => 'image', 'multiple' => false],
            'photo_primary_contact' => ['category' => 'photo_primary_contact', 'type' => 'image', 'multiple' => false],
            'photo_secondary_contact' => ['category' => 'photo_secondary_contact', 'type' => 'image', 'multiple' => false],
            'photo_organization' => ['category' => 'photo_organization', 'type' => 'image', 'multiple' => false],
            'photo_organization_logo' => ['category' => 'photo_organization_logo', 'type' => 'image', 'multiple' => false],
            'photo_activity_examples' => ['category' => 'photo_activity_examples', 'type' => 'image', 'multiple' => true],
        ];

        foreach ($definitions as $field => $config) {
            if (!$request->hasFile($field)) {
                continue;
            }

            $files = $request->file($field);
            if (!$config['multiple']) {
                $files = [$files];
            }

            foreach ($files as $file) {
                if (!$file instanceof UploadedFile) {
                    continue;
                }

                $stored = $this->storeUploadedFile($file, $application->reference, $config['category']);

                $attachment = new MembershipApplicationAttachment();
                $attachment->membership_application_id = $application->id;
                $attachment->category = $config['category'];
                $attachment->attachment_type = $config['type'];
                $attachment->original_name = $file->getClientOriginalName();
                $attachment->stored_name = $stored['stored_name'];
                $attachment->relative_path = $stored['relative_path'];
                $attachment->mime_type = $file->getClientMimeType();
                $attachment->file_extension = strtolower((string) $file->getClientOriginalExtension());
                $attachment->file_size = $file->getSize();
                $attachment->save();
            }
        }
    }

    private function storeUploadedFile(UploadedFile $file, string $reference, string $category): array
    {
        $baseDirectory = base_path('../assets/files/membership-applications');
        $relativeDirectory = $reference . '/' . $category;
        $absoluteDirectory = $baseDirectory . '/' . $relativeDirectory;

        if (!File::exists($absoluteDirectory)) {
            File::makeDirectory($absoluteDirectory, 0755, true);
        }

        $extension = strtolower((string) $file->getClientOriginalExtension());
        $storedName = uniqid($category . '_', true) . ($extension ? '.' . $extension : '');
        $file->move($absoluteDirectory, $storedName);

        return [
            'stored_name' => $storedName,
            'relative_path' => 'membership-applications/' . $relativeDirectory . '/' . $storedName,
        ];
    }

    private function generateReference(): string
    {
        do {
            $reference = 'GN-' . now()->format('Ymd') . '-' . strtoupper(substr(md5(uniqid((string) mt_rand(), true)), 0, 8));
        } while (MembershipApplication::where('reference', $reference)->exists());

        return $reference;
    }

    private function normalizeString($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);
        return $value === '' ? null : $value;
    }

    private function normalizeNumber($value)
    {
        if ($value === null || $value === '') {
            return null;
        }

        return is_numeric($value) ? $value : null;
    }

    private function stringFields(): array
    {
        return [
            'organization_name',
            'acronym',
            'contact_name',
            'contact_position',
            'primary_contact_name',
            'secondary_contact_name',
            'address',
            'country',
            'country_other',
            'telephone',
            'additional_phone_numbers',
            'email',
            'primary_contact_email',
            'secondary_contact_email',
            'website_url',
            'organization_structure_type',
            'governance_structure',
            'has_nonprofit_status',
            'has_formal_bylaws',
            'has_annual_report',
            'receives_government_funding',
            'is_ida_member',
            'is_membership_organization',
            'has_recruitment_material',
            'supports_branches_or_chapters',
            'membership_categories',
            'branches_or_chapters_details',
            'mission',
            'offers_public_activities',
            'has_annual_conference',
            'public_activities_details',
            'country_dyslexia_definition',
            'supports_country_definition',
            'supports_instructional_approaches',
            'organization_dyslexia_definition',
            'instructional_approaches_country',
            'remediation_programs_country',
            'advocated_approaches_programs',
            'signature_name',
        ];
    }

    private function numericFields(): array
    {
        return [
            'year_established',
            'annual_operating_budget_usd',
            'current_member_count',
            'annual_membership_dues_usd',
        ];
    }
}
