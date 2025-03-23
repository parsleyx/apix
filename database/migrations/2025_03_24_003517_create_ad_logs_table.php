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
        Schema::create('ad_logs', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'model')->nullable()->index('model');
            $table->string(column: 'os_version')->nullable()->index('os_version');
            $table->string('uuid')->nullable()->index('uuid');
            $table->unsignedBigInteger('channel_id')->nullable()->index('channel');
            $table->string('package_name')->nullable()->index('package_name');
            $table->string('ad_id')->nullable()->index('ad_id');
            $table->string('status')->nullable()->index('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ad_logs');
    }
};
