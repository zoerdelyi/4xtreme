<?php

namespace App\Http\Controllers\Robot;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\VisitorsCalendarController;
use App\Mail\RobotMail;

use App\BookingsCars;
use App\BookingsTires;

use Carbon\Carbon;

class SendEmailsController extends Controller
{

    public function __construct(){
        $this->MAIL_FROM_ADDRESS = 'gumiszerviz@4xtreme.hu';
        $this->APP_URL = 'https://www.4xtreme.hu/';
    }


    // reggeli emlékeztető email
    public function send_email_before_booking($tires_id, $cars_id){

        $result = '';
        if($tires_id != null){
            // id alapján kiküldeni az emlékeztetőt
            $tires = BookingsTires::where('bookings_tires.id', '=', $tires_id)
            ->join('bookings_services_tires', 'bookings_tires.id', '=', 'bookings_services_tires.booking_id')
            ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
            ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
            ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
            ->join('car_brands', 'bookings_tires.car_brand_id', '=', 'car_brands.id')
            ->select(
                'bookings_tires.*',
                'bookings_tires.id AS booking_id',
                'visitors.name AS visitors_name',
                'visitors.email AS visitors_email',
                'visitors.phone AS visitors_phone',
                'services_tires.id AS services_id',
                'bookings_tires.car_brand_id AS car_brand_id',
                'bookings_tires.car_type_id AS car_type_id',
                'car_brands.name AS car_brand_name',
                'car_types.name AS car_type_name',
                'bookings_tires.car_brand_other AS car_brand_other',
                'bookings_tires.car_type_other AS car_type_other',
                'bookings_tires.start_time AS start_time',
                'bookings_tires.end_time AS end_time',
                'bookings_tires.plus_mins AS plus_mins',
                'bookings_tires.licence_plate AS licence_plate',
                'services_tires.name AS service_name',
                'bookings_tires.tire_parking AS tire_parking',
                'bookings_tires.comment AS comment'
            )
            ->first();

            if($tires){
                if($tires->before_booking_notifi != 1){
                    // updateljük a db-t
                    $tires_update = BookingsTires::
                    where('id', '=', $tires_id)
                    ->update(array(
                        'before_booking_notifi' => 1,
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ));
                    $name = $tires->visitors_name;
                    $email = $tires->visitors_email;
                    $phone = $tires->visitors_phone;

                    // márka és típus létezik
                    if($tires->car_brand_id != 1 && $tires->car_type_id != 1){
                        $car_brand_and_type = $tires->car_brand_name.' '.$tires->car_type_name;
                    }
                    else{
                        // márka adott, típus egyedi
                        if($tires->car_brand_id != 1 && $tires->car_type_id == 1){
                            $car_brand_and_type = $tires->car_brand_name.' '.$tires->car_type_other;
                        }
                        else{
                            // márka egyedi, típus egyedi
                            if($tires->car_brand_id == 1 && $tires->car_type_id == 1){
                                $car_brand_and_type = $tires->car_brand_other.' '.$tires->car_type_other;
                            }
                            else{
                                $car_brand_and_type = '-';
                            }
                        }
                    }

                    $start_time = $tires->start_time;
                    $end_time = $tires->end_time;
                    $plus_mins = $tires->plus_mins;
                    $licence_plate = $tires->licence_plate;
                    $service_name = $tires->service_name;
                    if($service_name == 'NOTSET'){
                        $service_name = '-';
                    }
                    $tire_parking = $tires->tire_parking;
                    $comment = $tires->comment;
                    $send_email = 1;
                    $send_mmail_type = 'tire';

                    // email kiküldése!
                    if($send_email == 1){
                        $from_email = $this->MAIL_FROM_ADDRESS;
                        $name = $name;
                        $to_email = $email;
                        // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalás emlékeztető';
                        $subject = 'Időpontfoglalás emlékeztető';
                        // $pre_message = 'Önnek '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalása van a holnapi napon. ';
                        $pre_message = 'Önnek időpontfoglalása van a holnapi napon. ';
                        $message = '<p>Kérem jelenjen meg az alábbi lefoglalt időpontban. Köszönjük!</p><br><table>'.
                        ((!empty($name) && $name != 'NOTSET') ? '<tr>
                        <td><b>Név</b></td>
                        <td>'.$name.'</td>
                        </tr>' : '').
                        ((!empty($email) && $email != 'NOTSET') ? '<tr>
                        <td><b>E-mail cím:</b></td>
                        <td>'.$email.'</td>
                        </tr>' : '').
                        ((!empty($phone) && $phone != 'NOTSET') ? '<tr>
                        <td><b>Telefonszám:</b></td>
                        <td>'.$phone.'</td>
                        </tr>' : '').
                        '<tr>
                        <td><b>Autó márkája és típusa:</b></td>
                        <td>'.$car_brand_and_type.'</td>
                        </tr>
                        <tr>
                        <td><b>Autó rendszáma:</b></td>
                        <td>'.$licence_plate.'</td>
                        </tr>
                        <tr>
                        <td><b>Foglalt időpont kezdete:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime('+'.(($plus_mins != null) ? (($plus_mins > 30) ? $plus_mins-30 : $plus_mins ) : 0).' minutes', strtotime($start_time))).'</td>
                        </tr>
                        <!--<tr>
                        <td><b>Foglalt időpont vége:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime($end_time)).'</td>
                        </tr>-->'.
                        ((!empty($service_name) && $service_name != 'NOTSET') ? '<tr>
                        <td><b>Szolgáltatás:</b></td>
                        <td>'.$service_name.'</td>
                        </tr>' : '').
                        (($send_mmail_type == 'tire') ?
                        '<tr>
                        <td><b>Nálunk vannak tárolva a kerekei?</b></td>
                        <td>'.(($tire_parking != null) ? 'Igen' : 'Nem').'</td>
                        </tr>' : '').
                        ((!empty($comment) && $comment != 'NOTSET') ? '<tr>
                        <td><b>Megjegyzés:</b></td>
                        <td>'.(($comment != null) ? nl2br($comment) : ' -').'</td>
                        </tr>' : '').
                        '</table>';

                        $mail_datas = [
                            'name' => $name,
                            'from_email' => $from_email,
                            'from_name' => '4Xtreme Kft. '.($send_mmail_type == 'car' ? 'Autószerviz' : 'Gumiszerviz'),
                            'subject' => $subject,
                            'pre_message' => $pre_message,
                            'message' => $message
                        ];

                        \Mail::to($to_email)->send(new RobotMail($mail_datas));

                        if( count(\Mail::failures()) == 0 ) {
                            $result = 'tires_send_ok';
                        }
                        else{
                            $result = 'tires_send_fail';
                        }

                    }
                }
            }
            else{
                $result = 'tires_long_query_none';
            }
        }
        else{
            $result = 'tires_none';
        }

        if($cars_id != null){
            // id alapján kiküldeni az emlékeztetőt

            $cars = BookingsCars::where('bookings_cars.id', '=', $cars_id)
            ->join('bookings_services_cars', 'bookings_cars.id', '=', 'bookings_services_cars.booking_id')
            ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
            ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
            ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
            ->join('car_brands', 'bookings_cars.car_brand_id', '=', 'car_brands.id')
            ->select(
                'bookings_cars.*',
                'bookings_cars.id AS booking_id',
                'visitors.name AS visitors_name',
                'visitors.email AS visitors_email',
                'visitors.phone AS visitors_phone',
                'services_cars.id AS services_id',
                'bookings_cars.car_brand_id AS car_brand_id',
                'bookings_cars.car_type_id AS car_type_id',
                'car_brands.name AS car_brand_name',
                'car_types.name AS car_type_name',
                'bookings_cars.car_brand_other AS car_brand_other',
                'bookings_cars.car_type_other AS car_type_other',
                'bookings_cars.start_time AS start_time',
                'bookings_cars.end_time AS end_time',
                'bookings_cars.plus_mins AS plus_mins',
                'bookings_cars.licence_plate AS licence_plate',
                'services_cars.name AS service_name',
                'bookings_cars.comment AS comment'
            )
            ->first();

            if($cars->before_booking_notifi != 1){
                // updateljük a db-t
                $cars_update = BookingsCars::
                where('id', '=', $cars_id)
                ->update(array(
                    'confirmed' => 1,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ));
                $name = $cars->visitors_name;
                $email = $cars->visitors_email;
                $phone = $cars->visitors_phone;
                // márka és típus létezik
                if($tires->car_brand_id != 1 && $tires->car_type_id != 1){
                    $car_brand_and_type = $tires->car_brand_name.' '.$tires->car_type_name;
                }
                else{
                    // márka adott, típus egyedi
                    if($tires->car_brand_id != 1 && $tires->car_type_id == 1){
                        $car_brand_and_type = $tires->car_brand_name.' '.$tires->car_type_other;
                    }
                    else{
                        // márka egyedi, típus egyedi
                        if($tires->car_brand_id == 1 && $tires->car_type_id == 1){
                            $car_brand_and_type = $tires->car_brand_other.' '.$tires->car_type_other;
                        }
                        else{
                            $car_brand_and_type = '-';
                        }
                    }
                }
                $start_time = $cars->start_time;
                $end_time = $cars->end_time;
                $plus_mins = $cars->plus_mins;
                $licence_plate = $cars->licence_plate;
                $service_name = $cars->service_name;
                if($service_name == 'NOTSET'){
                    $service_name = '-';
                }
                $tire_parking = $cars->tire_parking;
                $comment = $cars->comment;
                $send_email = 1;
                $send_mmail_type = 'car';

                // email kiküldése!
                if($send_email == 1){
                    $from_email = $this->MAIL_FROM_ADDRESS;
                    $name = $name;
                    $to_email = $email;
                    // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalás emlékeztető';
                    $subject = 'Időpontfoglalás emlékeztető';
                    // $pre_message = 'Önnek '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalása van a holnapi napon. ';
                    $pre_message = 'Önnek időpontfoglalása van a holnapi napon. ';
                    $message = '<p>Kérem jelenjen meg az alábbi lefoglalt időpontban. Köszönjük!</p><br><table>'.
                        ((!empty($name) && $name != 'NOTSET') ? '<tr>
                        <td><b>Név</b></td>
                        <td>'.$name.'</td>
                        </tr>' : '').
                        ((!empty($email) && $email != 'NOTSET') ? '<tr>
                        <td><b>E-mail cím:</b></td>
                        <td>'.$email.'</td>
                        </tr>' : '').
                        ((!empty($phone) && $phone != 'NOTSET') ? '<tr>
                        <td><b>Telefonszám:</b></td>
                        <td>'.$phone.'</td>
                        </tr>' : '').
                        '<tr>
                        <td><b>Autó márkája és típusa:</b></td>
                        <td>'.$car_brand_and_type.'</td>
                        </tr>
                        <tr>
                        <td><b>Autó rendszáma:</b></td>
                        <td>'.$licence_plate.'</td>
                        </tr>
                        <tr>
                        <td><b>Foglalt időpont kezdete:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime('+'.(($plus_mins != null) ? (($plus_mins > 30) ? $plus_mins-30 : $plus_mins ) : 0).' minutes', strtotime($start_time))).'</td>
                        </tr>
                        <!--<tr>
                        <td><b>Foglalt időpont vége:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime($end_time)).'</td>
                        </tr>-->'.
                        ((!empty($service_name) && $service_name != 'NOTSET') ? '<tr>
                        <td><b>Szolgáltatás:</b></td>
                        <td>'.$service_name.'</td>
                        </tr>' : '').
                        (($send_mmail_type == 'tire') ?
                        '<tr>
                        <td><b>Nálunk vannak tárolva a kerekei?</b></td>
                        <td>'.(($tire_parking != null) ? 'Igen' : 'Nem').'</td>
                        </tr>' : '').
                        ((!empty($comment) && $comment != 'NOTSET') ? '<tr>
                        <td><b>Megjegyzés:</b></td>
                        <td>'.(($comment != null) ? nl2br($comment) : ' -').'</td>
                        </tr>' : '').
                        '</table>';


                    $mail_datas = [
                        'name' => $name,
                        'from_email' => $from_email,
                        'from_name' => '4Xtreme Kft. '.($send_mmail_type == 'car' ? 'Autószerviz' : 'Gumiszerviz'),
                        'subject' => $subject,
                        'pre_message' => $pre_message,
                        'message' => $message
                    ];

                    \Mail::to($to_email)->send(new RobotMail($mail_datas));

                    if( count(\Mail::failures()) == 0 ) {
                        $result .= ' | cars_send_ok';
                    }
                    else{
                        $result .= ' | cars_send_fail';
                    }

                }
            }
            else{
                $result .= 'cars_long_query_none';
            }
        }
        else{
            $result .= ' | cars_none';
        }

        return $result;
    }

    // [OK] foglalás után küldendő megerősítő email
    public function send_email_booking_confirm($name, $email, $confirm_hash, $send_mmail_type){
        $from_email = $this->MAIL_FROM_ADDRESS;

        $name = $name;
        $to_email = $email;
        // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalás megerősítése';
        $subject = 'Időpontfoglalás megerősítése';
        // $pre_message = 'Erősítse meg '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' foglalását! A megerősítéshez 15 perc áll rendelkezésre.';
        $pre_message = 'Erősítse meg foglalását! A megerősítéshez 15 perc áll rendelkezésre.';
        $message = '
        <p>Kérem erősítse meg a foglalását ezen a linken keresztül:</p>
        <a href="'.$this->APP_URL.'emails/confirm/'.$confirm_hash.'">Időpontfoglalás megerősítés</a>
        ';

        $mail_datas = [
            'name' => $name,
            'from_email' => $from_email,
            'from_name' => '4Xtreme Kft. '.($send_mmail_type == 'car' ? 'Autószerviz' : 'Gumiszerviz'),
            'subject' => $subject,
            'pre_message' => $pre_message,
            'message' => $message
        ];

        \Mail::to($to_email)->send(new RobotMail($mail_datas));

        if( count(\Mail::failures()) == 0 ) {
            return 1;
        }
        else{
            return 0;
        }
    }

    // [OK] megerősítés után küldendő visszaigazoló email - törlés linkkel
    // admin_activate_type = car / tire
    public function send_email_booking_confirm_after(Request $request){

        $admin_activate_success_query = 0;
        $confirm_mode = '';
        $confirm_msg = '';
        $send_email = 0;

        $confirm_hash = $request['hash'];
        $from_email = $this->MAIL_FROM_ADDRESS;
        $name = $email = '';

        $confirm_msg = 'Foglalás megerősítése sikeres! A visszaigazoló email-t elküldtük, kérem ellenőrizze email fiókját!';
        $confirm_mode = 'success';

        // $find_hash = BookingsTires::where('confirm_hash', '=', $confirm_hash)->first();

        $find_hash = BookingsTires::where('bookings_tires.confirm_hash', '=', $confirm_hash)
            ->join('bookings_services_tires', 'bookings_tires.id', '=', 'bookings_services_tires.booking_id')
            ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
            ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
            ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
            ->join('car_brands', 'bookings_tires.car_brand_id', '=', 'car_brands.id')
            ->select(
                'bookings_tires.*',
                'bookings_tires.deleted AS deleted',
                'bookings_tires.id AS booking_id',
                'visitors.name AS visitors_name',
                'visitors.email AS visitors_email',
                'visitors.phone AS visitors_phone',
                'services_tires.id AS services_id',
                'bookings_tires.car_brand_id AS car_brand_id',
                'bookings_tires.car_type_id AS car_type_id',
                'car_brands.name AS car_brand_name',
                'car_types.name AS car_type_name',
                'bookings_tires.car_brand_other AS car_brand_other',
                'bookings_tires.car_type_other AS car_type_other',
                'bookings_tires.start_time AS start_time',
                'bookings_tires.end_time AS end_time',
                'bookings_tires.plus_mins AS plus_mins',
                'bookings_tires.licence_plate AS licence_plate',
                'services_tires.name AS service_name',
                'bookings_tires.tire_parking AS tire_parking',
                'bookings_tires.comment AS comment'
            )
            ->first();


        if($find_hash){ // BookingTires

            if($find_hash->deleted !== 1){
                if($find_hash->confirmed != 1){
                    $hash_confirm = BookingsTires::
                    where('confirm_hash', '=', $confirm_hash)
                    ->update(array(
                        'confirmed' => 1,
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ));
                    $name = $find_hash->visitors_name;
                    $email = $find_hash->visitors_email;
                    $phone = $find_hash->visitors_phone;
                    // márka és típus létezik
                    if($find_hash->car_brand_id != 1 && $find_hash->car_type_id != 1){
                        $car_brand_and_type = $find_hash->car_brand_name.' '.$find_hash->car_type_name;
                    }
                    else{
                        // márka adott, típus egyedi
                        if($find_hash->car_brand_id != 1 && $find_hash->car_type_id == 1){
                            $car_brand_and_type = $find_hash->car_brand_name.' '.$find_hash->car_type_other;
                        }
                        else{
                            // márka egyedi, típus egyedi
                            if($find_hash->car_brand_id == 1 && $find_hash->car_type_id == 1){
                                $car_brand_and_type = $find_hash->car_brand_other.' '.$find_hash->car_type_other;
                            }
                            else{
                                $car_brand_and_type = '-';
                            }
                        }
                    }
                    $start_time = $find_hash->start_time;
                    $end_time = $find_hash->end_time;
                    $plus_mins = $find_hash->plus_mins;
                    $licence_plate = $find_hash->licence_plate;
                    $service_name = $find_hash->service_name;
                    if($service_name == 'NOTSET'){
                        $service_name = '-';
                    }
                    $tire_parking = $find_hash->tire_parking;
                    $comment = $find_hash->comment;
                    $send_email = 1;
                    $send_mmail_type = 'tire';
                }
                else{ // már aktiválva van
                    $confirm_msg = 'Az Ön foglalása már korábban meg lett erősítve!';
                }
            }else{
                $confirm_msg = 'Az Ön foglalása már korábban törölve van!';
            }

        }
        else{ // BookingCars

            // $find_hash_cars = BookingsCars::where('confirm_hash', '=', $confirm_hash)->first();

            $find_hash_cars = BookingsCars::where('bookings_cars.confirm_hash', '=', $confirm_hash)
            ->join('bookings_services_cars', 'bookings_cars.id', '=', 'bookings_services_cars.booking_id')
            ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
            ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
            ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
            ->join('car_brands', 'bookings_cars.car_brand_id', '=', 'car_brands.id')
            ->select(
                'bookings_cars.*',
                'bookings_cars.deleted AS deleted',
                'bookings_cars.id AS booking_id',
                'visitors.name AS visitors_name',
                'visitors.email AS visitors_email',
                'visitors.phone AS visitors_phone',
                'services_cars.id AS services_id',
                'bookings_cars.car_brand_id AS car_brand_id',
                'bookings_cars.car_type_id AS car_type_id',
                'car_brands.name AS car_brand_name',
                'car_types.name AS car_type_name',
                'bookings_cars.car_brand_other AS car_brand_other',
                'bookings_cars.car_type_other AS car_type_other',
                'bookings_cars.start_time AS start_time',
                'bookings_cars.end_time AS end_time',
                'bookings_cars.plus_mins AS plus_mins',
                'bookings_cars.licence_plate AS licence_plate',
                'services_cars.name AS service_name',
                'bookings_cars.comment AS comment'
            )
            ->first();

            if($find_hash_cars){
                if($find_hash_cars->deleted != 1){
                    if($find_hash_cars->confirmed != 1){
                        $hash_confirm = BookingsCars::
                        where('confirm_hash', '=', $confirm_hash)
                        ->update(array(
                            'confirmed' => 1,
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ));
                        $name = $find_hash_cars->visitors_name;
                        $email = $find_hash_cars->visitors_email;
                        $phone = $find_hash_cars->visitors_phone;
                        // márka és típus létezik
                        if($find_hash_cars->car_brand_id != 1 && $find_hash_cars->car_type_id != 1){
                            $car_brand_and_type = $find_hash_cars->car_brand_name.' '.$find_hash_cars->car_type_name;
                        }
                        else{
                            // márka adott, típus egyedi
                            if($find_hash_cars->car_brand_id != 1 && $find_hash_cars->car_type_id == 1){
                                $car_brand_and_type = $find_hash_cars->car_brand_name.' '.$find_hash_cars->car_type_other;
                            }
                            else{
                                // márka egyedi, típus egyedi
                                if($find_hash_cars->car_brand_id == 1 && $find_hash_cars->car_type_id == 1){
                                    $car_brand_and_type = $find_hash_cars->car_brand_other.' '.$find_hash_cars->car_type_other;
                                }
                                else{
                                    $car_brand_and_type = '-';
                                }
                            }
                        }
                        $start_time = $find_hash_cars->start_time;
                        $end_time = $find_hash_cars->end_time;
                        $plus_mins = $find_hash_cars->plus_mins;
                        $licence_plate = $find_hash_cars->licence_plate;
                        $service_name = $find_hash_cars->service_name;
                        if($service_name == 'NOTSET'){
                            $service_name = '-';
                        }
                        $tire_parking = $find_hash_cars->tire_parking;
                        $comment = $find_hash_cars->comment;
                        $send_email = 1;
                        $send_mmail_type = 'car';
                    }
                    else{ // már aktiválva van
                        $confirm_msg = 'Az Ön foglalása már korábban meg lett erősítve!';
                    }
                }else{
                    $confirm_msg = 'Az Ön foglalása már korábban törölve van!';
                }
            }
            else{

                // nincs semmilyen találat hash-re
                $confirm_msg = 'Foglalás megerősítése sikertelen! Nincs ilyen azonosító az adatbázisban! A 15 percnél régebbi, meg nem erősített foglalásokat a rendszer autómatikusan törli!';
                $confirm_mode = 'danger';
                $calendar = new VisitorsCalendarController;
                return $calendar->freedates_confirm($confirm_msg, $confirm_mode);
            }
        }
        

        // email kiküldése!
        if($send_email == 1 || $admin_activate_success_query == 1){
            $name = $name;
            $to_email = $email;
            if($admin_activate_success_query == 0){
                // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalás megerősítve';
                $subject = 'Időpontfoglalás megerősítve';
                // $pre_message = 'Sikeres '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalás megerősítés.';
                $pre_message = '';
                $message = '<p>Sikeresen megerősítette foglalását, köszönjük!</p>';
            }
            else{
                // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalást rögzítettünk';
                $subject = 'Időpontfoglalást rögzítettünk';
                // $pre_message = 'Sikeres '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalás.';
                $pre_message = 'Sikeres időpontfoglalás.';
                $message = '<p>Foglalása megerősítésre került!</p>';
            }

            
            $message .= '<table>'.
                        ((!empty($name) && $name != 'NOTSET') ? '<tr>
                        <td><b>Név</b></td>
                        <td>'.$name.'</td>
                        </tr>' : '').
                        ((!empty($email) && $email != 'NOTSET') ? '<tr>
                        <td><b>E-mail cím:</b></td>
                        <td>'.$email.'</td>
                        </tr>' : '').
                        ((!empty($phone) && $phone != 'NOTSET') ? '<tr>
                        <td><b>Telefonszám:</b></td>
                        <td>'.$phone.'</td>
                        </tr>' : '').
                        '<tr>
                        <td><b>Autó márkája és típusa:</b></td>
                        <td>'.$car_brand_and_type.'</td>
                        </tr>
                        <tr>
                        <td><b>Autó rendszáma:</b></td>
                        <td>'.$licence_plate.'</td>
                        </tr>
                        <tr>
                        <td><b>Foglalt időpont kezdete:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime('+'.(($plus_mins != null) ? (($plus_mins > 30) ? $plus_mins-30 : $plus_mins ) : 0).' minutes', strtotime($start_time))).'</td>
                        </tr>
                        <!--<tr>
                        <td><b>Foglalt időpont vége:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime($end_time)).'</td>
                        </tr>-->'.
                        ((!empty($service_name) && $service_name != 'NOTSET') ? '<tr>
                        <td><b>Szolgáltatás:</b></td>
                        <td>'.$service_name.'</td>
                        </tr>' : '').
                        (($send_mmail_type == 'tire') ?
                        '<tr>
                        <td><b>Nálunk vannak tárolva a kerekei?</b></td>
                        <td>'.(($tire_parking != null) ? 'Igen' : 'Nem').'</td>
                        </tr>' : '').
                        ((!empty($comment) && $comment != 'NOTSET') ? '<tr>
                        <td><b>Megjegyzés:</b></td>
                        <td>'.(($comment != null) ? nl2br($comment) : ' -').'</td>
                        </tr>' : '').
                        '</table>';

    $message .= '<br><p>Az időpontfoglalás törléséhez kattintson az alábbi linkre:<br>';
    $message .= '<a href="'.$this->APP_URL.'emails/delete/'.$confirm_hash.'">Időpontfoglalás törlése</a>';

            $mail_datas = [
                'name' => $name,
                'from_email' => $from_email,
                'from_name' => '4Xtreme Kft. '.($send_mmail_type == 'car' ? 'Autószerviz' : 'Gumiszerviz'),
                'subject' => $subject,
                'pre_message' => $pre_message,
                'message' => $message
            ];

            \Mail::to($to_email)->send(new RobotMail($mail_datas));

            if( count(\Mail::failures()) == 0 ) {
                // ha kiment az email, akkor visszairányít a naptárhoz az üzenettel
                $calendar = new VisitorsCalendarController;
                return $calendar->freedates_confirm($confirm_msg, $confirm_mode);
            }
            else{
                return 0;
            }
        }
        else{
            $calendar = new VisitorsCalendarController;
            // nincs semmilyen találat hash-re
            $confirm_msg = 'Foglalás megerősítése sikertelen! Nincs ilyen azonosító az adatbázisban! A 15 percnél régebbi, meg nem erősített foglalásokat a rendszer autómatikusan törli!';
            $confirm_mode = 'danger';
            return $calendar->freedates_confirm($confirm_msg, $confirm_mode);
        }
    }

    public function admin_send_email_booking_confirm_after($admin_activate = 0, $admin_activate_booking_id = null, $admin_activate_type = ''){

        $from_email = $this->MAIL_FROM_ADDRESS;
        $admin_activate_success_query = 0;
        if($admin_activate == 0){

        }
        else{
            // admin activate adatok lekérése booking ID alapján

            if($admin_activate_type == 'tire'){
                $find_booking = BookingsTires::where('bookings_tires.id', '=', $admin_activate_booking_id)
                    ->join('bookings_services_tires', 'bookings_tires.id', '=', 'bookings_services_tires.booking_id')
                    ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
                    ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
                    ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
                    ->join('car_brands', 'bookings_tires.car_brand_id', '=', 'car_brands.id')
                    ->select(
                        'bookings_tires.*',
                        'bookings_tires.id AS booking_id',
                        'visitors.name AS visitors_name',
                        'visitors.email AS visitors_email',
                        'visitors.phone AS visitors_phone',
                        'services_tires.id AS services_id',
                        'bookings_tires.car_brand_id AS car_brand_id',
                        'bookings_tires.car_type_id AS car_type_id',
                        'car_brands.name AS car_brand_name',
                        'car_types.name AS car_type_name',
                        'bookings_tires.car_brand_other AS car_brand_other',
                        'bookings_tires.car_type_other AS car_type_other',
                        'bookings_tires.start_time AS start_time',
                        'bookings_tires.end_time AS end_time',
                        'bookings_tires.plus_mins AS plus_mins',
                        'bookings_tires.licence_plate AS licence_plate',
                        'services_tires.name AS service_name',
                        'bookings_tires.tire_parking AS tire_parking',
                        'bookings_tires.comment AS comment'
                    )
                    ->first();

                    $name = $find_booking->visitors_name;
                    $email = $find_booking->visitors_email;
                    $phone = $find_booking->visitors_phone;
                    // márka és típus létezik
                    if($find_booking->car_brand_id != 1 && $find_booking->car_type_id != 1){
                        $car_brand_and_type = $find_booking->car_brand_name.' '.$find_booking->car_type_name;
                    }
                    else{
                        // márka adott, típus egyedi
                        if($find_booking->car_brand_id != 1 && $find_booking->car_type_id == 1){
                            $car_brand_and_type = $find_booking->car_brand_name.' '.$find_booking->car_type_other;
                        }
                        else{
                            // márka egyedi, típus egyedi
                            if($find_booking->car_brand_id == 1 && $find_booking->car_type_id == 1){
                                $car_brand_and_type = $find_booking->car_brand_other.' '.$find_booking->car_type_other;
                            }
                            else{
                                $car_brand_and_type = '-';
                            }
                        }
                    }
                    $start_time = $find_booking->start_time;
                    $end_time = $find_booking->end_time;
                    $plus_mins = $find_booking->plus_mins;
                    $licence_plate = $find_booking->licence_plate;
                    $service_name = $find_booking->service_name;
                    if($service_name == 'NOTSET'){
                        $service_name = '-';
                    }
                    $tire_parking = $find_booking->tire_parking;
                    $comment = $find_booking->comment;
                    $confirm_hash = $find_booking->confirm_hash;
                    $send_email = 1;
                    $send_mmail_type = 'tire';

                    $admin_activate_success_query = 1;
            }
            elseif($admin_activate_type == 'car'){
                $find_booking = BookingsCars::where('bookings_cars.id', '=', $admin_activate_booking_id)
                ->join('bookings_services_cars', 'bookings_cars.id', '=', 'bookings_services_cars.booking_id')
                ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
                ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
                ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
                ->join('car_brands', 'bookings_cars.car_brand_id', '=', 'car_brands.id')
                ->select(
                    'bookings_cars.*',
                    'bookings_cars.id AS booking_id',
                    'visitors.name AS visitors_name',
                    'visitors.email AS visitors_email',
                    'visitors.phone AS visitors_phone',
                    'services_cars.id AS services_id',
                    'bookings_cars.car_brand_id AS car_brand_id',
                    'bookings_cars.car_type_id AS car_type_id',
                    'car_brands.name AS car_brand_name',
                    'car_types.name AS car_type_name',
                    'bookings_cars.car_brand_other AS car_brand_other',
                    'bookings_cars.car_type_other AS car_type_other',
                    'bookings_cars.start_time AS start_time',
                    'bookings_cars.end_time AS end_time',
                    'bookings_cars.plus_mins AS plus_mins',
                    'bookings_cars.licence_plate AS licence_plate',
                    'services_cars.name AS service_name',
                    'bookings_cars.comment AS comment'
                )
                ->first();

                $name = $find_booking->visitors_name;
                $email = $find_booking->visitors_email;
                $phone = $find_booking->visitors_phone;
                // márka és típus létezik
                if($find_booking->car_brand_id != 1 && $find_booking->car_type_id != 1){
                    $car_brand_and_type = $find_booking->car_brand_name.' '.$find_booking->car_type_name;
                }
                else{
                    // márka adott, típus egyedi
                    if($find_booking->car_brand_id != 1 && $find_booking->car_type_id == 1){
                        $car_brand_and_type = $find_booking->car_brand_name.' '.$find_booking->car_type_other;
                    }
                    else{
                        // márka egyedi, típus egyedi
                        if($find_booking->car_brand_id == 1 && $find_booking->car_type_id == 1){
                            $car_brand_and_type = $find_booking->car_brand_other.' '.$find_booking->car_type_other;
                        }
                        else{
                            $car_brand_and_type = '-';
                        }
                    }
                }
                $start_time = $find_booking->start_time;
                $end_time = $find_booking->end_time;
                $plus_mins = $find_booking->plus_mins;
                $licence_plate = $find_booking->licence_plate;
                $service_name = $find_booking->service_name;
                if($service_name == 'NOTSET'){
                    $service_name = '-';
                }
                $tire_parking = $find_booking->tire_parking;
                $comment = $find_booking->comment;
                $confirm_hash = $find_booking->confirm_hash;
                $send_email = 1;
                $send_mmail_type = 'car';

                $admin_activate_success_query = 1;
            }
        }

        // email kiküldése!
        if($send_email == 1 || $admin_activate_success_query == 1){
            $name = $name;
            $to_email = $email;
            if($admin_activate_success_query == 0){
                // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalás megerősítve';
                $subject = 'Időpontfoglalás megerősítve';
                // $pre_message = 'Sikeres '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalás megerősítés.';
                $pre_message = '';
                $message = '<p>Sikeresen megerősítette foglalását, köszönjük!</p>';
            }
            else{
                // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalást rögzítettünk';
                $subject = 'Időpontfoglalást rögzítettünk';
                // $pre_message = 'Sikeres '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalás.';
                $pre_message = 'Sikeres időpontfoglalás.';
                $message = '<p>Foglalása megerősítésre került!</p>';
            }


            $message .= '<table>'.
                        ((!empty($name) && $name != 'NOTSET') ? '<tr>
                        <td><b>Név</b></td>
                        <td>'.$name.'</td>
                        </tr>' : '').
                        ((!empty($email) && $email != 'NOTSET') ? '<tr>
                        <td><b>E-mail cím:</b></td>
                        <td>'.$email.'</td>
                        </tr>' : '').
                        ((!empty($phone) && $phone != 'NOTSET') ? '<tr>
                        <td><b>Telefonszám:</b></td>
                        <td>'.$phone.'</td>
                        </tr>' : '').
                        '<tr>
                        <td><b>Autó márkája és típusa:</b></td>
                        <td>'.$car_brand_and_type.'</td>
                        </tr>
                        <tr>
                        <td><b>Autó rendszáma:</b></td>
                        <td>'.$licence_plate.'</td>
                        </tr>
                        <tr>
                        <td><b>Foglalt időpont kezdete:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime('+'.(($plus_mins != null) ? (($plus_mins > 30) ? $plus_mins-30 : $plus_mins ) : 0).' minutes', strtotime($start_time))).'</td>
                        </tr>
                        <!--<tr>
                        <td><b>Foglalt időpont vége:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime($end_time)).'</td>
                        </tr>-->'.
                        ((!empty($service_name) && $service_name != 'NOTSET') ? '<tr>
                        <td><b>Szolgáltatás:</b></td>
                        <td>'.$service_name.'</td>
                        </tr>' : '').
                        (($send_mmail_type == 'tire') ?
                        '<tr>
                        <td><b>Nálunk vannak tárolva a kerekei?</b></td>
                        <td>'.(($tire_parking != null) ? 'Igen' : 'Nem').'</td>
                        </tr>' : '').
                        ((!empty($comment) && $comment != 'NOTSET') ? '<tr>
                        <td><b>Megjegyzés:</b></td>
                        <td>'.(($comment != null) ? nl2br($comment) : ' -').'</td>
                        </tr>' : '').
                        '</table>';

    $message .= '<br><p>Az időpontfoglalás törléséhez kattintson az alábbi linkre:<br>';
    $message .= '<a href="'.$this->APP_URL.'emails/delete/'.$confirm_hash.'">Időpontfoglalás törlése</a>';

            $mail_datas = [
                'name' => $name,
                'from_email' => $from_email,
                'from_name' => '4Xtreme Kft. '.($send_mmail_type == 'car' ? 'Autószerviz' : 'Gumiszerviz'),
                'subject' => $subject,
                'pre_message' => $pre_message,
                'message' => $message
            ];

            \Mail::to($to_email)->send(new RobotMail($mail_datas));

            if( count(\Mail::failures()) == 0 ) {
                // ha kiment az email, akkor OK

                return 1;
            }
            else{
                return 0;
            }
        }
        else{

            return 0;
        }
    }

    public function send_email_booking_delete_after_pre(Request $request){

        // nincs semmilyen találat hash-re
        $confirm_msg = 'Biztosan törli a foglalását?';
        $calendar = new VisitorsCalendarController;
        return $calendar->freedates_confirm_pre($confirm_msg, $request['hash']);
    }

    public function send_email_booking_delete_after(Request $request, $admin_activate = 0, $admin_activate_booking_id = null, $admin_activate_type = ''){

        $admin_activate_success_query = 0;
        $send_email = 0;
        $confirm_msg = '';
        $confirm_mode = 'success';

        $admin_activate = 0; // ideiglenes --> látogató is törölhessen emailt!

        if($admin_activate == 0){
            $confirm_hash = $request['hash'];
            $from_email = $this->MAIL_FROM_ADDRESS;
            $name = $email = '';

            $confirm_msg = 'Foglalás törlése sikeres! A törlésről visszaigazoló email-t elküldtük, kérem ellenőrizze email fiókját!';
            $confirm_mode = 'success';

            // $find_hash = BookingsTires::where('confirm_hash', '=', $confirm_hash)->first();

            $find_hash = BookingsTires::where('bookings_tires.confirm_hash', '=', $confirm_hash)
                ->join('bookings_services_tires', 'bookings_tires.id', '=', 'bookings_services_tires.booking_id')
                ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
                ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
                ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
                ->join('car_brands', 'bookings_tires.car_brand_id', '=', 'car_brands.id')
                ->select(
                    'bookings_tires.*',
                    'bookings_tires.id AS booking_id',
                    'visitors.name AS visitors_name',
                    'visitors.email AS visitors_email',
                    'visitors.phone AS visitors_phone',
                    'services_tires.id AS services_id',
                    'bookings_tires.car_brand_id AS car_brand_id',
                    'bookings_tires.car_type_id AS car_type_id',
                    'car_brands.name AS car_brand_name',
                    'car_types.name AS car_type_name',
                    'bookings_tires.car_brand_other AS car_brand_other',
                    'bookings_tires.car_type_other AS car_type_other',
                    'bookings_tires.start_time AS start_time',
                    'bookings_tires.end_time AS end_time',
                    'bookings_tires.plus_mins AS plus_mins',
                    'bookings_tires.licence_plate AS licence_plate',
                    'services_tires.name AS service_name',
                    'bookings_tires.tire_parking AS tire_parking',
                    'bookings_tires.comment AS comment'
                )
                ->first();


            if($find_hash){ // BookingTires

                // előellenőrzés, hogy 12 órán belül van-e!
                if($find_hash->deleted != 1){

                    $booked_time = strtotime($find_hash->start_time);
                    $current_time = time();
                    $hours_12 = 60*60*12; // 12 óra

                    if(($booked_time-$current_time) > $hours_12){
                        if($find_hash->deleted != 1){
                            $hash_confirm = BookingsTires::
                            where('confirm_hash', '=', $confirm_hash)
                            ->update(array(
                                'deleted' => 1,
                                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                            ));
                            $name = $find_hash->visitors_name;
                            $email = $find_hash->visitors_email;
                            $phone = $find_hash->visitors_phone;
                            // márka és típus létezik
                            if($find_hash->car_brand_id != 1 && $find_hash->car_type_id != 1){
                                $car_brand_and_type = $find_hash->car_brand_name.' '.$find_hash->car_type_name;
                            }
                            else{
                                // márka adott, típus egyedi
                                if($find_hash->car_brand_id != 1 && $find_hash->car_type_id == 1){
                                    $car_brand_and_type = $find_hash->car_brand_name.' '.$find_hash->car_type_other;
                                }
                                else{
                                    // márka egyedi, típus egyedi
                                    if($find_hash->car_brand_id == 1 && $find_hash->car_type_id == 1){
                                        $car_brand_and_type = $find_hash->car_brand_other.' '.$find_hash->car_type_other;
                                    }
                                    else{
                                        $car_brand_and_type = '-';
                                    }
                                }
                            }
                            $start_time = $find_hash->start_time;
                            $end_time = $find_hash->end_time;
                            $plus_mins = $find_hash->plus_mins;
                            $licence_plate = $find_hash->licence_plate;
                            $service_name = $find_hash->service_name;
                            if($service_name == 'NOTSET'){
                                $service_name = '-';
                            }
                            $tire_parking = $find_hash->tire_parking;
                            $comment = $find_hash->comment;
                            $send_email = 1;
                            $send_mmail_type = 'tire';
                        }
                        else{ // már aktiválva van
                            $confirm_msg = 'Az Ön foglalása már törölve van!';
                        }
                    }
                    else{
                        // A foglalás 12 órán belül van!
                        $confirm_msg = '12 órán belüli „Foglalás” törlése nem lehetséges, kérjük vegye fel a kapcsolatot velünk elérhetőségeinken keresztül.';
                    }

                }
                else{
                    // A foglalás 12 órán belül van!
                    $confirm_msg = '12 órán belüli „Foglalás” törlése nem lehetséges, kérjük vegye fel a kapcsolatot velünk elérhetőségeinken keresztül.';
                }

            }
            else{ // BookingCars

                // $find_hash_cars = BookingsCars::where('confirm_hash', '=', $confirm_hash)->first();

                $find_hash_cars = BookingsCars::where('bookings_cars.confirm_hash', '=', $confirm_hash)
                ->join('bookings_services_cars', 'bookings_cars.id', '=', 'bookings_services_cars.booking_id')
                ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
                ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
                ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
                ->join('car_brands', 'bookings_cars.car_brand_id', '=', 'car_brands.id')
                ->select(
                    'bookings_cars.*',
                    'bookings_cars.id AS booking_id',
                    'visitors.name AS visitors_name',
                    'visitors.email AS visitors_email',
                    'visitors.phone AS visitors_phone',
                    'services_cars.id AS services_id',
                    'bookings_cars.car_brand_id AS car_brand_id',
                    'bookings_cars.car_type_id AS car_type_id',
                    'car_brands.name AS car_brand_name',
                    'car_types.name AS car_type_name',
                    'bookings_cars.car_brand_other AS car_brand_other',
                    'bookings_cars.car_type_other AS car_type_other',
                    'bookings_cars.start_time AS start_time',
                    'bookings_cars.end_time AS end_time',
                    'bookings_cars.plus_mins AS plus_mins',
                    'bookings_cars.licence_plate AS licence_plate',
                    'services_cars.name AS service_name',
                    'bookings_cars.comment AS comment'
                )
                ->first();

                if($find_hash_cars){
                    // előellenőrzés, hogy 12 órán belül van-e!
                    if($find_hash_cars->deleted != 1){

                        $booked_time = strtotime($find_hash_cars->start_time);
                        $current_time = time();
                        $hours_12 = 60*60*12; // 12 óra

                        if(($booked_time-$current_time) > $hours_12){
                            if($find_hash_cars->deleted != 1){
                                $hash_confirm = BookingsCars::
                                where('confirm_hash', '=', $confirm_hash)
                                ->update(array(
                                    'deleted' => 1,
                                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                                ));
                                $name = $find_hash_cars->visitors_name;
                                $email = $find_hash_cars->visitors_email;
                                $phone = $find_hash_cars->visitors_phone;
                                // márka és típus létezik
                                if($find_hash_cars->car_brand_id != 1 && $find_hash_cars->car_type_id != 1){
                                    $car_brand_and_type = $find_hash_cars->car_brand_name.' '.$find_hash_cars->car_type_name;
                                }
                                else{
                                    // márka adott, típus egyedi
                                    if($find_hash_cars->car_brand_id != 1 && $find_hash_cars->car_type_id == 1){
                                        $car_brand_and_type = $find_hash_cars->car_brand_name.' '.$find_hash_cars->car_type_other;
                                    }
                                    else{
                                        // márka egyedi, típus egyedi
                                        if($find_hash_cars->car_brand_id == 1 && $find_hash_cars->car_type_id == 1){
                                            $car_brand_and_type = $find_hash_cars->car_brand_other.' '.$find_hash_cars->car_type_other;
                                        }
                                        else{
                                            $car_brand_and_type = '-';
                                        }
                                    }
                                }
                                $start_time = $find_hash_cars->start_time;
                                $end_time = $find_hash_cars->end_time;
                                $plus_mins = $find_hash_cars->plus_mins;
                                $licence_plate = $find_hash_cars->licence_plate;
                                $service_name = $find_hash_cars->service_name;
                                if($service_name == 'NOTSET'){
                                    $service_name = '-';
                                }
                                $tire_parking = $find_hash_cars->tire_parking;
                                $comment = $find_hash_cars->comment;
                                $send_email = 1;
                                $send_mmail_type = 'car';
                            }
                            else{ // már aktiválva van
                                $confirm_msg = 'Az Ön foglalása már törölve van!';
                            }
                        }
                        else{
                            // A foglalás 12 órán belül van!
                            $confirm_msg = '12 órán belüli „Foglalás” törlése nem lehetséges, kérjük vegye fel a kapcsolatot velünk elérhetőségeinken keresztül.';
                        }
                    }
                    else{
                        // nincs semmilyen találat hash-re
                        $confirm_msg = 'Foglalás törlése sikertelen! Nincs ilyen azonosító az adatbázisban!';
                        $confirm_mode = 'danger';
                        $calendar = new VisitorsCalendarController;
                        return $calendar->freedates_confirm($confirm_msg, $confirm_mode);
                    }
                }
            }
        }
        else{
            // admin activate adatok lekérése booking ID alapján

            if($admin_activate_type == 'tire'){
                $find_booking = BookingsTires::where('bookings_tires.id', '=', $admin_activate_booking_id)
                    ->join('bookings_services_tires', 'bookings_tires.id', '=', 'bookings_services_tires.booking_id')
                    ->join('services_tires', 'bookings_services_tires.service_id', '=', 'services_tires.id')
                    ->join('visitors', 'bookings_tires.visitor_id', '=', 'visitors.id')
                    ->join('car_types', 'bookings_tires.car_type_id', '=', 'car_types.id')
                    ->join('car_brands', 'bookings_tires.car_brand_id', '=', 'car_brands.id')
                    ->select(
                        'bookings_tires.*',
                        'bookings_tires.id AS booking_id',
                        'visitors.name AS visitors_name',
                        'visitors.email AS visitors_email',
                        'visitors.phone AS visitors_phone',
                        'services_tires.id AS services_id',
                        'bookings_tires.car_brand_id AS car_brand_id',
                        'bookings_tires.car_type_id AS car_type_id',
                        'car_brands.name AS car_brand_name',
                        'car_types.name AS car_type_name',
                        'bookings_tires.car_brand_other AS car_brand_other',
                        'bookings_tires.car_type_other AS car_type_other',
                        'bookings_tires.start_time AS start_time',
                        'bookings_tires.end_time AS end_time',
                        'bookings_tires.plus_mins AS plus_mins',
                        'bookings_tires.licence_plate AS licence_plate',
                        'services_tires.name AS service_name',
                        'bookings_tires.tire_parking AS tire_parking',
                        'bookings_tires.comment AS comment'
                    )
                    ->first();
                    $admin_activate_success_query = 1;
            }
            elseif($admin_activate_type == 'car'){
                $find_booking = BookingsCars::where('bookings_cars.id', '=', $admin_activate_booking_id)
                ->join('bookings_services_cars', 'bookings_cars.id', '=', 'bookings_services_cars.booking_id')
                ->join('services_cars', 'bookings_services_cars.service_id', '=', 'services_cars.id')
                ->join('visitors', 'bookings_cars.visitor_id', '=', 'visitors.id')
                ->join('car_types', 'bookings_cars.car_type_id', '=', 'car_types.id')
                ->join('car_brands', 'bookings_cars.car_brand_id', '=', 'car_brands.id')
                ->select(
                    'bookings_cars.*',
                    'bookings_cars.id AS booking_id',
                    'visitors.name AS visitors_name',
                    'visitors.email AS visitors_email',
                    'visitors.phone AS visitors_phone',
                    'services_cars.id AS services_id',
                    'bookings_cars.car_brand_id AS car_brand_id',
                    'bookings_cars.car_type_id AS car_type_id',
                    'car_brands.name AS car_brand_name',
                    'car_types.name AS car_type_name',
                    'bookings_cars.car_brand_other AS car_brand_other',
                    'bookings_cars.car_type_other AS car_type_other',
                    'bookings_cars.start_time AS start_time',
                    'bookings_cars.end_time AS end_time',
                    'bookings_cars.plus_mins AS plus_mins',
                    'bookings_cars.licence_plate AS licence_plate',
                    'services_cars.name AS service_name',
                    'bookings_cars.comment AS comment'
                )
                ->first();
                $admin_activate_success_query = 1;
            }
        }

        // email kiküldése!
        if($send_email == 1 || $admin_activate_success_query == 1){
            $name = $name;
            $to_email = $email;
            if($admin_activate_success_query == 0){
                // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalás törölve';
                $subject = 'Időpontfoglalás törölve';
                // $pre_message = 'Sikeres '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalás megerősítés.';
                $pre_message = '';
                $message = '<p>Sikeresen törölte a foglalását!</p><br>';
            }
            else{
                // $subject = ($send_mmail_type == 'car' ? 'Autószerviz ' : 'Gumiszerviz ').'időpontfoglalást töröltünk';
                $subject = 'Időpontfoglalást töröltünk';
                // $pre_message = 'Sikeres '.($send_mmail_type == 'car' ? 'autószervizes' : 'gumiszervizes').' időpontfoglalás törlés.';
                $pre_message = 'Sikeres időpontfoglalás törlés.';
                $message = '<p>Foglalása törlésre került!</p><br>';
            }

            $message .= '<table>'.
                        ((!empty($name) && $name != 'NOTSET') ? '<tr>
                        <td><b>Név</b></td>
                        <td>'.$name.'</td>
                        </tr>' : '').
                        ((!empty($email) && $email != 'NOTSET') ? '<tr>
                        <td><b>E-mail cím:</b></td>
                        <td>'.$email.'</td>
                        </tr>' : '').
                        ((!empty($phone) && $phone != 'NOTSET') ? '<tr>
                        <td><b>Telefonszám:</b></td>
                        <td>'.$phone.'</td>
                        </tr>' : '').
                        '<tr>
                        <td><b>Autó márkája és típusa:</b></td>
                        <td>'.$car_brand_and_type.'</td>
                        </tr>
                        <tr>
                        <td><b>Autó rendszáma:</b></td>
                        <td>'.$licence_plate.'</td>
                        </tr>
                        <tr>
                        <td><b>Foglalt időpont kezdete:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime('+'.(($plus_mins != null) ? (($plus_mins > 30) ? $plus_mins-30 : $plus_mins ) : 0).' minutes', strtotime($start_time))).'</td>
                        </tr>
                        <!--<tr>
                        <td><b>Foglalt időpont vége:</b></td>
                        <td>'.date('Y. m. d. H:i', strtotime($end_time)).'</td>
                        </tr>-->'.
                        ((!empty($service_name) && $service_name != 'NOTSET') ? '<tr>
                        <td><b>Szolgáltatás:</b></td>
                        <td>'.$service_name.'</td>
                        </tr>' : '').
                        (($send_mmail_type == 'tire') ?
                        '<tr>
                        <td><b>Nálunk vannak tárolva a kerekei?</b></td>
                        <td>'.(($tire_parking != null) ? 'Igen' : 'Nem').'</td>
                        </tr>' : '').
                        ((!empty($comment) && $comment != 'NOTSET') ? '<tr>
                        <td><b>Megjegyzés:</b></td>
                        <td>'.(($comment != null) ? nl2br($comment) : ' -').'</td>
                        </tr>' : '').
                        '</table>';

        $mail_datas = [
            'name' => $name,
            'from_email' => $from_email,
            'from_name' => '4Xtreme Kft. '.($send_mmail_type == 'car' ? 'Autószerviz' : 'Gumiszerviz'),
            'subject' => $subject,
            'pre_message' => $pre_message,
            'message' => $message
        ];

        \Mail::to($to_email)->send(new RobotMail($mail_datas));

        if( count(\Mail::failures()) == 0 ) {
            // ha kiment az email, akkor visszairányít a naptárhoz az üzenettel
            $calendar = new VisitorsCalendarController;
            return $calendar->freedates_confirm($confirm_msg, $confirm_mode);
        }
        else{
            return 0;
        }
    }
    else{
        $confirm_msg = 'Foglalás törlése sikertelen! Nincs ilyen azonosító az adatbázisban!';
        $confirm_mode = 'danger';
        $calendar = new VisitorsCalendarController;
        return $calendar->freedates_confirm($confirm_msg, $confirm_mode);
    }
}

}
