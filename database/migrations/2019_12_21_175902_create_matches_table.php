<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                Schema::create('matches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('start');
            $table->unsignedBigInteger('host_team')->nullable();
            $table->unsignedBigInteger('guest_team')->nullable();
            $table->unsignedBigInteger('tournament_id')->nullable();
            $table->string('descriptions')->nullable();
            $table->integer('winner')->nullable();
            $table->integer('score_host')->nullable();
            $table->integer('score_guest')->nullable();
            $table->integer('week')->nullable();
            $table->string('stream_url')->nullable();
            $table->boolean('show')->default(true);
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->foreign('host_team')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('guest_team')->references('id')->on('teams')->onDelete('cascade');
            $table->bigInteger('gameId')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matches');
    }
}
