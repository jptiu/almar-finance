<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('concern_letters', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('type')->comment('warning, suspension, termination');
            $table->string('subject');
            $table->text('description');
            $table->date('date_issued');
            $table->date('effective_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('status')->default('pending')->comment('pending, accepted, rejected');
            $table->text('action_taken')->nullable();
            $table->string('issued_by');
            $table->string('approved_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('concern_letters');
    }
};
