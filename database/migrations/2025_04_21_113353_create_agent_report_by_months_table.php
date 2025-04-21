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
        Schema::create('agent_report_by_months', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id')->index('package')->comment('包名');
            $table->timestamp('started_at')->index('started_at')->index('开始时间');
            $table->timestamp('ended_at')->index('ended_at')->index('结束时间');
            $table->integer('show')->comment('展示次数');
            $table->decimal('money')->comment('收益');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_report_by_months');
    }
};
