<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moves', function (Blueprint $table) {
            $table->increments('id')
                ->length(11);

            $table->integer('game_id')
                ->length(11);

            $table->integer('number')
                ->length(11);

            $table->integer('status')
                ->length(2);

            $table->integer('current_user_id')
                ->length(11);

            $table->timestamps();

            $table->foreign('game_id')
              ->references('id')->on('games')
              ->onDelete('cascade');

            $table->foreign('current_user_id')
              ->references('id')->on('players')
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
        Schema::dropIfExists('moves');
    }
}
