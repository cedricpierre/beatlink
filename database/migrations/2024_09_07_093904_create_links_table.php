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
        Schema::create('links', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('url');
            $table->string('name');
            $table->foreignUlid('campaign_id');
            $table->string('title')->nullable();
            $table->string('type');
            $table->foreignUlid('platform_id');
            $table->unsignedBigInteger('leads_count')->default(0);
            $table->timestamps();
            $table->unique(['campaign_id', 'platform_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
