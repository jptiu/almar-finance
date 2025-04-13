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
        Schema::create('contribution_reports', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('sss_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->decimal('sss_employee_contribution', 10, 2)->default(0);
            $table->decimal('sss_employer_contribution', 10, 2)->default(0);
            $table->decimal('philhealth_employee_contribution', 10, 2)->default(0);
            $table->decimal('philhealth_employer_contribution', 10, 2)->default(0);
            $table->decimal('pagibig_employee_contribution', 10, 2)->default(0);
            $table->decimal('pagibig_employer_contribution', 10, 2)->default(0);
            $table->decimal('total_employee_contribution', 10, 2)->default(0);
            $table->decimal('total_employer_contribution', 10, 2)->default(0);
            $table->decimal('total_contribution', 10, 2)->default(0);
            $table->date('report_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contribution_reports');
    }
};
