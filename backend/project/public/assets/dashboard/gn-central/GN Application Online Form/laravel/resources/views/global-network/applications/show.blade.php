<x-app-layout>
    <div class="gn-shell">
        <div class="gn-container">
            <header class="gn-header">
                <div>
                    <p class="gn-kicker">IDA Global Network Program</p>
                    <h1 class="gn-title">{{ $application->organization_name ?: 'Global Network Application Draft' }}</h1>
                    <p class="gn-intro">Application status: {{ str_replace('_', ' ', ucfirst($application->status)) }}</p>
                </div>
            </header>

            <div class="gn-card gn-section is-active">
                <h2>Application received</h2>
                <p class="gn-section-note">
                    {{ $application->submitted_at ? 'Submitted by ' . ($application->contact_name ?: 'Applicant') . ' on ' . $application->submitted_at->format('F j, Y') : 'Draft saved. You can return to complete and submit it later.' }}
                </p>
                @if ($application->status === \App\Models\GlobalNetworkApplication::STATUS_DRAFT)
                    <p class="gn-section-note">
                        This application is saved as a draft. <a href="{{ route('global-network.applications.edit', $application) }}">Continue and finish the application</a>.
                    </p>
                @endif

                <div class="gn-grid">
                    <div class="gn-field">
                        <span class="gn-label">General email</span>
                        <span>{{ $application->email ?: 'Not provided' }}</span>
                    </div>
                    <div class="gn-field">
                        <span class="gn-label">Primary contact email</span>
                        <span>{{ $application->primary_contact_email ?: $application->email }}</span>
                    </div>
                    <div class="gn-field">
                        <span class="gn-label">Secondary contact email</span>
                        <span>{{ $application->secondary_contact_email ?: 'Not provided' }}</span>
                    </div>
                    <div class="gn-field">
                        <span class="gn-label">Primary contact</span>
                        <span>{{ $application->primary_contact_name ?: $application->contact_name }}</span>
                    </div>
                    <div class="gn-field">
                        <span class="gn-label">Secondary contact</span>
                        <span>{{ $application->secondary_contact_name ?: 'Not provided' }}</span>
                    </div>
                    <div class="gn-field">
                        <span class="gn-label">Country</span>
                        <span>{{ $application->country === 'Other' ? $application->country_other : ($application->country ?: 'Not provided') }}</span>
                    </div>
                    <div class="gn-field gn-field--full">
                        <span class="gn-label">Additional phone numbers</span>
                        <span>{{ $application->additional_phone_numbers ?: 'Not provided' }}</span>
                    </div>
                    <div class="gn-field gn-field--full">
                        <span class="gn-label">Documents</span>
                        <span>{{ $application->documents->count() }} uploaded document(s)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
