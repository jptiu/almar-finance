<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('leave_credits', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->string('leave_type');
            $table->integer('total_credits')->default(0);
            $table->integer('used_credits')->default(0);
            $table->integer('remaining_credits')->default(0);
            $table->date('effective_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leave_credits');
    }
};
