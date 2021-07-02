<?php

use Illuminate\Database\Seeder;

class LevelsPermissionsSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('levels_permissions')->delete();
        
        \DB::table('levels_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'level_id' => 1,
                'permission_id' => 1,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'level_id' => 1,
                'permission_id' => 2,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'level_id' => 1,
                'permission_id' => 3,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'level_id' => 1,
                'permission_id' => 4,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'level_id' => 1,
                'permission_id' => 5,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'level_id' => 1,
                'permission_id' => 6,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'level_id' => 1,
                'permission_id' => 7,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'level_id' => 2,
                'permission_id' => 5,
                'updated_at' => '2019-08-29 14:16:42',
                'created_at' => '2019-08-29 14:16:42',
            ),
            8 => 
            array (
                'id' => 9,
                'level_id' => 2,
                'permission_id' => 6,
                'updated_at' => '2019-09-14 15:28:54',
                'created_at' => '2019-09-14 15:28:54',
            ),
            9 => 
            array (
                'id' => 10,
                'level_id' => 2,
                'permission_id' => 3,
                'updated_at' => '2020-04-05 10:41:35',
                'created_at' => '2020-04-05 10:41:35',
            ),
            10 => 
            array (
                'id' => 11,
                'level_id' => 2,
                'permission_id' => 7,
                'updated_at' => '2020-04-13 18:24:55',
                'created_at' => '2020-04-13 18:24:55',
            ),
        ));
        
        
    }
}