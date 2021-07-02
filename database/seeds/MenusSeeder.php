<?php

use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menuses')->delete();
        
        \DB::table('menuses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'active' => 1,
                'menu_order' => 1,
                'name' => 'Főoldal',
                'seoname' => 'index',
                'page_id' => 1,
                'parent' => 0,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            1 => 
            array (
                'id' => 2,
                'active' => 1,
                'menu_order' => 2,
                'name' => 'Rólunk',
                'seoname' => 'rolunk',
                'page_id' => 2,
                'parent' => 0,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            2 => 
            array (
                'id' => 3,
                'active' => 0,
                'menu_order' => 5,
                'name' => 'Álláslehetőségek',
                'seoname' => 'allasok',
                'page_id' => 3,
                'parent' => 0,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            3 => 
            array (
                'id' => 4,
                'active' => 0,
                'menu_order' => 4,
                'name' => 'Időpontfoglaló',
                'seoname' => 'idopontfoglalo',
                'page_id' => 4,
                'parent' => 0,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            4 => 
            array (
                'id' => 5,
                'active' => 1,
                'menu_order' => 6,
                'name' => 'Gumiszerviz',
                'seoname' => 'gumiszerviz',
                'page_id' => 0,
                'parent' => 0,
                'is_parent' => 1,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            5 => 
            array (
                'id' => 6,
                'active' => 1,
                'menu_order' => 7,
                'name' => 'Szolgáltatások',
                'seoname' => 'gumiszerviz/szolgaltatasok',
                'page_id' => 7,
                'parent' => 5,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            6 => 
            array (
                'id' => 7,
                'active' => 1,
                'menu_order' => 8,
                'name' => 'Árlista',
                'seoname' => 'gumiszerviz/arlista',
                'page_id' => 8,
                'parent' => 5,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            7 => 
            array (
                'id' => 8,
                'active' => 1,
                'menu_order' => 9,
                'name' => 'Autószerviz',
                'seoname' => 'autoszerviz',
                'page_id' => 0,
                'parent' => 0,
                'is_parent' => 1,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            8 => 
            array (
                'id' => 9,
                'active' => 1,
                'menu_order' => 10,
                'name' => 'Szolgáltatások',
                'seoname' => 'autoszerviz/szolgaltatasok',
                'page_id' => 5,
                'parent' => 8,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            9 => 
            array (
                'id' => 10,
                'active' => 0,
                'menu_order' => 11,
                'name' => 'Árlista',
                'seoname' => 'autoszerviz/arlista',
                'page_id' => 6,
                'parent' => 8,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            10 => 
            array (
                'id' => 11,
                'active' => 1,
                'menu_order' => 12,
                'name' => 'Kapcsolat',
                'seoname' => 'kapcsolat',
                'page_id' => 9,
                'parent' => 0,
                'is_parent' => 0,
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2020-04-01 15:18:27',
            ),
            11 => 
            array (
                'id' => 12,
                'active' => 1,
                'menu_order' => 3,
                'name' => 'Hírek',
                'seoname' => 'hirek',
                'page_id' => 12,
                'parent' => 0,
                'is_parent' => 0,
                'created_at' => NULL,
                'updated_at' => '2020-04-01 15:18:27',
            ),
        ));
        
        
    }
}