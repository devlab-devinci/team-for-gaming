<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id', false, true)->index();
            $table->string('label', 255);
            $table->smallInteger('order');
            $table->timestamps();

            //$table->foreign('game_id')->references('id')->on('games');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_levels');
    }
}
