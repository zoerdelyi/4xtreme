<?php

use Illuminate\Database\Seeder;

class BookingsSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings_settings')->insert([
            [
                'name' => 'Kijelzett időpontok beállítása - Gumiszerviz',
                'enabled' => 1,
                'content' => '08:00|18:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Kijelzett időpontok beállítása - Autószerviz',
                'enabled' => 1,
                'content' => '07:30|17:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Aktuális időpont + X órától foglalható?  - Gumiszerviz',
                'enabled' => 1,
                'content' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Aktuális időpont + X órától foglalható?  - Autószerviz',
                'enabled' => 1,
                'content' => '2',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Gumiszerviz foglalás aktív?',
                'enabled' => 1,
                'content' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Autószerviz foglalás aktív?',
                'enabled' => 1,
                'content' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ebédszünet gumiszerviz',
                'enabled' => 1,
                'content' => '12:00|13:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ebédszünet autószerviz',
                'enabled' => 1,
                'content' => '12:00|13:00',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
