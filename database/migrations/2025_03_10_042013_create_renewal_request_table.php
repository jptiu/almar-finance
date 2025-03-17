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
        Schema::create('renewal_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id');
            $table->unsignedBigInteger('branch_id');
            $table->unsignedBigInteger('customer_id');
            $table->decimal('previous_balance', 15, 2);
            $table->string('month');
            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewal_request');
    }
};
