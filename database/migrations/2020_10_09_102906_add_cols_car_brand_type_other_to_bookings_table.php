<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsCarBrandTypeOtherToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings_cars', function($table)
        {
            $table->string('car_type_other')->after('car_type_id')->nullable();
            $table->string('car_brand_other')->after('car_type_id')->nullable();
        });
        Schema::table('bookings_tires', function($table)
        {
            $table->string('car_type_other')->after('car_type_id')->nullable();
            $table->string('car_brand_other')->after('car_type_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            //
        });
    }
}
