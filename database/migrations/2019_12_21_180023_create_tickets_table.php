<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('match_id')->nullable();
            $table->unsignedBigInteger('tournament_id')->nullable();
            $table->string('match')->nullable();
            $table->dateTime('match_start')->nullable();
            $table->string('tip');
            $table->float('odds');
            $table->float('cost')->default('1');
            $table->float('profit')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->text('note')->nullable();
            $table->boolean('show')->default(false);
            $table->boolean('notified')->default(false);
            $table->string('old_sezona')->nullable();
            $table->boolean('old_archiv')->nullable();
            $table->boolean('old_top')->nullable();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
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
        Schema::dropIfExists('tickets');
    }
}
