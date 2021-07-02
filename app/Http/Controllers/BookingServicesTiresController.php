<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\BookingsServicesTires;
use App\Http\Controllers\Admin\PermissionsAdminController;
use App\Enums\PermissionsEnum;

class BookingServicesTiresController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'booking_id' => ['required', 'numeric'],
            'service_id' => ['required', 'numeric', 'digits_between:1,10']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }

    public function insert($bookingId, $serviceId)
    {
        // if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_BOOKING_MENU)) {
        //     return redirect()->route('admin/home');
        // }

        $bookingServices["booking_id"] = $bookingId;
        $bookingServices["service_id"] = $serviceId;
        $errors = $this->validator($bookingServices);
        if ($errors) {
            return $errors;
        } else {
            $bookingServicesTire = new BookingsServicesTires();
            $bookingServicesTire->booking_id = $bookingId;
            $bookingServicesTire->service_id = $serviceId;

            $bookingServicesTire->save();
            return $bookingServicesTire;
        }
    }
}
