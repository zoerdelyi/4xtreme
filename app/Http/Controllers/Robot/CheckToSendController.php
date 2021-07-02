<?php

namespace App\Http\Controllers\Robot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\BookingsCars;
use App\BookingsTires;
use App\Http\Controllers\Robot\SendEmailsController;

use DateTime;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class CheckToSendController extends Controller
{

    /*
        **  CRON FELADATOK
    */

    // reggeltől nézze a rendsszer, hogy van-e a következő napra foglalás
    // értesítés után adott foglalás [ reggeli email elküldve oszlop 1 ]

    // regel 6-tól éjfélig időzíteni!

    public function check_email_before_booking(Request $request){
        // napszak megadása
        // aznap legyen az email reggel?
        // szerintem előnyösebb lenne előző nap kiküldeni!

        $bookings_tires = DB::select('SELECT * FROM `bookings_tires` WHERE DATEDIFF(start_time, DATE_ADD(CURDATE(), INTERVAL 1 DAY)) = 0 AND before_booking_notifi IS NULL AND confirmed = 1 AND deleted IS NULL LIMIT 1');

        
        $bookings_cars = DB::select('SELECT * FROM `bookings_cars` WHERE DATEDIFF(start_time, DATE_ADD(CURDATE(), INTERVAL 1 DAY)) = 0 AND confirmed = 1 AND deleted IS NULL');

        $tires_id = (!empty($bookings_tires)) ? $bookings_tires[0]->id : null;
        $cars_id = (!empty($bookings_cars)) ? $bookings_cars[0]->id : null;

        $sendemail = new SendEmailsController();
        echo $sendemail->send_email_before_booking($tires_id, $cars_id);

        // var_dump($bookings_tires);

        // $bookings_cars = DB::select('SELECT * FROM `bookings_cars` WHERE DATEDIFF(start_time, DATE_ADD(CURDATE(), INTERVAL 1 DAY)) = 0 AND confirmed = 1 AND deleted IS NULL LIMIT 1');
    }

    // ** PERCENKÉNT LEFUTTATNI
    // foglalások átnézése, ha nem megerősített 15 perc elteltével, akkor a foglalás törlése
    public function check_email_confirmed(Request $request){

        // MINTA
        // megnézi, hogy az adott időblokk foglalás alatt van-e. jelenlegi idő -15 perc amit keres
        // $now = new DateTime();
        // $now->modify('-15 minutes');
        // $max_date_in_progress = $now->format('Y-m-d H:i:s');
        // $booked_in_progress = BookingsSessions::
        // where('c_type', 'car')
        // ->where('c_start_time', $open_date)
        // ->where('c_end_time', $close_date)
        // ->where('booking_started', '>', $max_date_in_progress)
        // ->first();

        $now = new DateTime();
        $now->modify('-15 minutes');
        $max_date_in_progress = $now->format('Y-m-d H:i:s');
        $bookings_tires = BookingsTires::
        where('created_at', '<', $max_date_in_progress)
        ->where('confirmed', '=', null)
        ->update(array(
            'deleted' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ));

        $now = new DateTime();
        $now->modify('-15 minutes');
        $max_date_in_progress = $now->format('Y-m-d H:i:s');
        $bookings_cars = BookingsCars::
        where('created_at', '<', $max_date_in_progress)
        ->where('confirmed', '=', null)
        ->update(array(
            'deleted' => 1,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ));

        echo 't: '.$bookings_tires.'<br>'.'c: '.$bookings_cars;
    }
    
}
