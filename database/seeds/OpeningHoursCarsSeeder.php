<?php

use Illuminate\Database\Seeder;

class OpeningHoursCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('opening_hours_cars')->insert([
            [
                'week_day' => '1',
                'start' => '7:30:00',
                'end' => '17:00:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'week_day' => '2',
                'start' => '7:30:00',
                'end' => '17:00:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'week_day' => '3',
                'start' => '7:30:00',
                'end' => '17:00:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'week_day' => '4',
                'start' => '7:30:00',
                'end' => '17:00:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'week_day' => '5',
                'start' => '7:30:00',
                'end' => '17:00:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
