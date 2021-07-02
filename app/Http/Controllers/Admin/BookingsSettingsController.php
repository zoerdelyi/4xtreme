<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Enums\PermissionsEnum;
use App\BookingsSettings;
use App\WorkdaysTires;
use App\WorkdaysCars;

use App\OpeningHoursCars;
use App\OpeningHoursTires;

use Carbon\Carbon;

class BookingsSettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'date' => ['required', 'string', 'max:10']
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }

    public function index(){
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_BOOKING_MENU)) {
            return redirect()->route('admin/home');
        }

        $get_settings = BookingsSettings::all();

        $opening_hours_cars = OpeningHoursCars::all();
        $opening_hours_tires = OpeningHoursTires::all();

        // $get_workdays_tires = WorkdaysTires::all();
        // $get_workdays_cars = WorkdaysCars::all();

        // Ide kell szétosztani:
        // Rendkívüli nyitvatartás hozzáadása gumiszerviz / autószerviz
        // Ünnepnapok / Szabadnapok hozzáadása gumiszerviz / autószerviz

        // Ha rendkívüli, akkor is_work_day == 1
        // Ha rendkívüli, akkor Évet szűrni
        // Ha szabadnap, akkor is_work_day == 0
        // Ha szabadnap, akkor Évet és "*-03-10" formátumot is szűrni!

        // ELLENŐRZÉSE
        // if($get_workdays_tires->first()){}

        // Rendkívüli nyitvatartás hozzáadása gumiszerviz
        $get_workdays_tires = WorkdaysTires::where('is_work_day', '1')->where('date', 'LIKE', date('Y').'%')->orderBy('date')->get();

        // Rendkívüli nyitvatartás hozzáadása autószerviz
        $get_workdays_cars = WorkdaysCars::where('is_work_day', '1')->where('date', 'LIKE', date('Y').'%')->orderBy('date')->get();

        // Ünnepnapok / Szabadnapok hozzáadása gumiszerviz
        $get_non_workdays_tires = WorkdaysTires::where('is_work_day', '0')->where('date', 'LIKE', date('Y').'%')->orderBy('date')->get();
        $get_non_workdays_tires_repeat = WorkdaysTires::where('is_work_day', '0')->where('date', 'LIKE', '*-%')->orderBy('date')->get();

        // Ünnepnapok / Szabadnapok hozzáadása autószerviz
        $get_non_workdays_cars = WorkdaysCars::where('is_work_day', '0')->where('date', 'LIKE', date('Y').'%')->orderBy('date')->get();
        $get_non_workdays_cars_repeat = WorkdaysCars::where('is_work_day', '0')->where('date', 'LIKE', '*-%')->orderBy('date')->get();

        $tire_hours = explode('|', $get_settings[0]['content']);
        $tire_open = $tire_hours[0];
        $tire_close = $tire_hours[1];

        $car_hours = explode('|', $get_settings[1]['content']);
        $car_open = $car_hours[0];
        $car_close = $car_hours[1];

        $days_plus_tires = $get_settings[2]['content'];
        $days_plus_cars = $get_settings[3]['content'];

        $calendar_tires = $get_settings[4]['content'];
        $calendar_cars = $get_settings[5]['content'];

        $ebedszunet_gumis = explode('|', $get_settings[6]['content']);
        $ebedszunet_gumis_from = $ebedszunet_gumis[0];
        $ebedszunet_gumis_to = $ebedszunet_gumis[1];

        $ebedszunet_autos = explode('|', $get_settings[7]['content']);
        $ebedszunet_autos_from = $ebedszunet_autos[0];
        $ebedszunet_autos_to = $ebedszunet_autos[1];

        $settings_array = $this->get_settings_variables();
        return view('admin/content/bookingssettings')->with([
            'page_name' => $settings_array['page_name'],
            'hours_full' => $this->generate_hours('0:00', '23:30', '30'),
            'tire_open' => $tire_open,
            'tire_close' => $tire_close,
            'car_open' => $car_open,
            'car_close' => $car_close,
            'days_plus_tires' => $days_plus_tires,
            'days_plus_cars' => $days_plus_cars,
            'calendar_tires' => $calendar_tires,
            'calendar_cars' => $calendar_cars,
            'ebedszunet_gumis_from' => $ebedszunet_gumis_from,
            'ebedszunet_gumis_to' => $ebedszunet_gumis_to,
            'ebedszunet_autos_from' => $ebedszunet_autos_from,
            'ebedszunet_autos_to' => $ebedszunet_autos_to,

            'open_tire_mon_from' => date_format(date_create($opening_hours_tires[0]['start']),"H:i"),
            'open_tire_tue_from' => date_format(date_create($opening_hours_tires[1]['start']),"H:i"),
            'open_tire_wed_from' => date_format(date_create($opening_hours_tires[2]['start']),"H:i"),
            'open_tire_thu_from' => date_format(date_create($opening_hours_tires[3]['start']),"H:i"),
            'open_tire_fri_from' => date_format(date_create($opening_hours_tires[4]['start']),"H:i"),
            'open_tire_sat_from' => date_format(date_create($opening_hours_tires[5]['start']),"H:i"),
            'open_tire_mon_to' => date_format(date_create($opening_hours_tires[0]['end']),"H:i"),
            'open_tire_tue_to' => date_format(date_create($opening_hours_tires[1]['end']),"H:i"),
            'open_tire_wed_to' => date_format(date_create($opening_hours_tires[2]['end']),"H:i"),
            'open_tire_thu_to' => date_format(date_create($opening_hours_tires[3]['end']),"H:i"),
            'open_tire_fri_to' => date_format(date_create($opening_hours_tires[4]['end']),"H:i"),
            'open_tire_sat_to' => date_format(date_create($opening_hours_tires[5]['end']),"H:i"),

            'open_car_mon_from' => date_format(date_create($opening_hours_cars[0]['start']),"H:i"),
            'open_car_tue_from' => date_format(date_create($opening_hours_cars[1]['start']),"H:i"),
            'open_car_wed_from' => date_format(date_create($opening_hours_cars[2]['start']),"H:i"),
            'open_car_thu_from' => date_format(date_create($opening_hours_cars[3]['start']),"H:i"),
            'open_car_fri_from' => date_format(date_create($opening_hours_cars[4]['start']),"H:i"),
            'open_car_mon_to' => date_format(date_create($opening_hours_cars[0]['end']),"H:i"),
            'open_car_tue_to' => date_format(date_create($opening_hours_cars[0]['end']),"H:i"),
            'open_car_wed_to' => date_format(date_create($opening_hours_cars[0]['end']),"H:i"),
            'open_car_thu_to' => date_format(date_create($opening_hours_cars[0]['end']),"H:i"),
            'open_car_fri_to' => date_format(date_create($opening_hours_cars[0]['end']),"H:i"),
            'get_workdays_tires' => $get_workdays_tires,
            'get_workdays_cars' => $get_workdays_cars,
            'get_non_workdays_tires' => $get_non_workdays_tires,
            'get_non_workdays_tires_repeat' => $get_non_workdays_tires_repeat,
            'get_non_workdays_cars' => $get_non_workdays_cars,
            'get_non_workdays_cars_repeat' => $get_non_workdays_cars_repeat
        ]);
    }

    public function generate_hours($start, $end, $interval){
        $start = strtotime($start);
        $end = strtotime($end);
        $interval = $interval * 60; // interval másodpercekben
        $hours = array();
        for( $i = $start; $i <= $end; $i += $interval) {
            $hours[] = date('H:i', $i);
        }
        return $hours;
    }

    public function update_bookings_settings(Request $request){
        // $days_plus = $request->days_plus;
        $days_plus_cars = $request->days_plus_cars;
        $days_plus_tires = $request->days_plus_tires;
        $tire_open = $request->tire_open;
        $tire_close = $request->tire_close;
        $car_open = $request->car_open;
        $car_close = $request->car_close;
        $calendar_tires = $request->calendar_tires;
        $calendar_cars = $request->calendar_cars;
        
        $ebedszunet_gumis_from = $request->ebedszunet_gumis_from;
        $ebedszunet_gumis_to = $request->ebedszunet_gumis_to;
        $ebedszunet_autos_from = $request->ebedszunet_autos_from;
        $ebedszunet_autos_to = $request->ebedszunet_autos_to;

        $open_tire_1_from = $request->open_tire_1_from;
        $open_tire_2_from = $request->open_tire_2_from;
        $open_tire_3_from = $request->open_tire_3_from;
        $open_tire_4_from = $request->open_tire_4_from;
        $open_tire_5_from = $request->open_tire_5_from;
        $open_tire_6_from = $request->open_tire_6_from;
        $open_tire_1_to = $request->open_tire_1_to;
        $open_tire_2_to = $request->open_tire_2_to;
        $open_tire_3_to = $request->open_tire_3_to;
        $open_tire_4_to = $request->open_tire_4_to;
        $open_tire_5_to = $request->open_tire_5_to;
        $open_tire_6_to = $request->open_tire_6_to;

        $open_car_1_from = $request->open_car_1_from;
        $open_car_2_from = $request->open_car_2_from;
        $open_car_3_from = $request->open_car_3_from;
        $open_car_4_from = $request->open_car_4_from;
        $open_car_5_from = $request->open_car_5_from;
        $open_car_1_to = $request->open_car_1_to;
        $open_car_2_to = $request->open_car_2_to;
        $open_car_3_to = $request->open_car_3_to;
        $open_car_4_to = $request->open_car_4_to;
        $open_car_5_to = $request->open_car_5_to;

        // gumiszerviz update
        $tire_settings = BookingsSettings::find(1);
        if(empty($tire_settings)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 1 nem található az adatbázisban.']);
        }else{
            $tire_settings->content = $tire_open.'|'.$tire_close;
            $tire_settings->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $tire_settings->save();
        }

        // autószerviz update
        $car_settings = BookingsSettings::find(2);
        if(empty($car_settings)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 2 nem található az adatbázisban.']);
        }else{
            $car_settings->content = $car_open.'|'.$car_close;
            $car_settings->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $car_settings->save();
        }

        // kezdeti nap gumiszerviz update
        $days_settings_tires = BookingsSettings::find(3);
        if(empty($days_settings_tires)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 3 nem található az adatbázisban.']);
        }else{
            $days_settings_tires->content = $days_plus_tires;
            $days_settings_tires->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $days_settings_tires->save();
        }

        // kezdeti nap autószerviz update
        $days_settings_cars = BookingsSettings::find(4);
        if(empty($days_settings_cars)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 4 nem található az adatbázisban.']);
        }else{
            $days_settings_cars->content = $days_plus_cars;
            $days_settings_cars->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $days_settings_cars->save();
        }

        // Gumiszerviz foglalás aktív? update
        $calendar_tires_update = BookingsSettings::find(5);
        if(empty($calendar_tires_update)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 4 nem található az adatbázisban.']);
        }else{
            $calendar_tires_update->content = $calendar_tires;
            $calendar_tires_update->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $calendar_tires_update->save();
        }

        // Autószerviz foglalás aktív? update
        $calendar_cars_update = BookingsSettings::find(6);
        if(empty($calendar_cars_update)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 4 nem található az adatbázisban.']);
        }else{
            $calendar_cars_update->content = $calendar_cars;
            $calendar_cars_update->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $calendar_cars_update->save();
        }

        // Ebédszünet gumis update
        $ebedszunet_update = BookingsSettings::find(7);
        if(empty($ebedszunet_update)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 4 nem található az adatbázisban.']);
        }else{
            $ebedszunet_update->content = $ebedszunet_gumis_from.'|'.$ebedszunet_gumis_to;
            $ebedszunet_update->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $ebedszunet_update->save();
        }
        // Ebédszünet autós update
        $ebedszunet_update = BookingsSettings::find(8);
        if(empty($ebedszunet_update)){
            return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: 4 nem található az adatbázisban.']);
        }else{
            $ebedszunet_update->content = $ebedszunet_autos_from.'|'.$ebedszunet_autos_to;
            $ebedszunet_update->updated_at = Carbon::now()->format('Y-m-d H:i:s');
            $ebedszunet_update->save();
        }

        // nyitvatartás gumiszervíz update
        for($i = 1; $i < 7; $i++){
            $open_tire_act_day = OpeningHoursTires::find($i);
            if(empty($open_tire_act_day)){
                return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: '.$i.' nem található az adatbázisban.']);
            }else{
                $open_tire_act_day->start = ${'open_tire_'.$i.'_from'};
                $open_tire_act_day->end = ${'open_tire_'.$i.'_to'};
                $open_tire_act_day->save();
            }
        }

        // nyitvatartás autószerviz update
        for($i = 1; $i < 6; $i++){
            $open_tire_act_day = OpeningHoursCars::find($i);
            if(empty($open_tire_act_day)){
                return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Időpontfoglaló beállítások: ID: '.$i.' nem található az adatbázisban.']);
            }else{
                $open_tire_act_day->start = ${'open_car_'.$i.'_from'};
                $open_tire_act_day->end = ${'open_car_'.$i.'_to'};
                $open_tire_act_day->save();
            }
        }

        return response()->json([
            'success' => 1
        ]);
    }

    public function extradates_is_exists(Request $request){

        $date = $request->date;
        $tire_or_car = $request->tire_or_car;
        if($date >= date('Y-m-d')){

            // db ellenőrzés, majd ha ok akkor return success
            if($tire_or_car == 'tire'){
                $extradates_is_exists_rows = WorkdaysTires::where('date', $date)->get();
            }
            elseif($tire_or_car == 'car'){
                $extradates_is_exists_rows = WorkdaysCars::where('date', $date)->get();
            }

            if(count($extradates_is_exists_rows) > 0){
                return response()->json(['errors' => 'Már van ilyen dátum az adatbázisban!']);
            }
            else{
                return response()->json(['success' => 1]);
            }
        }
        else{
            return response()->json([
                'errors' => 'A kiválasztott nap nem eshet a mai napnál korábbi időpontra!' // a kiválasztott nap kisebb, mint a mai dátum..
            ]);
        }


    }

    public function extradates_upload(Request $request){

        $date = $request->date;
        $yearly_repeat = $request->yearly_repeat;
        $from_hour = $request->from_hour;
        $to_hour = $request->to_hour;
        $tire_or_car = $request->tire_or_car;
        $is_work_day = $request->is_work_day;

        // elndönteni, hogy ismétlődő-e az év
        if($yearly_repeat == 'true'){
            // ebben az esetben nincsenek hh:ii-k, csak yyyy-mm-dd --> végeredmény: pl.: *-01-01 kell hogy legyen
            $date = date("*-m-d", strtotime($date));
        }
            // ebben az esetben lehetnek hh:ii-k is!
            // VALIDÁCIÓ MAJD INSERT
            $errors = $this->validator($request->all());
            if ($errors) {
                return response()->json(['errors' => $errors]);
            } else {
                // ha van hh:ii
                if(!empty($from_hour) && !empty($to_hour)){
                    // megfelelő tábla kiválasztása
                    if($tire_or_car == 'tire'){
                        $workdays = WorkdaysTires::firstOrNew(array('date' => $date));
                    }else{
                        $workdays = WorkdaysCars::firstOrNew(array('date' => $date));
                    }
                    $workdays->date = $date;
                    $workdays->open_close = $from_hour.'|'.$to_hour;
                    $workdays->is_work_day = $is_work_day;
                    $workdays->save();
                    return response()->json(['success' => $workdays]);
                }else{
                    // megfelelő tábla kiválasztása
                    if($tire_or_car == 'tire'){
                        $workdays = WorkdaysTires::firstOrNew(array('date' => $date));
                    }else{
                        $workdays = WorkdaysCars::firstOrNew(array('date' => $date));
                    }
                    $workdays->date = $date;
                    $workdays->open_close = '';
                    $workdays->is_work_day = $is_work_day;
                    $workdays->save();
                    return response()->json(['success' => $workdays]);
                }
            }
    }

    public function extradates_list(Request $request){

        $tire_or_car = $request->tire_or_car;
        $is_work_day = $request->is_work_day;
        $by_year = $request->by_year;

        if($by_year != ''){
            $date_year = $by_year;
        }
        else{
            $date_year = date('Y');
        }

        if($tire_or_car != '' && $is_work_day != ''){

            // Ha rendkívüli, akkor is_work_day == 1
            // Ha rendkívüli, akkor Évet szűrni
            // Ha szabadnap, akkor is_work_day == 0
            // Ha szabadnap, akkor Évet és "*-03-10" formátumot is szűrni!

            // gumis
            if($tire_or_car == 'tire'){
                if($is_work_day == 1){
                    // Rendkívüli nyitvatartás hozzáadása gumiszerviz
                    $result_dates = WorkdaysTires::where('is_work_day', '1')->where('date', 'LIKE', $date_year.'%')->orderBy('date')->get();
                    $date_color = 'success';
                    $date_edit = 'btn_dates_open';
                }
                else{
                    // Ünnepnapok / Szabadnapok hozzáadása gumiszerviz
                    $result_dates = WorkdaysTires::where('is_work_day', '0')->where('date', 'LIKE', $date_year.'%')->orderBy('date')->get();
                    $result_dates_repeat = WorkdaysTires::where('is_work_day', '0')->where('date', 'LIKE', '*-%')->orderBy('date')->get();
                    $date_color = 'danger';
                    $date_edit = 'btn_dates_close';
                }
            }
            else{ // autós
                if($is_work_day == 1){
                    // Rendkívüli nyitvatartás hozzáadása autószerviz
                    $result_dates = WorkdaysCars::where('is_work_day', '1')->where('date', 'LIKE', $date_year.'%')->orderBy('date')->get();
                    $date_color = 'success';
                    $date_edit = 'btn_dates_open';
                }
                else{
                    // Ünnepnapok / Szabadnapok hozzáadása autószerviz
                    $result_dates = WorkdaysCars::where('is_work_day', '0')->where('date', 'LIKE', $date_year.'%')->orderBy('date')->get();
                    $result_dates_repeat = WorkdaysCars::where('is_work_day', '0')->where('date', 'LIKE', '*-%')->orderBy('date')->get();
                    $date_color = 'danger';
                    $date_edit = 'btn_dates_close';
                }
            }

            $dates_html = '';
            // ha van eredmény
            if($result_dates->first()){
                foreach($result_dates as $day){
                    $dates_html .= '<button type="button" data-id="'.$day->id.'" class="btn btn-'.$date_color.' btn-sm btn_dates btn_dates_ajax '.$date_edit .'">'.$day->date.' '.str_replace('|', ' - ', $day->open_close).'</button>';
                }
            }

            // ha van "ismétlődő évek" eredmény is
            if(isset($result_dates_repeat)){
                $dates_html .= '<div style="clear:both;"></div>';
                foreach($result_dates_repeat as $day){
                    $dates_html .= '<button type="button" data-id="'.$day->id.'" class="btn btn-'.$date_color.' btn-sm btn_dates btn_dates_ajax '.$date_edit .'">'.$day->date.' '.str_replace('|', ' - ', $day->open_close).'</button>';
                }
            }

            return response()->json([
                'success' => 1,
                'dates_html' => $dates_html
            ]);

        }
        else{
            return response()->json([
                'errors' => 'tire_or_car / is_work_day hiányzik!' // a kiválasztott nap kisebb, mint a mai dátum..
            ]);
        }
        
    }

    public function extradates_update_open(Request $request){

        $modal_parent_id = $request->modal_parent_id;
        $modal_date_id = $request->modal_date_id;
        $modal_only_date = $request->modal_only_date;
        $modal_only_from = $request->modal_only_from;
        $modal_only_to = $request->modal_only_to;
        $modal_yearly = $request->modal_yearly;

        // év meghatározása:
        $modal_only_year = explode('-', $modal_only_date);
        $modal_only_year = $modal_only_year[0];

        if($modal_yearly == '1'){
            $modal_only_date = date("*-m-d", strtotime($modal_only_date));
        }

        // tire táblába kell updatelni
        if($modal_parent_id == 'extradates_tire_open_list' || $modal_parent_id == 'extradates_tire_close_list'){
            
            // 1. előlekérdezés - van-e ilyen date
            // $extradates_is_exists_rows = WorkdaysTires::where('date', $modal_only_date)->get();
            $extradates_is_exists_rows = WorkdaysTires::where('date', $modal_only_date)->where('id', '!=', $modal_date_id)->get();

            if(count($extradates_is_exists_rows) > 0){
                return response()->json(['errors' => 'Már van ilyen dátum az adatbázisban!']);
            }
            else{
                // 2. update
                $tire_dates = WorkdaysTires::find($modal_date_id);
                if(empty($tire_dates)){
                    return response()->json(['errors' => '<storng>Adatázis hiba!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
                }else{
                    $tire_dates->date = $modal_only_date;
                    $tire_dates->open_close = $modal_only_from.'|'.$modal_only_to;
                    $tire_dates->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                    $tire_dates->save();

                    return response()->json([
                        'success' => $tire_dates,
                        'tire_or_car' => 'tire',
                        'only_year' => $modal_only_year
                    ]);
                }
            }

        }
        elseif($modal_parent_id == 'extradates_car_open_list' || $modal_parent_id == 'extradates_car_close_list'){ // car táblába kell updatelni

            // $extradates_is_exists_rows = WorkdaysCars::where('date', $modal_only_date)->get();
            $extradates_is_exists_rows = WorkdaysCars::where('date', $modal_only_date)->where('id', '!=', $modal_date_id)->get();
            if(count($extradates_is_exists_rows) > 0){
                return response()->json(['errors' => 'Már van ilyen dátum az adatbázisban!']);
            }
            else{
                // 2. update
                $tire_dates = WorkdaysCars::find($modal_date_id);
                if(empty($tire_dates)){
                    return response()->json(['errors' => '<storng>Adatázis hiba!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
                }else{
                    $tire_dates->date = $modal_only_date;
                    $tire_dates->open_close = $modal_only_from.'|'.$modal_only_to;
                    $tire_dates->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                    $tire_dates->save();

                    return response()->json([
                        'success' => $tire_dates,
                        'tire_or_car' => 'car',
                        'only_year' => $modal_only_year
                    ]);
                }
            }

        }
    }

    public function extradates_update_close(Request $request){

        $modal_parent_id = $request->modal_parent_id;
        $modal_date_id = $request->modal_date_id;
        $modal_only_date = $request->modal_only_date;
        $modal_yearly = $request->modal_yearly;

        // év meghatározása:
        $modal_only_year = explode('-', $modal_only_date);
        $modal_only_year = $modal_only_year[0];

        if($modal_yearly == 'true'){
            $modal_only_date = date("*-m-d", strtotime($modal_only_date));
        }

        // tire táblába kell updatelni
        if($modal_parent_id == 'extradates_tire_open_list' || $modal_parent_id == 'extradates_tire_close_list'){
            
            // 1. előlekérdezés - van-e ilyen date
            // $extradates_is_exists_rows = WorkdaysTires::where('date', $modal_only_date)->get();
            $extradates_is_exists_rows = WorkdaysTires::where('date', $modal_only_date)->where('id', '!=', $modal_date_id)->get();

            if(count($extradates_is_exists_rows) > 0){
                return response()->json(['errors' => 'Már van ilyen dátum az adatbázisban!']);
            }
            else{
                // 2. update
                $tire_dates = WorkdaysTires::find($modal_date_id);
                if(empty($tire_dates)){
                    return response()->json(['errors' => '<storng>Adatázis hiba!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
                }else{
                    $tire_dates->date = $modal_only_date;
                    $tire_dates->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                    $tire_dates->save();

                    return response()->json([
                        'success' => $tire_dates,
                        'tire_or_car' => 'tire',
                        'only_year' => $modal_only_year
                    ]);
                }
            }

        }
        elseif($modal_parent_id == 'extradates_car_open_list' || $modal_parent_id == 'extradates_car_close_list'){ // car táblába kell updatelni

            // $extradates_is_exists_rows = WorkdaysCars::where('date', $modal_only_date)->get();
            $extradates_is_exists_rows = WorkdaysCars::where('date', $modal_only_date)->where('id', '!=', $modal_date_id)->get();
            if(count($extradates_is_exists_rows) > 0){
                return response()->json(['errors' => 'Már van ilyen dátum az adatbázisban!']);
            }
            else{
                // 2. update
                $tire_dates = WorkdaysCars::find($modal_date_id);
                if(empty($tire_dates)){
                    return response()->json(['errors' => '<storng>Adatázis hiba!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
                }else{
                    $tire_dates->date = $modal_only_date;
                    $tire_dates->updated_at = Carbon::now()->format('Y-m-d H:i:s');
                    $tire_dates->save();

                    return response()->json([
                        'success' => $tire_dates,
                        'tire_or_car' => 'car',
                        'only_year' => $modal_only_year
                    ]);
                }
            }

        }
    }

    public function extradates_delete_open(Request $request){

        $modal_parent_id = $request->modal_parent_id;
        $modal_date_id = $request->modal_date_id;
        $modal_only_date = $request->modal_only_date;

        // év meghatározása:
        $modal_only_year = explode('-', $modal_only_date);
        $modal_only_year = $modal_only_year[0];

        // tire táblába kell deletelni
        if($modal_parent_id == 'extradates_tire_open_list' || $modal_parent_id == 'extradates_tire_close_list'){

            $deleted_row = WorkdaysTires::where('id', $modal_date_id)->delete();

            if($deleted_row){
                return response()->json([
                    'success' => $deleted_row,
                    'tire_or_car' => 'tire'
                ]);
            }
            else{
                return response()->json(['errors' => '<storng>Adatázis hiba, törlés sikertelen!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
            }

        }
        elseif($modal_parent_id == 'extradates_car_open_list' || $modal_parent_id == 'extradates_car_close_list'){ // car táblába kell deletelni

            $deleted_row = WorkdaysCars::where('id', $modal_date_id)->delete();

            if($deleted_row){
                return response()->json([
                    'success' => $deleted_row,
                    'tire_or_car' => 'car'
                ]);
            }
            else{
                return response()->json(['errors' => '<storng>Adatázis hiba, törlés sikertelen!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
            }

        }
        
    }

    public function extradates_delete_close(Request $request){
        
        $modal_parent_id = $request->modal_parent_id;
        $modal_date_id = $request->modal_date_id;
        $modal_only_date = $request->modal_only_date;

        // év meghatározása:
        $modal_only_year = explode('-', $modal_only_date);
        $modal_only_year = $modal_only_year[0];

        // tire táblába kell deletelni
        if($modal_parent_id == 'extradates_tire_open_list' || $modal_parent_id == 'extradates_tire_close_list'){

            $deleted_row = WorkdaysTires::where('id', $modal_date_id)->delete();

            if($deleted_row){
                return response()->json([
                    'success' => $deleted_row,
                    'tire_or_car' => 'tire'
                ]);
            }
            else{
                return response()->json(['errors' => '<storng>Adatázis hiba, törlés sikertelen!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
            }

        }
        elseif($modal_parent_id == 'extradates_car_open_list' || $modal_parent_id == 'extradates_car_close_list'){ // car táblába kell deletelni

            $deleted_row = WorkdaysCars::where('id', $modal_date_id)->delete();

            if($deleted_row){
                return response()->json([
                    'success' => $deleted_row,
                    'tire_or_car' => 'car'
                ]);
            }
            else{
                return response()->json(['errors' => '<storng>Adatázis hiba, törlés sikertelen!</strong> ID: '.$modal_date_id.' nem található az adatbázisban.']);
            }

        }

    }

}
