<?php

use Illuminate\Database\Seeder;

use App\Levels;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $adminLevel = Levels::where('name', 'Admin')->first();
            $felhasznaloLevel = Levels::where('name', 'Felhasználó')->first();
    
            DB::table('users')->insert(
                array(
                    array(
                        'name'     => 'admin',
                        'email'    => 'admin@4xtreme.hu',
                        'password' => Hash::make('awesome'),
                        'level_id' => $adminLevel->id,
                        'sex'     => '1',
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ),
                    array(
                        'name'     => 'Teszt István',
                        'email'    => 'istvan@4xtreme.hu',
                        'password' => Hash::make('awesome'),
                        'level_id' => $felhasznaloLevel->id,
                        'sex'     => '2',
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ),
                    array(
                        'name'     => 'Teszt Béla',
                        'email'    => 'bela@4xtreme.hu',
                        'password' => Hash::make('awesome'),
                        'level_id' => $felhasznaloLevel->id,
                        'sex'     => '2',
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ),
                )
            );
        });
    }
}
