<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_tips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('datum');
            $table->unsignedBigInteger('match_id');
            $table->integer('tip');
            $table->integer('result');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('contest_winners', function (Blueprint $table) {
            //
        });
    }
}
