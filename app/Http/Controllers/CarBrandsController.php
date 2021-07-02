<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\CarBrands;

class CarBrandsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAllCarBrands()
    {
        return CarBrands::all();
    }
}
