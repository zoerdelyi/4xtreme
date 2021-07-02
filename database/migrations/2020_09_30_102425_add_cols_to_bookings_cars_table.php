<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToBookingsCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings_cars', function (Blueprint $table) {
            $table->string('motortip')->after('licence_plate')->nullable();
            $table->string('alvaz')->after('licence_plate')->nullable();
            $table->string('cm3')->after('licence_plate')->nullable();
            $table->string('teljesitmeny')->after('licence_plate')->nullable();
            $table->integer('osszeg')->after('licence_plate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings_cars', function (Blueprint $table) {
            //
        });
    }
}
