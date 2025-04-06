<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->decimal('basic_salary', 10, 2);
            $table->decimal('daily_rate', 10, 2);
            $table->date('effective_date');
            $table->string('status')->default('active'); // active, inactive
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Add index for faster queries
            $table->index(['employee_id', 'status', 'effective_date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_salaries');
    }
};
