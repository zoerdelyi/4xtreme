<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTiresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings_tires', function (Blueprint $table) {
            $table->increments('id');
            $table->char('licence_plate', 20)->nullable();
            $table->string('comment', 500)->nullable();
            $table->timestamp('start_time')->default(now());
            $table->timestamp('end_time')->default(now());
            $table->integer('car_brand_id')->unsigned();
            $table->integer('car_type_id')->unsigned();
            $table->integer('visitor_id')->unsigned();
            $table->integer('deleted')->nullable();
            $table->integer('confirmed')->nullable();
            $table->timestamps();

            $table->foreign('car_brand_id')->references('id')->on('car_brands');
            $table->foreign('car_type_id')->references('id')->on('car_types');
            $table->foreign('visitor_id')->references('id')->on('visitors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings_tires');
    }
}
