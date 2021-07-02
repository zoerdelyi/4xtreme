<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBeforeBookingNotificationCol extends Migration
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
            $table->integer('before_booking_notifi')->after('confirm_hash')->nullable();
        });
        Schema::table('bookings_tires', function($table)
        {
            $table->integer('before_booking_notifi')->after('confirm_hash')->nullable();
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
