<?php

namespace App\Http\Controllers\Admin;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Pages;
use App\Blocks;
use App\Menus;
use App\Settings;
use Carbon\Carbon;

class AjaxController extends Controller
{

    protected function pages(Request $request){
        $page_id = $request->page_id;
        $blocks_ids = $request->blocks_ids;

        $page = Pages::find($page_id);

        // adatbázis lekérdezés ellenőrzése
        $page = Pages::find($page_id);
        if(empty($page)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Fv.: pages() Elem: page_id: '.$page_id.' nem található az adatbázisban, az adatbázis üres eredménnyel tért vissza.']);
        }else{
            if($blocks_ids == 'noblocks'){
                $page->blocks_ids = '';
            }else{
                $page->blocks_ids = $blocks_ids;
            }
            $page->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $page->save();
            return response()->json([
                'success' => $page->blocks_ids
            ]);
        }
    }

    protected function blocks(Request $request){
        $block_id = $request->block_id;
        $block_content = $request->block_content;

        $block = Blocks::find($block_id);
        if(empty($block)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Fv.: blocks() Elem: block_id: '.$block_id.' nem található az adatbázisban, az adatbázis üres eredménnyel tért vissza.']);
        }else{
            $block->content = $block_content;
            $block->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $block->save();
            return response()->json([
                'success' => $block->id
            ]);
        }
    }

    protected function blocks_append(Request $request){
        $block_id = $request->block_id;
        $block = Blocks::find($block_id);
        if(empty($block)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Fv.: blocks_append() Elem: block_id: '.$block_id.' nem található az adatbázisban, az adatbázis üres eredménnyel tért vissza.']);
        }else{
            return response()->json([
                'success' => 1,
                'content' => $block->content,
                'name' => $block->name
            ]);
        }
    }

    protected function menus_order(Request $request){
        $new_order = $request->new_order;
        foreach($new_order as $e){
            $menu = Menus::find($e['id']);
            if(empty($menu)){
                return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Fv.: menus_order() Menüelem id: '.$e['id'].'. nem található az adatbázisban.']);
            }else{
                $menu->menu_order = $e['menu_order'];
                $menu->parent = $e['parent'];
                $menu->is_parent = $e['is_parent'];
                $menu->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $menu->save();
            }
        }
        return response()->json([
            'success' => 1
        ]);
    }

    // menüelem beállításának lehívása
    protected function menu_settings(Request $request){
        $menu_id = $request->menu_id;
        $menus = Menus::find($menu_id);
        if(empty($menus)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Menüelem menu_id: '.$menu_id.'. nem található az adatbázisban.']);
        }else{
            // mivel a menus táblában nincs sok adat, így itt visszatérhetünk az egész $menus objektummal
            // ellenkező esetben ajánlatos oszloponként visszatérni az értékekkel, majd az ajax success-nél JSON.parse után az aktuális javascript objektum elemeit kezelni!
            return response()->json([
                'success' => 1,
                'menus' => $menus
            ]);
        }
    }

    // // menüelem beállítások validátor
    // protected function validator_menu_save(array $data){
    //     $validator = Validator::make($data, [
    //         'menu_seoname' => 'max:191'
    //     ]);

    //     // ezzel a formulával tökéletesen működik a validátok!
    //     if($validator->fails()) { // csak ezzel ment
    //         return $validator->messages()->first(); // ezzel pedig a hibaüzenetet tudjuk megfelelően kiolvasni!
    //     }
    // }

    // menüelem beállításának mentése
    protected function menu_save(Request $request){
        // validáció -- akkor kell ha vannak olyan imputok amiknek a hossza - formátuma számít!
        // $errors = $this->validator_menu_save($request->all());
        // if($errors){
        //     return response()->json(['errors'=>$errors]);
        // }else{
            $menu_id = $request->menu_id;
            $menu = Menus::find($menu_id);

            if(empty($menu)){
                return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Menüelem menu_id: '.$menu_id.'. nem található az adatbázisban.']);
            }else{
                // if(!empty($request->menu_seoname)){
                //     $menu->seoname = $request->menu_seoname;
                // }
                // if(!empty($request->menu_page)){
                //     $menu->page_id = $request->menu_page;
                // }
                if(isset($request->menu_active) && isset($menu->highlighted)){
                    $menu->active = $request->menu_active;
                    $menu->highlighted = $request->menu_highlighted;
                }
                $menu->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $menu->save();

                return response()->json([
                    'success' => $request->menu_active
                ]);
            }
        // }
    }

    // menüelem beállítások validátor
    protected function validator_settings_analytics(array $data){
        $validator = Validator::make($data, [
            'analytics_textarea' => 'required'
        ]);

        // ezzel a formulával tökéletesen működik a validátok!
        if($validator->fails()) { // csak ezzel ment
            return $validator->messages()->first(); // ezzel pedig a hibaüzenetet tudjuk megfelelően kiolvasni!
        }
    }

    // beállítások - analytics beállítások
    protected function settings_analytics(Request $request){
        // validáció -- akkor kell ha vannak olyan imputok amiknek a hossza - formátuma számít!
        $errors = $this->validator_settings_analytics($request->all());
        if($errors){
            return response()->json(['errors'=>$errors]);
        }else{
            $id = $request->id;
            $settings = Settings::find($id);
            if(empty($settings)){
                return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Menüelem menu_id: '.$id.'. nem található az adatbázisban.']);
            }else{
                if(!empty($request->analytics_textarea)){
                    $settings->content = $request->analytics_textarea;
                }
                $settings->enabled = $request->analytics_on_off;
                $settings->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                $settings->save();

                return response()->json([
                    'success' => 1
                ]);
            }
        }
    }

    protected function settings_social(Request $request){
        $social_fb_on = $request->social_fb_on;
        $social_fb_url = $request->social_fb_url;
        $social_ig_on = $request->social_ig_on;
        $social_ig_url = $request->social_ig_url;

        // fb update - id = 6 jelenleg
        $social_fb = Settings::find(6);
        if(empty($social_fb)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Facebook 6-os id nem található az adatbázis settings táblájában.']);
        }else{
            $social_fb->enabled = $social_fb_on;
            if(!empty($social_fb_url)){
                $social_fb->content = $social_fb_url;
            }
            $social_fb->save();
        }

        // ig update - id = 7 jelenleg
        $social_ig = Settings::find(7);
        if(empty($social_ig)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Instagram 7-es id nem található az adatbázis settings táblájában.']);
        }else{
            $social_ig->enabled = $social_ig_on;
            if(!empty($social_ig_url)){
                $social_ig->content = $social_ig_url;
            }
            $social_ig->save();
        }

        return response()->json([
            'success' => 1
        ]);
    }

    protected function dark_mode(Request $request){
        $id = $request->id;
        $dark_mode = $request->dark_mode_on;
        $block = Blocks::find($id);
        if(empty($block)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Fv.: menus_order() Menüelem id: '.$id.'. nem található az adatbázisban.']);
        }else{
            $block->dark_mode = $dark_mode;
            $block->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $block->save();

            return response()->json([
                'success' => 1
            ]);
        }
    }
}
