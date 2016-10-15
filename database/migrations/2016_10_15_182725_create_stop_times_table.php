<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stop_times', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('trip_id');
            $table->dateTime('arrival_time');
            $table->dateTime('departure_time');
            $table->integer('stop_id');
            $table->integer('stop_sequence');
            $table->string('stop_headsign')->nullable();
            $table->tinyInteger('pickup_type')->nullable();
            $table->tinyInteger('dropoff_type')->nullable();
            $table->double('distance_travelled')->nullable();
            $table->boolean('exact')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropTable('stop_times');
    }
}
