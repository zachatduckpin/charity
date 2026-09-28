<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dashboard_member_profiles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('slug')->unique();
            $table->string('organization_name');
            $table->string('membership_level', 40)->nullable();
            $table->string('country', 120)->nullable();
            $table->string('region', 120)->nullable();
            $table->string('primary_contact_name', 160)->nullable();
            $table->string('primary_contact_role', 200)->nullable();
            $table->string('email', 190)->nullable();
            $table->string('website_url', 255)->nullable();
            $table->text('summary')->nullable();
            $table->string('status', 40)->default('active');
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dashboard_member_profiles');
    }
};
