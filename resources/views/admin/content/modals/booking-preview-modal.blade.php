<!-- Modal -->
<div class="modal" id="bookingPreviewModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div id="bookingPreviewModal_loader"></div>
            <div class="modal-header modal-header-fix">
                <h5 class="modal-title" id="bookingModalTitle">Foglalás előnézete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="nav_tabs">
                <ul id="nav_tabs_selector" class="nav nav-tabs">
                    <li class="nav-item nav_append_new_booking">
                        <a id="append_new_booking" class="nav-link" href="javascript:" style="color: green;font-weight: bold;">+ Új</a>
                    </li>
                </ul>
            </div>
            <div class='modal-body row bookingModalContent pb-0'>
                <form id="bookingPreviewModalForm" class="col-md-12">
                    {{-- START Visitors data --}}
                    <div class="d-none row pre_booking_status"><div class="col-md-6"> <p><b>Foglalás állapota:</b></p> </div> <div class="col-md-6"><p></p> </div></div>
                    <div class="d-none row pre_visitor_name"><div class="col-md-6"> <p><b>Név:</b></p> </div> <div class="col-md-6"><p></p> </div></div>
                    <div class="d-none row pre_visitor_email"><div class="col-md-6"> <p><b>E-mail cím:</b></p> </div> <div class="col-md-6"><p></p> </div></div>
                    <div class="d-none row pre_visitor_phone"><div class="col-md-6"> <p><b>Telefonszám:</b></p> </div> <div class="col-md-6"><p>  visitor_phone </p> </div></div>
                    
                    <div class="d-none row pre_licencePlate"><div class="col-md-6"> <p><b>Autó rendszáma:</b></p> </div> <div class="col-md-6"><p> bookingData.car.licencePlate </p> </div></div>
                    <div class="d-none row pre_carBrandType"><div class="col-md-6"> <p><b>Autó márkája és típusa:</b></p> </div> <div class="col-md-6"><p></p> </div></div>
                    <div class="d-none row pre_booking_startTime"><div class="col-md-6"> <p><b>Foglalás időpontja:</b></p> </div> <div class="col-md-6"><p> booking_startTime </p> </div></div>
                    <div class="d-none row pre_service"><div class="col-md-6"> <p><b>Szolgáltatás:</b></p> </div> <div class="col-md-6"><p> service </p> </div></div>
                    <div class="d-none row pre_tireParking"><div class="col-md-6"> <p><b>Tárolt kerekek?</b></p> </div> <div class="col-md-6"><p> tireParking </p> </div></div>
                    <div class="d-none row pre_booking_comment"><div class="col-md-6"> <p><b>Megjegyzés:</b></p> </div> <div class="col-md-6"><p> booking_comment </p> </div></div>
                    {{-- END Visitors data --}}
                </div>
                <div class="modal-body col-md-12 pt-0 pb-0">
                    <div class="row">
                    <div class="form-group col-md-6">
                        <button type="button" class="btn btn-danger mr-auto edit_delete_booking">
                            <span>Foglalás törlése</span>
                        </button>
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-primary" id="editBookingButton">
                            <span>Foglalás szerkesztése</span>
                        </button>
                    </div>
                    </div>
                </div>
            </form>
                <div class="">
                    <form id="pay_form">
                        <div class="modal-body col-md-12">
                            <div id="pay_inputs" class="row">
                                <div class="form-group col-md-6">
                                    <p class="mb-0"><b>Fizetett végösszeg:</b></p>
                                    <input id="payment_total" type="number" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <p class="mb-0"><b>Fizetés módja:</b></p>
                                    <select class="form-control" id="payment_type" required>
                                        <option disabled selected value>Kérem válasszon</option>
                                        <option value="1">Készpénz</option>
                                        <option value="2">Bankkártya</option>
                                        <option value="3">Átutalás</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger d-none" id="delete_payment">
                                        <span>Összeg törlése</span>
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary" id="add_payment">
                                        <span>Fizetés</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="pay_buttons" class="modal-footer pb-0">
                            <button type="button" class="mr-auto invisible">
                                <span></span>
                            </button>
                            
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
