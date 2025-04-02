<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('performance_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->date('evaluation_date');
            $table->string('evaluation_period');
            $table->decimal('overall_rating', 3, 1); // 0.0 to 5.0
            $table->text('strengths');
            $table->text('areas_for_improvement');
            $table->text('goals');
            $table->text('manager_comments');
            $table->text('employee_comments')->nullable();
            $table->string('evaluated_by');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_evaluations');
    }
};
