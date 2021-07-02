$(document).ready(function() {

    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd',
        autoHide: true,
        weekStart: 1
    });


    // 1. dátum lecsekkolása, hogy van-e már ilyen a táblában --> ha van, akkor hibaüzenet, hogy módosítsa
    //      - lecsekkoló fv.
    /**
     * @param  {} date  datepickeres dátum
     * @param  {} yearly_repeat ismétlődjön a dátum évente?
     * @param  {} hours_from    nyitási idő
     * @param  {} hours_to  zárási idő
     * @param  {} list_layer    megjlenített dátumok
     * @param  {} tire_or_car   gumi, vagy autó?
     * @param  {} is_work_day   munkanap, vagy szabadnap? --> 1 / 0
     */
    function check_date(date, yearly_repeat, hours_from, hours_to, list_layer, tire_or_car, is_work_day, by_year){
        $('.div_preloader').show();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/booking/settings/extradates_is_exists",
            data: {
                date: date,
                tire_or_car: tire_or_car
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data);
                
                if (data.errors) { // ha VAN hiba
                    
                    $('.div_preloader').hide();
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: "<strong>Sikertelen hozzáadás!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{                    
                    upload_date(date, yearly_repeat, hours_from, hours_to, list_layer, tire_or_car, is_work_day, by_year);
                }
            }
        });
    }

    // 2. ha okés, akkor töltse fel
    //      - feltöltő fv.
    function upload_date(date, yearly_repeat, hours_from, hours_to, list_layer, tire_or_car, is_work_day, by_year){
        
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/booking/settings/extradates_upload",
            data: {
                date: date,
                yearly_repeat: yearly_repeat,
                from_hour: hours_from,
                to_hour: hours_to,
                tire_or_car: tire_or_car,
                is_work_day: is_work_day
            },
            dataType: "text",
            success: function(data) {
                
                data = JSON.parse(data);
                //console.log(data);
                if (data.errors) { // ha VAN hiba
                    
                    $('.div_preloader').hide();
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: "<strong>Sikertelen hozzáadás!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{
                    if (data.success) { // ha VAN változó / success
                        $('.div_preloader').hide();
                        // list_date(date, yearly_repeat, hours_from, hours_to, year, list_layer, tire_or_car, is_work_day);
                        list_date(list_layer, tire_or_car, is_work_day, by_year);
                        $.notify({
                            message : "<strong>Sikeres dátum hozzáadás!</strong>"
                        },{
                            type: 'success'
                        });
                    }
                }
            }
        });
    }

    // 3. ha sikerült, akkor jelenítse meg a listában (frissítse a dátumok tartalmát)
    //      - listázó fv.
    // function list_date(date, yearly_repeat, hours_from, hours_to, year, list_layer, tire_or_car, is_work_day){
    function list_date(list_layer, tire_or_car, is_work_day, by_year = ''){
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/booking/settings/extradates_list",
            data: {
                tire_or_car: tire_or_car,
                is_work_day: is_work_day,
                by_year: by_year
            },
            dataType: "text",
            success: function(data) {
                
                data = JSON.parse(data);
                //console.log(data);
                if (data.errors) { // ha VAN hiba
                    
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: list_layer + "<strong> Lista frissítése sikertelen!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{
                    if (data.success) { // ha VAN változó / success
                        $('#' + list_layer).html(data.dates_html);
                        compare_block_sizes();
                    }
                }
            }
        });
    }

    // Rendkívüli nyitvatartás hozzáadása - Gumiszerviz:
    $('#extradates_tire_open_add').click(function(){
        if($('#extradates_tire_open_date').val().length !== 0 ){
            var date = $('#extradates_tire_open_date').val(),
            yearly_repeat = false,
            hours_from = $('#extradates_tire_open_hours_from').val(),
            hours_to = $('#extradates_tire_open_hours_to').val(),
            list_layer = 'extradates_tire_open_list',
            tire_or_car = 'tire',
            is_work_day = 1;

            var year_from_date = date.split('-');
            var by_year = year_from_date[0];

            // nem lehet nagyobb, vagy egyenlő a nyitvatartás!
            if(hours_from >= hours_to){
                $.notify({
                    message : "<strong>A nyitás ideje kisebb kell, hogy legyen, mint a zárási idő!</strong>"
                },{
                    type: 'danger'
                });
            }
            else{
                check_date(date, yearly_repeat, hours_from, hours_to, list_layer, tire_or_car, is_work_day, by_year);  
                $('#extradates_tire_open_year').val(by_year);
            }

        }else{
            $.notify({
                message : "<strong>Kérem előbb válasszon ki dátumot!</strong>"
            },{
                type: 'danger'
            });
        }
    });
    
    $('#extradates_tire_open_year').on('change', function() {

        var list_layer = 'extradates_tire_open_list',
        tire_or_car = 'tire',
        is_work_day = 1,
        by_year = $(this).val();

        list_date(list_layer, tire_or_car, is_work_day, by_year);
    });

    // Ünnepnapok / Szabadnapok hozzáadása - Gumiszerviz:
    $('#extradates_tire_close_add').click(function(){
        if($('#extradates_tire_close').val().length !== 0 ){
            var date = $('#extradates_tire_close').val(),
            yearly_repeat = $('#extradates_tire_close_yearly_repeat').prop('checked'),
            hours_from = '',
            hours_to = '',
            list_layer = 'extradates_tire_close_list',
            tire_or_car = 'tire';
            is_work_day = 0;

            var year_from_date = date.split('-');
            var by_year = year_from_date[0];

            check_date(date, yearly_repeat, hours_from, hours_to, list_layer, tire_or_car, is_work_day, by_year);
            $('#extradates_tire_close_year').val(by_year);

        }else{
            $.notify({
                message : "<strong>Kérem előbb válasszon ki dátumot!</strong>"
            },{
                type: 'danger'
            });
        }
    });

    $('#extradates_tire_close_year').on('change', function() {

        var list_layer = 'extradates_tire_close_list',
        tire_or_car = 'tire',
        is_work_day = 0,
        by_year = $(this).val();

        list_date(list_layer, tire_or_car, is_work_day, by_year);
    });


    // Rendkívüli nyitvatartás hozzáadása - Autószerviz:
    $('#extradates_car_open_add').click(function(){
        if($('#extradates_car_open_date').val().length !== 0 ){
            var date = $('#extradates_car_open_date').val(),
            yearly_repeat = false,
            hours_from = $('#extradates_car_open_hours_from').val(),
            hours_to = $('#extradates_car_open_hours_to').val(),
            list_layer = 'extradates_car_open_list',
            tire_or_car = 'car';
            is_work_day = 1;

            var year_from_date = date.split('-');
            var by_year = year_from_date[0];

            // nem lehet nagyobb, vagy egyenlő a nyitvatartás!
            if(hours_from >= hours_to){
                $.notify({
                    message : "<strong>A nyitás ideje kisebb kell, hogy legyen, mint a zárási idő!</strong>"
                },{
                    type: 'danger'
                });
            }
            else{
                check_date(date, yearly_repeat, hours_from, hours_to, list_layer, tire_or_car, is_work_day, by_year);  
                $('#extradates_car_open_year').val(by_year);
            }

        }else{
            $.notify({
                message : "<strong>Kérem előbb válasszon ki dátumot!</strong>"
            },{
                type: 'danger'
            });
        }
    });

    $('#extradates_car_open_year').on('change', function() {

        var list_layer = 'extradates_car_open_list',
        tire_or_car = 'car',
        is_work_day = 1,
        by_year = $(this).val();

        list_date(list_layer, tire_or_car, is_work_day, by_year);
    });


    // Ünnepnapok / Szabadnapok hozzáadása - Autószerviz:
    $('#extradates_car_close_add').click(function(){
        if($('#extradates_car_close').val().length !== 0 ){
            var date = $('#extradates_car_close').val(),
            yearly_repeat = $('#extradates_car_close_yearly_repeat').prop('checked'),
            hours_from = '',
            hours_to = '',
            list_layer = 'extradates_car_close_list',
            tire_or_car = 'car';
            is_work_day = 0;

            var year_from_date = date.split('-');
            var by_year = year_from_date[0];

            check_date(date, yearly_repeat, hours_from, hours_to, list_layer, tire_or_car, is_work_day, by_year);
            $('#extradates_car_close_year').val(by_year);

        }else{
            $.notify({
                message : "<strong>Kérem előbb válasszon ki dátumot!</strong>"
            },{
                type: 'danger'
            });
        }
    });

    $('#extradates_car_close_year').on('change', function() {

        var list_layer = 'extradates_car_close_list',
        tire_or_car = 'car',
        is_work_day = 0,
        by_year = $(this).val();

        list_date(list_layer, tire_or_car, is_work_day, by_year);
    });


    // MÓDOSÍTÁS / TÖRLÉS

    // Globális változók - ezeket a modal bezárását követően kinullázzuk!
    var modal_parent_id = '',
    modal_date_id = '';

    // Rendkívüli dátum módosítása
    $(document).on('click', '.btn_dates_open', function(){

        var parent_id = $(this).parent().attr('id'),
        date_id = $(this).attr('data-id'),
        date = $(this).text();

        var date_parts = date.split(' ');

        modal_parent_id = parent_id,
        modal_date_id = date_id;

        $('#modal_open_date').val(date_parts[0]);
        $('#modal_open_from').val(date_parts[1]);
        $('#modal_open_to').val(date_parts[3]);

        // datepicker
        $('[data-toggle="datepicker_spec"]').datepicker({
            format: 'yyyy-mm-dd',
            autoHide: true,
            weekStart: 1,
            date: date_parts[0]
        });

        $('#bookings_settings_rendkivuli').modal('show');
        
    });

    // Ünnepnapok / Szabadnapok dátum módosítása
    $(document).on('click', '.btn_dates_close', function(){

        var parent_id = $(this).parent().attr('id'),
        date_id = $(this).attr('data-id'),
        date = $(this).text();

        var date_parts = date.split(' ');

        $('#modal_close_date').val(date_parts[0]);

        modal_parent_id = parent_id,
        modal_date_id = date_id;

        // első karakter meghatározása:
        var yearly_repeat = date.slice(0,1);
        // ha csillaggal kezdődik a dátum:
        if(yearly_repeat == '*'){
            var new_date = date_parts[0].replace('*', new Date().getFullYear());
            // datepicker ismétlődős - idei évet mutatjuk neki
            $('[data-toggle="datepicker_spec"]').datepicker({
                format: 'yyyy-mm-dd',
                autoHide: true,
                weekStart: 1,
                date: new_date
            });
            $('#modal_close_date_yearly').prop( "checked", true );
        }
        else{
            // datepicker éves
            $('[data-toggle="datepicker_spec"]').datepicker({
                format: 'yyyy-mm-dd',
                autoHide: true,
                weekStart: 1,
                date: date_parts[0]
            });
        }

        $('#bookings_settings_szabadnap').modal('show');

    });

    // spec modalok destroy-ja ha a modal bezáródik!
    $('.modal').on('hidden.bs.modal', function () {
        modal_parent_id = '',
        modal_date_id = '';

        $('[data-toggle="datepicker_spec"]').datepicker('destroy');
        $('#modal_close_date_yearly').prop( "checked", false );
    });


    // Open btn update
    $(document).on('click', '#modal_open_btn_update', function(){
        
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/booking/settings/extradates_update_open",
            data: {
                modal_parent_id : modal_parent_id,
                modal_date_id : modal_date_id,
                modal_only_date : $('#modal_open_date').val(),
                modal_only_from : $('#modal_open_from').val(),
                modal_only_to : $('#modal_open_to').val()
            },
            dataType: "text",
            success: function(data) {
                
                data = JSON.parse(data);
                // console.log(data);
                if (data.errors) { // ha VAN hiba
                    
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: "<strong> Dátum frissítése sikertelen!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{
                    if (data.success) { // ha VAN változó / success

                        // lista frissítése a háttérben!
                        var list_layer = modal_parent_id,
                        tire_or_car = data.tire_or_car,
                        is_work_day = 1,
                        by_year = data.only_year;

                        // console.log(list_layer + ' - ' + tire_or_car + ' - ' + is_work_day + ' - ' + by_year);

                        list_date(list_layer, tire_or_car, is_work_day, by_year);

                        // év gomb állítása
                        $('#' + modal_parent_id).closest('.dates-list-box').find('select').val(by_year)

                        // modal bezárása
                        $('.modal').modal('hide');

                        $.notify({
                            message : "<strong>Sikeres dátum módosítás!</strong>"
                        },{
                            type: 'success'
                        });
                    }
                }
            }
        });

    });

    // Close btn update
    $(document).on('click', '#modal_close_btn_update', function(){
        
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/booking/settings/extradates_update_close",
            data: {
                modal_parent_id : modal_parent_id,
                modal_date_id : modal_date_id,
                modal_only_date : $('#modal_close_date').val(),
                modal_yearly: $('#modal_close_date_yearly').is(":checked")
            },
            dataType: "text",
            success: function(data) {
                
                data = JSON.parse(data);
                // console.log(data);
                if (data.errors) { // ha VAN hiba
                    
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: "<strong> Dátum frissítése sikertelen!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{
                    if (data.success) { // ha VAN változó / success

                        // lista frissítése a háttérben!
                        var list_layer = modal_parent_id,
                        tire_or_car = data.tire_or_car,
                        is_work_day = 0,
                        by_year = data.only_year;

                        list_date(list_layer, tire_or_car, is_work_day, by_year);

                        // év gomb állítása
                        $('#' + modal_parent_id).closest('.dates-list-box').find('select').val(by_year)

                        // modal bezárása
                        $('.modal').modal('hide');

                        $.notify({
                            message : "<strong>Sikeres dátum módosítás!</strong>"
                        },{
                            type: 'success'
                        });
                    }
                }
            }
        });

    });

    // Open btn delete
    $(document).on('click', '#modal_open_btn_delete', function(){
        var conf = confirm("Biztosan törölni akarja ezt a dátumot: " + $('#modal_open_date').val());
        if(conf == true){
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: "POST",
                url: "/admin/booking/settings/extradates_delete_open",
                data: {
                    modal_parent_id : modal_parent_id,
                    modal_date_id : modal_date_id,
                    modal_only_date : $('#modal_close_date').val()
                },
                dataType: "text",
                success: function(data) {
                    
                    data = JSON.parse(data);
                    // console.log(data);
                    if (data.errors) { // ha VAN hiba
                        
                        // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                        $.notify({
                            message: "<strong> Dátum törlése sikertelen!</strong> Hibaüzenet: " + data.errors
                        },{
                            // settings
                            type: 'danger',
                            delay: 0
                        });
                    }else{
                        if (data.success) { // ha VAN változó / success

                            // lista frissítése a háttérben!
                            var list_layer = modal_parent_id,
                            tire_or_car = data.tire_or_car,
                            is_work_day = 1,
                            by_year = '';

                            list_date(list_layer, tire_or_car, is_work_day, by_year);

                            // modal bezárása
                            $('.modal').modal('hide');

                            $.notify({
                                message : "<strong>Sikeres dátum törlés!</strong>"
                            },{
                                type: 'success'
                            });
                        }
                    }
                }
            });
        }
        else{
            $.notify({
                message: "<strong>" + $('#modal_open_date').val() + " dátum törlése megszakítva!</strong>"
            },{
                // settings
                type: 'danger'
            });
        }
    });

    // Close btn delete
    $(document).on('click', '#modal_close_btn_delete', function(){
        var conf = confirm("Biztosan törölni akarja ezt a dátumot: " + $('#modal_close_date').val());
        if(conf == true){
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: "POST",
                url: "/admin/booking/settings/extradates_delete_close",
                data: {
                    modal_parent_id : modal_parent_id,
                    modal_date_id : modal_date_id,
                    modal_only_date : $('#modal_close_date').val()
                },
                dataType: "text",
                success: function(data) {
                    
                    data = JSON.parse(data);
                    // console.log(data);
                    if (data.errors) { // ha VAN hiba
                        
                        // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                        $.notify({
                            message: "<strong> Dátum törlése sikertelen!</strong> Hibaüzenet: " + data.errors
                        },{
                            // settings
                            type: 'danger',
                            delay: 0
                        });
                    }else{
                        if (data.success) { // ha VAN változó / success

                            // lista frissítése a háttérben!
                            var list_layer = modal_parent_id,
                            tire_or_car = data.tire_or_car,
                            is_work_day = 0,
                            by_year = '';

                            list_date(list_layer, tire_or_car, is_work_day, by_year);

                            // modal bezárása
                            $('.modal').modal('hide');

                            $.notify({
                                message : "<strong>Sikeres dátum törlés!</strong>"
                            },{
                                type: 'success'
                            });
                        }
                    }
                }
            });
        }
        else{
            $.notify({
                message: "<strong>" + $('#modal_close_date').val() + " dátum törlése megszakítva!</strong>"
            },{
                // settings
                type: 'danger'
            });
        }
    });

    // Modal checkbox szerkesztéskor
    $(document).on('change', '#modal_close_date_yearly', function(){
        if(!$(this).is(":checked")){ // csekkolás kivéve -> dátum átírása
            $('#modal_close_date').val($('#modal_close_date').val().replace('*', new Date().getFullYear()));
        }
    });


    $('.bookings_settings_save').click(function(){

        // var days_plus = $('#days_plus_cars').val();

        var days_plus_cars = $('#days_plus_cars').val();
        var days_plus_tires = $('#days_plus_tires').val();
        var tire_open = $('#tire_open').val();
        var tire_close = $('#tire_close').val();
        var car_open = $('#car_open').val();
        var car_close = $('#car_close').val();
        var calendar_tires = $('#tires_booking_active').val();
        var calendar_cars = $('#cars_booking_active').val();

        var ebedszunet_gumis_from = $('#ebedszunet_gumis_from').val();
        var ebedszunet_gumis_to = $('#ebedszunet_gumis_to').val();
        var ebedszunet_autos_from = $('#ebedszunet_autos_from').val();
        var ebedszunet_autos_to = $('#ebedszunet_autos_to').val();

        // nyitvatartás változók
        var open_tire_1_from = $('#open_tire_mon_from').val(),
        open_tire_2_from = $('#open_tire_tue_from').val(),
        open_tire_3_from = $('#open_tire_wed_from').val(),
        open_tire_4_from = $('#open_tire_thu_from').val(),
        open_tire_5_from = $('#open_tire_fri_from').val(),
        open_tire_6_from = $('#open_tire_sat_from').val(),
        open_tire_1_to = $('#open_tire_mon_to').val(),
        open_tire_2_to = $('#open_tire_tue_to').val(),
        open_tire_3_to = $('#open_tire_wed_to').val(),
        open_tire_4_to = $('#open_tire_thu_to').val(),
        open_tire_5_to = $('#open_tire_fri_to').val(),
        open_tire_6_to = $('#open_tire_sat_to').val(),

        open_car_1_from = $('#open_car_mon_from').val(),
        open_car_2_from = $('#open_car_tue_from').val(),
        open_car_3_from = $('#open_car_wed_from').val(),
        open_car_4_from = $('#open_car_thu_from').val(),
        open_car_5_from = $('#open_car_fri_from').val(),
        open_car_1_to = $('#open_car_mon_to').val(),
        open_car_2_to = $('#open_car_tue_to').val(),
        open_car_3_to = $('#open_car_wed_to').val(),
        open_car_4_to = $('#open_car_thu_to').val(),
        open_car_5_to = $('#open_car_fri_to').val();

        // alert(days_plus_cars + days_plus_tire)

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/booking/settings/update",
            data: {
                // days_plus: days_plus,
                days_plus_cars: days_plus_cars,
                days_plus_tires: days_plus_tires,
                tire_open: tire_open,
                tire_close: tire_close,
                car_open: car_open,
                car_close: car_close,
                calendar_tires: calendar_tires,
                calendar_cars: calendar_cars,
                ebedszunet_gumis_from: ebedszunet_gumis_from,
                ebedszunet_gumis_to: ebedszunet_gumis_to,
                ebedszunet_autos_from: ebedszunet_autos_from,
                ebedszunet_autos_to: ebedszunet_autos_to,

                open_tire_1_from :open_tire_1_from,
                open_tire_2_from :open_tire_2_from,
                open_tire_3_from :open_tire_3_from,
                open_tire_4_from :open_tire_4_from,
                open_tire_5_from :open_tire_5_from,
                open_tire_6_from :open_tire_6_from,
                open_tire_1_to :open_tire_1_to,
                open_tire_2_to :open_tire_2_to,
                open_tire_3_to :open_tire_3_to,
                open_tire_4_to :open_tire_4_to,
                open_tire_5_to :open_tire_5_to,
                open_tire_6_to :open_tire_6_to,

                open_car_1_from :open_car_1_from,
                open_car_2_from :open_car_2_from,
                open_car_3_from :open_car_3_from,
                open_car_4_from :open_car_4_from,
                open_car_5_from :open_car_5_from,
                open_car_1_to :open_car_1_to,
                open_car_2_to :open_car_2_to,
                open_car_3_to :open_car_3_to,
                open_car_4_to :open_car_4_to,
                open_car_5_to :open_car_5_to
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data);
                if (data.errors) { // ha VAN hiba
                    
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: "<strong>Sikertelen mentés!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{
                    if (data.success) { // ha VAN változó / success
                        $.notify({
                            message : "<strong>Sikeres mentés!</strong> A Naptár beállítások frissítésre kerültek az adatbázisban."
                        },{
                            type: 'success'
                        });
                    }
                }
            }
        });
    });

    // induláskor lefutó összehasonlítás:
    compare_block_sizes();

    // felület funkciók - átméretezés
    function compare_block_sizes(){
        if($('#rendkivuli_autoszerviz_blue').outerHeight() > $('#rendkivuli_gumiszerviz_blue').outerHeight()){
            $('#rendkivuli_gumiszerviz_blue').css('min-height', $('#rendkivuli_autoszerviz_blue').outerHeight());
        }
        else{
            $('#rendkivuli_autoszerviz_blue').css('min-height', $('#rendkivuli_gumiszerviz_blue').outerHeight());
        }

        if($('#szabadnapok_gumiszerviz_blue').outerHeight() > $('#szabadnapok_autoszerviz_blue').outerHeight()){
            $('#szabadnapok_autoszerviz_blue').css('min-height', $('#szabadnapok_gumiszerviz_blue').outerHeight());
        }
        else{
            $('#szabadnapok_gumiszerviz_blue').css('min-height', $('#szabadnapok_autoszerviz_blue').outerHeight());
        }
    }

    // ablak átméretezésekor
    $(window).resize(function(){
        // console.log('resize van');
        
        compare_block_sizes();
    });

});