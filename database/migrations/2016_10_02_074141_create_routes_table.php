<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->integer('agency_id');
            $table->string('short_name', 32);
            $table->string('full_name');
            $table->integer('route_type')->default(3); // Default: 3 - Bus.
            $table->string('description', 512)->nullable();
            $table->string('route_url')->nullable();
            $table->string('route_colour', 8)->default('FFFFFF');
            $table->string('background_colour', 8)->default('000000');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('routes');
    }
}
