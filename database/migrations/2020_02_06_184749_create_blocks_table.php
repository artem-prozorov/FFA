<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->increments('id')
                ->length(11);

            $table->integer('player_id')
                ->length(11);

            $table->integer('duration')
                ->length(2);

            $table->integer('position_id')
                ->length(11);

            $table->foreign('player_id')
              ->references('id')->on('players')
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
        Schema::dropIfExists('blocks');
    }
}
