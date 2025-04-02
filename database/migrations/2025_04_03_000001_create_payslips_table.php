<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->date('pay_period_start');
            $table->date('pay_period_end');
            $table->decimal('basic_salary', 12, 2);
            $table->decimal('total_hours', 5, 2);
            $table->decimal('overtime_hours', 5, 2)->default(0);
            $table->decimal('overtime_pay', 12, 2)->default(0);
            $table->decimal('allowances', 12, 2)->default(0);
            $table->decimal('deductions', 12, 2)->default(0);
            $table->decimal('net_pay', 12, 2);
            $table->string('status')->default('draft'); // draft, processed, paid
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes
            $table->unique(['employee_id', 'pay_period_start', 'pay_period_end']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payslips');
    }
};
