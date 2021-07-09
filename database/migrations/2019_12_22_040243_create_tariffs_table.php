<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',191);
            $table->string('seo')->nullable()->unique();
            $table->text('descriptions')->nullable();
            $table->string('image')->default('fbheader.png');
            $table->string('color')->nullable();
            $table->boolean('show')->default(false);
            $table->integer('priceCZK');
            $table->integer('priceEUR');
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();
            $table->integer('days')->nullable();
            $table->dateTime('to')->nullable();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');;
            $table->softDeletes();
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
        Schema::dropIfExists('tariffs');
    }
}
