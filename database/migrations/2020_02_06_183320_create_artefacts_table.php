<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtefactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artefacts', function (Blueprint $table) {
            $table->increments('id')
                ->length(11);

            $table->integer('game_id')
                ->length(11);

            $table->integer('player_id')
                ->length(11)
                ->nullable();

            $table->string('name')
                ->length(255);

            $table->integer('type')
                ->length(2);

            $table->timestamps();

            $table->foreign('game_id')
              ->references('id')->on('games')
              ->onDelete('cascade');

            $table->foreign('player_id')
              ->references('id')->on('players')
              ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artefacts');
    }
}
