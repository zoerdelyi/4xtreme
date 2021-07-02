<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Pages;
use App\Blocks;
use App\Menus;
use App\Settings;
use App\Visitors;
use App\Mail\ContactMail;

class VisitorsController extends Controller
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

    protected function validator_admin(array $data)
    {
        $validator =  Validator::make($data, [
            'name' => ['string', 'max:191'],
            'email' => ['string', 'max:191', 'regex:/^.+@.+$/i'],
            'phone' => ['string', 'max:20', 'regex:/(\+|\d)\d{0,13}/'],
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

    // adott oldalak funkciói
    public function index(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Főoldal')->first();
        $block_ids = $page_blocks->blocks_ids;
        $page_blocks = explode(',', $block_ids);
        $blocks = Blocks::whereIn('id', $page_blocks)->orderByRaw("FIELD(id, ".$block_ids.") ASC")->get();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();
        $settings_array = $this->get_settings();

        return view('visitors/index')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    public function about(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Rólunk')->first();
        $block_ids = $page_blocks->blocks_ids;
        $page_blocks = explode(',', $block_ids);
        $blocks = Blocks::whereIn('id', $page_blocks)->orderByRaw("FIELD(id, ".$block_ids.") ASC")->get();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();
        $settings_array = $this->get_settings();

        return view('visitors/about')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    public function jobs(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Álláslehetőségek')->first();
        $block_ids = $page_blocks->blocks_ids;
        $page_blocks = explode(',', $block_ids);
        $blocks = Blocks::whereIn('id', $page_blocks)->orderByRaw("FIELD(id, ".$block_ids.") ASC")->get();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();
        $settings_array = $this->get_settings();

        return view('visitors/jobs')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    // ELKÖLTÖZÖTT A VisitorsCalendarController-BE!
    // public function freedates(){
    //     // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
    //     $page_blocks = Pages::where('name', 'Időpontok')->first();
    //     $block_ids = $page_blocks->blocks_ids;
    //     $page_blocks = explode(',', $block_ids);
    //     $blocks = Blocks::whereIn('id', $page_blocks)->orderByRaw("FIELD(id, ".$block_ids.") ASC")->get();

    //     $block_header = $this->layout_header();
    //     $block_footer = $this->layout_footer();
    //     $block_menu_array = $this->layout_menu();

    //     $block_header = $this->layout_header();
    //     $block_footer = $this->layout_footer();
    //     $block_menu_array = $this->layout_menu();
    //     $settings_array = $this->get_settings();

    //     return view('visitors/freedates')->with([
    //         'blocks' => $blocks,
    //         'block_header' => $block_header,
    //         'block_footer' => $block_footer,
    //         'menus' => $block_menu_array['menus'],
    //         'ids_order' => $block_menu_array['ids_order'],
    //         'page_name_full' => $settings_array['page_name_full'],
    //         'page_name' => $settings_array['page_name'],
    //         'page_url' => $settings_array['page_url'],
    //         'author' => $settings_array['author'],
    //         'alnalytics' => $settings_array['analytics'],
    //         'social_facebook' => $settings_array['social_facebook'],
    //         'social_instagram' => $settings_array['social_instagram']
    //     ]);
    // }

    public function CarServices(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Autós szolgáltatások')->first();
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

        return view('visitors/carservices')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    public function CarPriceList(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Autós árlista')->first();
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

        return view('visitors/carpricelist')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    public function TireServices(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Gumis szolgáltatások')->first();
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

        return view('visitors/tireservices')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    public function TirePriceList(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Gumis árlista')->first();
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

        return view('visitors/tirepricelist')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    public function contact($msg_sent = '', $msg_type = ''){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Kapcsolat')->first();
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
            'social_instagram' => $settings_array['social_instagram']
        ];

        if($msg_sent != '' && $msg_type != ''){
            $return_array['msg_sent'] = $msg_sent;
            $return_array['msg_type'] = $msg_type;
        }

        return view('visitors/contact')->with($return_array);
    }

    public function contact_post(Request $request){

        // globális változóból húzzuk be!
        $to_email = 'info@4xtreme.hu';

        $username = $request->username;
        $email = $request->email;
        $subject = $request->subject;
        $phone = $request->phone;
        $message = $request->message;

        $mail_datas = [
            'username' => $username,
            'email' => $email,
            'subject' => $subject,
            'phone' => $phone,
            'message' => $message
        ];


        \Mail::to($to_email)->send(new ContactMail($mail_datas));

        // ha nincs email küldés hiba!
        if( count(\Mail::failures()) == 0 ) {
            // visszatér a kapcsolati oldallal
            return $this->contact('Üzenete sikeresen továbbítva!', 'success');
        }
        else{
            // email küldés hiba lépett fel
            return $this->contact('Üzenet küldés sikertelen!', 'danger');
        }
    }

    public function hirek(){
        // Aktuális blokklista lekérdezése | orderByRaw --> ezzel a kívánt sorrendben jelnnek meg a blokkok!
        $page_blocks = Pages::where('name', 'Hírek')->first();
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

        return view('visitors/hirek')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    // TEMP adott oldalak funkciói
    public function all(){
        // Összes blokklista lekérdezése
        $blocks = Blocks::all();

        $block_header = $this->layout_header();
        $block_footer = $this->layout_footer();
        $block_menu_array = $this->layout_menu();
        $settings_array = $this->get_settings();

        return view('visitors/index')->with([
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
            'social_instagram' => $settings_array['social_instagram']
        ]);
    }

    public function insert($visitor) {
        $errors = $this->validator( $visitor);
        if ($errors) {
            return $errors;
        } else {
            $visitors = new Visitors();

            $visitors->name = $visitor['name'];
            $visitors->email = $visitor['email'];
            $visitors->phone = $visitor['phone'];
            $visitors->save();
            return $visitors;
        }
    }

    // adminnak külön validator!
    public function insert_admin($visitor) {
        $errors = $this->validator_admin($visitor);
        if ($errors) {
            return $errors;
        } else {
            $visitors = new Visitors();

            $visitors->name = $visitor['name'];
            $visitors->email = $visitor['email'];
            $visitors->phone = $visitor['phone'];
            $visitors->save();
            return $visitors;
        }
    }
}
