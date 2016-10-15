<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexColumnToShapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shapes', function (Blueprint $table) {
            $table->integer('shape_id')->after('id');
            $table->increments('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shapes', function (Blueprint $table) {
            $table->dropColumn('shape_id');
            $table->integer('id')->change();
        });
    }
}
