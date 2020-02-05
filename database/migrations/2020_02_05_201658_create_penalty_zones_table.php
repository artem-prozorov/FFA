<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenaltyZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penalty_zones', function (Blueprint $table) {
            $table->increments('id')
                ->length(11);

            $table->integer('type')
                ->length(2);

            $table->integer('map_id')
                ->length(11);

            $table->foreign('map_id')
              ->references('id')->on('maps')
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
        Schema::dropIfExists('penalty_zones');
    }
}
