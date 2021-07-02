<?php

use Illuminate\Database\Seeder;

class _ExportLevelsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('levels')->delete();
        
        \DB::table('levels')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Admin',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Felhasználó',
            ),
        ));
        
        
    }
}