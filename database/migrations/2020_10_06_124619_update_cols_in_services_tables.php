<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColsInServicesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services_cars', function($table)
        {
            $table->integer('gross_price')->nullable()->change();
            $table->integer('net_price')->nullable()->change();
        });
        Schema::table('services_tires', function($table)
        {
            $table->integer('gross_price')->nullable()->change();
            $table->integer('net_price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_tables', function (Blueprint $table) {
            //
        });
    }
}
