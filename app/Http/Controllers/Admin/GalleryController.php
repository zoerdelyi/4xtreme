<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\PermissionsEnum;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_MENUS_MENU)) {
            return redirect()->route('admin/home');
        }

        $settings_array = $this->get_settings_variables();
        
        return view('admin/content/gallery')->with([
            'page_name' => $settings_array['page_name']
        ]);
    }
}
