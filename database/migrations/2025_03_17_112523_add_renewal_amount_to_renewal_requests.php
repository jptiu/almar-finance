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
        Schema::table('renewal_requests', function (Blueprint $table) {
            $table->decimal('requested_renewal_amount', 15, 2);
            $table->decimal('renewed_amount', 15, 2)->nullable();
            $table->string('renewal_tenure')->nullable();
            $table->decimal('renewal_interest_rate', 15, 2)->nullable();
            $table->string('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('renewal_requests', function (Blueprint $table) {
            //
        });
    }
};
