$(document).ready(function () {
    var booking_type;
    window.InsertSelectedTime = function(date_start, date_end, date_nice, c_type){
        $('#bookingDateInterval').attr('data-start', date_start);
        $('#bookingDateInterval').attr('data-end', date_end);
        $('#bookingDateInterval').attr('data-c_type', c_type);
        $('#bookingDateInterval').val(date_nice);
        booking_type = c_type;
        getServicesList();
    }

    window.get_only_serivice_list = function(modal_type, c_type, selected_id){
        booking_type = c_type;
        getServicesList(modal_type, selected_id);
    }

    $('#bookingModalForm').submit(function (event) {
        $('#preloader').show();
        event.preventDefault();
        var bookingData;

        // tire parking meghatározása:
        car_or_tire = $('.admin_title').attr('data-c_type');
        if(car_or_tire == 'tire'){
            var tire_parking_val = $("#bookingModal .tireParking:checked").val() ? 1 : 0;
        }
        else{ // car
            var tire_parking_val = '';
        }   

        bookingData = {
            "visitor": {
                "name": $('#bookingModal #visitorName').val(),
                "email": $('#bookingModal #visitorEmail').val(),
                "phone": $('#bookingModal #visitorPhone').val()
            },
            "car": {
                "type": $('#bookingModal #carType').val(),
                "brand": $('#bookingModal #carBrand').val(),
                "type_other": $('#bookingModal #carType_other').val(),
                "brand_other": $('#bookingModal #carBrand_other').val(),
                "licencePlate": $('#bookingModal #licencePlate').val()
            },
            "booking": {
                "startTime": $('#bookingModal #bookingDateInterval').attr('data-start'),
                "endTime": $('#bookingModal #bookingDateInterval').attr('data-end'),
                "service": $('#bookingModal #bookingService').val(),
                "comment": $('#bookingModal #bookingComment').val()
            },
            "service_id": $('#bookingModal #bookingService').val(),
            "tireParking": tire_parking_val,
            "motortip": $('#bookingModal #motortip').val(),
            "alvaz": $('#bookingModal #alvaz').val(),
            "cm3": $('#bookingModal #cm3').val(),
            "teljesitmeny": $('#bookingModal #teljesitmeny').val()
        }

        saveBooking(bookingData);
    });

    // $('#carBrand').change(function () {
    $(document).on('change', '#carBrand', function(){
        $('#serviceListloader').show();
        getCarTypesByBrandId($(this).val());
    });

    window.get_only_car_types_list = function(brand_id, modal_type, type_id){
        getCarTypesByBrandId(brand_id, modal_type, type_id);
    }

    function getServicesList(modal_type, selected_id) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/services/" + booking_type + "/list",
            type: "GET",
            success: function (data) {
                if (!$.isEmptyObject(data.services)) {
                    createservicesDropDownList(data.services, modal_type, selected_id);
                    $('#saveBookingButton').removeAttr('disabled');
                    $('#preloader').hide();
                }
            }
        });
    }
    

    function createservicesDropDownList(servicesList, modal_type, selected_id) {
        var selected = '';
        var service_select = '<select class="form-control" id="bookingService" name="bookingService" required>';
        service_select += '<option disabled="" selected="" value="">Kérem válasszon szolgáltatást</option>';
        $.each(servicesList, function (key, serviceValue) {
            if(serviceValue.id != 1){
                if(serviceValue.id == selected_id){
                    selected = ' selected';
                }
                else{
                    selected = '';
                }
                service_select += '<option value="' + serviceValue.id + '"'+ selected +'>' + serviceValue.name + '</option>';
            }
        });
        service_select += '</select>';

        if(modal_type == 'edit'){
            $('#bookingEditModal #servicesHolder').html(service_select);
        }
        else{
            $('#servicesHolder').html(service_select);
        }
    }

    function saveBooking(bookingData) {
        // console.log(bookingData);
        
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/insert_admin",
            type: "POST",
            data: {
                type: booking_type,
                bookingData: bookingData,
                mode: 'visitor'
            },
            success: function (data) {
                
                if (data.success) {
                    // bookingModal eltüntetése
                    $('#bookingModal').modal('hide');

                    var verify_email = '<p style="text-align:justify;"><b>Kérem erősítse meg a foglalást! A megerősítéshez kérjük ellenőrizze e-mail fiókját! <span class="text-danger">A foglalás megerősítésére 15 perc áll rendelkezésre. Ez után a foglalás felszabadul!</span> Amennyiben nem kapja meg a megerősítő levelet, kérjük ellenőrizze a levélszemét (spam) mappát!</b></p><br>'

                    if(bookingData.visitor.name != ''){ var visitor_name = bookingData.visitor.name; }else{ var visitor_name = ' -'; }
                    if(bookingData.visitor.email != ''){ var visitor_email = bookingData.visitor.email; }else{ var visitor_email = ' -'; }
                    if(bookingData.visitor.phone != ''){ var visitor_phone = bookingData.visitor.phone; }else{ var visitor_phone = ' -'; }
                    if(bookingData.booking.startTime != ''){ var booking_startTime = bookingData.booking.startTime; }else{ var booking_startTime = ' -'; }
                    if(bookingData.booking.endTime != ''){ var booking_endTime = bookingData.booking.endTime; }else{ var booking_endTime = ' -'; }
                    if($('#bookingService option:selected').val() != ''){ var service = $('#bookingService option:selected').text(); }else{ var service = ' -'; }
                    if(bookingData.booking.comment != ''){ var booking_comment = bookingData.booking.comment; }else{ var booking_comment = ' -'; }
                    
                    // ha gumis oldalon vagyunk, csak akkor jelenjen meg a gumi tárolás!
                    if(booking_type == 'tire'){
                        if(bookingData.tireParking != 0){ var tireParking = 'Igen'; }else{ var tireParking = ' -'; }
                        var booking_parking = '<div class="col-md-6">' + '<p><b>Gumitárolás?</b></p>' + '</div>' + '<div class="col-md-6"><p>' + tireParking + '</p>' + '</div>';
                    }else{
                        var booking_parking = '';
                    }

                    // content lecserélése:
                    $('#bookingSuccessModalContent').html('<div class="col-md-12">'
                    + '<h3 class="text-success mb-3">Sikeres foglalás!</h3>'
                    + verify_email
                    + '<div class="row">'
                    + '<div class="col-md-6">' + '<p><b>Név:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + visitor_name + '</p>' + '</div>'
                    + '<div class="col-md-6">' + '<p><b>E-mail cím:</b></p>' + '</div>' + '<div class="col-md-6"><p>' +  visitor_email + '</p>' + '</div>'
                    + '<div class="col-md-6">' + '<p><b>Telefonszám:</b></p>' + '</div>' + '<div class="col-md-6"><p>' +  visitor_phone + '</p>' + '</div>'
                    + '<div class="col-md-6">' + '<p><b>Autó márkája és típusa:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + $('#carBrand option:selected').text() + ' ' + $('#carType option:selected').text() + '</p>' + '</div>'
                    + '<div class="col-md-6">' + '<p><b>Autó rendszáma:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + bookingData.car.licencePlate + '</p>' + '</div>'
                    + '<div class="col-md-6">' + '<p><b>Foglalt időpont kezdete:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + booking_startTime + '</p>' + '</div>'
                    + '<div class="col-md-6">' + '<p><b>Foglalt időpont vége:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + booking_endTime + '</p>' + '</div>'
                    + '<div class="col-md-6">' + '<p><b>Szolgáltatás:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + service + '</p>' + '</div>'
                    + booking_parking
                    + '<div class="col-md-6">' + '<p><b>Megjegyzés:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + booking_comment + '</p>' + '</div>'
                    + '</div>'
                    + '</div>');
                    $('#bookingSuccessModal').modal('show');

                } else if (data.errors) {
                    //FIXME ezt le kell cserélni egy error kezelő megoldásra
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
        });
    }

    function getCarTypesByBrandId(brandId, modal_type, type_id) {

        if(modal_type == 'edit'){
            $('#bookingEditModal #carType').remove();
        }
        else{
            $('#carType').remove();
        }

        // ha egyéb autó típus!
        if (brandId == 1) {
            $("#serviceListloader").hide();
            $("#carType-form-group").attr("hidden", true);
            if (modal_type == "edit") {
                $("#bookingEditModal #carBrand_other").parent(".form-group").removeAttr("hidden");
                $("#bookingEditModal #carType_other").parent(".form-group").removeAttr("hidden");
                $('#bookingEditModal #carBrand_other').prop('required',true);
                $('#bookingEditModal #carType_other').prop('required',true);
            }
            else{
                $("#carBrand_other").parent(".form-group").removeAttr("hidden");
                $("#carType_other").parent(".form-group").removeAttr("hidden");
                $("#carBrand_other").prop('required',true);
                $("#carType_other").prop('required',true);
            }
        }
        else{
            if (modal_type == "edit") {
                $("#bookingEditModal #carBrand_other").parent(".form-group").attr("hidden", true);
                $("#bookingEditModal #carType_other").parent(".form-group").attr("hidden", true);
                $('#bookingEditModal #carBrand_other').prop('required',false);
                $('#bookingEditModal #carType_other').prop('required',false);
            } else {
                $("#carBrand_other").parent(".form-group").attr("hidden", true);
                $("#carType_other").parent(".form-group").attr("hidden", true);
                $("#carBrand_other").prop('required',false);
                $("#carType_other").prop('required',false);
            }
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                url: "/carType/" + brandId,
                type: "GET",
                success: function (data) {
                    if (data.success) {

                        if(modal_type == 'edit'){
                            createCarTypesDropdownList(data.success, modal_type, type_id);
                            $('#bookingEditModal #carType-form-group').removeAttr('hidden');
                            $('#bookingEditModal #serviceListloader').hide();
                        }
                        else{
                            createCarTypesDropdownList(data.success);
                            $('#carType-form-group').removeAttr('hidden');
                            $('#serviceListloader').hide();
                        }
                    }
                }
            });
        }
    }

    $(document).on('change', '#carType', function(){
        // console.log('megy');
        if($(this).val() == 1){
            if ($("#bookingEditModal").hasClass("show") === true) {
                $('#bookingEditModal #carType_other').parent('.form-group').removeAttr('hidden');
                $('#bookingEditModal #carType_other').prop('required',true);
            }
            else{
                $('#carType_other').parent('.form-group').removeAttr('hidden');
                $('#carType_other').prop('required',true);
            }
        }
        else{
            if ($("#bookingEditModal").hasClass("show") === true) {      
                $('#bookingEditModal #carType_other').parent('.form-group').attr("hidden", true);
                $('#bookingEditModal #carType_other').prop('required',false);
            }
            else{
                $('#carType_other').parent('.form-group').attr("hidden", true);
                $('#carType_other').prop('required',false);
            }
        }            
    });

    function createCarTypesDropdownList(carTypesList, modal_type, type_id) {
        var carTypeList = $("<select class='form-control' id='carType' required></select>"),
        selected = '';

        carTypeList.append("<option disabled selected value>Kérem válasszon modelt</option>");
        $.each(carTypesList, function (index, value) {
            if(value.id == type_id){
                selected = ' selected';
            }
            else{
                selected = '';
            }
            carTypeList.append($('<option value="' + value.id + '"' + selected + '>' + value.name + '</option>'));
        });
        carTypeList.append("<option value=\"1\">Egyéb autó model</option>");
        if(modal_type == 'edit'){
            $('#bookingEditModal #carType-form-group').append(carTypeList);
        }
        else{
            $('#carType-form-group').append(carTypeList);
        }
    }
});
