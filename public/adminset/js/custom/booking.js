$(document).ready(function() {
    var booking_type;

    // átalakítja a date_nice-t csak dátumra..
    function date_nice_to_onlydate(date_nice) {
        var text_split = date_nice.split(" ");
        var new_date = [];
        text_split.forEach(function(item, index) {
            if (index < 4) {
                new_date.push(item);
            }
        });
        return new_date.join(" ");
    }

    function date_wo_mins(date_nice) {
        var text_split = date_nice.split(":");
        return text_split[0] + ' :';
    }

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

    window.InsertSelectedTime = function(
        date_start,
        date_end,
        date_nice,
        c_type
    ) {
        $("#bookingDateInterval").attr("data-start", date_start);
        $("#bookingDateInterval").attr("data-end", date_end);
        $("#bookingDateInterval").attr("data-c_type", c_type);
        $("#bookingDateInterval").attr("data-date_nice", date_nice);
        $("#bookingDateInterval").val(date_wo_mins(date_nice));
        $("#bookingDateMins").html(generate_mins(date_start));
        booking_type = c_type;
        getServicesList();
    };

    window.get_only_serivice_list = function(modal_type, c_type, selected_id) {
        booking_type = c_type;
        getServicesList(modal_type, selected_id);
    };

    $("#bookingModalForm").submit(function(event) {
        $("#preloader").show();
        event.preventDefault();
        var bookingData;
        bookingData = {
            visitor: {
                name: $("#bookingModal #visitorName").val(),
                email: $("#bookingModal #visitorEmail").val(),
                phone: $("#bookingModal #visitorPhone").val()
            },
            car: {
                type: $("#bookingModal #carType").val(),
                brand: $("#bookingModal #carBrand").val(),
                type_other: $("#bookingModal #carType_other").val(),
                brand_other: $("#bookingModal #carBrand_other").val(),
                licencePlate: $("#bookingModal #licencePlate").val()
            },
            booking: {
                startTime: $("#bookingModal #bookingDateInterval").attr(
                    "data-start"
                ),
                endTime: $("#bookingModal #bookingDateInterval").attr(
                    "data-end"
                ),
                dateMins: $("#bookingModal #bookingDateMins").val(),
                service: $("#bookingModal #bookingService").val(),
                comment: $("#bookingModal #bookingComment").val()
            },
            service_id: $("#bookingModal #bookingService").val(),
            tireParking: $("#bookingModal #tireParking:checked").length ? 1 : 0,
            motortip: $("#bookingModal #motortip").val(),
            alvaz: $("#bookingModal #alvaz").val(),
            cm3: $("#bookingModal #cm3").val(),
            teljesitmeny: $("#bookingModal #teljesitmeny").val()
        };

        saveBooking(bookingData);
    });

    // $('#carBrand').change(function () {
    var initial_edit = 0;
    $(document).on("change", "#carBrand", function() {
        initial_edit = 1;
        $("#serviceListloader").show();
        // alert('megy');
        getCarTypesByBrandId($(this).val());
    });

    window.get_only_car_types_list = function(brand_id, modal_type, type_id) {
        getCarTypesByBrandId(brand_id, modal_type, type_id);
    };

    function getServicesList(modal_type, selected_id) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/services/" + booking_type + "/list",
            type: "GET",
            success: function(data) {
                if (!$.isEmptyObject(data.services)) {
                    createservicesDropDownList(
                        data.services,
                        modal_type,
                        selected_id
                    );
                    $("#saveBookingButton").removeAttr("disabled");
                    $("#preloader").hide();
                }
            }
        });
    }

    function createservicesDropDownList(servicesList, modal_type, selected_id) {
        var selected = "";
        var service_select =
            '<select class="form-control" id="bookingService" name="bookingService">';
        service_select +=
            '<option disabled="" selected="" value="">Kérem válasszon szolgáltatást</option>';
        $.each(servicesList, function(key, serviceValue) {
            if (serviceValue.id != 1) {
                if (serviceValue.id == selected_id) {
                    selected = " selected";
                } else {
                    selected = "";
                }
                service_select +=
                    '<option value="' +
                    serviceValue.id +
                    '"' +
                    selected +
                    ">" +
                    serviceValue.name +
                    "</option>";
            }
        });
        service_select += "</select>";

        if (modal_type == "edit") {
            $("#bookingEditModal #servicesHolder").html(service_select);
        } else {
            $("#servicesHolder").html(service_select);
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
                mode: "admin"
            },
            success: function(data) {
                if (data.success) {
                    // bookingModal eltüntetése
                    $("#bookingModal").modal("hide");

                    // Felhasznaloi jogosultsaggal a marka+tipus megadasa utan a tovabbi foglalasoknal kotlezoen kitoltendove valnak a mezok
                    // következő booking modal megnyitáskor ne legyen ott alapból a márka
                    $('#bookingModal #carType').remove();
                    $('#bookingModal #carType-form-group').attr('hidden', true);

                    // // admin felületnél nincs megerősítés!
                    // // var verify_email = '<p><b>Kérem erősítse meg a foglalást! A megerősítéshez kérjük ellenőrizze e-mail fiókját!</b></p><br>'
                    // var verify_email = '';

                    // if(bookingData.visitor.name != ''){ var visitor_name = bookingData.visitor.name; }else{ var visitor_name = ' -'; }
                    // if(bookingData.visitor.email != ''){ var visitor_email = bookingData.visitor.email; }else{ var visitor_email = ' -'; }
                    // if(bookingData.visitor.phone != ''){ var visitor_phone = bookingData.visitor.phone; }else{ var visitor_phone = ' -'; }
                    // if(bookingData.booking.startTime != ''){ var booking_startTime = bookingData.booking.startTime; }else{ var booking_startTime = ' -'; }
                    // if(bookingData.booking.endTime != ''){ var booking_endTime = bookingData.booking.endTime; }else{ var booking_endTime = ' -'; }
                    // if($('#bookingService option:selected').val() != ''){ var service = $('#bookingService option:selected').text(); }else{ var service = ' -'; }
                    // if(bookingData.booking.comment != ''){ var booking_comment = bookingData.booking.comment; }else{ var booking_comment = ' -'; }
                    // if(bookingData.tireParking != 0){ var tireParking = 'Kérek'; }else{ var tireParking = ' -'; }

                    // // content lecserélése:
                    // $('#bookingSuccessModalContent').html('<div class="col-md-12">'
                    // + '<h3 class="text-success mb-3">Sikeres foglalás!</h3>'
                    // + verify_email
                    // + '<div class="row">'
                    // + '<div class="col-md-6">' + '<p><b>Név:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + visitor_name + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>E-mail cím:</b></p>' + '</div>' + '<div class="col-md-6"><p>' +  visitor_email + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Telefonszám:</b></p>' + '</div>' + '<div class="col-md-6"><p>' +  visitor_phone + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Autó márkája és típusa:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + $('#carBrand option:selected').text() + ' ' + $('#carType option:selected').text() + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Autó rendszáma:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + bookingData.car.licencePlate + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Foglalt időpont kezdete:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + booking_startTime + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Foglalt időpont vége:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + booking_endTime + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Szolgáltatás:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + service + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Nálunk vannak tárolva a kerekei?</b></p>' + '</div>' + '<div class="col-md-6"><p>' + tireParking + '</p>' + '</div>'
                    // + '<div class="col-md-6">' + '<p><b>Megjegyzés:</b></p>' + '</div>' + '<div class="col-md-6"><p>' + booking_comment + '</p>' + '</div>'
                    // + '</div>'
                    // + '</div>');
                    // $('#bookingSuccessModal').modal('show');
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
        // edit mód forcolása:
        if ($("#bookingEditModal").hasClass("show") == true) {
            modal_type = "edit";
            if ($("#bookingEditModal #carBrand").val() != 1) {
                $("#bookingEditModal #serviceListloader").show();
            }
        } else {
            $("#bookingEditModal #serviceListloader").hide();
        }

        if (modal_type == "edit") {
            $("#bookingEditModal #carType").remove();
        } else {
            $("#carType").remove();
        }

        // ha egyéb autó típus!
        if (brandId == 1) {

            $("#serviceListloader").hide();
            $("#carType-form-group").attr("hidden", true);
            
            if (modal_type == "edit") {
                // alert('lefut');
                $("#bookingEditModal #carBrand_other").parent(".form-group").removeAttr("hidden");
                $("#bookingEditModal #carType_other").parent(".form-group").removeAttr("hidden");
                $('#bookingEditModal #carBrand_other').prop('required',true);
                $('#bookingEditModal #carType_other').prop('required',true);

                // ha nincs egyéb megadva
                if( $('#bookingEditModal #carBrand_other').val() == '' && $('#bookingEditModal #carType_other').val() == '' && initial_edit == 0){
                    $('#bookingEditModal #carBrand').val('').prop('required',false);
                    $("#bookingEditModal #carBrand_other").parent(".form-group").attr("hidden", true);
                    $("#bookingEditModal #carType_other").parent(".form-group").attr("hidden", true);
                    $('#bookingEditModal #carBrand_other').prop('required',false);
                    $('#bookingEditModal #carType_other').prop('required',false);
                }
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
                success: function(data) {
                    if (data.success) {
                        if (modal_type == "edit") {
                            createCarTypesDropdownList(
                                data.success,
                                modal_type,
                                type_id
                            );
                            $(
                                "#bookingEditModal #carType-form-group"
                            ).removeAttr("hidden");
                            $("#bookingEditModal #serviceListloader").hide();
                        } else {
                            // console.log(modal_type);
                            createCarTypesDropdownList(data.success);
                            $("#carType-form-group").removeAttr("hidden");
                            $("#serviceListloader").hide();
                        }
                    }
                }
            });
        }
    }

    // $(document).on("change", "#carType", function() {
    //     if ($(this).val() == 1) {
    //         if ($("#bookingEditModal").hasClass("show") === true) {
    //             $("#bookingEditModal #carType_other")
    //                 .parent(".form-group")
    //                 .removeAttr("hidden");
    //         } else {
    //             $("#carType_other")
    //                 .parent(".form-group")
    //                 .removeAttr("hidden");
    //         }
    //     }
    // });

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
        var carTypeList = $(
                "<select class='form-control' id='carType' required></select>"
            ),
            selected = "";

        carTypeList.append(
            "<option disabled selected value>Kérem válasszon modelt</option>"
        );
        $.each(carTypesList, function(index, value) {
            if (value.id == type_id) {
                selected = " selected";
            } else {
                selected = "";
            }
            carTypeList.append(
                $(
                    '<option value="' +
                        value.id +
                        '"' +
                        selected +
                        ">" +
                        value.name +
                        "</option>"
                )
            );
        });
        carTypeList.append('<option value="1">Egyéb autó model</option>');
        if (modal_type == "edit") {
            $("#bookingEditModal #carType-form-group").append(carTypeList);
        } else {
            $("#carType-form-group").append(carTypeList);
        }
    }
});
