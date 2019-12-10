<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('transactions', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->bigIncrements('rent_plans_id');
        $table->boolean('success');
        $table->boolean('status');
        $table->text('gateway_response');
        $table->integer('attempt');

        rent_plans_id	status	gateway_response	attempt
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
        Schema::dropIfExists('transactions');
    }
}
