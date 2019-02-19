<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisation_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->nullable();
            $table->integer('organisation_id')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();

            //$table->foreign('team_id')->references('id')->on('teams');
            //$table->foreign('organisation_id')->references('id')->on('organisations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organisation_team');
    }
}
