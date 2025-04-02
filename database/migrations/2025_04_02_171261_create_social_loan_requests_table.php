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
        Schema::create('social_loan_requests', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('loan_type')->comment('SSS or PAGIBIG');
            $table->decimal('amount_requested', 12, 2);
            $table->text('purpose');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('remarks')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('rejected_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_loan_requests');
    }
};
