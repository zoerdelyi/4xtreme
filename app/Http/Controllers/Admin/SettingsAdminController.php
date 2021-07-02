<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Settings;

use App\Enums\PermissionsEnum;

class SettingsAdminController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_SETTINGS_MENU)) {
            return redirect()->route('admin/home');
        }
        // analytics settings lekérdezése
        $analytics_settings = Settings::find(1);
        $social_facebook = Settings::find(6);
        $social_instagram = Settings::find(7);

        $settings_array = $this->get_settings_variables();
        return view('admin/content/settings')->with([
            'analytics_settings' => $analytics_settings,
            'page_name' => $settings_array['page_name'],
            'social_facebook' => $social_facebook,
            'social_instagram' => $social_instagram
        ]);
    }

    public function analytics(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_SETTINGS_MENU)) {
            return redirect()->route('admin/home');
        }
        // analytics settings lekérdezése
        $analytics_settings = Settings::find(1);

        $settings_array = $this->get_settings_variables();
        return view('admin/content/analytics')->with([
            'analytics_settings' => $analytics_settings,
            'page_name' => $settings_array['page_name']
        ]);
    }

    public function social(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_SETTINGS_MENU)) {
            return redirect()->route('admin/home');
        }
        $social_facebook = Settings::find(6);
        $social_instagram = Settings::find(7);

        $settings_array = $this->get_settings_variables();
        return view('admin/content/social')->with([
            'social_facebook' => $social_facebook,
            'social_instagram' => $social_instagram,
            'page_name' => $settings_array['page_name']
        ]);
    }
}
