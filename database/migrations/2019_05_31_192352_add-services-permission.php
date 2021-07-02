<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddServicesPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permissions')->insert(array(
            array('name' => 'Admin "Időpontfoglaló/Szolgáltatások" menü elérése', 'machine_name' => 'ENABLE_ADMIN_SERVICES_MENU')
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
        DB::delete( 'delete permissions where machine_name = ?', [ 'ENABLE_ADMIN_SERVICES_MENU']);
    }
}
