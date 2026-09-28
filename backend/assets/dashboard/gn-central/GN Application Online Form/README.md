# GN Application Online Form

This folder converts the IDA Home Office PDF application into a Laravel-ready online form module for GN Central.

## Contents

- `spec/GN Application Workflow.md` - product workflow and field breakdown.
- `laravel/database/migrations` - SQL schema for applications and supporting documents.
- `laravel/app/Models` - Eloquent models.
- `laravel/app/Http/Requests` - validation rules for draft and final submission.
- `laravel/app/Http/Controllers` - create, store, and show flow.
- `laravel/routes/global_network.php` - route definitions.
- `laravel/resources/views/global-network/applications` - Blade form and confirmation page.
- `laravel/resources/css/global-network-application.css` - visual styling.
- `laravel/public/images/ida-global-network-logo.png` - logo used in the welcome step.
- `laravel/config/global-network-countries.php` - country dropdown options, with `Other` handled in the form.
- `prototype/index.html` - standalone preview for discussing layout before integration.
- `prototype/assets/ida-global-network-logo.png` - logo used by the standalone prototype welcome step.

## Integration Notes

1. Copy the Laravel files into the GN Central codebase.
2. Include `routes/global_network.php` from `routes/web.php`:

```php
require __DIR__ . '/global_network.php';
```

3. Add the CSS to the build pipeline or publish it to `public/css/global-network-application.css`.
4. Configure a private filesystem disk for uploaded documents if one does not exist.
5. Run migrations.
6. Add authorization policies so only the applicant, GN reviewers, and administrators can view each application.

## Progress And Drafts

- The form includes a visual progress bar with step count and percentage complete.
- Applicants can save a draft from every step using `Save draft and finish later`.
- Drafts can be reopened through `global-network.applications.edit` and saved through `global-network.applications.update`.
- The database allows partial drafts, while final submission validation still requires the core application fields.

## Upload Limits

- Document uploads: PDF, DOC, DOCX, JPG, JPEG, or PNG up to 10 MB each, with up to 12 files per document category.
- Applicant/person completing the form photo: required on final submission, JPG, PNG, or WebP up to 4 MB.
- Primary contact photo: required on final submission, JPG, PNG, or WebP up to 4 MB.
- Secondary contact photo: required when a secondary contact is provided, JPG, PNG, or WebP up to 4 MB.
- Organization photo: required on final submission, JPG, PNG, or WebP up to 6 MB.
- Organization logo: recommended high-resolution JPG, PNG, WebP, or SVG up to 10 MB.
- Activity example photos: up to 8 JPG, PNG, or WebP images, up to 6 MB each.

## Suggested Next Build Items

- Edit/update draft route.
- Reviewer dashboard and status changes.
- Email notification after submission.
- Request-more-information workflow.
- PDF export of submitted application.
