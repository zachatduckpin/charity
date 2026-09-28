# PDF Field Analysis

## PDF Summary

- File reviewed: `2025 Global_NetworkApplication_form_Part A_editable.pdf`
- Pages: 1
- Format: Editable PDF AcroForm
- Fillable fields detected: 43
- Main limitation: The form compresses long narrative answers, checkboxes, attachment prompts, signature, and contact details into one page.

## Online Form Sections

The paper form was reorganized into these digital sections:

1. Association contact information
2. Organization profile
3. Members and branches
4. Mission, activities, and practice context
5. Supporting documents
6. Review and signature

## Field Map

| PDF prompt | Online field |
| --- | --- |
| Organization NAME | `organization_name` |
| Acronym | `acronym` |
| CONTACT Name & Position | `contact_name`, `primary_contact_name`, `secondary_contact_name`, `contact_position` |
| ADDRESS including city, state, Zip/Postal code, country | `address`, `country`, `country_other` |
| TELEPHONE number | `telephone`, `additional_phone_numbers` |
| E-MAIL address | `email`, `primary_contact_email`, `secondary_contact_email` |
| WEBSITE address/URL | `website_url` |
| YEAR established | `year_established` |
| GOVERNANCE structure | `governance_structure` |
| NGO/Non-profit/Charity | `organization_structure_type`, `has_nonprofit_status` |
| Formal bylaws | `has_formal_bylaws`, `documents[bylaws]` |
| Operating budget | `annual_operating_budget_usd` |
| Annual operating or financial report | `has_annual_report`, `documents[annual_report]` |
| Government/state funding | `receives_government_funding` |
| Organization member of IDA | `is_ida_member` |
| Membership organization | `is_membership_organization` |
| Current members | `current_member_count` |
| Membership categories | `membership_categories` |
| Annual membership dues | `annual_membership_dues_usd` |
| Promotional/recruitment material | `has_recruitment_material`, `documents[recruitment_material]` |
| Branches or chapters | `supports_branches_or_chapters`, `branches_or_chapters_details` |
| Mission | `mission` |
| Public activities | `offers_public_activities`, `public_activities_details` |
| Annual conference | `has_annual_conference` |
| Definition of dyslexia in country | `country_dyslexia_definition` |
| Organization support for definition | `supports_country_definition` |
| Different organization definition | `organization_dyslexia_definition` |
| Instructional approaches | `instructional_approaches_country` |
| Remediation programs | `remediation_programs_country` |
| Support for approaches and programs | `supports_instructional_approaches` |
| Advocated approaches/programs | `advocated_approaches_programs` |
| Signature of Contact | `signature_name` |
| Date | `submitted_at` |

## Added Digital-Only Upload Fields

The online form also adds optional image uploads that were not explicitly supported by the one-page PDF:

| Online prompt | Storage type and limit |
| --- | --- |
| Applicant/person completing the form photo | `photos[applicant_contact]`, JPG/PNG/WebP, maximum 4 MB, required on final submission |
| Primary contact photo | `photos[primary_contact]`, JPG/PNG/WebP, maximum 4 MB, required on final submission |
| Secondary contact photo | `photos[secondary_contact]`, JPG/PNG/WebP, maximum 4 MB, required when a secondary contact is provided |
| Organization photo | `photos[organization]`, JPG/PNG/WebP, maximum 6 MB, required on final submission |
| Organization logo, high resolution | `photos[organization_logo]`, JPG/PNG/WebP/SVG, maximum 10 MB |
| Additional activity photos | `photos[activity_examples][]`, up to 8 JPG/PNG/WebP images, maximum 6 MB each |
