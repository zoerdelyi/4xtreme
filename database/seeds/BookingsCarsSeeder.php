<?php

use Illuminate\Database\Seeder;

class BookingsCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings_cars')->insert([
            [
                'licence_plate' => 'NOTSET',
                'comment' => 'NOTSET',
                'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'car_brand_id' => 1,
                'car_type_id' => 1,
                'visitor_id' => 1,
                'deleted' => 1,
                'confirmed' => NULL,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
