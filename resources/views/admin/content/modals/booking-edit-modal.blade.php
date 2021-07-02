<!-- Modal -->
<div class="modal" id="bookingEditModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-fix">
                <h5 class="modal-title" id="bookingModalTitle">Foglalás szerkesztése</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class='modal-body row bookingModalContent'>
                <form id="bookingEditModalForm" class="col-md-12">
                    {{-- START Visitors data --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="visitorName">Név:</label>
                                <input type="text" class="form-control" id="visitorName" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="visitorEmail">E-mail cím:</label>
                                <input type="email" class="form-control" id="visitorEmail" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="visitorPhone">Telefonszám:</label>
                                <input type="tel" class="form-control" pattern="^(\+|\d)\d{0,13}$" id="visitorPhone" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    {{-- END Visitors data --}}

                    {{-- START car type and brand data --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="licencePlate">Rendszám: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rendszam" id="licencePlate" minlength="6" maxlength="20" chars="A-Z0-9" pattern="[A-Z0-9]+" title="Csak betűk és számok adhatók meg, kötőjelek és szóköz nélkül!" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" required autocomplete="off">
                            </div>
                            <div class="form-group" id="carBrand-form-group">
                                <label for="carBrand">Autó típusa: <span class="text-danger">*</span></label>
                                <select class="form-control" id="carBrand" required>
                                    <option disabled selected value>Kérem válasszon autó típust</option>
                                    @foreach ($car_brands as $car_brand)
                                    @if($car_brand->id != 1)
                                        <option value="{{$car_brand->id}}">{{$car_brand->name}}</option>
                                    @endif
                                    @endforeach
                                    <option value="1">Egyéb autó típus</option>
                                </select>
                            </div>
                            <div id="serviceListloader" class="loader"></div>
                            <div class="form-group" id="carType-form-group" hidden>
                                <label for="carType">Autó model:</label>
                            </div>
                            <div class="form-group" id="carBrand-form-group" hidden>
                                <label for="carBrand_other">Egyéb autó típusa: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="carBrand_other" autocomplete="off">
                            </div>
                            <div class="form-group" id="carBrand-form-group" hidden>
                                <label for="carType_other">Egyéb autó model: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="carType_other" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="motortip">Motor típusa: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="motortip" minlength="6" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="alvaz">Alvázszám: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="alvaz" minlength="6" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="cm3">Hengerűrtartalom: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="cm3" minlength="6" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="teljesitmeny">Teljesítmény: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="teljesitmeny" minlength="6" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    {{-- END car type and brand data --}}

                    {{-- START booking data --}}
                    <div class="card">
                        <div class="card-body">
                            <label>Foglalás időpontja: <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <input type="text" class="form-control" id="bookingDateInterval" data-start="" data-end="" data-c_type="" value="" disabled>
                                </div>
                                <select class="custom-select" id="bookingDateMins"></select>
                            </div>
                            <div class="form-group" id="servicesRadioButtonList">
                                <label for="bookingServie">Kívánt szolgáltatás: <span class="text-danger">*</span></label>
                                <div id="servicesHolder"></div>
                            </div>
                            <div class="form-group d-none" id="tireParkingBlock">
                                <label for="tireParking">Tárolt kerekek?</label>
                                <div class="clearfix"></div>
                                <input type="checkbox" id="tireParking"> Igen
                            </div>
                            <div class="form-group">
                                <label for="bookingComment">Megjegzés: </label>
                                <textarea class="form-control" id="bookingComment" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    {{-- END booking data --}}
                </div>
                <div class='modal-footer'>
                    <button type="button" class="btn btn-danger mr-auto edit_delete_booking">
                        <span>Törlés</span>
                    </button>
                    <button type="submit" class="btn btn-primary" id="updateBookingButton">
                        <span>Módosítás</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
