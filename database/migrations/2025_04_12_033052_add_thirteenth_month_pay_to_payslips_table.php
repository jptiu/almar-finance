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
        Schema::table('payslips', function (Blueprint $table) {
            $table->decimal('thirteenth_month_pay', 10, 2)->nullable()->default(0);
            $table->decimal('sil_value', 10, 2)->nullable()->default(0);
            $table->integer('remaining_sil_days')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payslips', function (Blueprint $table) {
            $table->dropColumn('thirteenth_month_pay');
            $table->dropColumn('sil_value');
            $table->dropColumn('remaining_sil_days');
        });
    }
};
