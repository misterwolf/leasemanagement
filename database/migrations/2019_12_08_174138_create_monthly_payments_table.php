<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('rent_plan_id')->references('id')->on('users');
            $table->boolean('success');
            $table->text('message');
            $table->int('attempt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_payments');
    }
}
