<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('membership_application_attachments')) {
            Schema::table('membership_application_attachments', function (Blueprint $table) {
                $table->foreign('membership_application_id', 'maa_application_fk')
                    ->references('id')
                    ->on('membership_applications')
                    ->cascadeOnDelete();
            });

            return;
        }

        Schema::create('membership_application_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membership_application_id')
                ->constrained('membership_applications', indexName: 'maa_application_fk')
                ->cascadeOnDelete();
            $table->string('category', 120);
            $table->string('attachment_type', 20);
            $table->string('original_name');
            $table->string('stored_name');
            $table->string('relative_path');
            $table->string('mime_type')->nullable();
            $table->string('file_extension', 20)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('membership_application_attachments');
    }
};
