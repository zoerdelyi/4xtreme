<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('c_type');
            $table->timestamp('c_start_time')->nullable();
            $table->timestamp('c_end_time')->nullable();
            $table->timestamp('booking_started')->nullable();
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
        Schema::dropIfExists('bookings_sessions');
    }
}
