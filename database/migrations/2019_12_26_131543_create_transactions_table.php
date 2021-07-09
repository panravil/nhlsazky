<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->uuid('payment_id');
            $table->unsignedBigInteger('tariff_id')->unsigned();
            $table->string('user_email')->nullable(true)->default(null);
            $table->enum('status', ['Prepared', 'Started', 'InProgress', 'Waiting', 'Reserved', 'Authorized', 'Canceled', 'Succeeded', 'Failed', 'PartiallySucceeded', 'Expired']);
            $table->dateTime('activated_date')->nullable(true)->default(null);
            $table->dateTime('active_to')->nullable(true)->default(null);
            $table->integer('priceCZK')->nullable(true)->default(null);
            $table->integer('priceEUR')->nullable(true)->default(null);
            $table->foreign('tariff_id')->references('id')->on('tariffs');
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
