$(document).ready(function () {

    var timer;
    var auto_update_list = 0;
    var refresh_rate = 10000; // frissítési ráta ms-ban!

    $('#tf_date').daterangepicker({
        "showDropdowns": true,
        autoUpdateInput: false,
        forceUpdate: true,
        startDate: $('#tf_date').attr('data-from'),
        endDate: $('#tf_date').attr('data-to'),
        ranges: {
            'Ma': [moment(), moment()],
            'Tegnap': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Legutóbbi 7 nap': [moment().subtract(6, 'days'), moment()],
            'Legutóbbi 30 nap': [moment().subtract(29, 'days'), moment()],
            'Ez a hónap': [moment().startOf('month'), moment().endOf('month')],
            'Előző hónap': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "locale": {
            "format": "YYYY. MM. DD.",
            "separator": " - ",
            "applyLabel": "Alkalmaz",
            "cancelLabel": "Mégse",
            "fromLabel": "Ettől",
            "toLabel": "Eddig",
            "customRangeLabel": "Egyedi",
            "daysOfWeek": [
                "V",
                "H",
                "K",
                "SZE",
                "CS",
                "P",
                "SZO"
            ],
            "monthNames": [
                "Január",
                "Február",
                "Március",
                "Április",
                "Május",
                "Június",
                "Július",
                "Augusztus",
                "Szeptember",
                "Október",
                "November",
                "December"
            ],
            "firstDay": 1
        }
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        $('#tf_date').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        $('#tf_date').attr('data-from', start.format('YYYY-MM-DD'));
        $('#tf_date').attr('data-to', end.format('YYYY-MM-DD'));
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });

    $('#cf_date').daterangepicker({
        "showDropdowns": true,
        autoUpdateInput: false,
        startDate: $('#cf_date').attr('data-from'),
        endDate: $('#cf_date').attr('data-to'),
        ranges: {
            'Ma': [moment(), moment()],
            'Tegnap': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Legutóbbi 7 nap': [moment().subtract(6, 'days'), moment()],
            'Legutóbbi 30 nap': [moment().subtract(29, 'days'), moment()],
            'Ez a hónap': [moment().startOf('month'), moment().endOf('month')],
            'Előző hónap': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "alwaysShowCalendars": true,
        "locale": {
            "format": "YYYY. MM. DD.",
            "separator": " - ",
            "applyLabel": "Alkalmaz",
            "cancelLabel": "Mégse",
            "fromLabel": "Ettől",
            "toLabel": "Eddig",
            "customRangeLabel": "Egyedi",
            "daysOfWeek": [
                "V",
                "H",
                "K",
                "SZE",
                "CS",
                "P",
                "SZO"
            ],
            "monthNames": [
                "Január",
                "Február",
                "Március",
                "Április",
                "Május",
                "Június",
                "Július",
                "Augusztus",
                "Szeptember",
                "Október",
                "November",
                "December"
            ],
            "firstDay": 1
        }
    }, function(start, end, label) {
        console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
        $('#cf_date').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        $('#cf_date').attr('data-from', start.format('YYYY-MM-DD'));
        $('#cf_date').attr('data-to', end.format('YYYY-MM-DD'));
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });

    $(document).on('keyup', '#tf_licence_plate', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    $(document).on('keyup', '#tf_comment', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    $(document).on('input', '#tf_date', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    $(document).on('keyup', '#tf_name', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    $(document).on('keyup', '#tf_phone', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    $(document).on('change', '#tf_payment_type', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    $(document).on('change', '#tf_maxitems', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    $(document).on('click', '#tf_date_clear', function(){
        $('#tf_date').val('');
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_tires(page, length);
        }, 500);
    });
    

    $(document).on('keyup', '#cf_licence_plate', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });
    $(document).on('keyup', '#cf_comment', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });
    $(document).on('input', '#cf_date', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });
    $(document).on('keyup', '#cf_name', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });
    $(document).on('keyup', '#cf_phone', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });
    $(document).on('change', '#cf_payment_type', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });
    $(document).on('change', '#cf_maxitems', function(){
        clearTimeout(timer);  //clear any running timeout on key up
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#tf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });
    $(document).on('click', '#cf_date_clear', function(){
        $('#cf_date').val('');
        timer = setTimeout(function() { //then give it a second to see if the user is finished
            var length = $('#cf_maxitems').val();
            var page = 1;
            filter_cars(page, length);
        }, 500);
    });

    // MAI NAP LEKEZELÉSE - első datepicker
    $(document).on('click', '.daterangepicker .ranges:eq(0) .active', function(){

        if($(this).attr('data-range-key') == 'Ma'){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $('#tf_date').val(today + ' - ' + today).attr('data-from', today).attr('data-to', today);

            clearTimeout(timer);  //clear any running timeout on key up
            timer = setTimeout(function() { //then give it a second to see if the user is finished
                var length = $('#tf_maxitems').val();
                var page = 1;
                filter_tires(page, length);
            }, 500);
        }
    });
    // MAI NAP LEKEZELÉSE - második datepicker
    $(document).on('click', '.daterangepicker .ranges:eq(1) .active', function(){

        if($(this).attr('data-range-key') == 'Ma'){
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            today = yyyy + '-' + mm + '-' + dd;
            $('#cf_date').val(today + ' - ' + today).attr('data-from', today).attr('data-to', today);

            clearTimeout(timer);  //clear any running timeout on key up
            timer = setTimeout(function() { //then give it a second to see if the user is finished
                var length = $('#tf_maxitems').val();
                var page = 1;
                filter_cars(page, length);
            }, 500);
        }
    });


    // NAPTÁRVÁLASZTÓ INICIALIZÁLÁSA
    // ha csak egy naptár jelenik meg, automatikusan az legyen kiválasztva!
    if($('.list_select_booking_type').length < 2){
        // $('.intro_layer').hide();
        calendar_type_selector($('.list_select_booking_type').attr('data-c_type'));
    }
    else{
        $('#calendar_holder').removeClass('d-none');
    }

    // interval update list
    function interval_update_list(){

        if($('.list_intro_layer').is(":hidden")){ // csak akkor, ha a főmenü nem aktív
            if(auto_update_list == 1){
                
                setTimeout(function(){

                    if($('.list_intro_layer').is(":hidden")){

                        var paginate_page = $('.pagination .active .page-link').text();
                        var length = $('#tf_maxitems').val();
                        var page = 1;
                        if(paginate_page != ''){
                            page = paginate_page;
                        }
                        filter_tires(page, length);

                        // önmaga újrahívása
                        interval_update_list();
                    }
                }, refresh_rate);
            }
        }
    }

    // típus kiválasztása után
    $('.list_select_booking_type').click(function(){
        calendar_type_selector($(this).attr('data-c_type'));
    });
    function calendar_type_selector(c_type){
        var get_first_date = new Date().toISOString().slice(0,10);
        if(c_type != ''){
            if(c_type == 'tire'){
                $('#idopontok_gumiszerviz').removeClass('d-none');
                $('.admin_title').attr('data-c_type', c_type);
            }else{
                if(c_type == 'car'){
                    $('#idopontok_autoszerviz').removeClass('d-none');
                    $('.admin_title').attr('data-c_type', c_type);
                }
            }
            $('#calendar_holder').addClass('d-none');
            interval_update_list();
        }
    }

    function filter_tires(page = null, length = null){

        var tf_licence_plate = ($('#tf_licence_plate').val().length > 0) ? $('#tf_licence_plate').val() : null;
        var tf_comment = ($('#tf_comment').val().length > 0) ? $('#tf_comment').val() : null;
        var tf_name = ($('#tf_name').val().length > 0) ? $('#tf_name').val() : null;
        var tf_phone = ($('#tf_phone').val().length > 0) ? $('#tf_phone').val() : null;
        var tf_payment_type = ($('#tf_payment_type').val().length > 0) ? $('#tf_payment_type').val() : null;
        var tf_maxitems = $('#tf_maxitems').val();
        
        if($('#tf_date').val().length > 0){
            tf_date_from = $('#tf_date').attr('data-from');
            tf_date_to = $('#tf_date').attr('data-to');
        }
        else{
            tf_date_from = null;
            tf_date_to = null;
        }

        var datas = {
            tf_licence_plate : tf_licence_plate,
            tf_comment : tf_comment,
            tf_name : tf_name,
            tf_phone : tf_phone,
            tf_date_from : tf_date_from,
            tf_date_to : tf_date_to,
            tf_payment_type : tf_payment_type,
            tf_maxitems : tf_maxitems,
            page : page,
            length : length
        }

        filter_ajax_tires(datas, 'tires');
    }

    function filter_cars(page = null, length = null){

        var cf_licence_plate = ($('#cf_licence_plate').val().length > 0) ? $('#cf_licence_plate').val() : null;
        var cf_comment = ($('#cf_comment').val().length > 0) ? $('#cf_comment').val() : null;
        var cf_name = ($('#cf_name').val().length > 0) ? $('#cf_name').val() : null;
        var cf_phone = ($('#cf_phone').val().length > 0) ? $('#cf_phone').val() : null;
        var cf_payment_type = ($('#cf_payment_type').val().length > 0) ? $('#cf_payment_type').val() : null;
        var cf_maxitems = $('#cf_maxitems').val();
        
        if($('#cf_date').val().length > 0){
            cf_date_from = $('#cf_date').attr('data-from');
            cf_date_to = $('#cf_date').attr('data-to');
        }
        else{
            cf_date_from = null;
            cf_date_to = null;
        }

        var datas = {
            cf_licence_plate : cf_licence_plate,
            cf_comment : cf_comment,
            cf_name : cf_name,
            cf_phone : cf_phone,
            cf_date_from : cf_date_from,
            cf_date_to : cf_date_to,
            cf_payment_type : cf_payment_type,
            cf_maxitems,
            page : page,
            length : length
        }

        filter_ajax_cars(datas, 'cars');
    }

    function filter_ajax_tires(datas, type){
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/ajax/filters/" + type,
            type: "POST",
            data: {
                'tf_licence_plate': datas.tf_licence_plate,
                'tf_comment': datas.tf_comment,
                'tf_name': datas.tf_name,
                'tf_phone': datas.tf_phone,
                'tf_date_from': datas.tf_date_from,
                'tf_date_to': datas.tf_date_to,
                'tf_payment_type': datas.tf_payment_type,
                'tf_maxitems': datas.tf_maxitems,
                'page': datas.page,
                'length': datas.length,
            },
            beforeSend: function(){
                // $('#'+type+'_body').html('<div class="loader_holder"><div class="table_loader"></div></div>');
                if($("#bookingEditModal").hasClass('show') == false && $("#bookingPreviewModal").hasClass('show') == false){
                    $('.div_preloader').show();
                }
            },
            success: function (data) {
                $('#'+type+'_body').html(data);
                $('.div_preloader').hide();
            }
        });
    }

    function filter_ajax_cars(datas, type){
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/ajax/filters/" + type,
            type: "POST",
            data: {
                'cf_licence_plate': datas.cf_licence_plate,
                'cf_comment': datas.cf_comment,
                'cf_name': datas.cf_name,
                'cf_phone': datas.cf_phone,
                'cf_date_from': datas.cf_date_from,
                'cf_date_to': datas.cf_date_to,
                'cf_payment_type': datas.cf_payment_type,
                'cf_maxitems': datas.cf_maxitems,
                'page': datas.page,
                'length': datas.length,
            },
            beforeSend: function(){
                // $('#'+type+'_body').html('<div class="loader_holder"><div class="table_loader"></div></div>');
                if($("#bookingEditModal").hasClass('show') == false && $("#bookingPreviewModal").hasClass('show') == false){
                    $('.div_preloader').show();
                }
            },
            success: function (data) {
                $('#'+type+'_body').html(data);
                $('.div_preloader').hide();
            }
        });
    }

    // táblázat lapozása - pagination - TIRES
    $(document).on("click", "#tires_holder .pagination a", function(event) {
        event.preventDefault();

        // $('#tires_body').html('<div class="loader_holder"><div class="table_loader"></div></div>');

        var length = $('#tf_maxitems').val();
        var page = $(this).attr("href").split("page=")[1];
        filter_tires(page, length);
    });

    // táblázat lapozása - pagination - CARS
    $(document).on("click", "#cars_holder .pagination a", function(event) {
        event.preventDefault();

        $('#cars_body').html('<div class="loader_holder"><div class="table_loader"></div></div>');

        var length = $('#tf_maxitems').val();
        var page = $(this).attr("href").split("page=")[1];
        filter_cars(page, length);
    });
});