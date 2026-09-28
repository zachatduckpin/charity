<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dashboard_member_profiles', function (Blueprint $table): void {
            $table->string('phone', 80)->nullable()->after('primary_contact_role');
            $table->json('social_links')->nullable()->after('impact_metrics');
            $table->string('directory_card_title', 255)->nullable()->after('profile_links');
            $table->string('directory_location', 255)->nullable()->after('directory_card_title');
            $table->string('directory_address', 255)->nullable()->after('directory_location');
            $table->text('directory_description')->nullable()->after('directory_address');
            $table->string('directory_image_path', 255)->nullable()->after('directory_description');
            $table->string('directory_image_alt', 255)->nullable()->after('directory_image_path');
            $table->string('region_code', 12)->nullable()->after('directory_image_alt');
            $table->decimal('latitude', 10, 6)->nullable()->after('region_code');
            $table->decimal('longitude', 10, 6)->nullable()->after('latitude');
            $table->unsignedSmallInteger('map_zoom')->nullable()->after('longitude');
            $table->unsignedInteger('highlight_radius')->nullable()->after('map_zoom');
        });
    }

    public function down(): void
    {
        Schema::table('dashboard_member_profiles', function (Blueprint $table): void {
            $table->dropColumn([
                'phone',
                'social_links',
                'directory_card_title',
                'directory_location',
                'directory_address',
                'directory_description',
                'directory_image_path',
                'directory_image_alt',
                'region_code',
                'latitude',
                'longitude',
                'map_zoom',
                'highlight_radius',
            ]);
        });
    }
};
