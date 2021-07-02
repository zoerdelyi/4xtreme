<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BlocksTemplate;
use App\Blocks;
use App\Pages;

class BlocksController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function GetPage($id){

        $page = Pages::find($id);
        // megkeresi az adott oldalnál a blocks_ids értékeket (string (1,2,3,4))
        $blocks_ids = $page->blocks_ids;

        // a blocks_ids stringként van elmentve, így egy explode-al tömbbé konvertálva lekérdezhetjük az értékeket
        $exploded_ids = explode(',', $blocks_ids);

        $blocks = Blocks::find($exploded_ids);

        // az eredeti sorrend helyreállítása érdekében ezt a módszert használhatjuk:
        // https://stackoverflow.com/questions/40731863/sort-collection-by-custom-order-in-eloquent
        $blocks = $blocks->sortBy(function($model) use ($exploded_ids) {
            return array_search($model->getKey(), $exploded_ids);
        });

        // az összes blokkra is szükségünk van:
        $blocks_all = Blocks::all();

        $settings_array = $this->get_settings_variables();
        return view('admin/content/editpage')->with([
            'blocks' => $blocks,
            'page' => $page,
            'blocks_all' => $blocks_all,
            'page_name' => $settings_array['page_name']
        ]);
    }
}
