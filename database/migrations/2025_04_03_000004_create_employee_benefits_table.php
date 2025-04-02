<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_benefits', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('benefit_type'); // health_insurance, dental, vision, etc.
            $table->decimal('amount', 12, 2)->nullable();
            $table->date('effective_date');
            $table->date('expiration_date')->nullable();
            $table->text('description');
            $table->enum('status', ['active', 'expired', 'cancelled'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_benefits');
    }
};
