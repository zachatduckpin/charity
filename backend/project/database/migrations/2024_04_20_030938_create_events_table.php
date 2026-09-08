<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->string('time');
            $table->string('event_type');
            $table->string('event_link')->nullable();
            $table->string('event_location')->nullable();
            $table->string('organizar_name');
            $table->string('organizar_email')->nullable();
            $table->string('organizar_phone')->nullable();
            $table->text('map_link')->nullable();
            $table->text('description');
            $table->string('photo');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
