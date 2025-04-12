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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('employment_status', ['active', 'inactive'])->default('active');
            $table->enum('employment_type', ['probation', 'regular'])->default('probation');
            $table->timestamp('employment_status_updated_at')->nullable();
            $table->timestamp('employment_type_updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['employment_status', 'employment_type', 'employment_status_updated_at', 'employment_type_updated_at']);
        });
    }
};
