$(document).ready(function () {

    // inicializáljuk a jobb menüsávot!
    lbd.initRightMenu();

    // naptár automatikus frissítése
    // var auto_update_calendar = 0; --> így kikapcsolva
    var auto_update_calendar = 1;
    
    var session_id = null;
    var interval_update_in_progress = null;
    var booking_time_over = null;

    var payment_click_count = 0;
    $(document).on('submit','#pay_form',function(event){
        // console.log(payment_click_count);
        event.preventDefault();
        if($('#add_payment').hasClass('disabled') && payment_click_count < 4){
            // rendezve
            payment_click_count++;
        }
        else{
            if(payment_click_count > 3){
                if (confirm('Biztosan újra módosítani kívánja a Rendezett tételt?')) {
                    // átengedjük
                    $('#add_payment span').text('Fizetés módosítása');
                    $('#payment_total').removeAttr('disabled');
                    $('#payment_type').removeAttr('disabled');
                    $('#add_payment').addClass('btn-primary').removeClass('btn-success').removeClass('disabled');
                    $('#payment_total').focus();
                    payment_click_count = 0;
                }
                else{
                    payment_click_count = 0;
                }
            }
            else{
                // szabadon módosíthat
                payment_ajax();
            }
        }
    });

    function payment_ajax(){
        var c_type = $('.admin_title').attr('data-c_type'),
        payment_total = $('#bookingPreviewModal #payment_total').val(),
        payment_type = $('#bookingPreviewModal #payment_type').val(),
        booking_id = $('#bookingPreviewModal #editBookingButton').attr('data-booking_id');

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/ajax/update_payment/" + c_type,
            type: "POST",
            data: {
                booking_id: booking_id,
                payment_total: payment_total,
                payment_type: payment_type
            },
            beforeSend: function(){
                // $('#enable_prev').addClass('disabled');
            },
            success: function (data) {
                if(data.success == 1){
                    $('#add_payment span').text('Rendezve');
                    $('#add_payment').removeClass('btn-primary').addClass('btn-success').addClass('disabled');

                    // foglalás és törlés gomb is legyen disabled!
                    $('#bookingPreviewModal .edit_delete_booking').addClass('disabled');
                    $('#bookingPreviewModal #editBookingButton').addClass('disabled');
                    $('#bookingPreviewModal #payment_type').focus();
                    // összeg törlése gomb megjlenítése
                    $('#bookingPreviewModal #delete_payment').removeClass('d-none');

                    $('#bookingPreviewModal #payment_total').prop("disabled", true);
                    $('#bookingPreviewModal #payment_type').prop("disabled", true);
                    $.notify({
                        message : "<strong>Sikeres véggösszeg beállítás!</strong>"
                    },{
                        type: 'success'
                    });
                }
                else{
                    $.notify({
                        message : "<strong>Sikertelen véggösszeg beállítás!</strong>"
                    },{
                        type: 'danger'
                    });
                }
            }
        });
    }

    $(document).on('click','#delete_payment',function(event){
        var c_type = $('.admin_title').attr('data-c_type'),
        booking_id = $('#bookingPreviewModal #editBookingButton').attr('data-booking_id');

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/ajax/delete_payment/" + c_type,
            type: "POST",
            data: {
                booking_id: booking_id
            },
            beforeSend: function(){
                // $('#enable_prev').addClass('disabled');
            },
            success: function (data) {
                if(data.success == 1){
                    $('#add_payment span').text('Fizetés');
                    $('#add_payment').removeClass('btn-success').addClass('btn-primary').removeClass('disabled');

                    $('#bookingPreviewModal #payment_total').val('');
                    $('#bookingPreviewModal #payment_type').val('');
                    $('#bookingPreviewModal #delete_payment').addClass('d-none');

                    // foglalás és törlés gomb is legyen disabled!
                    $('#bookingPreviewModal .edit_delete_booking').removeClass('disabled');
                    $('#bookingPreviewModal #editBookingButton').removeClass('disabled');
                    $('#bookingPreviewModal #payment_type').focus();

                    $('#bookingPreviewModal #payment_total').prop("disabled", false);
                    $('#bookingPreviewModal #payment_type').prop("disabled", false);
                    $.notify({
                        message : "<strong>Sikeres véggösszeg törlés!</strong>"
                    },{
                        type: 'success'
                    });
                }
                else{
                    $.notify({
                        message : "<strong>Sikertelen véggösszeg törlés!</strong>"
                    },{
                        type: 'danger'
                    });
                }
            }
        });
    });

    // NAPTÁRVÁLASZTÓ INICIALIZÁLÁSA
    // ha csak egy naptár jelenik meg, automatikusan az legyen kiválasztva!
    if($('.select_booking_type').length != 0 && $('.select_booking_type').length < 2){
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
        $('#carBrand_other').val('');
        $('#carType_other').val('');
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
            $('#carBrand_other').val('');
            $('#carType_other').val('');
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

    $(document).on('click', '#append_new_booking', function(){

        date_start = $(this).attr('data-start');
        date_end = $(this).attr('data-end');
        date_nice = $(this).attr('data-nice');
        c_type = $('.admin_title').attr('data-c_type');

        $('#preloader').show();
        $('#bookingPreviewModal').modal('hide');

        // session ellenőrzés:
        is_date_in_sessions(c_type, date_start, date_end, date_nice);
    });

    $('body').on('click', '.cal_free, .closed', function(){

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

    // előnézet után szerekesztés megnyitása
    var edit_click_count = 0;
    $('body').on('click', '#editBookingButton', function(){
        event.preventDefault();

        if($(this).hasClass('disabled') && edit_click_count < 4){
            // rendezve
            edit_click_count++;
        }
        else{
            if(edit_click_count > 3){
                if (confirm('Biztosan újra módosítani kívánja a Rendezett foglalást?')) {
                    // átengedjük
                    // $('#editBookingButton').removeClass('disabled');
                    // $('#bookingPreviewModal #payment_type').focus();
                    // edit_click_count = 0;

                    // szabadon módosíthat
                    $('#bookingPreviewModal').modal('hide');
                    bookingEditModal($('#editBookingButton').attr('data-booking_id'));
                }
                else{
                    edit_click_count = 0;
                }
            }
            else{
                // szabadon módosíthat
                $('#bookingPreviewModal').modal('hide');
                bookingEditModal($('#editBookingButton').attr('data-booking_id'));
            }
        }
    });

    // előnézet nullázása
    function pre_reset(){
        $('.pre_booking_status div:nth-child(2) p').text('');
        $('.pre_booking_status').addClass("d-none");
        $('.pre_visitor_name div:nth-child(2) p').text('');
        $('.pre_visitor_name').addClass("d-none");
        $('.pre_visitor_email div:nth-child(2) p').text('');
        $('.pre_visitor_email').addClass("d-none");
        $('.pre_visitor_phone div:nth-child(2) p').text('');
        $('.pre_visitor_phone').addClass("d-none");
        $('.pre_licencePlate div:nth-child(2) p').text('');
        $('.pre_licencePlate').addClass("d-none");
        $('.pre_carBrandType div:nth-child(2) p').text('');
        $('.pre_carBrandType').addClass("d-none");
        $('.pre_booking_startTime div:nth-child(2) p').text('');
        $('.pre_booking_startTime').addClass("d-none");
        $('.pre_booking_endTime div:nth-child(2) p').text('');
        $('.pre_booking_endTime').addClass("d-none");
        $('.pre_service div:nth-child(2) p').text('');
        $('.pre_service').addClass("d-none");
        $('.pre_tireParking div:nth-child(2) p').text('');
        $('.pre_tireParking').addClass("d-none");
    }

    // ha egy időponthoz több foglalás tartozik, akkor itt dolgozza fel a lapfüleket!
    function handle_multiple_bookings_tab(ids, id){
        // régebbi elemek kitörlése (ha van) és új lista generálása
        $('.nav_tabs_elem').remove();
        var active = '';
        var payment_total = '';
        jQuery.each(ids, function(i, e){
            active = '';
            payment_total = '';
            if(e.payment_total != null){
                // ha aktív is és fizetve is van
                if(id == e.id){
                    payment_total = ' active_paid';
                }else{
                    // csak fizetve van
                    payment_total = ' paid';
                }
            }else{
                payment_total = '';
                if(id == e.id){
                    active = ' active';
                }else{
                    active = '';
                }
            }
            $('<li class="nav-item nav_tabs_elem"><a data-tab="' + (i+1) + '" data-id="' + e.id + '" class="nav-link' + active + payment_total + '" href="javascript:">' + e.licence_plate + '</a></li>').insertBefore('.nav_append_new_booking');
        });
    }

    function display_edit_get_datas(booking_id, start_time, end_time, c_type){
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/" + c_type + "/edit_get_datas",
            type: "POST",
            data: {
                booking_id: booking_id,
                start_time: start_time,
                end_time: end_time,
            },
            success: function (data) {
                console.log(data);
                // ha egy időponthoz több foglalás tartozik, akkor itt dolgozza fel a lapfüleket!
                handle_multiple_bookings_tab(data[2], booking_id);

                // ha az időpont nincs megerősítve, akkor NEM lehet törölni, sem szerkeszteni!
                if(data[0].confirmed != 1){
                    // $('.edit_delete_booking').css('display', 'none');
                    // $('#editBookingButton').css('display', 'none');
                    $('#delete_edit_group').css('display', 'none');
                    $('#pay_form').css('display', 'none');
                }
                else{
                    // $('.edit_delete_booking').css('display', 'block');
                    // $('#editBookingButton').css('display', 'block');
                    $('#delete_edit_group').css('display', 'block');
                    $('#pay_form').css('display', 'block');
                }

                // törlés gomb data-id:
                $('.edit_delete_booking').attr('data-booking_id', booking_id);

                // update gomb data-id:
                $('#editBookingButton').attr('data-booking_id', booking_id);

                if(data[0].confirmed != 'NOTSET' && data[0].confirmed != ''){
                    var confirmed_text;
                    if(data[0].confirmed == null){
                        confirmed_text = '<span style="color: orange;font-weight: bold;">Megerősítés alatt</span>';
                    }else{
                        confirmed_text = '<span style="color: #911615;font-weight: bold;">Megerősített</span>';
                    }
                    $('.pre_booking_status div:nth-child(2) p').html(confirmed_text);
                    $('.pre_booking_status').removeClass("d-none");
                }else{
                    $('.pre_booking_status div:nth-child(2) p').text('');
                    $('.pre_booking_status').addClass("d-none");
                }

                if(data[0].visitors_name != 'NOTSET' && data[0].visitors_name != ''){
                    $('.pre_visitor_name div:nth-child(2) p').text(data[0].visitors_name);
                    $('.pre_visitor_name').removeClass("d-none");
                }else{
                    $('.pre_visitor_name div:nth-child(2) p').text('');
                    $('.pre_visitor_name').addClass("d-none");
                }

                if(data[0].visitors_email != 'NOTSET' && data[0].visitors_email != ''){
                    // console.log('kimegy');
                    $('.pre_visitor_email div:nth-child(2) p').text(data[0].visitors_email);
                    $('.pre_visitor_email').removeClass("d-none");
                }else{
                    $('.pre_visitor_email div:nth-child(2) p').text('');
                    $('.pre_visitor_email').addClass("d-none");
                }

                if(data[0].visitors_phone != 'NOTSET' && data[0].visitors_phone != ''){
                    $('.pre_visitor_phone div:nth-child(2) p').text(data[0].visitors_phone);
                    $('.pre_visitor_phone').removeClass("d-none");
                }else{
                    $('.pre_visitor_phone div:nth-child(2) p').text('');
                    $('.pre_visitor_phone').addClass("d-none");
                }

                if(data[0].licence_plate != 'NOTSET' && data[0].licence_plate != ''){
                    $('.pre_licencePlate div:nth-child(2) p').text(data[0].licence_plate);
                    $('.pre_licencePlate').removeClass("d-none");
                }else{
                    $('.pre_licencePlate div:nth-child(2) p').text('');
                    $('.pre_licencePlate').addClass("d-none");
                }

                // márka és típus létezik
                if(data[0].car_brand_id != 1 && data[0].car_type_id != 1){
                    $('.pre_carBrandType div:nth-child(2) p').text(data[0].car_brand_name + ' ' + data[0].car_type_name);
                    $('.pre_carBrandType').removeClass("d-none");
                }else{
                    // márka adott, típus egyedi
                    if(data[0].car_brand_id != 1 && data[0].car_type_id == 1){
                        if(data[0].car_type_other != null){
                            $('.pre_carBrandType div:nth-child(2) p').text(data[0].car_brand_name + ' ' + data[0].car_type_other);
                        }
                        else{
                            $('.pre_carBrandType div:nth-child(2) p').text(data[0].car_brand_name);
                        }
                        
                        $('.pre_carBrandType').removeClass("d-none");
                    }else{
                        // márka egyedi, típus egyedi
                        if( (data[0].car_brand_id == 1 && data[0].car_type_id == 1) && data[0].car_brand_other != null && data[0].car_type_other != null){
                            $('.pre_carBrandType div:nth-child(2) p').text(data[0].car_brand_other + ' ' + data[0].car_type_other);
                            $('.pre_carBrandType').removeClass("d-none");
                        }
                        else{
                            // márka és típus sincs megadva
                            // console.log('null??');
                            $('.pre_carBrandType div:nth-child(2) p').text('');
                        }
                    }
                }

                if(data[0].services_name != 'NOTSET' && data[0].services_name != ''){
                    $('.pre_service div:nth-child(2) p').text(data[0].services_name);
                    $('.pre_service').removeClass("d-none");
                }else{
                    $('.pre_service div:nth-child(2) p').text('');
                    $('.pre_service').addClass("d-none");
                }

                if(data[0].start_time != 'NOTSET' && data[0].start_time != ''){
                    if(data[0].plus_mins != null){
                        var start_time = data[0].start_time.substring(0, data[0].start_time.length-5);
                        start_time = start_time + ("0" + data[0].plus_mins).slice(-2);
                    }
                    else{
                        var start_time = data[0].start_time.substring(0, data[0].start_time.length-3);
                    }
                    $('.pre_booking_startTime div:nth-child(2) p').text(start_time);
                    $('.pre_booking_startTime').removeClass("d-none");
                }else{
                    $('.pre_booking_startTime div:nth-child(2) p').text('');
                    $('.pre_booking_startTime').addClass("d-none");
                }

                if(data[0].end_time != 'NOTSET' && data[0].end_time != ''){
                    var end_time = data[0].end_time.substring(0, data[0].end_time.length-3);
                    $('.pre_booking_endTime div:nth-child(2) p').text(end_time);
                    $('.pre_booking_endTime').removeClass("d-none");
                }else{
                    $('.pre_booking_endTime div:nth-child(2) p').text('');
                    $('.pre_booking_endTime').addClass("d-none");
                }

                // kívánt szolgáltatás

                if(data[0].tire_parking != 'NOTSET' && data[0].tire_parking != '' && c_type == 'tire'){
                    if(data[0].tire_parking == 1){
                        var tire_parking_text = 'Igen';
                    }
                    else{
                        var tire_parking_text = 'Nem';
                    }
                    
                    $('.pre_tireParking div:nth-child(2) p').text(tire_parking_text);
                    $('.pre_tireParking').removeClass("d-none");
                }else{
                    $('.pre_tireParking div:nth-child(2) p').text('');
                    $('.pre_tireParking').addClass("d-none");
                }

                if(data[0].comment != null && data[0].comment != ''){
                    $('.pre_booking_comment div:nth-child(2) p').html(data[0].comment);
                    $('.pre_booking_comment').removeClass("d-none");
                }else{
                    $('.pre_booking_comment div:nth-child(2) p').text('');
                    $('.pre_booking_comment').addClass("d-none");
                }

                $('#bookingPreviewModal #payment_type').val('');
                if(data[0].payment_type != null && data[0].payment_type != ''){
                    $('#bookingPreviewModal #payment_type').val(data[0].payment_type);
                }

                $('#bookingPreviewModal #payment_total').val('');
                $('#add_payment span').text('Fizetés');
                $('#add_payment').addClass('btn-primary').removeClass('btn-success').removeClass('disabled');
                $('#bookingPreviewModal .edit_delete_booking').removeClass('disabled');
                $('#bookingPreviewModal #editBookingButton').removeClass('disabled');
                $('#bookingPreviewModal #payment_total').prop("disabled", false);
                $('#bookingPreviewModal #payment_type').prop("disabled", false);
                // $('#add_payment').css('width', '183px').css('float', 'right');
                if(data[0].payment_total !== null && data[0].payment_total !== ''){
                    // console.log(data[0].payment_total);
                    $('#bookingPreviewModal #payment_total').val(data[0].payment_total);
                    $('#add_payment span').text('Rendezve');
                    $('#add_payment').removeClass('btn-primary').addClass('btn-success').addClass('disabled');

                    // foglalás és törlés gomb is legyen disabled és az inpoutok is
                    $('#bookingPreviewModal .edit_delete_booking').addClass('disabled');
                    $('#bookingPreviewModal #editBookingButton').addClass('disabled');

                    // összeg törlése gomb megjlenítése
                    $('#bookingPreviewModal #delete_payment').removeClass('d-none');

                    $('#bookingPreviewModal #payment_total').prop("disabled", true);
                    $('#bookingPreviewModal #payment_type').prop("disabled", true);
                }

                // autó típus, márka
                get_only_car_types_list(data[0].car_brand, 'edit', data[0].car_type);

                get_only_serivice_list('edit', c_type, data[0].services_id);

                $('#bookingPreviewModal #bookingDateInterval').val(data[1]);

                // modal megjelenítése
                $('#bookingPreviewModal').modal('show');
                $('#bookingPreviewModal_loader').hide();
                $('.div_preloader').hide();
            }
        });
    }

    $(document).on('click', '.nav_tabs_elem', function(){
        $('#bookingPreviewModal_loader').show();
        var booking_id = $(this).find('a').attr('data-id');
        var start_time = $('#append_new_booking').attr('data-start');
        var end_time = $('#append_new_booking').attr('data-end');
        var c_type = $('#append_new_booking').attr('data-type');

        display_edit_get_datas(booking_id, start_time, end_time, c_type);
    });

    // foglalt időpont ELŐNÉZETE
    $('body').on('click', '.cal_not_free:not(.cal_progressed )', function(){



        // előnézet nullázása
        pre_reset();
        $('.div_preloader').show();

        var booking_id = $(this).attr('data-id'),
        start_time = $(this).attr('data-start'),
        end_time = $(this).attr('data-end'),
        data_nice = $(this).attr('data-nice'),
        c_type = $('.admin_title').attr('data-c_type');

        // értékek beállítása az +Új gombnak:
        $('#append_new_booking').attr('data-start', start_time);
        $('#append_new_booking').attr('data-end', end_time);
        $('#append_new_booking').attr('data-type', c_type);
        $('#append_new_booking').attr('data-nice', data_nice);

        // console.log($(this).attr('data-id'));

        display_edit_get_datas(booking_id, start_time, end_time, c_type);
    });


    // dátumból generál percek alapján végződéseket 5 percenként
    // intervallumok: 0-25 között, vagy 30 és 55 között 5 percenként
    //@from_date 2020-10-28 08:00:00
    //return array pl.: <option value="30">30</option> ...
    function generate_mins(from_date) {
        var text_split = from_date.split(":");
        var mins = text_split[1];
        var disp_mins = [];
        var option = "";
        if (mins == "00") {
            for (var i = 0; i < 30; i += 5) {
                option = ("0" + i).slice(-2); // formátum 0 helyett 00
                disp_mins.push(
                    '<option value="' + i + '">' + option + "</option>"
                );
            }
        } else if (mins == "30") {
            for (var z = 30; z < 60; z += 5) {
                option = ("0" + z).slice(-2); // formátum 0 helyett 00
                disp_mins.push(
                    '<option value="' + z + '">' + option + "</option>"
                );
            }
        }
        return disp_mins;
    }

    function date_wo_mins(date_nice) {
        var text_split = date_nice.split(":");
        return text_split[0] + ' :';
    }

    // foglalt időpont módosítása
    function bookingEditModal(booking_id){
    // $('body').on('click', '.cal_reserved_TMPBLOCK', function(){ 

        $('.div_preloader').show();

        // var booking_id = $(this).attr('data-id'),
        var c_type = $('.admin_title').attr('data-c_type');

        // console.log($(this).attr('data-id'));

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/" + c_type + "/edit_get_datas",
            type: "POST",
            data: {
                booking_id: booking_id
            },
            success: function (data) {
                // console.log(data[0]);

                $("#bookingEditModal #bookingDateMins").html(generate_mins(data[0].start_time));

                // ha az időpont nincs megerősítve, akkor NEM lehet törölni, sem szerkeszteni!
                if(data[0].confirmed != 1){
                    // $('.edit_delete_booking').css('display', 'none');
                    // $('#editBookingButton').css('display', 'none');
                    $('#delete_edit_group').css('display', 'none');
                    $('#pay_form').css('display', 'none');
                }
                else{
                    // $('.edit_delete_booking').css('display', 'block');
                    // $('#editBookingButton').css('display', 'block');
                    $('#delete_edit_group').css('display', 'block');
                    $('#pay_form').css('display', 'block');
                }

                // törlés gomb data-id:
                $('.edit_delete_booking').attr('data-booking_id', booking_id);

                // update gomb data-id:
                $('#updateBookingButton').attr('data-booking_id', booking_id);

                if(data[0].visitors_name != 'NOTSET'){
                    $('#bookingEditModal #visitorName').val(data[0].visitors_name);
                }else{
                    $('#bookingEditModal #visitorName').val('');
                }
                
                if(data[0].visitors_email != 'NOTSET'){
                    $('#bookingEditModal #visitorEmail').val(data[0].visitors_email);
                }else{
                    $('#bookingEditModal #visitorEmail').val('');
                }

                if(data[0].visitors_phone != 'NOTSET'){
                    $('#bookingEditModal #visitorPhone').val(data[0].visitors_phone);
                }else{
                    $('#bookingEditModal #visitorPhone').val('');
                }

                if(data[0].licence_plate != 'NOTSET'){
                    $('#bookingEditModal #licencePlate').val(data[0].licence_plate);
                }else{
                    $('#bookingEditModal #licencePlate').val('');
                }

                if(data[0].plus_mins != null){
                    $('#bookingEditModal #bookingDateMins').val(data[0].plus_mins);
                }else{
                    $('#bookingEditModal #bookingDateMins')[0].selectedIndex = 0;
                }

                if(data[0].car_brand != 'NOTSET'){
                    $('#bookingEditModal #carBrand').val(data[0].car_brand);
                }else{
                    $('#bookingEditModal #carBrand').val('');
                }
                
                if(data[0].car_brand_other != 'NOTSET'){
                    $('#bookingEditModal #carBrand_other').val(data[0].car_brand_other);
                }
                else{
                    $('#bookingEditModal #carBrand_other').val('');
                }
                if(data[0].car_type_other != 'NOTSET'){
                    $('#bookingEditModal #carType_other').val(data[0].car_type_other);
                }else{
                    $('#bookingEditModal #carType_other').val('');
                }

                

                if(data[0].motortip!= 'NOTSET'){
                    $('#bookingEditModal #motortip').val(data[0].motortip);
                }else{
                    $('#bookingEditModal #motortip').val('');
                }
                if(data[0].alvaz!= 'NOTSET'){
                    $('#bookingEditModal #alvaz').val(data[0].alvaz);
                }else{
                    $('#bookingEditModal #alvaz').val('');
                }
                if(data[0].cm3!= 'NOTSET'){
                    $('#bookingEditModal #cm3').val(data[0].cm3);
                }else{
                    $('#bookingEditModal #cm3').val('');
                }
                if(data[0].teljesitmeny!= 'NOTSET'){
                    $('#bookingEditModal #teljesitmeny').val(data[0].teljesitmeny);
                }else{
                    $('#bookingEditModal #teljesitmeny').val('');
                }


                get_only_car_types_list(data[0].car_brand, 'edit', data[0].car_type);

                get_only_serivice_list('edit', c_type, data[0].services_id);

                $('#bookingEditModal #bookingDateInterval').val(date_wo_mins(data[1]));

                if(data[0].tire_parking != 'NOTSET'){
                    if(data[0].tire_parking == 1){
                        $('#bookingEditModal #tireParking').prop( "checked", true );
                    }
                    else{
                        $('#bookingEditModal #tireParking').prop( "checked", false );
                    }
                }

                // alert(data[0].comment);
                if(data[0].comment != null){

                    var regex = /<br\s*[\/]?>/gi;
                    $('#bookingEditModal #bookingComment').val(data[0].comment.replace(regex, ""));
                }else{
                    $('#bookingEditModal #bookingComment').val('');
                }

                // modal megjelenítése
                $('#bookingEditModal').modal('show');

                if(c_type == 'tire'){
                    $('#bookingEditModal #tireParkingBlock').removeClass('d-none');
                    $('#bookingEditModal #motortip').parent('.form-group').addClass('d-none');
                    $('#bookingEditModal #alvaz').parent('.form-group').addClass('d-none');
                    $('#bookingEditModal #cm3').parent('.form-group').addClass('d-none');
                    $('#bookingEditModal #teljesitmeny').parent('.form-group').addClass('d-none');
                }
                else{
                    $('#bookingEditModal #tireParkingBlock').addClass('d-none');
                    $('#bookingEditModal #motortip').parent('.form-group').removeClass('d-none');
                    $('#bookingEditModal #alvaz').parent('.form-group').removeClass('d-none');
                    $('#bookingEditModal #cm3').parent('.form-group').removeClass('d-none');
                    $('#bookingEditModal #teljesitmeny').parent('.form-group').removeClass('d-none');
                }
                
                $('.div_preloader').hide();


                    // $.notify(
                    //     {
                    //         message:
                    //             "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                    //             JSON.stringify(data.errors)
                    //     },
                    //     {
                    //         // settings
                    //         type: "danger",
                    //         delay: 0
                    //     }
                    // );
            }
        });
    // });
    }

    // törlés előnézet közben
    var delete_click_count = 0;
    $('body').on('click', '#bookingPreviewModal .edit_delete_booking', function(){

        if($(this).hasClass('disabled') && delete_click_count < 4){
            // rendezve
            delete_click_count++;
        }
        else{
            if(delete_click_count > 3){
                if (confirm('Biztosan engedélyezni szeretné a törlést?')) {
                    // átengedjük
                    $('#bookingPreviewModal .edit_delete_booking').removeClass('disabled');
                    $('#bookingPreviewModal #payment_type').focus();
                    delete_click_count = 0;

                    // szabadon törölhet
                    delete_in_preview_modal();
                }
                else{
                    delete_click_count = 0;
                }
            }
            else{
                // szabadon törölhet
                delete_in_preview_modal();
            }
        }
    });

    function delete_in_preview_modal(){
        var booking_id = $('#bookingPreviewModal .edit_delete_booking').attr('data-booking_id'),
        c_type = $('.admin_title').attr('data-c_type');

        var reason = prompt("Biztosan törölni akarja ezt foglalást?\nRendszám: " + $('.pre_licencePlate div:nth-child(2) p').text() + '\nAdja meg a törlés okát:');
        if (reason === "") {
            // make_delete(booking_id, c_type);
        }else if(reason){
            make_delete(booking_id, c_type, reason);
        }

        // make_delete(booking_id, c_type);
    }

    function make_delete(booking_id, c_type, reason = ''){
        $('.div_preloader').show();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "/admin/booking/" + c_type + "/edit_delete",
                type: "POST",
                data: {
                    booking_id: booking_id,
                    reason: reason
                },
                success: function (data) {
                    $('#bookingPreviewModal').modal('hide');
                    $('#bookingEditModal').modal('hide');
                    $('.div_preloader').hide();

                    if(data.success == 1){
                        $.notify({
                            message : "<strong>Sikeres foglalás törlés!</strong>"
                        },{
                            type: 'success'
                        });
                        // frissítsük a naptárat!
                        booking_restart_actual_date();
                    }
                    else{
                        $.notify(
                            {
                                message:
                                    "<strong>Sikertelen törlés!</strong> Hibaüzenet: " +
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
            });
    }

    // törlés szerkesztés közben
    $('body').on('click', '#bookingEditModal .edit_delete_booking', function(){

        $('.div_preloader').show();

        var booking_id = $(this).attr('data-booking_id'),
        c_type = $('.admin_title').attr('data-c_type');

        var reason = prompt("Biztosan törölni akarja ezt foglalást?\nRendszám: " + $('.pre_licencePlate div:nth-child(2) p').text() + '\nAdja meg a törlés okát:');
        if (reason === "") {
            // make_delete(booking_id, c_type);
        }else if(reason){
            make_delete(booking_id, c_type, reason);
        }

        // var conf = confirm("Biztosan törölni akarja ezt foglalást? Rendszám: " + $('#bookingEditModal #licencePlate').val());
        // if(conf == true){
        //     $.ajax({
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        //         },
        //         url: "/admin/booking/" + c_type + "/edit_delete",
        //         type: "POST",
        //         data: {
        //             booking_id: booking_id
        //         },
        //         success: function (data) {

        //             $('.div_preloader').hide();

        //             if(data.success == 1){
        //                 $.notify({
        //                     message : "<strong>Sikeres foglalás törlés!</strong>"
        //                 },{
        //                     type: 'success'
        //                 });

        //                 // frissítsük a naptárat!
        //                 booking_restart_actual_date();
        //             }
        //             else{
        //                 $.notify(
        //                     {
        //                         message:
        //                             "<strong>Sikertelen törlés!</strong> Hibaüzenet: " +
        //                             JSON.stringify(data.errors)
        //                     },
        //                     {
        //                         // settings
        //                         type: "danger",
        //                         delay: 0
        //                     }
        //                 );
        //             }
                    
                    
        //         }
        //     });
        // }

    });


    // foglalás módosítása:
    $('#bookingEditModalForm').submit(function (event) {
        event.preventDefault();

        var booking_id = $('#bookingEditModal #updateBookingButton').attr('data-booking_id'),
        c_type = $('.admin_title').attr('data-c_type');

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/" + c_type + "/edit_update",
            type: "POST",
            data: {
                booking_id: booking_id,

                licencePlate: $('#bookingEditModal #licencePlate').val(),
                plus_mins: $('#bookingEditModal #bookingDateMins').val(),
                carBrand: $('#bookingEditModal #carBrand').val(),
                carType: $('#bookingEditModal #carType').val(),
                bookingComment: $('#bookingEditModal #bookingComment').val(),
                tireParking: $("#bookingEditModal #tireParking:checked").length,
                bookingService: $('#bookingEditModal #bookingService').val(),
                visitorName: $('#bookingEditModal #visitorName').val(),
                visitorEmail: $('#bookingEditModal #visitorEmail').val(),
                visitorPhone: $('#bookingEditModal #visitorPhone').val(),
                motortip: $('#bookingEditModal #motortip').val(),
                alvaz: $('#bookingEditModal #alvaz').val(),
                cm3: $('#bookingEditModal #cm3').val(),
                teljesitmeny: $('#bookingEditModal #teljesitmeny').val()
            },
            success: function (data) {

                // $('.div_preloader').hide();

                if(data.success == 1){
                    $.notify({
                        message : "<strong>Sikeres foglalás módosítás!</strong>"
                    },{
                        type: 'success'
                    });

                    // inputok kitörlése
                    $('#bookingEditModal #visitorName').val('');
                    $('#bookingEditModal #visitorEmail').val('');
                    $('#bookingEditModal #visitorPhone').val('');
                    $('#bookingEditModal #licencePlate').val('');
                    $('#bookingEditModal #bookingDateMins').val('');
                    $('#bookingEditModal #carBrand').val('');
                    $('#bookingEditModal #carType').val('');
                    $('#bookingEditModal #bookingService').val('');
                    $('#bookingEditModal #bookingComment').val('');
                    $('#bookingEditModal #tireParking').prop('checked', false);

                    // szerkesztés modal bezárása
                    $('#bookingEditModal').modal('hide');

                    // frissítsük a naptárat!
                    // booking_restart_actual_date();
                }
                else{
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen módosítás!</strong> Hibaüzenet: " +
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
        });

    });

    // AJAX --> SESSION KEZELÉS

    // 1. AJAX: Megnézi, hogy az aktuális időpont foglalás alatt van-e! (pl ha úgyhagy egy weboldalt sokáig, akkor már teljesen más lehet a kép!)
    // ha foglalt --> akkor kiírja, hogy az aktuális időpont már foglalt és újratölti a naptárat!

    function is_date_in_sessions(c_type, date_start, date_end, date_nice) {

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/" + c_type + "services/get_session",
            type: "POST",
            data: {
                c_type: c_type,
                date_start: date_start,
                date_end: date_end
            },
            success: function (data) {
                // megnézi, hogy az adott időpont nincs-e a múltban. HA igen, akkor új foglalás nem eszközölhető rá!
                // if(data.past_booking_error == 1){
                //     alert('Az adott időpont a múltban van, nem foglalható!');
                //     booking_restart_actual_date();
                // }
                // else{
                    // MEHET AZ INSERT A SESSION TÁBLÁBA!
                    insert_update_sessions(c_type, date_start, date_end, date_nice);
                // }
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
            url: "/admin/booking/" + c_type + "services/insert_update_session",
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
                        }
                        else{
                            $('#bookingModal #tireParkingBlock').addClass('d-none');
                            $('#bookingModal #motortip').parent('.form-group').removeClass('d-none');
                            $('#bookingModal #alvaz').parent('.form-group').removeClass('d-none');
                            $('#bookingModal #cm3').parent('.form-group').removeClass('d-none');
                            $('#bookingModal #teljesitmeny').parent('.form-group').removeClass('d-none');
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

        var c_type = $('.admin_title').attr('data-c_type'),
        date_start = '',
        date_end = '',
        date_nice = '';

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
        $('#bookingEditModal #motortip').val('');
        $('#bookingEditModal #alvaz').val('');
        $('#bookingEditModal #cm3').val('');
        $('#bookingEditModal #teljesitmeny').val('');
    });

    function UpdateCalendar(first_date, mode, length, c_type, without_preloader) {
        if(c_type != ''){
            // naptár időközönként frissítésének elindítása - csak egyszer az induláskor!
            if(interval_update_in_progress == null){
                // ÁTMENETILEG KIKAPCS!
                interval_update_calendar();
            }
            if(without_preloader == null){
                $('.div_preloader').show();
            }
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "/ajax/update_calendar/" + c_type,
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
                                var time_block = '',
                                multiple_counter = '';
                                time_block = '<div class="noselect';
                                if(t_e[2] == 2){
                                    time_block += ' closed" data-start="' + t_e[0] + '" data-end="' + t_e[1] + '" data-nice="' + t_e[3] + '">-</div>';
                                }else{
                                    if(t_e[2] == 1){
                                        time_block += ' cal_free"'; 
                                    }else{
                                        if(t_e[2] == 3 || t_e[5] == null){ // ha folyamatban van a foglalás, vagy ha a foglalás még nincs megerősítve
                                            if(t_e[2] == 3){
                                                time_block += ' cal_progressed cal_pending"';
                                            }
                                            else{
                                                time_block += ' cal_progressed cal_not_free"';
                                            }
                                        }
                                        else{
                                            if(t_e[8] == t_e[7]){
                                                time_block += ' cal_paid cal_not_free"';
                                            }
                                            else{
                                                time_block += ' cal_reserved cal_not_free"';
                                            }
                                        }
                                    }
                                    if(t_e[4]){
                                        time_block += ' data-id="' + t_e[4] + '" data-start="' + t_e[0] + '" data-end="' + t_e[1] + '" data-nice="' + t_e[6] + '" data-count="' + t_e[7] + '">'; 
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
                                            // admin oldalon foglalt + rendszám:
                                            // ha t_e[7] > 1 --> itt többszörös foglalás van, írassuk ki!
                                            if(t_e[7] > 1){

                                                // a sárga gombot jelölni kékkel, ha a többi is fizetve van --> még bizonytalan
                                                // if(t_e[8] != null){
                                                //     multiple_counter = 'multiple_counter_paid"';
                                                // }
                                                // else{
                                                //     multiple_counter = 'multiple_counter"';
                                                // }

                                                multiple_counter = 'multiple_counter';

                                                time_block += t_e[3] + '<span class="'+multiple_counter+'">+' + (t_e[7]-1) + '</span>';
                                            }
                                            else{
                                                time_block += t_e[3];
                                            }
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
                        // if(data.enable_prev == 1){
                        //     $('#enable_prev').removeClass('disabled');
                        // }else{
                        //     $('#enable_prev').addClass('disabled');
                        // }
                        $('#enable_prev').removeClass('disabled');
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
            if(auto_update_calendar == 1){
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
    $(".rendszam").on('keyup change', function (event){

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
