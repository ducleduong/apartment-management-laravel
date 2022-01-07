<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->increments('id');
            $table->date('created_date');
            $table->string('customer_address', 200);
            $table->integer('resident_id')->unsigned();
            $table->foreign('resident_id')->references('id')->on('resident')->onDelete('cascade')->primary();
            $table->integer('apartment_id')->unsigned();
            $table->foreign('apartment_id')->references('id')->on('apartment')->onDelete('cascade')->primary();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract');
    }
}