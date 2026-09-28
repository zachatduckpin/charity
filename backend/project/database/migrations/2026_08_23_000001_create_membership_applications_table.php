<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('membership_applications', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('submission_status', 20)->default('draft');

            $table->string('organization_name')->nullable();
            $table->string('acronym', 50)->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_position')->nullable();
            $table->string('primary_contact_name')->nullable();
            $table->string('secondary_contact_name')->nullable();
            $table->text('address')->nullable();
            $table->string('country')->nullable();
            $table->string('country_other')->nullable();
            $table->string('telephone')->nullable();
            $table->string('additional_phone_numbers')->nullable();
            $table->string('email')->nullable();
            $table->string('primary_contact_email')->nullable();
            $table->string('secondary_contact_email')->nullable();
            $table->string('website_url')->nullable();

            $table->unsignedSmallInteger('year_established')->nullable();
            $table->string('organization_structure_type')->nullable();
            $table->text('governance_structure')->nullable();
            $table->string('has_nonprofit_status', 10)->nullable();
            $table->string('has_formal_bylaws', 10)->nullable();
            $table->string('has_annual_report', 10)->nullable();
            $table->string('receives_government_funding', 10)->nullable();
            $table->string('is_ida_member', 10)->nullable();
            $table->decimal('annual_operating_budget_usd', 14, 2)->nullable();

            $table->string('is_membership_organization', 10)->nullable();
            $table->string('has_recruitment_material', 10)->nullable();
            $table->string('supports_branches_or_chapters', 10)->nullable();
            $table->unsignedInteger('current_member_count')->nullable();
            $table->decimal('annual_membership_dues_usd', 14, 2)->nullable();
            $table->text('membership_categories')->nullable();
            $table->text('branches_or_chapters_details')->nullable();

            $table->text('mission')->nullable();
            $table->string('offers_public_activities', 10)->nullable();
            $table->string('has_annual_conference', 10)->nullable();
            $table->text('public_activities_details')->nullable();
            $table->text('country_dyslexia_definition')->nullable();
            $table->string('supports_country_definition', 10)->nullable();
            $table->string('supports_instructional_approaches', 10)->nullable();
            $table->text('organization_dyslexia_definition')->nullable();
            $table->text('instructional_approaches_country')->nullable();
            $table->text('remediation_programs_country')->nullable();
            $table->text('advocated_approaches_programs')->nullable();

            $table->string('signature_name')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->string('client_ip', 64)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_applications');
    }
};
