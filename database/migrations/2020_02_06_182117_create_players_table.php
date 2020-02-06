<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->increments('id')
                ->length(11);

            $table->integer('game_id')
                ->length(11);

            $table->integer('user_id')
                ->length(11);

            $table->integer('status')
                ->length(2);

            $table->integer('position_id')
                ->length(11);

            $table->foreign('game_id')
              ->references('id')->on('games')
              ->onDelete('cascade');

            $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

            $table->foreign('position_id')
              ->references('id')->on('positions')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}
