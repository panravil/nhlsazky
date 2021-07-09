<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('seo');
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->boolean('bigbanner')->default(false);
            $table->boolean('show')->default(false);
            $table->boolean('show_menu')->default(false);
            $table->text('note')->nullable();
            $table->text('html_template');
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
        Schema::dropIfExists('events');
    }
}
