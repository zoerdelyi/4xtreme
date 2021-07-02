<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Settings;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // beállítások lekérdezése
    public function get_settings_variables(){
        $analytics = Settings::where('id', '1')->first();
        $page_name_full = Settings::where('id', '2')->first();
        $page_name = Settings::where('id', '3')->first();
        $page_url = Settings::where('id', '4')->first();
        $author = Settings::where('id', '5')->first();
    
        $analytics = ($analytics->enabled == 1) ? $analytics->content : '';
        $page_name_full = $page_name_full->content;
        $page_name = $page_name->content;
        $page_url = $page_url->content;
        $author = $author->content;

        return [
            'analytics' => $analytics,
            'page_name_full' => $page_name_full,
            'page_name' => $page_name,
            'page_url' => $page_url,
            'author' => $author
        ];
    }
}
