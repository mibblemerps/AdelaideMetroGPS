<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->integer('route_id');
            $table->integer('service_id')->nullable();
            $table->boolean('outbound')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('shape_id')->nullable();
            $table->string('headsign')->nullable();
            $table->string('short_name', 32)->nullable();
            $table->boolean('wheelchair_accessible')->nullable();
            $table->boolean('bikes_allowed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('trips');
    }
}
