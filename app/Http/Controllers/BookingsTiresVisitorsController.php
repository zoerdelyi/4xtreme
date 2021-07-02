<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use DateTime;
use DateInterval;
use DatePeriod;
use App\Workdays;
use App\WorkdaysTires;
use App\OpeningHoursTires;
use App\BookingsTires;
use App\BookingsSettings;
use App\BookingsSessions;
use App\Http\Controllers\Admin\PermissionsAdminController;
use App\Enums\PermissionsEnum;

use Carbon\Carbon;

class BookingsTiresVisitorsController extends Controller
{


    public function __construct()
    {
        // $this->middleware('auth');
    }

    protected function validator(array $data)
    {
        $validator =  Validator::make($data, [
            'car_brand_id' => ['required', 'numeric', 'max:255'],
            'visitor_id' => ['required', 'numeric', 'digits_between:1,10'],
            'licence_plate' => ['required', 'string', 'max:20'],
            // 'comment' => ['string', 'max: 500'],
            'start_time' => ['required ', 'date'],// 'before: end_time'], //TODO Kell egy validátor, ami ellenörzi, hogy a 2 dátm között csak 30 perc lehet
            'end_time' => ['required ', 'date']//, 'after: start_time'] //TODO service provider-el meg lehetne szépen csinálni https://laracasts.com/discuss/channels/general-discussion/validation-startend-date-with-min-and-max-amount-of-days-inbetween
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        }
    }

    public function translate_day_to_hungarian($nth_day){
        switch($nth_day){
            case 1:
                return 'Hétfő';
            case 2:
                return 'Kedd';
            case 3:
                return 'Szerda';
            case 4:
                return 'Csütörtök';
            case 5:
                return 'Péntek';
            case 6:
                return 'Szombat';
            case 0:
                return 'Vasárnap';
        }
    }

    // napok kinyerése $from, $days, $to, segítségével
    // $from [string] = kezdeti nap YYYY-MM-DD - kötelező
    // $days [int] = kezdeti naptól X napig számoljon - választható
    // $mode
    // $left_times_start
    // $left_times_end
    // $hours_plus --> mostani időhöz X órát adni, ami még nem foglalható. pl 11 óra van, X = 2, így csak 13 órától lehet foglalni
    // $to [string] = végső nap YYYY-MM-DD - választható
    // $just_days
    // VISSZATÉR = array([0] => dátum számítási, [1] dárum vizuális, [2] => hét napja)
    public function get_working_days($from, $days = 0, $mode, $left_times_start, $left_times_end, $hours_plus = 0, $to = '', $just_days = 0) {
        setlocale(LC_ALL,'hu_HU');
        if($days != 0 || $to != ''){
            // OK! munkanapok DB-ből pl.: (1, 2, 3, 4, 5, 6)
            $get_workingDays = OpeningHoursTires::all();
            $workingDays = [];
            foreach($get_workingDays as $day){
                $workingDays[] = $day->week_day;
            }
            // elegendő a Workdays-t egyszer lekérdezni, majd kétszer felhasználhatjuk az objektumot!
            $workdays = WorkdaysTires::all();
            // OK! ahol adatbázisban a workdays táblában 0 van! pl.: ('*-12-25', '*-01-01')
            $get_holidayDays = $workdays->where('is_work_day', 0)->all();
            $holidayDays = [];
            foreach($get_holidayDays as $day){
                $holidayDays[] = $day->date;
            }
            // OK! ahol az adatbázisban  a workdays táblában 1 van! pl.: ('2019-04-25')
            $get_special_workingDays = $workdays->where('is_work_day', 1)->all();
            $special_workingDays = [];
            foreach($get_special_workingDays as $day){
                $special_workingDays[] = $day->date;
            }

            $final_days = array();
            $from_ = $from;
            $from = new DateTime($from);
            if($days == 0){
                $to = new DateTime($to);
            }else{
                $to = date('Y-m-d', strtotime($from_ . ' +99 day'));
                $to = new DateTime($to);
            }
            $to->modify('+1 day');
            if($mode == 'next'){
                $interval = DateInterval::createFromDateString('+1 day');
            }elseif($mode = 'prev'){
                $interval = DateInterval::createFromDateString('-1 day');
            }
            $periods = new DatePeriod($from, $interval, $to);

            $limit = 0;
            foreach ($periods as $period) {
                // ha az adott nap rendkívüli munkanap, akkor ne hagyja ki a napot!
                if (!in_array($period->format('Y-m-d'), $special_workingDays)){
                    // csak akkor fut le, ha nincs rendkívüli munkanap!
                    if (!in_array($period->format('N'), $workingDays)) continue;
                }
                if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
                if (in_array($period->format('*-m-d'), $holidayDays)) continue;

                // ha NEM speciális munkanap
                if (!in_array($period->format('Y-m-d'), $special_workingDays)){

                    // hét napját lekérdezni (szerda = 3), majd az alapján megnézni, hogy meddig van nyitvatartás DB-ből
                    // a $get_workingDays -ből kérdezzük le, így nincs ismétlődő DB lekérdezés!
                    $day_of_week = $period->format('N');
                    $day_of_week_row = $get_workingDays->where('week_day', $day_of_week)->first();

                    // visszatérési tömb (számítási dátum, kijelzett dátum, hét napja, nyitási idő, zárási idő)
                    $start = $day_of_week_row['start'];
                    $end = $day_of_week_row['end'];
                    $date = $period->format('Y-m-d');

                }
                else{ // HA SPECIÁLIS MUNKANAP

                    $actual_special_working_day = $workdays->where('is_work_day', 1)->where('date', $period->format('Y-m-d'))->first();

                    $open_close = explode('|', $actual_special_working_day['open_close']);

                    $start = $open_close[0];
                    $end = $open_close[1];
                    $date = $period->format('Y-m-d');
                }

                // ha a $just_days értéke == 1, akkor csak a napokra kíváncsi a lekérdezés, így nem terheljük feleslegesen a DB-t a rengeteg
                // időblokkok lekérdezésével (pl. nincs 8-18-ig fél óránként 5 napra lekérdezés!)
                if($just_days == 1){
                    $final_days[] = array(
                        $date
                    );
                }else{
                    $final_days[] = array(
                        $date,
                        $period->format('Y. m. d.'),
                        $this->translate_day_to_hungarian(strftime('%w', strtotime($period->format('Y-m-d')))),
                        $start,
                        $end,
                        $this->check_time_blocks($start, $end, $date, $left_times_start, $left_times_end, $hours_plus)
                    );
                }
                $limit++;
                if($limit == $days){
                    break;
                }
            }
            return $final_days;
        }else{
            return 'Please give $days or $to.';
        }
    }

    // $start = '12:00'; kezdeti óra:perc
    // $end = '13:00'; vég óra:perc
    // $date = '2019-06-17'; dátum (év-hónap-nap)
    // $left_times_start
    // $left_times_end
    // $hours_plus --> mostani időhöz X órát adni, ami még nem foglalható. pl 11 óra van, X = 2, így csak 13 órától lehet foglalni
    // $interval = 30; alapértelmezett - léptetés percekben

    // alap kezdeti idő
    // alap vég idő

    public function check_time_blocks($start, $end, $date, $left_times_start, $left_times_end, $hours_plus, $interval = 30){
        $d_open_time = strtotime($left_times_start);
        $d_close_time = strtotime($left_times_end);
        $open_time = strtotime($start);
        $close_time = strtotime($end);

        $interval = $interval * 60; // interval másodpercekben

        // times tömb:
        // times[x][0] = nyitó dátum = ('2019-06-22 09:30:00')
        // times[x][1] = záró dátum = ('2019-06-22 10:00:00')
        // times[x][2] = szabad, vagy foglalt ('free' / 'reserved')
        $times = array();
        $count = 0;

        $today = date("Y-m-d");
        $today_hours = strtotime(date("H:i:s") .' +'.$hours_plus.' hour'); // $hours_plus hozzáadása $today_hours-hoz
        $today_hours_teszt = date("H:i:s"); // $hours_plus hozzáadása $today_hours-hoz

        // Booking tábla előlekérdezése $date napra
        // Így maximum 5 lekérdezés történik a bookings táblából
        // Majd a kapott eredmény 1 napra vonatkozik!
        $bookings = BookingsTires::where('start_time', 'like', $date.'%')->get();

        $ebedszunet = BookingsSettings::find(7);
        $ebedszunet = $ebedszunet['content'];
        $ebedszunet = explode('|', $ebedszunet);
        $ebedszunet_from = strtotime($ebedszunet[0]);
        $ebedszunet_to = strtotime($ebedszunet[1]);

        for( $i = $d_open_time; $i < $d_close_time; $i += $interval) {

            if($i >= $open_time && $i < $close_time){

                $open_date = $date.' '.date("H:i:s", $i);
                $close_date = $date.' '.date("H:i:s", $i+$interval);
                $nice_date = date('Y. m. d.', strtotime($date)).' '.date("H:i", $i).' - '.date("H:i", $i+$interval);

                $ebedszunet = 0;
                if($i >= $ebedszunet_from && $i < $ebedszunet_to){
                    $ebedszunet = 1;
                }

                // foglalható ág
                $times[$count][0] = $open_date;
                $times[$count][1] = $close_date;
                $times[$count][3] = $nice_date;
                // adatbázis ellenőrzés ide --> megnézi, hogy az adott időintervallum foglalt-e
                $booked = $bookings->where('start_time', $open_date)->where('end_time', $close_date)->where('deleted', NULL)->first();

                // megnézi, hogy az adott időblokk foglalás alatt van-e. jelenlegi idő -15 perc amit keres
                $now = new DateTime();
                $now->modify('-15 minutes');
                $max_date_in_progress = $now->format('Y-m-d H:i:s');
                $booked_in_progress = BookingsSessions::
                where('c_type', 'tire')
                ->where('c_start_time', $open_date)
                ->where('c_end_time', $close_date)
                ->where('booking_started', '>', $max_date_in_progress)
                ->first();

                if($ebedszunet == 1){
                    // ebédszünet
                    $times[$count][2] = 2;
                }
                elseif($booked){
                    $times[$count][2] = 0;
                    // admin oldalon foglalt + rendszám:
                    // $times[$count][3] = $booked->licence_plate;
                    // $times[$count][4] = $booked->id;
                }
                elseif($booked_in_progress){
                    $times[$count][2] = 3;
                }
                elseif($date == $today && $today_hours > $i){ // ha a mostani idő (pl: 14:45) nagyobb, mint az aktuális időblokk
                // elseif($date == $today){ // utólagos módosítás: így a mai nap kiesik! --> Látogatói nézet mai nap kihagyása
                    $times[$count][0] = '';
                    $times[$count][1] = '';
                    $times[$count][2] = 2;
                }else{
                    $times[$count][2] = 1;
                }

            }else{
                // nem foglalható ág
                $times[$count][0] = '';
                $times[$count][1] = '';
                $times[$count][2] = 2;
            }
            $count++;
        }
        return $times;
    }

    public function get_left_times($start, $end, $interval = 30){
        $start = strtotime($start);
        $end = strtotime($end);
        $interval = $interval * 60; // interval másodpercekben
        $hours = array();
        for( $i = $start; $i < $end; $i += $interval) {
            $hours[] = date('H:i', $i).' - '.date('H:i', $i+$interval);
        }
        return $hours;
    }

    public function update_calendar(Request $request){
        $first_date = $request->first_date;
        $mode = $request->mode;
        $length = $request->length;
        $enable_prev = 1; // engedélyezi a szerver a visszaléptetést

        // c_type alapján kérdezzük le a kezdeti és vég óra:percet
        // majd ezek alapján generáljuk le a nyitási oszlopot
        // $booking_settings = BookingsSettings::all();
        // $left_times = $booking_settings->find(1);
        // $left_times = explode('|', $left_times['content']);
        // global $left_times_start;
        // global $left_times_end;
        // $left_times_start = $left_times[0];
        // $left_times_end = $left_times[1];

        $booking_settings = BookingsSettings::all();
        global $left_times_start;
        global $left_times_end;
        $OpeningHoursTires = OpeningHoursTires::all();
        $left_times_start = $OpeningHoursTires->min('start');
        $left_times_end = $OpeningHoursTires->max('end');
        $left_times = $this->get_left_times($left_times_start, $left_times_end);

        // mostani időhöz X órát adni, ami még nem foglalható. pl 11 óra van, X = 2, így csak 13 órától lehet foglalni
        $hours_plus = $booking_settings->find(3);
        $hours_plus = $hours_plus['content'];

        // ha hozzáadunk napokat:
        // először számoljuk ki, hogy melyik nap az utolsó amivel kezdjünk! ezért X+1-et adunk hozzá, majd a tömb utolsó eleme lesz a kezedeti érték
        // így már ki tudjuk számítani a következő 5 napot:
        if($mode == 'start'){
            // ezzel tudjuk manipulálni a kezdeti napot!
            $enable_prev = 0;
            $start_date = $this->get_working_days($first_date, $length+1, 'prev', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül

            // a start_date legmagasabb napja
            $prev_max = $start_date[0][0];
            // ha a $prev_max != $first_date-el --> akkor ez egy munkaszüneti nap!
            // ebben az esetben más értéket kell hozzáadni!! :)
            if($prev_max == $first_date){
                $start_date = $start_date[$length][0];
            }else{
                $start_date = $start_date[$length-1][0];
            }

            $future_date = $this->get_working_days($start_date, $length+1, 'next', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
            $future_date = $future_date[$length][0];
            $dates_array = $this->get_working_days($future_date, 5, 'next', $left_times_start, $left_times_end, $hours_plus); // mély lekérdezés időblokkokkal


        }
        elseif($mode == 'refresh'){
            // ezzel tudjuk manipulálni a kezdeti napot!
            // $enable_prev = 0;
            $start_date = $this->get_working_days($first_date, $length+1, 'prev', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül

            // a start_date legmagasabb napja
            $prev_max = $start_date[0][0];
            // ha a $prev_max != $first_date-el --> akkor ez egy munkaszüneti nap!
            // ebben az esetben más értéket kell hozzáadni!! :)
            if($prev_max == $first_date){
                $start_date = $start_date[$length][0];
            }else{
                $start_date = $start_date[$length-1][0];
            }

            $future_date = $this->get_working_days($start_date, $length+1, 'next', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
            $future_date = $future_date[$length][0];
            $dates_array = $this->get_working_days($future_date, 5, 'next', $left_times_start, $left_times_end, $hours_plus); // mély lekérdezés időblokkokkal

            // today létrehozása! amennyiben az adott nap munkaszüneti napra esik, úgy a következő szabad napot veszi today-nek!
            // így működik jól a rendszer
            $today = date('Y-m-d');
            $today = $this->get_working_days($today, $length+1, 'next', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
            $today = $today[0][0];

            // ellenőrzés, hogy a ma nap nagyobb-e, mint a cél dátum!
            if($today > $future_date){
                // próbálja addig, amíg nem talál olyan napot ami már megfelel!
                for($i = $length; $i>=0; $i--){
                    $future_date = $this->get_working_days($first_date, $i+1, 'prev', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
                    $future_date = $future_date[$i][0];
                    if($today == $future_date){
                        $enable_prev = 0;
                        break;
                    }
                }
            }

            if($today == $future_date){
                $enable_prev = 0;
            }

        }
        elseif($mode == 'next'){
            $future_date = $this->get_working_days($first_date, $length+1, 'next', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
            $future_date = $future_date[$length][0];
            $dates_array = $this->get_working_days($future_date, 5, 'next', $left_times_start, $left_times_end, $hours_plus); // mély lekérdezés időblokkokkal
        }elseif($mode == 'prev'){
            $future_date = $this->get_working_days($first_date, $length+1, 'prev', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
            $future_date = $future_date[$length][0];

            // today létrehozása! amennyiben az adott nap munkaszüneti napra esik, úgy a következő szabad napot veszi today-nek!
            // így működik jól a rendszer
            $today = date('Y-m-d');
            $today = $this->get_working_days($today, $length+1, 'next', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
            $today = $today[0][0];

            // ellenőrzés, hogy a ma nap nagyobb-e, mint a cél dátum!
            if($today > $future_date){
                // próbálja addig, amíg nem talál olyan napot ami már megfelel!
                for($i = $length; $i>=0; $i--){
                    $future_date = $this->get_working_days($first_date, $i+1, 'prev', $left_times_start, $left_times_end, $hours_plus, '', 1); // gyors lekérdezés - időblokkok nélkül
                    $future_date = $future_date[$i][0];
                    if($today == $future_date){
                        $enable_prev = 0;
                        break;
                    }
                }
            }

            if($today == $future_date){
                $enable_prev = 0;
            }

            $dates_array = $this->get_working_days($future_date, 5, 'next', $left_times_start, $left_times_end, $hours_plus); // mély lekérdezés időblokkokkal
        }

        // hibakezelés
        if(!empty($dates_array)){
            return response()->json([
                'success' => 1,
                'dates_array' => $dates_array,
                'left_times' => $left_times,
                'enable_prev' => $enable_prev
            ]);
        }else{
            return response()->json(['errors' => '<storng>Nincs eredmény!</strong> Hibásan megadott idősáv!.']);
        }
    }

    public function get_session(Request $request){

        $c_type = $request->c_type;
        $open_date = $request->date_start;
        $close_date = $request->date_end;

        // megnézi, hogy az adott időblokk foglalás alatt van-e. jelenlegi idő -15 perc amit keres
        $now = new DateTime();
        $now->modify('-15 minutes');
        $max_date_in_progress = $now->format('Y-m-d H:i:s');

        $booked_in_progress = BookingsSessions::
                where('c_type', $c_type)
                ->where('c_start_time', $open_date)
                ->where('c_end_time', $close_date)
                ->where('booking_started', '>', $max_date_in_progress)
                ->first();

        // ha foglalt az adott dátum, de a deleted oszlop nem = 1 --> tehát nem törölt a foglalás
        $booked = BookingsTires::where('start_time', $open_date)
                ->where('end_time', $close_date)
                ->where('deleted', '!=', 1)
                ->first();

        // ha van ilyen foglalás
        if($booked){
            return response()->json([
                'booked' => 1
            ]);
        }
        // ha van ilyen nyitott session
        elseif($booked_in_progress){
            return response()->json([
                'session_is_progress' => 1
            ]);
        }
        else{
            return response()->json([
                'session_is_progress' => 0,
                'booked' => 0
            ]);
        }

        
    }

    public function insert_update_session(Request $request){
        $c_type = $request->c_type;
        $open_date = $request->date_start;
        $close_date = $request->date_end;
        $session_id = $request->session_id;
        $delete_session = $request->delete_session;

        if($delete_session != null){

            $deleted_row = BookingsSessions::where('id', $session_id)->delete();

            if($deleted_row){
                return response()->json([
                    'success' => 1,
                    'deleted_session' => 1
                ]);
            }
            else{
                return response()->json(['errors' => '<storng>Adatázis hiba, törlés sikertelen!</strong>SESSION ID: '.$session_id.' nem található az adatbázisban.']);
            }

        }
        elseif($session_id == null){ // ha ez egy új foglalás

            $bookingsSessions = new BookingsSessions();
            $bookingsSessions->c_type = $c_type;
            $bookingsSessions->c_start_time = $open_date;
            $bookingsSessions->c_end_time = $close_date;
            $bookingsSessions->booking_started = Carbon::now()->format('Y-m-d H:i:s');
            $bookingsSessions->save();

            if($bookingsSessions){
                return response()->json([
                    'success' => 1,
                    'session_id' => $bookingsSessions->id,
                    'session_updated' => 0
                ]);
            }
            else{
                return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Session rögzítése sikertelen!']);
            }

        }
        else{ // ha újrakezdés és meg kell hosszabbítani az aktív sessiont
            $bookingsSessions = BookingsSessions::find($session_id);
            $bookingsSessions->booking_started = Carbon::now()->format('Y-m-d H:i:s');
            $bookingsSessions->save();

            if($bookingsSessions){
                return response()->json([
                    'success' => 1,
                    'session_id' => $bookingsSessions->id,
                    'session_updated' => 1
                ]);
            }
            else{
                return response()->json(['errors' => '<storng>Adatázis hiba!</strong> Session meghosszabbítása sikertelen!']);
            }
        }
    }


    public function insert($booking)
    {
        if (!PermissionsAdminController::hasPermission(PermissionsEnum::ENABLE_ADMIN_BOOKING_MENU)) {
            return redirect()->route('admin/home');
        }

        $bookingTires = new BookingsTires();
        $bookingTires->car_brand_id = $booking['car_brand_id'];
        $bookingTires->car_type_id = $booking[ 'car_type_id'];
        $bookingTires->visitor_id = $booking['visitor_id'];
        $bookingTires->comment = $booking['comment'];
        $bookingTires->start_time = $booking['start_time'];
        $bookingTires->end_time = $booking['end_time'];
        $bookingTires->licence_plate = $booking['licence_plate'];

        $bookingTires->save();
        return $bookingTires;
    }
}
