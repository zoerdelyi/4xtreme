<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Pages;
use App\Blocks;
use App\Menus;
use App\Settings;
use App\Visitors;
use App\BookingsSettings;
use App\Mail\ContactMail;

use App\Http\Controllers\CarBrandsController;

class VisitorsCalendarController extends Controller
{

    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'max:191', 'regex:/^.+@.+$/i'],
            'phone' => ['required', 'string', 'max:20', 'regex:/(\+|\d)\d{0,13}/'],
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }

    // ide azok a lekérdezések kerülnek amelyek a visitors layout-hoz tartoznak
    public function layout_header(){
        $block_header = Pages::where('name', 'Fejléc')->first();
        $block_header = explode(',', $block_header->blocks_ids);
        $block_header = Blocks::whereIn('id', $block_header)->get();

        return $block_header;
    }

    public function layout_footer(){
        $block_footer = Pages::where('name', 'Lábléc')->first();
        $block_footer = explode(',', $block_footer->blocks_ids);
        $block_footer = Blocks::whereIn('id', $block_footer)->get();

        return $block_footer;
    }

    public function layout_menu(){
        // összes menüelem lekérdezése
        $menus = Menus::all()->sortBy("menu_order");
        // $menus = Menus::where('active', 1)->sortBy("menu_order");

        // id-k sorrendje menu_order rendezés után
        $ids_order = [];
        $ids_order[] = 1;
        unset($ids_order[0]);
        foreach($menus as $menu){
            $ids_order[] = $menu->id;
        }

        return [
            'menus' => $menus,
            'ids_order' => $ids_order
        ];
    }

    // beállítások lekérdezése
    public function get_settings(){
        $analytics = Settings::where('id', '1')->first();
        $page_name_full = Settings::where('id', '2')->first();
        $page_name = Settings::where('id', '3')->first();
        $page_url = Settings::where('id', '4')->first();
        $author = Settings::where('id', '5')->first();
        $social_facebook = Settings::where('id', '6')->first();
        $social_instagram = Settings::where('id', '7')->first();

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
            'author' => $author,
            'social_facebook' => $social_facebook,
            'social_instagram' => $social_instagram
        ];
    }

    public function freedates($msg_sent = '', $msg_type = ''){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Időpontfoglaló')->first();
        $block_ids = $page_blocks->blocks_ids;
        $page_blocks = explode(',', $block_ids);
        $blocks = Blocks::whereIn('id', $page_blocks)->orderByRaw("FIELD(id, ".$block_ids.") ASC")->get();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();
        $settings_array = $this->get_settings();

        $get_bookings_settings = BookingsSettings::all();
        $calendar_tires = $get_bookings_settings[4]['content'];
        $calendar_cars = $get_bookings_settings[5]['content'];

        // csak az egyik funkció aktív
        if( ($calendar_cars == 1 && $calendar_tires == 0) || ($calendar_cars == 0 && $calendar_tires == 1) ){
            $calendar_options = 1;
        }
        elseif($calendar_cars == 0 && $calendar_tires == 0){
            $calendar_options = 0;
        }
        else{
            $calendar_options = 2;
        }


        $carBrandsController = new CarBrandsController;

        $return_array = [
            'blocks' => $blocks,
            'block_header' => $block_header,
            'block_footer' => $block_footer,
            'menus' => $block_menu_array['menus'],
            'ids_order' => $block_menu_array['ids_order'],
            'page_name_full' => $settings_array['page_name_full'],
            'page_name' => $settings_array['page_name'],
            'page_url' => $settings_array['page_url'],
            'author' => $settings_array['author'],
            'alnalytics' => $settings_array['analytics'],
            'social_facebook' => $settings_array['social_facebook'],
            'social_instagram' => $settings_array['social_instagram'],

            'car_brands' => $carBrandsController->getAllCarBrands(),

            'calendar_tires' => $calendar_tires,
            'calendar_cars' => $calendar_cars,
            'calendar_options' => $calendar_options
        ];

        if($msg_sent != '' && $msg_type != ''){
            $return_array['msg_sent'] = $msg_sent;
            $return_array['msg_type'] = $msg_type;
        }

        return view('visitors/freedates')->with($return_array);
    }

    public function freedates_confirm($msg_sent = '', $msg_type = ''){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Időpontfoglaló')->first();
        $block_ids = $page_blocks->blocks_ids;
        $page_blocks = explode(',', $block_ids);
        $blocks = Blocks::whereIn('id', $page_blocks)->orderByRaw("FIELD(id, ".$block_ids.") ASC")->get();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();
        $settings_array = $this->get_settings();

        $get_bookings_settings = BookingsSettings::all();
        $calendar_tires = $get_bookings_settings[4]['content'];
        $calendar_cars = $get_bookings_settings[5]['content'];

        // csak az egyik funkció aktív
        if( ($calendar_cars == 1 && $calendar_tires == 0) || ($calendar_cars == 0 && $calendar_tires == 1) ){
            $calendar_options = 1;
        }
        elseif($calendar_cars == 0 && $calendar_tires == 0){
            $calendar_options = 0;
        }
        else{
            $calendar_options = 2;
        }


        $carBrandsController = new CarBrandsController;

        $return_array = [
            'blocks' => $blocks,
            'block_header' => $block_header,
            'block_footer' => $block_footer,
            'menus' => $block_menu_array['menus'],
            'ids_order' => $block_menu_array['ids_order'],
            'page_name_full' => $settings_array['page_name_full'],
            'page_name' => $settings_array['page_name'],
            'page_url' => $settings_array['page_url'],
            'author' => $settings_array['author'],
            'alnalytics' => $settings_array['analytics'],
            'social_facebook' => $settings_array['social_facebook'],
            'social_instagram' => $settings_array['social_instagram'],

            'car_brands' => $carBrandsController->getAllCarBrands(),

            'calendar_tires' => $calendar_tires,
            'calendar_cars' => $calendar_cars,
            'calendar_options' => $calendar_options
        ];

        if($msg_sent != '' && $msg_type != ''){
            $return_array['msg_sent'] = $msg_sent;
            $return_array['msg_type'] = $msg_type;
        }

        return view('visitors/freedates_confirm')->with($return_array, );
    }

    public function freedates_confirm_pre($message, $hash){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Időpontfoglaló')->first();
        $block_ids = $page_blocks->blocks_ids;
        $page_blocks = explode(',', $block_ids);
        $blocks = Blocks::whereIn('id', $page_blocks)->orderByRaw("FIELD(id, ".$block_ids.") ASC")->get();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();
        $settings_array = $this->get_settings();

        $get_bookings_settings = BookingsSettings::all();
        $calendar_tires = $get_bookings_settings[4]['content'];
        $calendar_cars = $get_bookings_settings[5]['content'];

        // csak az egyik funkció aktív
        if( ($calendar_cars == 1 && $calendar_tires == 0) || ($calendar_cars == 0 && $calendar_tires == 1) ){
            $calendar_options = 1;
        }
        elseif($calendar_cars == 0 && $calendar_tires == 0){
            $calendar_options = 0;
        }
        else{
            $calendar_options = 2;
        }


        $carBrandsController = new CarBrandsController;

        $return_array = [
            'blocks' => $blocks,
            'block_header' => $block_header,
            'block_footer' => $block_footer,
            'menus' => $block_menu_array['menus'],
            'ids_order' => $block_menu_array['ids_order'],
            'page_name_full' => $settings_array['page_name_full'],
            'page_name' => $settings_array['page_name'],
            'page_url' => $settings_array['page_url'],
            'author' => $settings_array['author'],
            'alnalytics' => $settings_array['analytics'],
            'social_facebook' => $settings_array['social_facebook'],
            'social_instagram' => $settings_array['social_instagram'],

            'car_brands' => $carBrandsController->getAllCarBrands(),

            'calendar_tires' => $calendar_tires,
            'calendar_cars' => $calendar_cars,
            'calendar_options' => $calendar_options,
            'message' => $message,
            'hash' => $hash
        ];

        return view('visitors/freedates_confirm_pre')->with($return_array);
    }
}
