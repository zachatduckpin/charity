<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('global_network_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('status')->default('draft')->index();

            $table->string('organization_name')->nullable();
            $table->string('acronym')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('primary_contact_name')->nullable();
            $table->string('secondary_contact_name')->nullable();
            $table->string('contact_position')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('country_other')->nullable();
            $table->string('telephone')->nullable();
            $table->text('additional_phone_numbers')->nullable();
            $table->string('email')->nullable();
            $table->string('primary_contact_email')->nullable();
            $table->string('secondary_contact_email')->nullable();
            $table->string('website_url')->nullable();

            $table->unsignedSmallInteger('year_established')->nullable();
            $table->longText('governance_structure')->nullable();
            $table->string('organization_structure_type')->nullable();
            $table->boolean('has_nonprofit_status')->nullable();
            $table->boolean('has_formal_bylaws')->nullable();
            $table->decimal('annual_operating_budget_usd', 14, 2)->nullable();
            $table->boolean('has_annual_report')->nullable();
            $table->boolean('receives_government_funding')->nullable();
            $table->boolean('is_ida_member')->nullable();

            $table->boolean('is_membership_organization')->nullable();
            $table->unsignedInteger('current_member_count')->nullable();
            $table->text('membership_categories')->nullable();
            $table->decimal('annual_membership_dues_usd', 10, 2)->nullable();
            $table->boolean('has_recruitment_material')->nullable();
            $table->boolean('supports_branches_or_chapters')->nullable();
            $table->longText('branches_or_chapters_details')->nullable();

            $table->longText('mission')->nullable();
            $table->boolean('offers_public_activities')->nullable();
            $table->longText('public_activities_details')->nullable();
            $table->boolean('has_annual_conference')->nullable();

            $table->longText('country_dyslexia_definition')->nullable();
            $table->boolean('supports_country_definition')->nullable();
            $table->longText('organization_dyslexia_definition')->nullable();
            $table->longText('instructional_approaches_country')->nullable();
            $table->longText('remediation_programs_country')->nullable();
            $table->boolean('supports_instructional_approaches')->nullable();
            $table->longText('advocated_approaches_programs')->nullable();

            $table->string('signature_name')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->json('review_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_network_applications');
    }
};
