<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->boolean('is_sunday')->default(false);
            $table->boolean('is_branch_meeting')->default(false);
            $table->integer('late_minutes')->default(0);
            $table->integer('undertime_minutes')->default(0);
            $table->decimal('daily_rate', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn([
                'is_sunday',
                'is_branch_meeting',
                'late_minutes',
                'undertime_minutes',
                'daily_rate'
            ]);
        });
    }
};
