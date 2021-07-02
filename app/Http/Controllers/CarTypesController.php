<?php

namespace App\Http\Controllers;

use App\CarTypes;

class CarTypesController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function getAllCarBrands($brandId)
    {
        $carTypes = CarTypes::where('brand_id', $brandId)->get();
        if (empty( $carTypes)) {
            return response()->json(['errors' => "Nem található ehhez a modellhez autó típus"]);
        } else {
            return response()->json(['success' => $carTypes]);
        }
    }
}
