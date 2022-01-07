<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartment', function($table) {
            $table->timestamps();
        });

        Schema::table('resident', function($table) {
            $table->timestamps();
        });

        Schema::table('apartment_areas', function($table) {
            $table->timestamps();
        });

        Schema::table('contract', function($table) {
            $table->dropColumn('created_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
