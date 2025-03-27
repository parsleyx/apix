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
        Schema::create('check_logs', function (Blueprint $table) {
            $table->id();
            $table->string(column: 'model')->nullable()->index('model');
            $table->string(column:'os_version')->nullable()->index('os_version');
            $table->string('uuid')->nullable()->index('uuid');
            $table->text('permissions')->nullable();
            $table->unsignedBigInteger('channel_id')->nullable()->index('channel');
            $table->string('package_name')->nullable()->index('package_name');
            $table->enum('channel_status', ['on','off'])->default('on')->index('channel_status');
            $table->string('ad_id')->nullable()->index('ad_id');
            $table->enum('ad_status', ['on','off'])->default('on')->index('ad_status');
            $table->enum('model_status', ['on','off'])->default('on')->index('model_status');
            $table->enum('permission_status', ['on','off'])->default('on')->index('permission_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_logs');
    }
};
