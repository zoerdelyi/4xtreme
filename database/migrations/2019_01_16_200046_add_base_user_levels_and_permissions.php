<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaseUserLevelsAndPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('levels')->insert(array(
                array('name' => 'Admin'),
                array('name' => 'Felhasználó')
            )
        );

        DB::table('permissions')->insert(array(
            // TODO: az enum-bol kellene feltölteni a DB-t
                // array('name' => 'Admin felület elérése', 'machine_name' => 'ENABLE_ADMIN_PAGE'), // Erre jelenleg nincs szükség
                array('name' => 'Admin "Felhasználók" menü elérése', 'machine_name' => 'ENABLE_ADMIN_USERS_MENU'),
                array('name' => 'Admin "Jogosultságok" menü elérése', 'machine_name' => 'ENABLE_ADMIN_PERMISSIONS_MENU'),
                array('name' => 'Időpontfoglalás engedélyezése (a foglalásra is hatással van!)', 'machine_name' => 'ENABLE_ADMIN_BOOKING_MENU'),
                array('name' => 'Admin "Beállítások" menü elérése', 'machine_name' => 'ENABLE_ADMIN_SETTINGS_MENU'),
                array('name' => 'Admin "Oldalak kezelése" menü elérése', 'machine_name' => 'ENABLE_ADMIN_PAGES_MENU'),
                array('name' => 'Admin "Menüelemek" menü elérése', 'machine_name' => 'ENABLE_ADMIN_MENUS_MENU'),
                array('name' => 'Admin "Időpontfoglaló/Szolgáltatások" menü elérése', 'machine_name' => 'ENABLE_ADMIN_SERVICES_MENU'),

                array('name' => 'Admin "Időpontfoglaló/Naptár" menü elérése', 'machine_name' => 'ENABLE_ADMIN_BOOKING_CALENDAR_MENU'),
                array('name' => 'Admin "Időpontfoglaló/Napi foglalások" menü elérése', 'machine_name' => 'ENABLE_ADMIN_BOOKING_DAILY_LIST_MENU'),
                array('name' => 'Admin "Időpontfoglaló/Összegzés" menü elérése', 'machine_name' => 'ENABLE_ADMIN_BOOKING_LIST_MENU'),
                array('name' => 'Admin "Időpontfoglaló/Funkciók" menü elérése', 'machine_name' => 'ENABLE_ADMIN_BOOKING_SETTINGS_MENU'),
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
