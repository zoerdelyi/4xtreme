$(document).ready(function () {

    $(document).on("click", ".editServiceButton", function () {
        var serviceId = $(this).data("service-id");
        var serviceType = $(this).data("service-type");
        $("." + serviceType + "-service-edit-block-" + serviceId).toggle();
    });

    $(document).on("click", ".update_service", function () {
        var serviceType = $(this).data("service-type");
        var serviceId = $(this).data("service-id");

        var serviceName = $("input[name='" + serviceType + "-serviceName" + serviceId + "']").val();
        var serviceGrossPrice = $("input[name='" + serviceType + "-serviceGrossPrice" + serviceId + "']").val();
        var serviceNetPrice = $("input[name='" + serviceType + "-serviceNetPrice" + serviceId + "']").val();
        ajaxUpdateService(serviceType, serviceId, serviceName, serviceGrossPrice, serviceNetPrice);
    });

    $(document).on("click", ".removeServiceButton", function() {
        if (
            confirm(
                "Biztosan el szeretné távolítani ezt a szolgáltatást?"
            )
        ) {
            ajaxRemoveService($(this).data("service-id"), $(this).data("service-type"));
        }
    });

    $(document).on("click", ".saveServiceButton", function () {
        var serviceType = $("select[name='serviceType']").val();
        if (serviceType == null) {
            alert("Az autó típust kötelező kiválasztani.");
            return;
        }

        var serviceName = $("input[name='serviceName']").val();
        var serviceGrossPrice = $("input[name='serviceGrossPrice']").val();
        var serviceNetPrice = $("input[name='serviceNetPrice']").val();

        ajaxInsertService(serviceType, serviceName, serviceGrossPrice, serviceNetPrice);
    });

    function ajaxUpdateService(serviceType, serviceId, serviceName, serviceGrossPrice, serviceNetPrice) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/" + serviceType + "services/update",
            type: "POST",
            data: {
                id: serviceId,
                name: serviceName,
                grossPrice: serviceGrossPrice,
                netPrice: serviceNetPrice
            },
            success: function (data) {
                if (!$.isEmptyObject(data.errors)) {
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                                data.errors
                        },
                        {
                            // settings
                            type: "danger",
                            delay: 0
                        }
                    );
                }
                if (!$.isEmptyObject(data.success)) {
                    $.notify(
                        {
                            message:
                                "<strong>Sikeres mentés!</strong> A szolgáltatás frissítve az adatbázisban."
                        },
                        {
                            type: "success"
                        }
                    );
                    $("." + serviceType + "-name-" + serviceId).text(serviceName);
                    // $("." + serviceType + "-gross-price-" + serviceId).text(serviceGrossPrice + " Ft");
                    // $("." + serviceType + "-net-price-" + serviceId).text(serviceNetPrice + " Ft");

                    $("." + serviceType + "-service-edit-block-" + serviceId).toggle();
                }
            }
        });
    }

    function ajaxRemoveService(serviceId, serviceType) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/" + serviceType + "services/remove/" + serviceId,
            type: "DELETE",
            success: function (data) {
                if (!$.isEmptyObject(data.errors)) {
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen törlés!</strong> Hibaüzenet: " +
                                data.errors
                        },
                        {
                            // settings
                            type: "danger",
                            delay: 0
                        }
                    );
                }
                if (!$.isEmptyObject(data.success)) {
                    $('.' + serviceType + '-service-block-' + serviceId).remove();
                    $('.' + serviceType + '-service-edit-block-' + serviceId).remove();
                    $.notify(
                        {
                            message:
                                "<strong>Sikeres törlés!</strong> A szolgáltatás törölve az adatbázisbol."
                        },
                        {
                            type: "success"
                        }
                    );
                }
            }
        });
    }

    function ajaxInsertService(serviceType, serviceName, serviceGrossPrice, serviceNetPrice) {
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            url: "/admin/booking/" + serviceType + "services/insert",
            type: "POST",
            data: {
                name: serviceName,
                grossPrice: serviceGrossPrice,
                netPrice: serviceNetPrice
            },
            success: function (data) {
                if (!$.isEmptyObject(data.errors)) {
                    $.notify(
                        {
                            message:
                                "<strong>Sikertelen mentés!</strong> Hibaüzenet: " +
                                data.errors
                        },
                        {
                            // settings
                            type: "danger",
                            delay: 0
                        }
                    );
                }
                if (!$.isEmptyObject(data.success)) {
                    $('#serviceType').val('');
                    $('#serviceName').val('');
                    $('#serviceGrossPrice').val('');
                    $.notify(
                        {
                            message:
                                "<strong>Sikeres mentés!</strong> A szolgáltatás mentve az adatbázisban."
                        },
                        {
                            type: "success"
                        }
                    );
                    $('#servieModal').modal('hide');
                    $("#" + serviceType + "-service-list tbody").append(createTableRow(data.success));
                }
            }
        });
    }

    function createTableRow(service) {
        return '<tr class="service-block-' + service.id + '">' +
            '<td class="name-' + service.id + '" >' + service.name + '</td>' +
            // '<td class="gross-price-' + service.id + '">' + service.gross_price + ' Ft</td>' +
            // '<td class="net-price-' + service.id + '">' + service.net_price + ' Ft</td>' +
            '<td>' +
                '<button class="btn btn-primary btn-sm editServiceButton" style="margin-bottom: 5px;" data-service-id="' + service.id + '">' +
                    '<i class="far fa-edit"></i><span>Szerkesztés</span>' +
                '</button>' +
                '<button class="btn btn-danger btn-sm removeServiceButton" data-service-id="' + service.id + '">' +
                    '<i class="fas fa-trash-alt"></i><span>Eltávolítás</span>' +
                '</button>' +
            '</td>' +
        '</tr>' +
            '<tr class="hide service-edit-block-' + service.id + '">' +
                '<td colspan="5">' +
                    '<form>' +
                        '<div class="form-group row">' +
                            '<label for="serviceName' + service.id + '" class="col-sm-3 col-form-label">Szolgáltatás neve</label>' +
                            '<div class="col-sm-9">' +
                                '<input type="text" class="form-control" name="serviceName' + service.id + '" id="serviceName' + service.id + '" value="' + service.name + '"><br>' +
                            '</div>' +
                        '</div>' +
                        //         '<div class="form-group row">' +
                        //             '<label for="serviceGrossPrice' + service.id + '" class="col-sm-3 col-form-label">Bruttó ár</label>' +
                        //             '<div class="col-sm-9">' +
                        //                 '<input type="number" class="form-control" name="serviceGrossPrice' + service.id + '" id="serviceGrossPrice' + service.id + '" value="' + service.gross_price + '"><br>' +
                        //     '</div>' +
                        // '</div>' +
            //                             '<div class="form-group row">' +
            //                                 '<label for="serviceNetPrice' + service.id + '" class="col-sm-3 col-form-label">Nettó ár</label>' +
            //                                 '<div class="col-sm-9">' +
            // '<input type="number" class="form-control" name="serviceNetPrice' + service.id + '" id="serviceNetPrice' + service.id + '" value="' + service.net_price + '"><br>' +
            //                 '</div>' +
            //             '</div>' +
                                                '<button type="button" class="btn btn-success btn-sm update_service" data-service-id="' + service.id + '">' +
                                                    '<i class="fas fa-save"></i><span>Módosítások mentése</span>' +
                                                '</button>' +
                    '</form>' +
                '</td>' +
            '</tr>';
    }
});
