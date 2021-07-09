<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
             $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->text('text')->nullable();
            $table->boolean('read')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('maxiclub')->default(false);
            $table->dropColumn('text')->nullable();
            $table->dropColumn('read')->default(false);
            $table->dropColumn('user_id')->nullable();
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });
    }
}
