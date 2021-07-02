<?php

use Illuminate\Database\Seeder;

class _ExportPagesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages')->delete();
        
        \DB::table('pages')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Főoldal',
                'blocks_ids' => '1,2,3,24,19,11',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-12-16 16:23:21',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Rólunk',
                'blocks_ids' => '9,10,11',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-12-12 14:00:15',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Álláslehetőségek',
                'blocks_ids' => '12,13',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Időpontok',
                'blocks_ids' => '16',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Autós szolgáltatások',
                'blocks_ids' => '17,19',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-11-14 11:01:00',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Autós árlista',
                'blocks_ids' => '21,22',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Gumis szolgáltatások',
                'blocks_ids' => '23,24',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Gumis árlista',
                'blocks_ids' => '27,28',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-03-11 19:35:29',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Kapcsolat',
                'blocks_ids' => '29,31,30',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-02-04 22:35:25',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Fejléc',
                'blocks_ids' => '32',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 19:07:15',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Lábléc',
                'blocks_ids' => '33',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-11-19 19:23:51',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Hírek',
                'blocks_ids' => '34,35',
                'created_at' => NULL,
                'updated_at' => '2020-04-01 15:02:20',
            ),
        ));
        
        
    }
}