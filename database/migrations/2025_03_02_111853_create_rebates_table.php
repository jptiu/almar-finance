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
        Schema::create('rebates', function (Blueprint $table) {
            $table->id();
            $table->string('loan_id')->nullable();
            $table->string('rebate_amount')->nullable();
            $table->string('rebate_percent')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rebates');
    }
};
