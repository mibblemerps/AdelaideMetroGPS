<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stops', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('name');
            $table->string('stop_code')->nullable();
            $table->decimal('lat', 10, 6);
            $table->decimal('long', 10, 6);
            $table->string('description', 512)->nullable();
            $table->integer('zone_id')->nullable();
            $table->string('stop_url')->nullable();
            $table->boolean('is_station')->nullable();
            $table->integer('parent_station')->nullable();
            $table->string('timezone')->nullable();
            $table->boolean('wheelchair_accessible')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stops');
    }
}
