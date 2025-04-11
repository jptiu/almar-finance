<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_incentive_logs', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id');
            $table->date('date_taken');
            $table->integer('days_taken');
            $table->decimal('amount_paid', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('service_incentive_logs');
    }
};
