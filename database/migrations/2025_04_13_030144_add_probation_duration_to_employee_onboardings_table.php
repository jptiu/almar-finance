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
            $table->integer('probation_duration')->nullable()->after('probation_end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_onboardings', function (Blueprint $table) {
            $table->dropColumn('probation_duration');
        });
    }
};
