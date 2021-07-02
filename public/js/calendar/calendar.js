$(document).ready(function () {

    var session_id = null;
    var interval_update_in_progress = null;
    var booking_time_over = null;

    // NAPTÁRVÁLASZTÓ INICIALIZÁLÁSA
    // ha csak egy naptár jelenik meg, automatikusan az legyen kiválasztva!
    if($('.select_booking_type').length < 2){
        // $('.intro_layer').hide();
        calendar_type_selector($('.select_booking_type').attr('data-c_type'));
    }
    else{
        $('.intro_layer').show();
        $('#booking_restart').removeClass('d-none');
    }

    // típus kiválasztása után
    $('.select_booking_type').click(function(){
        calendar_type_selector($(this).attr('data-c_type'));
    });
    function calendar_type_selector(c_type){
        var get_first_date = new Date().toISOString().slice(0,10);
        if(c_type != ''){
            if(c_type == 'tire'){
                $('.admin_title').text('Gumiszerviz időpontfoglalás').attr('data-c_type', c_type).show();
            }else{
                if(c_type == 'car'){
                    $('.admin_title').text('Autószervíz időpontfoglalás').attr('data-c_type', c_type).show();
                }
            }
            
            UpdateCalendar(get_first_date, 'start', 5, c_type);
        }
    }

    $('#booking_restart').click(function(){
        booking_restart();
    });

    function booking_restart(){
        $('#booking_restart').hide();
        $('.calendar_layer').hide();

        $('#cal_times .cal_dates').html('');
        $('.cal_titles .cal_day').html('');
        $('.cal_titles .cal_day_name').html('');
        $('.cal_free_space').html('');

        $('.admin_title').text('Időpontfoglaló Naptár');

        // booking inputok kinullázása!
        $('#visitorName').val('');
        $('#visitorEmail').val('');
        $('#visitorPhone').val('');
        $('#licencePlate').val('');
        $('#carBrand').val('');
        $('#carType').val('');
        $('#bookingService').val('');
        $('.tireParking').prop('checked', false);
        $('#bookingComment').val('');
        $('#motortip').val('');
        $('#alvaz').val('');
        $('#cm3').val('');
        $('#teljesitmeny').val('');

        $('.intro_layer').show();

        session_id = null;
        interval_update_in_progress = null;
    }

    function booking_restart_actual_date(without_preloader = null){

        var get_first_date = $('#cal_1').attr('data-date');
        var length = $('.dynamic_dates:visible').length;
        var c_type = $('.admin_title').attr('data-c_type');

        // ha NEM háttérfrissítés történt
        if(without_preloader == null){

            // ha nincs folyamatban idő lejárta, akkor nullázzuk csak a sessiont!
            if(booking_time_over == null){
                session_id = null;
            }
            else{
                // folyamatban van az idő lejárta, így innen direkt módon végezzük a session törlést:
                $('.countDownTimer').timer('remove');
                insert_update_sessions(c_type, date_start, date_end, date_nice, 1);
            }

            // booking inputok kinullázása!
            $('#visitorName').val('');
            $('#visitorEmail').val('');
            $('#visitorPhone').val('');
            $('#licencePlate').val('');
            $('#carBrand').val('');
            $('#carType').val('');
            $('#bookingService').val('');
            $('.tireParking').prop('checked', false);
            $('#bookingComment').val('');
            $('#motortip').val('');
            $('#alvaz').val('');
            $('#cm3').val('');
            $('#teljesitmeny').val('');

            $('#bookingModal').modal('hide');
            $('#preloader').hide();
        }

        UpdateCalendar(get_first_date, 'refresh', length, c_type, without_preloader);        
    }

    $('.cal_next_prev').click(function(){
        var c_type = $('.admin_title').attr('data-c_type');
        var next_prev = $(this).attr('data-next_prev');
        if( c_type != ''){
            if( next_prev != ''){
                var get_first_date = $('#cal_1').attr('data-date');
                var length = $('.dynamic_dates:visible').length;
                // length --> napok kiszámítása (hány nappal ugorjon vissza az első dátum!)
                UpdateCalendar(get_first_date, next_prev, length, c_type);
            }else{
                //TODO: Hiba, hibás next_prev típus
            }
        }else{
            //TODO: Hiba, hibás naptár típus
        }
    });

    var date_start, date_end, date_nice, c_type;

    $('body').on('click', '.cal_free', function(){

        // változók hozzáadása a globális változókhoz, session újraindítás esetén szükséges!
        date_start = $(this).attr('data-start');
        date_end = $(this).attr('data-end');
        date_nice = $(this).attr('data-nice');
        c_type = $('.admin_title').attr('data-c_type');

        // preloader elindítása
        $('#preloader').show();

        // session ellenőrzés:
        is_date_in_sessions(c_type, date_start, date_end, date_nice);
    });

        // AJAX --> SESSION KEZELÉS

    // 1. AJAX: Megnézi, hogy az aktuális időpont foglalás alatt van-e! (pl ha úgyhagy egy weboldalt sokáig, akkor már teljesen más lehet a kép!)
    // ha foglalt --> akkor kiírja, hogy az aktuális időpont már foglalt és újratölti a naptárat!

    function is_date_in_sessions(c_type, date_start, date_end, date_nice) {

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/visitors/booking/" + c_type + "services/get_session",
            type: "POST",
            data: {
                c_type: c_type,
                date_start: date_start,
                date_end: date_end
            },
            success: function (data) {
                // foglalás folyamatban van az adott időpontra
                if(data.booked == 1){
                    alert('Már van foglalás az adott időpontra! A naptár frissül!');
                    booking_restart_actual_date();
                }
                else{
                    if(data.session_is_progress == 1){
                        alert('Foglalás folyamatban van az adott időpontra! A naptár frissül!');
                        booking_restart_actual_date();
                    }
                    else{ // nincs folyamatban foglalás az adott időpontra
                        
                        // MEHET AZ INSERT A SESSION TÁBLÁBA!
                        insert_update_sessions(c_type, date_start, date_end, date_nice);

                    }
                }
                
            }
        });
    }

    // 2. AJAX:
    //      - ha nem foglalt, akkor tesz egy foglalt bejegyzést a session-ök közé! - visszatér egy session_id-vel!
    //      - ha újrakezdés gombra kattint akkor a visszatért id-t updateli!


    function insert_update_sessions(c_type, date_start, date_end, date_nice, delete_session = null){
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/visitors/booking/" + c_type + "services/insert_update_session",
            type: "POST",
            data: {
                c_type: c_type,
                date_start: date_start,
                date_end: date_end,
                session_id: session_id,
                delete_session: delete_session
            },
            success: function (data) {
                // console.log(data);

                // session törölve!
                if(data.deleted_session){
                    if(booking_time_over == null){
                        booking_restart_actual_date();
                    }
                    else{
                        // most már álállítható null-ra!
                        session_id = null;
                        booking_time_over = null;
                    }
                }
                else{
                    // ha sikerült az új session rögzítése
                    if(data.success == 1){
                        $('#bookingModal').modal('show');

                        // csak ha gumis foglalás van, akkor mutassa a gumi tárolás opciót
                        if(c_type == 'tire'){
                            // console.log(c_type);
                            $('#bookingModal #tireParkingBlock').removeClass('d-none');
                            $('#bookingModal #motortip').parent('.form-group').addClass('d-none');
                            $('#bookingModal #alvaz').parent('.form-group').addClass('d-none');
                            $('#bookingModal #cm3').parent('.form-group').addClass('d-none');
                            $('#bookingModal #teljesitmeny').parent('.form-group').addClass('d-none');
                            $('#bookingModal #motortip').removeAttr("required");
                            $('#bookingModal #alvaz').removeAttr("required");
                            $('#bookingModal #cm3').removeAttr("required");
                            $('#bookingModal #teljesitmeny').removeAttr("required");
                        }
                        else{
                            $('#bookingModal #tireParkingBlock').addClass('d-none');
                            $('#bookingModal #motortip').parent('.form-group').removeClass('d-none');
                            $('#bookingModal #alvaz').parent('.form-group').removeClass('d-none');
                            $('#bookingModal #cm3').parent('.form-group').removeClass('d-none');
                            $('#bookingModal #teljesitmeny').parent('.form-group').removeClass('d-none');
                            $('#bookingModal #tireParkingBlock input').removeAttr("required");

                        }

                        // visszaszámlálás elkezdése
                        start_countdown();
                        InsertSelectedTime(date_start, date_end, date_nice, c_type);

                        // visszatért data.session_id hozzáadása a globális változóhoz
                        session_id = data.session_id;
                        
                        // session updatelve lett, most már vizuálisan is meghosszabbítható a session
                        if(data.session_updated == 1){
                            $('.countDownTimer').timer('reset');
                        }
                    }
                    else{
                        $.notify(
                            {
                                message:
                                    "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                                    JSON.stringify(data.errors)
                            },
                            {
                                // settings
                                type: "danger",
                                delay: 0
                            }
                        );
                    }
                }
            }
        });
    }

    // ha a countdown gombra kattint, a száláló újraindul!
    $('body').on('click', '#countdown_btn', function(){
        insert_update_sessions(c_type, date_start, date_end, date_nice);
    }); 

    // ba bezáródik bármilyen módon a booking modal
    $('#bookingModal').on('hidden.bs.modal', function () {
        if(booking_time_over == null){
            $('.div_preloader').show();
            $('.countDownTimer').timer('remove');
            insert_update_sessions(c_type, date_start, date_end, date_nice, 1);
        }

        // booking edit inputok kinullázása!
        $('#bookingEditModal #visitorName').val('');
        $('#bookingEditModal #visitorEmail').val('');
        $('#bookingEditModal #visitorPhone').val('');
        $('#bookingEditModal #licencePlate').val('');
        $('#bookingEditModal #carBrand').val('');
        $('#bookingEditModal #carType').val('');
        $('#bookingEditModal #bookingService').val('');
        $('#bookingEditModal #bookingComment').val('');
        $('#bookingEditModal #tireParking').prop('checked', false);
    });

    function UpdateCalendar(first_date, mode, length, c_type, without_preloader) {
        if(c_type != ''){
            // naptár időközönként frissítésének elindítása - csak egyszer az induláskor!
            if(interval_update_in_progress == null){
                interval_update_calendar();
            }
            if(without_preloader == null){
                $('.div_preloader').show();
            }
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "/ajax/visitors/update_calendar/" + c_type,
                type: "POST",
                data: {
                    'first_date': first_date,
                    'mode': mode,
                    'length': length
                },
                beforeSend: function(){
                    $('#enable_prev').addClass('disabled');
                    $('#enable_next').addClass('disabled');
                    $('#booking_restart').addClass('disabled');
                },
                success: function (data) {
                    // console.log(data);
                    if(!data.errors){
                        // bal oldali időskála feltöltése
                        var left_times = data.left_times;
                        var left_times_html = '';
                        jQuery.each(left_times, function(index, e){
                            left_times_html += '<div>' + e + '</div>';
                        });
                        $('#cal_times .cal_dates').html(left_times_html);

                        // aktuális nap lekérése
                        var d = new Date(),
                        full_date = d.getFullYear() + '. ' + ( '0' + parseInt(d.getMonth()+1) ).slice(-2) + '. ' + ( '0' + d.getDate() ).slice(-2) + '.';

                        // időpontok feltöltése
                        var dates_array = data.dates_array;
                        jQuery.each(dates_array, function(index, e){
                            $('#cal_' + (index+1)).attr('data-date', e[0]);
                            
                            // első nap más színűre színezés:
                            if(e[1] == full_date){
                                $('#cal_' + (index+1) + ' .cal_day').html('<span style="color: #f44122;font-weight: bold;font-family: Roboto;">' + e[1] + '</span>');
                                $('#cal_' + (index+1) + ' .cal_day_name').html('<span style="color: #f44122;font-weight: bold;font-family: Roboto;">' + e[2] + '</span>');
                            }
                            else{
                                $('#cal_' + (index+1) + ' .cal_day').html(e[1]);
                                $('#cal_' + (index+1) + ' .cal_day_name').html(e[2]);
                            }

                            // időpontok loopolása
                            var new_free_spaces = '';

                            jQuery.each(e[5], function(t_index, t_e){
                                var time_block = '';
                                time_block = '<div class="noselect';
                                if(t_e[2] == 2){
                                    time_block += ' closed">-</div>';
                                }else{
                                    if(t_e[2] == 1){
                                        time_block += ' cal_free"'; 
                                    }else{
                                        if(t_e[2] == 3 || t_e[5] == null){ // ha folyamatban van a foglalás, vagy ha a foglalás még nincs megerősítve
                                            // visitors felületen elrejtjük a látogató számára, hogy folyamatban van a foglalás
                                            // time_block += ' cal_progressed"';
                                            time_block += ' cal_reserved"';
                                        }
                                        else{
                                            time_block += ' cal_reserved"';
                                        }
                                    }
                                    if(t_e[4]){
                                        time_block += ' data-id="' + t_e[4] + '" data-start="' + t_e[0] + '" data-end="' + t_e[1] + '" data-nice="' + t_e[3] + '">'; 
                                    }
                                    else{
                                        time_block += ' data-start="' + t_e[0] + '" data-end="' + t_e[1] + '" data-nice="' + t_e[3] + '">';
                                    }
                                    
                                    if(t_e[2] == 1){
                                        time_block += 'Szabad';
                                    }
                                    else{
                                        if(t_e[2] == 3){
                                            time_block += 'Foglalás alatt';
                                        }
                                        else{
                                            // time_block += 'Foglalt';
                                            // admin oldalon foglalt
                                            time_block += 'Foglalt';
                                        }
                                    }
                                    
                                }
                                time_block += '</div>';
                                new_free_spaces += time_block;
                            });

                            $('#cal_' + (index+1) + ' .cal_free_space').html(new_free_spaces);
                            //console.log(e[5]);

                        });
                        // vissza gomb tiltása / engedélyezése
                        if(data.enable_prev == 1){
                            $('#enable_prev').removeClass('disabled');
                        }else{
                            $('#enable_prev').addClass('disabled');
                        }
                        $('#enable_next').removeClass('disabled');
                        $('#booking_restart').removeClass('disabled');
                        $('.intro_layer').hide();
                        $('.calendar_layer').show();
                        $('#booking_restart').show();

                        $('.div_preloader').hide();

                        if(without_preloader != null){
                            $('#update_without_preloader').hide();
                        }
                    }else{
                        // TODO: hibakezelést átgondolni!
                        alert(data.errors);
                    }
                }
            });
        }
    }

    function interval_update_calendar(){

        

        if($('.intro_layer').is(":hidden") || interval_update_in_progress == null){ // csak akkor, ha a főmenü nem aktív

            // console.log('lefut');
            interval_update_in_progress = 1;
            
            setTimeout(function(){

                if($('.intro_layer').is(":hidden")){
                    $('#update_without_preloader').show();

                    // naptár frissítése
                    booking_restart_actual_date(1);

                    // önmaga újrahívása
                    interval_update_calendar();
                }
            }, 10000);
        }
    }

    function start_countdown(){
        $('.countDownTimer').timer({
            countdown: true,
            duration: '15m0s',
            callback: function() {
                booking_time_over = 1;
                alert('Lejárt a foglalási időkeret! A naptár frissül!');
                booking_restart_actual_date();
            }
        });
    }

    // Rendszám gépelés kötőjel prevenció
    $("#licencePlate").on('keyup change', function (event){

        var $elem = $(this),
          value = $elem.val(),
          regReplace,
          preset = {
            'only-numbers': '0-9',
            'numbers': '0-9\\s',
            'only-letters': 'A-Za-z',
            'letters': 'A-Za-z\\s',
            'email': '\\wÑñ@._\\-',
            'alpha-numeric': '\\w\\s',
            'latin-alpha-numeric': '\\w\\sÑñáéíóúüÁÉÍÓÚÜ'
          },
          filter = preset[$elem.attr('chars')] || $elem.attr('chars');
      
        regReplace = new RegExp('[^' + filter + ']', 'ig');
        $elem.val(value.replace(regReplace, ''));
      
      });
      
});
