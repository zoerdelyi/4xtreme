<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsBeforeDeployment extends Migration
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
            $table->integer('car_brand_id')->nullable()->change()->unsigned();
            $table->integer('car_type_id')->nullable()->change()->unsigned();
        });
        Schema::table('bookings_tires', function($table)
        {
            $table->integer('car_brand_id')->nullable()->change()->unsigned();
            $table->integer('car_type_id')->nullable()->change()->unsigned();
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
