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
        Schema::table('employee_onboardings', function (Blueprint $table) {
            $table->text('performance_metrics')->nullable()->after('probation_status');
            $table->text('training_requirements')->nullable()->after('performance_metrics');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_onboardings', function (Blueprint $table) {
            $table->dropColumn(['performance_metrics', 'training_requirements']);
        });
    }
};
