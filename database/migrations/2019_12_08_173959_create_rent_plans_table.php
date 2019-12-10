<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('conductor_id')->references('id')->on('users');
            $table->foreign('lessee_id')->references('id')->on('users');
            $table->foreign('conductor_bank_account_id')->references('id')->on('bank_accounts');
            $table->foreign('lessee_bank_account_id')->references('id')->on('bank_accounts');
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->integer('renewal_day');
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
        Schema::dropIfExists('rent_plans');
    }
}
