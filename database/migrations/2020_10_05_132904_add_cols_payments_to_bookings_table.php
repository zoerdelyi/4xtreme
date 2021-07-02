<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsPaymentsToBookingsTable extends Migration
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
            $table->integer('payment_total')->after('deleted')->nullable();
            $table->integer('payment_type')->after('deleted')->nullable();
        });
        Schema::table('bookings_tires', function($table)
        {
            $table->integer('payment_total')->after('deleted')->nullable();
            $table->integer('payment_type')->after('deleted')->nullable();
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
