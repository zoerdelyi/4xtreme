<?php

use Illuminate\Database\Seeder;

class BookingsSessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings_sessions')->insert([
            [
                'c_type' => 'car',
                'c_start_time' => '2019-07-05 10:00:00',
                'c_end_time' => '2019-07-05 10:30:00',
                'booking_started' => '2019-07-02 18:30:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'c_type' => 'tire',
                'c_start_time' => '2019-07-05 10:00:00',
                'c_end_time' => '2019-07-05 10:30:00',
                'booking_started' => '2019-07-02 18:40:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
