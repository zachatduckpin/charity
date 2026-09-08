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
    {if (Schema::hasTable('donations')) {
        return;
    }
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->integer('owner_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('total', 11);
            $table->double('tips', 11);
            $table->text('currency')->nullable();
            $table->string('status');
            $table->text('campaign_slug')->nullable();
            $table->string('payment_method');
            $table->string('txn_id');
            $table->integer('payment_status')->default(0);
            $table->timestamps();
        });}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
