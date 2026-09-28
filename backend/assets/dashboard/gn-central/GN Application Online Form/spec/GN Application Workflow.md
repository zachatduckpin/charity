# Global Network Application - Online Workflow

## Source

Paper source reviewed: `2025 Global_NetworkApplication_form_Part A_editable.pdf`

The source is a one-page editable PDF AcroForm with 43 fields. The online form should preserve the application substance while replacing the cramped PDF layout with a guided workflow.

## Recommended User Flow

1. Start application
   - Show a dedicated welcome step with the Global Network logo, program title, and warm welcome message.
   - Applicant selects `Start application` to move from the welcome step into the form.
   - Let applicant save as draft after entering the form.
   - Show a progress meter with current step and percentage complete after the welcome step.

2. Association contact information
   - Organization name
   - Acronym
   - Contact name for the person completing the application
   - Primary contact name for ongoing IDA communication
   - Secondary contact name for backup communication
   - Primary and secondary contacts should be editable later in GN Central.
   - Contact position
   - Address
   - Country dropdown populated from `laravel/config/global-network-countries.php`
   - Other country name if the applicant selects `Other`
   - Telephone with country code
   - Additional phone numbers
   - General email
   - Primary contact email for ongoing IDA communication
   - Secondary contact email for backup communication
   - Website URL

3. Organization profile
   - Year established
   - Governance structure
   - Organization structure type: NGO / Non-profit / Charity / Other
   - NGO/non-profit/charity status confirmation
   - Bylaws confirmation
   - Estimated annual operating budget in USD
   - Annual operating or financial report confirmation
   - Government or state funding confirmation
   - IDA membership confirmation

4. Members and branches
   - Membership organization confirmation
   - Current number of members
   - Membership categories
   - Annual membership dues in USD
   - Promotional or recruitment material confirmation
   - Local branches or chapters confirmation
   - Branches/chapters details if applicable

5. Mission, community activities, and practice context
   - Organization mission
   - Public activities confirmation
   - Public activities details if applicable
   - Annual conference confirmation
   - Country definition of dyslexia and who formulated it
   - Whether the organization supports the country definition
   - Organization definition if different
   - Instructional approaches used in the country
   - Remediation programs used in the country
   - Whether the organization supports these approaches/programs
   - Organization advocated approaches/programs

6. Supporting documents
   - NGO/non-profit/charity status document
   - Bylaws
   - Annual operating or financial report
   - Promotional/recruitment sample
   - Additional mission/definition/instruction documents
   - Applicants may upload multiple documents in any document category.
   - Document uploads are limited to 12 files per category and 10 MB per file.
   - Add additional files option for any extra material that does not fit the named categories.
   - Applicant/person completing the form photo, required on final submission, JPG/PNG/WebP, maximum 4 MB
   - Primary contact photo, required on final submission, JPG/PNG/WebP, maximum 4 MB
   - Secondary contact photo, required when a secondary contact is provided, JPG/PNG/WebP, maximum 4 MB
   - Organization photo, required on final submission, JPG/PNG/WebP, maximum 6 MB
   - Organization logo, recommended high-resolution JPG/PNG/WebP/SVG, maximum 10 MB
   - Additional activity example photos, optional, up to 8 images, maximum 6 MB each
   - Activity photos may include examples from schools, assessment centres, events, training, community activities, or other services.

7. Review and submit
   - Applicant reviews all answers.
   - Contact signs by typing name.
   - Contact confirms authority to submit.
   - Date is stored automatically and shown to applicant.
   - Status changes from `draft` to `submitted`.

## Save And Resume

- Applicants can select `Save draft and finish later` at any step.
- Draft saves use the same form and preserve completed fields, uploaded documents, and uploaded photos.
- Draft applications can be reopened through the edit route and completed later.
- Final submission keeps stricter validation than drafts; draft records may be partial.

## Suggested Status Workflow

- `draft`: applicant is still editing.
- `submitted`: applicant has sent the application.
- `under_review`: Global Network Committee review has started.
- `needs_information`: reviewer requests clarification or documents.
- `recommended`: committee recommends approval.
- `not_recommended`: committee does not recommend approval.
- `board_approved`: IDA Board approves participation.
- `board_declined`: IDA Board declines participation.
- `withdrawn`: applicant withdraws or application is closed without review.

## Design Direction

- Use a stepper on desktop and compact progress indicator on mobile.
- Keep the form calm and professional: white form surface, deep blue headings, teal progress/accent, warm amber highlights for required document prompts.
- Use large text areas for narrative responses.
- Use conditional panels for "Yes" answers that require details or attachments.
- Use autosave/draft capability if GN Central supports authenticated users.
- Use attachment upload fields, not "please attach separate page" instructions.

## Database Notes

The source PDF asks for several long narrative answers. Store those as `longText`.

Supporting documents should be modeled separately from the application record so the team can add more document types later without migration churn.

Photos and logo files are stored in the same supporting-document table using typed `document_type` values such as `photo_applicant_contact`, `photo_primary_contact`, `photo_secondary_contact`, `photo_organization`, `organization_logo`, and `photo_activity_example_1`.
