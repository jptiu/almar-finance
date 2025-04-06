<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('daily_time_records', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->date('attendance_date');
            $table->timestamp('clock_in')->nullable();
            $table->timestamp('clock_out')->nullable();
            $table->decimal('working_hours', 5, 2)->default(0);
            $table->integer('late_minutes')->default(0);
            $table->integer('undertime_minutes')->default(0);
            $table->enum('status', ['present', 'late', 'absent'])->default('present');
            $table->decimal('deductions', 10, 2)->default(0);
            $table->decimal('net_amount', 10, 2)->default(0);
            $table->boolean('is_sunday')->default(false);
            $table->boolean('is_branch_meeting')->default(false);
            $table->timestamps();

            $table->unique(['employee_id', 'attendance_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_time_records');
    }
};
