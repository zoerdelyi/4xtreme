<?php

use Illuminate\Database\Seeder;

class _ExportSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Analytics követőkód',
                'enabled' => 1,
            'content' => '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-154552264-1"></script>
<script>
window.dataLayer = window.dataLayer || [];
function gtag(){dataLayer.push(arguments);}
gtag(\'js\', new Date());
gtag(\'config\', \'UA-154552264-1\');
</script>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-12-23 13:43:39',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Weboldal teljes neve',
                'enabled' => 1,
                'content' => '4Xtreme | Gumi és Autószerviz | Biatorbágy',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Weboldal rövid neve',
                'enabled' => 1,
                'content' => '4Xtreme',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Alapértelmezett URL',
                'enabled' => 1,
                'content' => 'https://www.4xtreme.hu',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Author',
                'enabled' => 1,
                'content' => '4xtreme.hu',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Social Facebook',
                'enabled' => 1,
                'content' => 'https://www.facebook.com/4xtremekft/',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Social Instagram',
                'enabled' => 1,
                'content' => 'https://www.instagram.com/bia4xtreme/',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-12-23 12:15:37',
            ),
        ));
        
        
    }
}