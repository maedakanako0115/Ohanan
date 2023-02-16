<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiarysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diarys', function (Blueprint $table) {
            $table->bigIncrements('id')->autoIncrement();
            $table->date('date');
            $table->integer('user_id');
            $table->integer('group_id');
            $table->string('title');
            $table->string('image')->nullable();
            $table->string('text');
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
        Schema::dropIfExists('diarys');
    }
}
