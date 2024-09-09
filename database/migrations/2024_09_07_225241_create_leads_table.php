<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('link_id');
            $table->foreignUlid('campaign_id');
            $table->foreignUlid('platform_id');
            $table->string('ip')->nullable();
            $table->string('country')->nullable();
            $table->string('country_code')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('referer')->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
