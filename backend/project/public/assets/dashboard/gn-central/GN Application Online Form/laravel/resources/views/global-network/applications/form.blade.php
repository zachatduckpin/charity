@php
    $yesNo = [
        '1' => 'Yes',
        '0' => 'No',
    ];

    $steps = [
        'Welcome',
        'Contact',
        'Organization',
        'Members',
        'Mission & Practice',
        'Documents',
        'Review',
    ];

    $countries = config('global-network-countries', []);
@endphp

<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/global-network-application.css') }}">
    @endpush

    <div class="gn-shell">
        <div class="gn-container">
            <form class="gn-form-layout is-welcome-step" method="POST" action="{{ $application->exists ? route('global-network.applications.update', $application) : route('global-network.applications.store') }}" enctype="multipart/form-data" data-gn-application-form>
                @csrf
                @if ($application->exists)
                    @method('PUT')
                @endif
                <aside class="gn-stepper" aria-label="Application sections">
                    @foreach ($steps as $index => $step)
                        @if ($index > 0)
                            <button type="button" class="gn-step" data-step-target="{{ $index }}" aria-current="false">
                                <span class="gn-step-number">{{ $index }}</span>
                                <span>{{ $step }}</span>
                            </button>
                        @endif
                    @endforeach
                </aside>

                <main class="gn-card">
                    <div class="gn-progress" aria-live="polite">
                        <div>
                            <span class="gn-progress-label" data-progress-step>Step 1 of {{ count($steps) - 1 }}</span>
                            <strong data-progress-percent>17% complete</strong>
                        </div>
                        <div class="gn-progress-track" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="17" data-progress-bar>
                            <span style="width: 17%"></span>
                        </div>
                        <p class="gn-progress-help">Use Save draft at any step to keep your work and return later to finish.</p>
                    </div>

                    <section class="gn-section gn-section--welcome is-active" data-step-panel="0">
                        <img src="{{ asset('images/ida-global-network-logo.png') }}" alt="The International Dyslexia Association Global Network logo" class="gn-welcome-logo">
                        <h1 class="gn-title">Welcome to IDA Global Network Central</h1>
                        <p>
                            IDA Global Network Central is the online home of the International Dyslexia Association's Global Network. Through this platform, prospective and current members can apply for membership, connect with colleagues worldwide, share initiatives, access resources, participate in collaborative projects, and contribute to the advancement of dyslexia advocacy and evidence-based practice. We are pleased to welcome you to a growing international community working together to create meaningful impact across diverse regions and cultures.
                        </p>
                    </section>

                    <section class="gn-section" data-step-panel="1">
                        <h2>Association contact information</h2>
                        <p class="gn-section-note">Tell the IDA Home Office who is applying and who should be contacted about this application.</p>

                        <div class="gn-grid">
                            <label class="gn-field">
                                <span class="gn-label">Organization name</span>
                                <input class="gn-input" name="organization_name" value="{{ old('organization_name', $application->organization_name) }}" required>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Acronym</span>
                                <input class="gn-input" name="acronym" value="{{ old('acronym', $application->acronym) }}">
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Contact name</span>
                                <input class="gn-input" name="contact_name" value="{{ old('contact_name', $application->contact_name) }}" required>
                                <p class="gn-help">The person completing this application.</p>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Contact position</span>
                                <input class="gn-input" name="contact_position" value="{{ old('contact_position', $application->contact_position) }}">
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Primary contact name</span>
                                <input class="gn-input" name="primary_contact_name" value="{{ old('primary_contact_name', $application->primary_contact_name) }}" required>
                                <p class="gn-help">Main person IDA should contact. This can be changed later.</p>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Secondary contact name</span>
                                <input class="gn-input" name="secondary_contact_name" value="{{ old('secondary_contact_name', $application->secondary_contact_name) }}">
                                <p class="gn-help">Backup contact for continuity. This can be changed later.</p>
                            </label>

                            <label class="gn-field gn-field--full">
                                <span class="gn-label">Address</span>
                                <textarea class="gn-textarea" name="address" required>{{ old('address', $application->address) }}</textarea>
                                <p class="gn-help">Include street address, city, state or region, and postal code.</p>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Country</span>
                                <select class="gn-select" name="country" required data-country-select>
                                    <option value="">Select country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country }}" @selected(old('country', $application->country) === $country)>{{ $country }}</option>
                                    @endforeach
                                    <option value="Other" @selected(old('country', $application->country) === 'Other')>Other</option>
                                </select>
                            </label>

                            <label class="gn-field" data-country-other-field hidden>
                                <span class="gn-label">If Other, please specify</span>
                                <input class="gn-input" name="country_other" value="{{ old('country_other', $application->country_other) }}">
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Telephone</span>
                                <input class="gn-input" name="telephone" value="{{ old('telephone', $application->telephone) }}" placeholder="+1 410 296 0232" required>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Additional phone numbers</span>
                                <input class="gn-input" name="additional_phone_numbers" value="{{ old('additional_phone_numbers', $application->additional_phone_numbers) }}" placeholder="Mobile, WhatsApp, or alternate office number">
                                <p class="gn-help">Optional. Add extra numbers with country code.</p>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">General email</span>
                                <input class="gn-input" type="email" name="email" value="{{ old('email', $application->email) }}" required>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Primary contact email</span>
                                <input class="gn-input" type="email" name="primary_contact_email" value="{{ old('primary_contact_email', $application->primary_contact_email) }}" required data-primary-email>
                                <p class="gn-help">Main email IDA should use. This can be changed later.</p>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Secondary contact email</span>
                                <input class="gn-input" type="email" name="secondary_contact_email" value="{{ old('secondary_contact_email', $application->secondary_contact_email) }}" data-secondary-email>
                                <label class="gn-inline-option">
                                    <input type="checkbox" data-secondary-same-email @checked(old('secondary_contact_email', $application->secondary_contact_email) && old('secondary_contact_email', $application->secondary_contact_email) === old('primary_contact_email', $application->primary_contact_email))>
                                    Same as primary contact email
                                </label>
                                <p class="gn-help">Backup email for continuity. This can be changed later.</p>
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Website URL</span>
                                <input class="gn-input" type="url" name="website_url" value="{{ old('website_url', $application->website_url) }}" placeholder="https://">
                            </label>
                        </div>
                    </section>

                    <section class="gn-section" data-step-panel="2">
                        <h2>Organization profile</h2>
                        <p class="gn-section-note">Describe the legal, governance, and financial structure of the organization.</p>

                        <div class="gn-grid">
                            <label class="gn-field">
                                <span class="gn-label">Year established</span>
                                <input class="gn-input" type="number" name="year_established" min="1800" max="{{ now()->year }}" value="{{ old('year_established', $application->year_established) }}">
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Organization structure type</span>
                                <select class="gn-select" name="organization_structure_type">
                                    <option value="">Select one</option>
                                    <option value="ngo">NGO</option>
                                    <option value="non_profit">Non-profit</option>
                                    <option value="charity">Charity</option>
                                    <option value="other">Other</option>
                                </select>
                            </label>

                            <label class="gn-field gn-field--full">
                                <span class="gn-label">Governance structure</span>
                                <textarea class="gn-textarea" name="governance_structure">{{ old('governance_structure', $application->governance_structure) }}</textarea>
                                <p class="gn-help">Include board, executive director, committees, and other governance roles.</p>
                            </label>

                            @foreach ([
                                'has_nonprofit_status' => 'Do you have NGO, non-profit, or charity status?',
                                'has_formal_bylaws' => 'Does your association have formal bylaws?',
                                'has_annual_report' => 'Do you produce an annual operating or financial report?',
                                'receives_government_funding' => 'Do you receive government or state funding?',
                                'is_ida_member' => 'Is your organization a member of IDA?',
                            ] as $name => $label)
                                <fieldset class="gn-field">
                                    <legend class="gn-label">{{ $label }}</legend>
                                    <div class="gn-choice-row">
                                        @foreach ($yesNo as $value => $text)
                                            <label class="gn-choice">
                                                <input type="radio" name="{{ $name }}" value="{{ $value }}" @checked((string) old($name, $application->{$name} === null ? null : (int) $application->{$name}) === $value)>
                                                {{ $text }}
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endforeach

                            <label class="gn-field">
                                <span class="gn-label">Estimated annual operating budget (USD)</span>
                                <input class="gn-input" type="number" step="0.01" min="0" name="annual_operating_budget_usd" value="{{ old('annual_operating_budget_usd', $application->annual_operating_budget_usd) }}">
                            </label>
                        </div>
                    </section>

                    <section class="gn-section" data-step-panel="3">
                        <h2>Members and branches</h2>
                        <p class="gn-section-note">Capture the current membership model and any local branches or chapters.</p>

                        <div class="gn-grid">
                            @foreach ([
                                'is_membership_organization' => 'Are you a membership organization?',
                                'has_recruitment_material' => 'Do you print promotional or member recruitment material?',
                                'supports_branches_or_chapters' => 'Does your organization support local branches or chapters?',
                            ] as $name => $label)
                                <fieldset class="gn-field">
                                    <legend class="gn-label">{{ $label }}</legend>
                                    <div class="gn-choice-row">
                                        @foreach ($yesNo as $value => $text)
                                            <label class="gn-choice">
                                                <input type="radio" name="{{ $name }}" value="{{ $value }}" @checked((string) old($name, $application->{$name} === null ? null : (int) $application->{$name}) === $value)>
                                                {{ $text }}
                                            </label>
                                        @endforeach
                                    </div>
                                </fieldset>
                            @endforeach

                            <label class="gn-field">
                                <span class="gn-label">Current members</span>
                                <input class="gn-input" type="number" min="0" name="current_member_count" value="{{ old('current_member_count', $application->current_member_count) }}">
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Annual membership dues (USD)</span>
                                <input class="gn-input" type="number" step="0.01" min="0" name="annual_membership_dues_usd" value="{{ old('annual_membership_dues_usd', $application->annual_membership_dues_usd) }}">
                            </label>

                            <label class="gn-field gn-field--full">
                                <span class="gn-label">Membership categories</span>
                                <textarea class="gn-textarea" name="membership_categories">{{ old('membership_categories', $application->membership_categories) }}</textarea>
                                <p class="gn-help">Examples: individual, family, school, professional, student.</p>
                            </label>

                            <label class="gn-field gn-field--full">
                                <span class="gn-label">Branches or chapters details</span>
                                <textarea class="gn-textarea" name="branches_or_chapters_details">{{ old('branches_or_chapters_details', $application->branches_or_chapters_details) }}</textarea>
                            </label>
                        </div>
                    </section>

                    <section class="gn-section" data-step-panel="4">
                        <h2>Mission, activities, and practice context</h2>
                        <p class="gn-section-note">Describe the purpose of the organization, how it serves the community, and the dyslexia practice context in the applicant's country.</p>

                        <div class="gn-subsection-stack">
                            <div class="gn-subsection">
                                <h3>Mission and activities</h3>
                                <div class="gn-grid">
                                    <label class="gn-field gn-field--full">
                                        <span class="gn-label">Mission</span>
                                        <textarea class="gn-textarea" name="mission">{{ old('mission', $application->mission) }}</textarea>
                                    </label>

                                    <fieldset class="gn-field">
                                        <legend class="gn-label">Do you offer public activities to the community?</legend>
                                        <div class="gn-choice-row">
                                            @foreach ($yesNo as $value => $text)
                                                <label class="gn-choice">
                                                    <input type="radio" name="offers_public_activities" value="{{ $value }}" @checked((string) old('offers_public_activities', $application->offers_public_activities === null ? null : (int) $application->offers_public_activities) === $value)>
                                                    {{ $text }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </fieldset>

                                    <fieldset class="gn-field">
                                        <legend class="gn-label">Do you have an annual conference?</legend>
                                        <div class="gn-choice-row">
                                            @foreach ($yesNo as $value => $text)
                                                <label class="gn-choice">
                                                    <input type="radio" name="has_annual_conference" value="{{ $value }}" @checked((string) old('has_annual_conference', $application->has_annual_conference === null ? null : (int) $application->has_annual_conference) === $value)>
                                                    {{ $text }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </fieldset>

                                    <label class="gn-field gn-field--full">
                                        <span class="gn-label">Typical public activities</span>
                                        <textarea class="gn-textarea" name="public_activities_details">{{ old('public_activities_details', $application->public_activities_details) }}</textarea>
                                    </label>
                                </div>
                            </div>

                            <div class="gn-subsection">
                                <h3>Practice context</h3>
                                <div class="gn-grid">
                                    <label class="gn-field gn-field--full">
                                        <span class="gn-label">Country definition of dyslexia</span>
                                        <textarea class="gn-textarea" name="country_dyslexia_definition">{{ old('country_dyslexia_definition', $application->country_dyslexia_definition) }}</textarea>
                                        <p class="gn-help">Include who formulated the definition.</p>
                                    </label>

                                    <fieldset class="gn-field gn-field--full">
                                        <legend class="gn-label">Does your organization support this definition?</legend>
                                        <div class="gn-choice-row">
                                            @foreach ($yesNo as $value => $text)
                                                <label class="gn-choice">
                                                    <input type="radio" name="supports_country_definition" value="{{ $value }}" @checked((string) old('supports_country_definition', $application->supports_country_definition === null ? null : (int) $application->supports_country_definition) === $value)>
                                                    {{ $text }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </fieldset>

                                    <label class="gn-field gn-field--full">
                                        <span class="gn-label">Organization definition, if different</span>
                                        <textarea class="gn-textarea" name="organization_dyslexia_definition">{{ old('organization_dyslexia_definition', $application->organization_dyslexia_definition) }}</textarea>
                                    </label>

                                    <label class="gn-field gn-field--full">
                                        <span class="gn-label">Instructional approaches used in your country</span>
                                        <textarea class="gn-textarea" name="instructional_approaches_country">{{ old('instructional_approaches_country', $application->instructional_approaches_country) }}</textarea>
                                    </label>

                                    <label class="gn-field gn-field--full">
                                        <span class="gn-label">Remediation programs used in your country</span>
                                        <textarea class="gn-textarea" name="remediation_programs_country">{{ old('remediation_programs_country', $application->remediation_programs_country) }}</textarea>
                                    </label>

                                    <fieldset class="gn-field gn-field--full">
                                        <legend class="gn-label">Does your organization support these approaches and programs?</legend>
                                        <div class="gn-choice-row">
                                            @foreach ($yesNo as $value => $text)
                                                <label class="gn-choice">
                                                    <input type="radio" name="supports_instructional_approaches" value="{{ $value }}" @checked((string) old('supports_instructional_approaches', $application->supports_instructional_approaches === null ? null : (int) $application->supports_instructional_approaches) === $value)>
                                                    {{ $text }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </fieldset>

                                    <label class="gn-field gn-field--full">
                                        <span class="gn-label">Specific approaches or programs your organization advocates</span>
                                        <textarea class="gn-textarea" name="advocated_approaches_programs">{{ old('advocated_approaches_programs', $application->advocated_approaches_programs) }}</textarea>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="gn-section" data-step-panel="5">
                        <h2>Supporting documents</h2>
                        <p class="gn-section-note">Upload one or more documents in any category, plus photos of the applicant contacts and the organization.</p>

                        <div class="gn-document-list">
                            <h3 class="gn-upload-heading">Required and supporting files</h3>
                            @foreach ([
                                'nonprofit_status' => ['NGO/non-profit/charity status', 'Required if the organization has formal status. You may upload multiple files, up to 10 MB each.'],
                                'bylaws' => ['Formal bylaws', 'Required if the association has bylaws. You may upload multiple files, up to 10 MB each.'],
                                'annual_report' => ['Annual operating or financial report', 'Recommended if available. You may upload multiple files, up to 10 MB each.'],
                                'recruitment_material' => ['Promotional or recruitment material sample', 'Required if recruitment material is produced. You may upload multiple files, up to 10 MB each.'],
                                'additional_context' => ['Additional context pages', 'Mission, definition, instructional approaches, or other supporting information. You may upload multiple files, up to 10 MB each.'],
                            ] as $name => [$title, $help])
                                <label class="gn-document">
                                    <span>
                                        <strong>{{ $title }}</strong>
                                        <span class="gn-help">{{ $help }}</span>
                                    </span>
                                    <input class="gn-input" type="file" name="documents[{{ $name }}][]" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple>
                                </label>
                            @endforeach

                            <h3 class="gn-upload-heading">Photos and images</h3>
                            @foreach ([
                                'applicant_contact' => ['Applicant / person completing this form photo', 'Please upload a clear photo or headshot of the person completing the application. JPG, PNG, or WebP up to 4 MB.'],
                                'primary_contact' => ['Primary contact photo', 'Please upload a clear photo or headshot of the primary contact. JPG, PNG, or WebP up to 4 MB.'],
                                'secondary_contact' => ['Secondary contact photo', 'Optional clear photo or headshot of the secondary contact. JPG, PNG, or WebP up to 4 MB.'],
                                'organization' => ['Organization photo', 'Please upload a photo of the organization, office, centre, school, or main location. JPG, PNG, or WebP up to 6 MB.'],
                            ] as $name => [$title, $help])
                                <label class="gn-document">
                                    <span>
                                        <strong>{{ $title }}</strong>
                                        <span class="gn-help">{{ $help }}</span>
                                    </span>
                                    <input class="gn-input" type="file" name="photos[{{ $name }}]" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                </label>
                            @endforeach

                            <label class="gn-document">
                                <span>
                                    <strong>Organization logo, high resolution</strong>
                                    <span class="gn-help">Recommended for profile pages, certificates, and IDA review materials. Upload JPG, PNG, WebP, or SVG up to 10 MB.</span>
                                </span>
                                <input class="gn-input" type="file" name="photos[organization_logo]" accept=".jpg,.jpeg,.png,.webp,.svg,image/jpeg,image/png,image/webp,image/svg+xml">
                            </label>

                            <label class="gn-document">
                                <span>
                                    <strong>Additional activity photos</strong>
                                    <span class="gn-help">Optional examples of activities, schools, assessment centres, events, training, or community work. Upload up to 8 images, each up to 6 MB.</span>
                                </span>
                                <input class="gn-input" type="file" name="photos[activity_examples][]" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp" multiple>
                            </label>

                            <label class="gn-document">
                                <span>
                                    <strong>Add additional files</strong>
                                    <span class="gn-help">Optional. Upload any other relevant files that do not fit the categories above, up to 10 MB each.</span>
                                </span>
                                <input class="gn-input" type="file" name="documents[additional_files][]" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple>
                            </label>
                        </div>
                    </section>

                    <section class="gn-section" data-step-panel="6">
                        <h2>Review and signature</h2>
                        <p class="gn-section-note">The organization acknowledges that acceptance into the Global Network Program and final participation level are subject to IDA approval.</p>

                        <div class="gn-grid">
                            <label class="gn-field">
                                <span class="gn-label">Signature of contact</span>
                                <input class="gn-input" name="signature_name" value="{{ old('signature_name', $application->signature_name) }}" placeholder="Type full name">
                            </label>

                            <label class="gn-field">
                                <span class="gn-label">Date</span>
                                <input class="gn-input" value="{{ now()->format('F j, Y') }}" disabled>
                            </label>
                        </div>
                    </section>

                    <div class="gn-actions">
                        <button class="gn-button" type="button" data-prev-step disabled>Back</button>
                        <div>
                            <button class="gn-button" type="submit" name="intent" value="draft" data-draft-button>Save draft and finish later</button>
                            <button class="gn-button gn-button--primary" type="button" data-next-step>Start application</button>
                            <button class="gn-button gn-button--submit" type="submit" name="intent" value="submit" hidden>Submit application</button>
                        </div>
                    </div>
                </main>
            </form>
        </div>
    </div>

    <script>
        (() => {
            const form = document.querySelector('[data-gn-application-form]');
            if (!form) return;

            const panels = [...form.querySelectorAll('[data-step-panel]')];
            const steps = [...form.querySelectorAll('[data-step-target]')];
            const previous = form.querySelector('[data-prev-step]');
            const next = form.querySelector('[data-next-step]');
            const submit = form.querySelector('[value="submit"]');
            const draft = form.querySelector('[data-draft-button]');
            const countrySelect = form.querySelector('[data-country-select]');
            const countryOtherField = form.querySelector('[data-country-other-field]');
            const primaryEmail = form.querySelector('[data-primary-email]');
            const secondaryEmail = form.querySelector('[data-secondary-email]');
            const secondarySameEmail = form.querySelector('[data-secondary-same-email]');
            const progressStep = form.querySelector('[data-progress-step]');
            const progressPercent = form.querySelector('[data-progress-percent]');
            const progressBar = form.querySelector('[data-progress-bar]');
            const progressFill = progressBar?.querySelector('span');
            let current = 0;

            const showStep = (index) => {
                current = Math.max(0, Math.min(index, panels.length - 1));
                const formStep = Math.max(current, 1);
                const formStepCount = Math.max(panels.length - 1, 1);
                const percent = Math.round((formStep / formStepCount) * 100);
                form.classList.toggle('is-welcome-step', current === 0);
                panels.forEach((panel, panelIndex) => panel.classList.toggle('is-active', panelIndex === current));
                steps.forEach((step, stepIndex) => step.setAttribute('aria-current', stepIndex === current ? 'step' : 'false'));
                previous.disabled = current === 0;
                previous.hidden = current === 0;
                if (draft) draft.hidden = current === 0;
                if (next) next.textContent = current === 0 ? 'Start application' : 'Next';
                next.hidden = current === panels.length - 1;
                submit.hidden = current !== panels.length - 1;
                if (progressStep) progressStep.textContent = `Step ${formStep} of ${formStepCount}`;
                if (progressPercent) progressPercent.textContent = `${percent}% complete`;
                if (progressBar) progressBar.setAttribute('aria-valuenow', String(percent));
                if (progressFill) progressFill.style.width = `${percent}%`;
                window.scrollTo({ top: form.offsetTop - 24, behavior: 'smooth' });
            };

            steps.forEach((step) => step.addEventListener('click', () => showStep(Number(step.dataset.stepTarget))));
            previous.addEventListener('click', () => showStep(current - 1));
            next.addEventListener('click', () => showStep(current + 1));

            const syncCountryOther = () => {
                if (!countrySelect || !countryOtherField) return;
                countryOtherField.hidden = countrySelect.value !== 'Other';
            };

            countrySelect?.addEventListener('change', syncCountryOther);
            syncCountryOther();

            const syncSecondaryEmail = () => {
                if (!primaryEmail || !secondaryEmail || !secondarySameEmail || !secondarySameEmail.checked) return;
                secondaryEmail.value = primaryEmail.value;
            };

            secondarySameEmail?.addEventListener('change', () => {
                secondaryEmail.readOnly = secondarySameEmail.checked;
                syncSecondaryEmail();
            });
            primaryEmail?.addEventListener('input', syncSecondaryEmail);
            if (secondaryEmail && secondarySameEmail) {
                secondaryEmail.readOnly = secondarySameEmail.checked;
            }
            syncSecondaryEmail();
            showStep(0);
        })();
    </script>
</x-app-layout>
