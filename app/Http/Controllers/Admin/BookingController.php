<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BookingsServicesCars;
use App\BookingsServicesTires;
use App\BookingsSettings;

use App\Enums\PermissionsEnum;
use App\Http\Controllers\BookingsCarsController;
use App\Http\Controllers\VisitorsController;
use App\Http\Controllers\BookingServicesCarsController;
use App\Http\Controllers\BookingServicesTiresController;
use App\Http\Controllers\BookingsTiresController;
use App\Http\Controllers\Robot\SendEmailsController;
use Illuminate\Support\Facades\Request as FacadesRequest;

use Carbon\Carbon;

use App\Http\Controllers\CarBrandsController;

class BookingController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');

        $this->paginate = 50; // ennyi sor legyen. értéke eggyezzen meg = $('#tf_maxitems').val() kiinduló értékével!
    }

    public function index(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_BOOKING_MENU)) {
            return redirect()->route('admin/home');
        }

        $start_date = Carbon::now();
        // $end_date = Carbon::now()->addDays(30);
        $end_date = Carbon::now();

        $cars = BookingsServicesCars::join('bookings_cars', 'bookings_services_cars.booking_id', '=', 'bookings_cars.id')
        ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
        ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
        ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
        ->join('car_brands', 'bookings_cars.car_brand_id', '=', 'car_brands.id')
        ->where('bookings_cars.deleted', NULL)
        ->whereDate('start_time', '>=', $start_date->format('Y-m-d'))
        ->whereDate('start_time', '<=', $end_date->format('Y-m-d'))
        ->select(
            'bookings_cars.*',
            'bookings_cars.id AS booking_id',
            'visitors.name AS visotors_name',
            'visitors.email AS visotors_email',
            'visitors.phone AS visotors_phone',
            'visitors.is_valid_data AS visotors_is_valid_data',
            'services_cars.name AS services_cars_name',
            'services_cars.gross_price AS services_cars_gross_price',
            'services_cars.net_price AS services_cars_net_price',
            'car_brands.name AS car_brand',
            'car_types.name AS car_type'
        )
        ->orderBy('start_time', 'ASC')
        ->paginate($this->paginate);

        $tires = BookingsServicesTires::join('bookings_tires', 'bookings_services_tires.booking_id', '=', 'bookings_tires.id')
        ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
        ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
        ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
        ->join('car_brands', 'bookings_tires.car_brand_id', '=', 'car_brands.id')
        ->where('bookings_tires.deleted', NULL)
        ->whereDate('start_time', '>=', $start_date->format('Y-m-d'))
        ->whereDate('start_time', '<=', $end_date->format('Y-m-d'))
        ->select(
            'bookings_tires.*',
            'bookings_tires.id AS booking_id',
            'visitors.name AS visotors_name',
            'visitors.email AS visotors_email',
            'visitors.phone AS visotors_phone',
            'visitors.is_valid_data AS visotors_is_valid_data',
            'services_tires.name AS services_tires_name',
            'services_tires.gross_price AS services_tires_gross_price',
            'services_tires.net_price AS services_tires_net_price',
            'car_brands.name AS car_brand',
            'car_types.name AS car_type'
        )
        ->orderBy('start_time', 'ASC')
        ->paginate($this->paginate);
        
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

        
        return view('admin/content/booking')->with([
            'page_name' => $settings_array['page_name'],
            'car_brands' => $carBrandsController->getAllCarBrands(),
            'calendar_tires' => $calendar_tires,
            'calendar_cars' => $calendar_cars,
            'calendar_options' => $calendar_options,
            'cars' => $cars,
            'tires' => $tires,
            'paginate' => $this->paginate,
            'start_date' => $start_date->format('Y-m-d'),
            'end_date' => $end_date->format('Y-m-d'),
        ]);
    }

    public function filter_tires(Request $request){

        $tires = BookingsServicesTires::join('bookings_tires', 'bookings_services_tires.booking_id', '=', 'bookings_tires.id')
        ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
        ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
        ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
        ->join('car_brands', 'car_types.brand_id', '=', 'car_brands.id')
        ->where('bookings_tires.deleted', NULL)
        ->select(
            'bookings_tires.*',
            'bookings_tires.id AS booking_id',
            'visitors.name AS visotors_name',
            'visitors.email AS visotors_email',
            'visitors.phone AS visotors_phone',
            'visitors.is_valid_data AS visotors_is_valid_data',
            'services_tires.name AS services_tires_name',
            'services_tires.gross_price AS services_tires_gross_price',
            'services_tires.net_price AS services_tires_net_price',
            'car_brands.name AS car_brand',
            'car_types.name AS car_type'
        )
        ->orderBy('start_time', 'ASC');

        $tf_licence_plate = $request['tf_licence_plate'];
        $tf_comment = $request['tf_comment'];
        $tf_name = $request['tf_name'];
        $tf_phone = $request['tf_phone'];
        $tf_date_from = $request['tf_date_from'];
        $tf_date_to = $request['tf_date_to'];
        $tf_payment_type = $request['tf_payment_type'];
        $tf_maxitems = $request['tf_maxitems'];
        $page = $request['page'];
        $length = $request['length'];

        if ($tf_licence_plate != null) {
            $tires = $tires->where('licence_plate', 'like', '%'.$tf_licence_plate.'%');
        }

        if ($tf_comment != null) {
            $tires = $tires->where('comment', 'like', '%'.$tf_comment.'%');
        }

        if ($tf_name != null) {
            $tires = $tires->where('visitors.name', 'like', '%'.$tf_name.'%');
        }

        if ($tf_phone != null) {
            $tires = $tires->where('visitors.phone', 'like', '%'.$tf_phone.'%');
        }

        if ($tf_date_from != null && $tf_date_to != null) {
            $tires = $tires->whereDate('start_time', '>=', Carbon::parse($tf_date_from)->format('Y-m-d'))->whereDate('start_time', '<=', Carbon::parse($tf_date_to)->format('Y-m-d'));
        }

        if ($tf_payment_type != null) {
            $tires = $tires->where('payment_type', '=', $tf_payment_type);
        }

        if($tf_maxitems != 0){
            $tires = $tires->paginate($tf_maxitems);
        }
        else{
            $tires = $tires->paginate(99999999999999999);
        }

        if($tires->first()){
            return view('admin.content.tables.tires_table', compact('tires'))->render();
        }
        else{
            return '<p class="mt-3">Nincs a keresésnek megfelelő találat!</p>';
        }
        
    }

    public function filter_cars(Request $request){

        $cars = BookingsServicesCars::join('bookings_cars', 'bookings_services_cars.booking_id', '=', 'bookings_cars.id')
        ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
        ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
        ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
        ->join('car_brands', 'car_types.brand_id', '=', 'car_brands.id')
        ->where('bookings_cars.deleted', NULL)
        ->select(
            'bookings_cars.*',
            'bookings_cars.id AS booking_id',
            'visitors.name AS visotors_name',
            'visitors.email AS visotors_email',
            'visitors.phone AS visotors_phone',
            'visitors.is_valid_data AS visotors_is_valid_data',
            'services_cars.name AS services_cars_name',
            'services_cars.gross_price AS services_cars_gross_price',
            'services_cars.net_price AS services_cars_net_price',
            'car_brands.name AS car_brand',
            'car_types.name AS car_type'
        )
        ->orderBy('start_time', 'ASC');

        $cf_licence_plate = $request['cf_licence_plate'];
        $cf_comment = $request['cf_comment'];
        $cf_name = $request['cf_name'];
        $cf_phone = $request['cf_phone'];
        $cf_date_from = $request['cf_date_from'];
        $cf_date_to = $request['cf_date_to'];
        $cf_payment_type = $request['cf_payment_type'];
        $cf_maxitems = $request['cf_maxitems'];
        $page = $request['page'];
        $length = $request['length'];

        if ($cf_licence_plate != null) {
            $cars = $cars->where('licence_plate', 'like', '%'.$cf_licence_plate.'%');
        }

        if ($cf_comment != null) {
            $cars = $cars->where('comment', 'like', '%'.$cf_comment.'%');
        }

        if ($cf_name != null) {
            $cars = $cars->where('visitors.name', 'like', '%'.$cf_name.'%');
        }

        if ($cf_phone != null) {
            $cars = $cars->where('visitors.phone', 'like', '%'.$cf_phone.'%');
        }

        if ($cf_date_from != null && $cf_date_to != null) {
            $cars = $cars->whereDate('start_time', '>=', Carbon::parse($cf_date_from)->format('Y-m-d'))->whereDate('start_time', '<=', Carbon::parse($cf_date_to)->format('Y-m-d'));
        }

        if ($cf_payment_type != null) {
            $cars = $cars->where('payment_type', '=', $cf_payment_type);
        }

        if($cf_maxitems != 0){
            $cars = $cars->paginate($cf_maxitems);
        }
        else{
            $cars = $cars->paginate(99999999999999999);
        }

        if($cars->first()){
            return view('admin.content.tables.cars_table', compact('cars'))->render();
        }
        else{
            return '<p class="mt-3">Nincs a keresésnek megfelelő találat!</p>';
        }
        
    }

    public function bookingtoday(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_BOOKING_MENU)) {
            return redirect()->route('admin/home');
        }

        $start_date = Carbon::now();
        $end_date = Carbon::now();

        $cars = BookingsServicesCars::join('bookings_cars', 'bookings_services_cars.booking_id', '=', 'bookings_cars.id')
        ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
        ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
        ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
        ->join('car_brands', 'car_types.brand_id', '=', 'car_brands.id')
        ->where('bookings_cars.deleted', NULL)
        ->whereDate('start_time', '>=', $start_date->format('Y-m-d'))
        ->whereDate('start_time', '<=', $end_date->format('Y-m-d'))
        ->select(
            'bookings_cars.*',
            'bookings_cars.id AS booking_id',
            'visitors.name AS visotors_name',
            'visitors.email AS visotors_email',
            'visitors.phone AS visotors_phone',
            'visitors.is_valid_data AS visotors_is_valid_data',
            'services_cars.name AS services_cars_name',
            'services_cars.gross_price AS services_cars_gross_price',
            'services_cars.net_price AS services_cars_net_price',
            'car_brands.name AS car_brand',
            'car_types.name AS car_type'
        )
        ->orderBy('start_time', 'ASC')
        ->paginate($this->paginate);

        $tires = BookingsServicesTires::join('bookings_tires', 'bookings_services_tires.booking_id', '=', 'bookings_tires.id')
        ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
        ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
        ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
        ->join('car_brands', 'car_types.brand_id', '=', 'car_brands.id')
        ->where('bookings_tires.deleted', NULL)
        ->whereDate('start_time', '>=', $start_date->format('Y-m-d'))
        ->whereDate('start_time', '<=', $end_date->format('Y-m-d'))
        ->select(
            'bookings_tires.*',
            'bookings_tires.id AS booking_id',
            'visitors.name AS visotors_name',
            'visitors.email AS visotors_email',
            'visitors.phone AS visotors_phone',
            'visitors.is_valid_data AS visotors_is_valid_data',
            'services_tires.name AS services_tires_name',
            'services_tires.gross_price AS services_tires_gross_price',
            'services_tires.net_price AS services_tires_net_price',
            'car_brands.name AS car_brand',
            'car_types.name AS car_type'
        )
        ->orderBy('start_time', 'ASC')
        ->paginate($this->paginate);
        
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

        
        return view('admin/content/booking_today')->with([
            'page_name' => $settings_array['page_name'],
            'car_brands' => $carBrandsController->getAllCarBrands(),
            'calendar_tires' => $calendar_tires,
            'calendar_cars' => $calendar_cars,
            'calendar_options' => $calendar_options,
            'cars' => $cars,
            'tires' => $tires,
            'paginate' => $this->paginate,
            'start_date' => $start_date->format('Y-m-d'),
            'end_date' => $end_date->format('Y-m-d'),
        ]);
    }

    protected function insert(Request $request) {
        $booking = $request->bookingData;
        $type = $request->type;

        $bookingRequest['car_brand_id'] = $booking['car']['brand'];
        $bookingRequest['car_type_id'] = $booking['car']['type'];
        $bookingRequest['comment'] = $booking['booking']['comment'];
        $bookingRequest['start_time'] = $booking['booking']['startTime'];
        $bookingRequest['end_time'] = $booking['booking']['endTime'];
        $bookingRequest['dateMins'] = $booking['booking']['dateMins'];
        $bookingRequest['licence_plate'] = $booking['car']['licencePlate'];

        if ($type == "car") {
            return  response()->json($this->bookingCars($bookingRequest, $booking['visitor'], $booking['service_id']));
        } else if ($type == "tire") {
            return response()->json($this->bookingTires( $bookingRequest, $booking['visitor'], $booking['service_id']));
        }
    }

    protected function insert_admin(Request $request) {
        $booking = $request->bookingData;
        $type = $request->type;
        $mode = $request->mode;

        $booking_car_brand = (!isset($booking['car']['brand'])) ? 1 : $booking['car']['brand'];
        $booking_car_type = (!isset($booking['car']['type'])) ? 1 : $booking['car']['type'];

        $bookingRequest['car_brand_id'] = $booking_car_brand;
        $bookingRequest['car_type_id'] = $booking_car_type;
        $bookingRequest['car_brand_other'] = $booking['car']['brand_other'];
        $bookingRequest['car_type_other'] = $booking['car']['type_other'];
        $bookingRequest['comment'] = $booking['booking']['comment'];
        $bookingRequest['start_time'] = $booking['booking']['startTime'];
        $bookingRequest['end_time'] = $booking['booking']['endTime'];
        if(isset($booking['booking']['dateMins'])){
            $bookingRequest['dateMins'] = $booking['booking']['dateMins'];
        }
        // $bookingRequest['start_time'] = date("Y. m. d. H:i", strtotime($booking['booking']['startTime']));
        // $bookingRequest['end_time'] = date("Y. m. d. H:i", strtotime($booking['booking']['endTime']));
        $bookingRequest['licence_plate'] = $booking['car']['licencePlate'];
        $bookingRequest['tire_parking'] = $booking['tireParking'];

        $bookingRequest['motortip'] = $booking['motortip'];
        $bookingRequest['alvaz'] = $booking['alvaz'];
        $bookingRequest['cm3'] = $booking['cm3'];
        $bookingRequest['teljesitmeny'] = $booking['teljesitmeny'];

        if ($type == "car") {
            return  response()->json($this->bookingCars_admin($bookingRequest, $booking['visitor'], $booking['service_id'], $mode));
        } else if ($type == "tire") {
            return response()->json($this->bookingTires_admin( $bookingRequest, $booking['visitor'], $booking['service_id'], $mode));
        }
    }

    private function bookingCars($bookingRequest, $visitor, $serviceId) {

        // A felhasználó rögzítését direkt ide tette, mert itt már ellenörízve van, hogy jó típusba fogja menteni
        $visitorsController = new VisitorsController;
        $visitorsResponse = $visitorsController->insert( $visitor);
        if (!isset($visitorsResponse->id)) {
            return ['errors' => $visitorsResponse];
        }
        //FIXME foglalás megerősítése
        $bookingsCarsController = new BookingsCarsController;
        $bookingRequest['visitor_id'] = $visitorsResponse->id;
        $bookingResponse = $bookingsCarsController->insert($bookingRequest);
        if (!isset($bookingResponse->id)) {
            return ['errors' => $bookingResponse];
        }

        $bookingServicesCarsController = new BookingServicesCarsController();
        $bookingServicesCarsController->insert($bookingResponse->id, $serviceId);
        if (!isset($bookingResponse->id)) {
            return ['errors' => $bookingServicesCarsController];
        } else {
            return ['success' => $bookingServicesCarsController];
        }
    }

    private function bookingCars_admin($bookingRequest, $visitor, $serviceId, $mode) {

        // A felhasználó rögzítését direkt ide tette, mert itt már ellenörízve van, hogy jó típusba fogja menteni

        // csak akkor legyen Visitors DB insert, ha meg van adva legalább egy adat!
        if($visitor['name'] != null || $visitor['email'] != null || $visitor['phone'] != null){

            if($visitor['name'] == null){
                $visitor['name'] = '';
            }
            if($visitor['email'] == null){
                $visitor['email'] = '';
            }
            if($visitor['phone'] == null){
                $visitor['phone'] = '';
            }

            $visitorsController = new VisitorsController;
            $visitorsResponse = $visitorsController->insert_admin( $visitor);
            if (!isset($visitorsResponse->id)) {
                return ['errors' => $visitorsResponse];
            }
            $bookingRequest['visitor_id'] = $visitorsResponse->id;
        }
        else{
            // NOTSET beállítása visitors ID-re!
            $bookingRequest['visitor_id'] = 1;
        }

        $bookingsCarsController = new BookingsCarsController;

        if($bookingRequest == null){
            $bookingRequest = '';
        }
        
        $bookingResponse = $bookingsCarsController->insert($bookingRequest, $mode);
        if (!isset($bookingResponse->id)) {
            return ['errors' => $bookingResponse];
        }

        if($serviceId != null){
            $bookingServicesCarsController = new BookingServicesCarsController();
            $bookingServicesCarsController->insert($bookingResponse->id, $serviceId);
            if (!isset($bookingResponse->id)) {
                return ['errors' => $bookingServicesCarsController];
            } else {

                //FIXME foglalás megerősítése
                if($visitor['email'] != ''){
                    if($mode == 'visitor'){
                        
                        // látogatói foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        $sendEmailsResponse = $sendEmailsController->send_email_booking_confirm($visitor['name'], $visitor['email'], $bookingResponse['confirm_hash'], 'car');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                    elseif($mode == 'admin'){
                        // admin foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        
                        $sendEmailsResponse = $sendEmailsController->admin_send_email_booking_confirm_after($admin_activate = 1, $bookingResponse->id, 'car');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                }

                return ['success' => $bookingServicesCarsController];
            }
        }
        else{
            $bookingServicesCarsController = new BookingServicesCarsController();
            $bookingServicesCarsController->insert($bookingResponse->id, 1);
            if (!isset($bookingResponse->id)) {
                return ['errors' => $bookingServicesCarsController];
            } else {

                //FIXME foglalás megerősítése
                if($visitor['email'] != ''){
                    if($mode == 'visitor'){
                        
                        // látogatói foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        $sendEmailsResponse = $sendEmailsController->send_email_booking_confirm($visitor['name'], $visitor['email'], $bookingResponse['confirm_hash'], 'car');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                    elseif($mode == 'admin'){
                        // admin foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        
                        $sendEmailsResponse = $sendEmailsController->admin_send_email_booking_confirm_after($admin_activate = 1, $bookingResponse->id, 'car');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                }

                return ['success' => $bookingServicesCarsController];
            }
        }
    }

    private function bookingTires( $bookingRequest, $visitor, $serviceId) {
        // A felhasználó rögzítését direkt ide tette, mert itt már ellenörízve van, hogy jó típusba fogja menteni
        $visitorsController = new VisitorsController;
        $visitorsResponse = $visitorsController->insert( $visitor);
        if (!isset($visitorsResponse->id)) {
            return ['errors' => $visitorsResponse];
        }
        //FIXME foglalás megerősítése
        $bookingTiresController = new BookingsTiresController;
        $bookingRequest['visitor_id'] = $visitorsResponse->id;
        $bookingResponse = $bookingTiresController->insert($bookingRequest);
        if (!isset($bookingResponse->id)) {
            return ['errors' => $bookingResponse];
        }

        $bookingServicesTiresController = new BookingServicesTiresController();
        $bookingServicesTiresController->insert($bookingResponse->id, $serviceId);
        if (!isset($bookingResponse->id)) {
            return ['errors' => $bookingServicesTiresController];
        } else {
            return ['success' => $bookingServicesTiresController];
        }
    }

    private function bookingTires_admin( $bookingRequest, $visitor, $serviceId, $mode) {
        // A felhasználó rögzítését direkt ide tette, mert itt már ellenörízve van, hogy jó típusba fogja menteni

        // csak akkor legyen Visitors DB insert, ha meg van adva legalább egy adat!
        if($visitor['name'] != null || $visitor['email'] != null || $visitor['phone'] != null){

            if($visitor['name'] == null){
                $visitor['name'] = '';
            }
            if($visitor['email'] == null){
                $visitor['email'] = '';
            }
            if($visitor['phone'] == null){
                $visitor['phone'] = '';
            }

            $visitorsController = new VisitorsController;
            $visitorsResponse = $visitorsController->insert_admin( $visitor);
            if (!isset($visitorsResponse->id)) {
                return ['errors' => $visitorsResponse];
            }
            $bookingRequest['visitor_id'] = $visitorsResponse->id;
        }
        else{
            // NOTSET beállítása visitors ID-re!
            $bookingRequest['visitor_id'] = 1;
        }

        $BookingsTiresController = new BookingsTiresController;

        if($bookingRequest == null){
            $bookingRequest = '';
        }
        
        $bookingResponse = $BookingsTiresController->insert($bookingRequest, $mode);
        if (!isset($bookingResponse->id)) {
            return ['errors' => $bookingResponse];
        }

        if($serviceId != null){
            $bookingServicesTiresController = new BookingServicesTiresController();
            $bookingServicesTiresController->insert($bookingResponse->id, $serviceId);
            if (!isset($bookingResponse->id)) {
                return ['errors' => $bookingServicesTiresController];
            } else {

                //FIXME foglalás megerősítése
                if($visitor['email'] != ''){
                    if($mode == 'visitor'){
                        
                        // látogatói foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        $sendEmailsResponse = $sendEmailsController->send_email_booking_confirm($visitor['name'], $visitor['email'], $bookingResponse['confirm_hash'], 'tire');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                    elseif($mode == 'admin'){
                        // admin foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        
                        $sendEmailsResponse = $sendEmailsController->admin_send_email_booking_confirm_after($admin_activate = 1, $bookingResponse->id, 'tire');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                }

                return ['success' => $bookingServicesTiresController];
            }
        }
        else{
            $bookingServicesTiresController = new BookingServicesTiresController();
            $bookingServicesTiresController->insert($bookingResponse->id, 1);
            if (!isset($bookingResponse->id)) {
                return ['errors' => $bookingServicesTiresController];
            } else {
                //FIXME foglalás megerősítése
                if($visitor['email'] != ''){
                    if($mode == 'visitor'){
                        // látogatói foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        $sendEmailsResponse = $sendEmailsController->send_email_booking_confirm($visitor['name'], $visitor['email'], $bookingResponse['confirm_hash'], 'tire');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                    elseif($mode == 'admin'){
                        // admin foglalás megerősítése
                        $sendEmailsController = new SendEmailsController;
                        
                        $sendEmailsResponse = $sendEmailsController->admin_send_email_booking_confirm_after($admin_activate = 1, $bookingResponse->id, 'tire');

                        if ($sendEmailsResponse == 0) {
                            return ['errors' => 'Megerősítő email kiküldése sikertelen!'];
                        }
                    }
                }

                return ['success' => $bookingServicesTiresController];
            }
        }
    }
}
