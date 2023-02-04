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
            $table->bigIncrements('id')->autoIncrement();
            $table->string('name');
            $table->string('email')->unique();
            // $table->string('remember_token');
            $table->string('tel')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('role')->default(0);
            $table->boolean('del_flg')->default(0);
            $table->string('group_id')->nullable();
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
