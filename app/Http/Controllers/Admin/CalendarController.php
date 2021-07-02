<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\PermissionsEnum;

use App\Http\Controllers\CarBrandsController;

use App\BookingsSettings;

class CalendarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // use DatesTrait;
    public function index(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_BOOKING_MENU)) {
            return redirect()->route('admin/home');
        }

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

        $settings_array = $this->get_settings_variables();
        $carBrandsController = new CarBrandsController;
        return view('admin/content/calendar')->with([
            'page_name' => $settings_array['page_name'],
            'car_brands' => $carBrandsController->getAllCarBrands(),
            'calendar_tires' => $calendar_tires,
            'calendar_cars' => $calendar_cars,
            'calendar_options' => $calendar_options
        ]);
    }
}