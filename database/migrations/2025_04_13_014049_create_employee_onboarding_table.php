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
        Schema::create('employee_onboardings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->date('probation_start_date')->nullable();
            $table->date('probation_end_date')->nullable();
            $table->date('regularization_date')->nullable();
            $table->text('probation_evaluation')->nullable();
            $table->text('regularization_notes')->nullable();
            $table->enum('probation_status', ['pending', 'completed', 'extended', 'failed'])->default('pending');
            $table->boolean('is_regularized')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_onboarding');
    }
};
