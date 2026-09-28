<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('global_network_application_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('global_network_application_id')
                ->constrained('global_network_applications')
                ->cascadeOnDelete();
            $table->string('document_type')->index();
            $table->string('original_name');
            $table->string('path');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('global_network_application_documents');
    }
};

