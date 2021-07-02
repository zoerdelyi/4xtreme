<?php

use Illuminate\Database\Seeder;

class PagesTemplateSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pages_templates')->delete();
        
        \DB::table('pages_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Home1',
                'blocks_ids' => '1,2,3,4,5,6,7,8',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Home2',
                'blocks_ids' => '1,2,6,10,3,11,12,8',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Home3',
                'blocks_ids' => '13,14,3,15,6,11,16,8',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'AboutUs',
                'blocks_ids' => '17,18,6',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Services',
                'blocks_ids' => '17,19,20,21',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'OurGallery',
                'blocks_ids' => '17,22',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => '404',
                'blocks_ids' => '17,23',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'PricePlans',
                'blocks_ids' => '17,21',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
        ));
        
        
    }
}