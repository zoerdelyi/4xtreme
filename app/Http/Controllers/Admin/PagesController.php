<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menus;
use App\Pages;

use App\Enums\PermissionsEnum;

class PagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_PAGES_MENU)) {
            return redirect()->route('admin/home');
        }

        $pages = Pages::all();

        // 'page_name_full' => $settings_array['page_name_full'],
        // 'page_name' => $settings_array['page_name'],
        // 'page_url' => $settings_array['page_url'],
        // 'author' => $settings_array['author'],
        // 'alnalytics' => $settings_array['analytics']

        $settings_array = $this->get_settings_variables();

        return view('admin/content/pages')->with([
            'pages' => $pages,
            'page_name' => $settings_array['page_name']
        ]);
    }

    public function menu(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_MENUS_MENU)) {
            return redirect()->route('admin/home');
        }
        // összes menüelem lekérdezése
        $menus = Menus::all()->sortBy("menu_order");

        $menus_first = $menus[0];

        // id-k sorrendje menu_order rendezés után
        $ids_order = [];
        $ids_order[] = 1;
        unset($ids_order[0]);
        foreach($menus as $menu){
            $ids_order[] = $menu->id;
        }

        // pages lista lekérdezése
        $pages = Pages::all();

        $settings_array = $this->get_settings_variables();
        return view('admin/content/menus')->with([
            'menus' => $menus,
            'ids_order' => $ids_order,
            'menus_first' => $menus_first,
            'pages' => $pages,
            'page_name' => $settings_array['page_name']
        ]);
    }
}
