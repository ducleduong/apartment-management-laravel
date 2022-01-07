<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResidentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resident', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->date('birthday');
            $table->string('gender',4);
            $table->string('phone_number',11);
            $table->String('identity_card_number',20);
            $table->string('country', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resident');
    }
}
