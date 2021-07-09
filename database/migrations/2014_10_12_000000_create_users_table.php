<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('ip')->nullable();
            $table->string('telefon')->nullable();
            $table->string('jmeno')->nullable();
            $table->string('prijmeni')->nullable();
            $table->boolean('newsletter')->default(false);
            $table->boolean('notifications')->default(true);
            $table->timestamp('last_login_at')->useCurrent();
            $table->boolean('admin')->default(false);
            $table->string('last_login_ip')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
