<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dashboard_member_profiles', function (Blueprint $table): void {
            $table->string('profile_type', 40)->default('member')->after('user_id');
            $table->string('level_label', 120)->nullable()->after('membership_level');
            $table->string('flag_emoji', 16)->nullable()->after('region');
            $table->string('hero_asset_path', 255)->nullable()->after('flag_emoji');
            $table->string('hero_asset_alt', 255)->nullable()->after('hero_asset_path');
            $table->string('hero_asset_mode', 40)->nullable()->after('hero_asset_alt');
            $table->boolean('is_wide_logo')->default(false)->after('hero_asset_mode');
            $table->string('profile_heading', 160)->nullable()->after('website_url');
            $table->string('profile_subheading', 255)->nullable()->after('profile_heading');
            $table->string('record_title', 255)->nullable()->after('profile_subheading');
            $table->text('record_summary')->nullable()->after('record_title');
            $table->string('organization_logo_path', 255)->nullable()->after('record_summary');
            $table->string('representative_name', 160)->nullable()->after('organization_logo_path');
            $table->string('representative_role', 255)->nullable()->after('representative_name');
            $table->string('representative_image_path', 255)->nullable()->after('representative_role');
            $table->text('leader_bio')->nullable()->after('representative_image_path');
            $table->text('organization_profile')->nullable()->after('leader_bio');
            $table->string('impact_title', 255)->nullable()->after('organization_profile');
            $table->json('impact_metrics')->nullable()->after('impact_title');
            $table->json('profile_links')->nullable()->after('impact_metrics');
        });
    }

    public function down(): void
    {
        Schema::table('dashboard_member_profiles', function (Blueprint $table): void {
            $table->dropColumn([
                'profile_type',
                'level_label',
                'flag_emoji',
                'hero_asset_path',
                'hero_asset_alt',
                'hero_asset_mode',
                'is_wide_logo',
                'profile_heading',
                'profile_subheading',
                'record_title',
                'record_summary',
                'organization_logo_path',
                'representative_name',
                'representative_role',
                'representative_image_path',
                'leader_bio',
                'organization_profile',
                'impact_title',
                'impact_metrics',
                'profile_links',
            ]);
        });
    }
};
