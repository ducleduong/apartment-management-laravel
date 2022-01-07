<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment', function (Blueprint $table) {
            $table->increments('id');
            $table->float('area');
            $table->float('price');
            $table->boolean('status');
            $table->integer('rooms');
            $table->integer('resident_id')->unsigned();
            $table->foreign('resident_id')->references('id')->on('resident')->onDelete('cascade');
            $table->integer('apartment_areas_id')->unsigned();
            $table->foreign('apartment_areas_id')->references('id')->on('apartment_areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartment');
    }
}
