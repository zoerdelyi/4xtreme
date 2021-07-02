@extends('admin/layouts/admin') 
@section('content')

@push('title') 
<title>Időpontfoglaló Beállítások - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <h2 class="admin_title">Időpontfoglaló Beállítások</h2>
    <p class="plus_text">A naptár működésén ezekkel a beállításokkal módosíthat.</p>
</div>
<div class="div_preloader"></div>
<div class="row" id="social_settings">
    <!-- Gumiszerviz blokk -->
    <div class="col-md-6 settings_block" style="border-right: solid 1px #971817;">
        <h3 class="text-center">Gumiszerviz beállítások</h3>
        <hr>
        <div class="row">
                <div class="col-sm-12">
                    <p class="font-weight-bold">Aktuális időpont + X órától foglalható?</p>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <select class="form-control" id="days_plus_tires">
                        @for($i = 0; $i < 7; $i++)
                        <option value="{{ $i }}"{{ $days_plus_tires == $i ? ' selected' : '' }}>+{{ $i }} óra</option>
                        @endfor
                    </select>
                </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <p class="font-weight-bold">Ebédszünet</p>
            </div>
            <div class="input-group col-sm-10 col-xl-8">
                <select class="form-control" id="ebedszunet_gumis_from">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $ebedszunet_gumis_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
                <div class="input-group-prepend">
                    <div class="input-group-text">-</div>
                </div>
                <select class="form-control" id="ebedszunet_gumis_to">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $ebedszunet_gumis_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <hr>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-12">
                <p class="font-weight-bold">Gumiszerviz foglalás aktív?</p>
            </div>
            <div class="col-sm-6 col-xl-4">
                <select class="form-control" id="tires_booking_active">
                    <option value="1"{{ $calendar_tires == 1 ? ' selected' : '' }}>Aktív</option>
                    <option value="0"{{ $calendar_tires == 0 ? ' selected' : '' }}>Inaktív</option>
                </select>
            </div>
        </div>
        {{-- <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-12">
                <p class="font-weight-bold">Kijelzett órák - Gumiszerviz:</p>
            </div>
            <div class="input-group col-sm-10 col-xl-8">
                <select class="form-control" id="tire_open">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $tire_open == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
                <div class="input-group-prepend">
                    <div class="input-group-text">-</div>
                </div>
                <select class="form-control" id="tire_close">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $tire_close == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        <div id="nyitvatartas_gumiszerviz">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12">
                    <p class="font-weight-bold">Nyitvatartás - Gumiszerviz:</p>
                </div>
                <div class="col-sm-12">
                    <p style="margin: 0;">Hétfő:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_tire_mon_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_mon_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_tire_mon_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_mon_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Kedd:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_tire_tue_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_tue_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_tire_tue_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_tue_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Szerda:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_tire_wed_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_wed_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_tire_wed_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_wed_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Csütörtök:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_tire_thu_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_thu_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_tire_thu_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_thu_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Péntek:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_tire_fri_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_fri_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_tire_fri_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_fri_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Szombat:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_tire_sat_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_sat_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_tire_sat_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_tire_sat_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" style="margin-top: 30px;">
                    <button type="button" class="btn btn-primary bookings_settings_save" style="float: left;">
                        <i class="fas fa-sync-alt"></i>Naptár beállítások frissítése
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div id="rendkivuli_gumiszerviz">
            <div class="row" >
                <div class="col-sm-12">
                    <p class="font-weight-bold">Rendkívüli nyitvatartás hozzáadása - Gumiszerviz:</p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12">
                    <p style="margin: 0;">Dátum és idő kiválasztása:</p>
                </div>
                <div id="add_non_working_days" class="col-sm-8 col-xl-6">
                    <input id="extradates_tire_open_date" class="form-control" data-toggle="datepicker" autocomplete="off" placeholder="Dátum pl.: 2020-02-02">
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="extradates_tire_open_hours_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}">{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="extradates_tire_open_hours_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}">{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" id="extradates_tire_open_add" class="btn btn-primary btn-sm" style="margin-bottom: 20px;">
                        <i class="fas fa-plus"></i>Rendkívüli hozzáadása
                    </button>
                </div>
            </div>
            <div class="row dates-list-box">
            <div id="rendkivuli_gumiszerviz_blue">
                <div class="col-sm-6 col-xl-4" style="margin-bottom: 10px;">
                    <select id="extradates_tire_open_year" class="form-control" style="width: auto;">
                        @for($i = 2020; $i < 2040; $i++)
                        <option value="{{ $i }}"<?php if($i == date('Y')) echo ' selected'; ?>>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div id="extradates_tire_open_list" class="col-sm-12">
                    @foreach ($get_workdays_tires as $day)
                    <button type="button" data-id="{{ $day->id }}" class="btn btn-success btn-sm btn_dates btn_dates_open">{{ $day->date }} {{ str_replace('|', ' - ', $day->open_close) }}</button>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
        <hr>
        <div id="szabadnapok_gumiszerviz">
            <div class="row" >
                <div class="col-sm-12">
                    <p class="font-weight-bold">Ünnepnapok / Szabadnapok hozzáadása - Gumiszerviz:</p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12">
                    <p style="margin: 0;">Dátum kiválasztása:</p>
                </div>
                <div id="add_non_working_days" class="col-sm-8 col-xl-6">
                    <input id="extradates_tire_close" class="form-control" data-toggle="datepicker" autocomplete="off" placeholder="Dátum pl.: 2020-02-02">
                </div>
                <div class="col-sm-12">
                    <div class="form-check">
                        <input id="extradates_tire_close_yearly_repeat" class="form-check-input" type="checkbox" value="">
                        <label class="form-check-label" for="defaultCheck1">
                            Évente ismétlődő szabadnap?
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" id="extradates_tire_close_add" class="btn btn-primary btn-sm" style="margin-bottom: 20px;">
                        <i class="fas fa-plus"></i>Szabadnap hozzáadása
                    </button>
                </div>
            </div>
            <div class="row dates-list-box">
            <div id="szabadnapok_gumiszerviz_blue">
                <div class="col-sm-6 col-xl-4" style="margin-bottom: 10px;">
                    <select id="extradates_tire_close_year" class="form-control" style="width: auto;">
                        @for($i = 2020; $i < 2040; $i++)
                        <option value="{{ $i }}"<?php if($i == date('Y')) echo ' selected'; ?>>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div id="extradates_tire_close_list" class="col-sm-12">
                    @foreach ($get_non_workdays_tires as $day)
                    <button type="button" data-id="{{ $day->id }}" class="btn btn-danger btn-sm btn_dates btn_dates_close">{{ $day->date }} {{ str_replace('|', ' - ', $day->open_close) }}</button>
                    @endforeach
                    <div style="clear:both;"></div>
                    @foreach ($get_non_workdays_tires_repeat as $day)
                    <button type="button" data-id="{{ $day->id }}" class="btn btn-danger btn-sm btn_dates btn_dates_close">{{ $day->date }} {{ str_replace('|', ' - ', $day->open_close) }}</button>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- Autószerviz blokk -->
    <div class="col-md-6 settings_block">
        <h3 class="text-center">Autószerviz beállítások</h3>
        <hr>
        <div class="row">
                <div class="col-sm-12">
                    <p class="font-weight-bold">Aktuális időpont + X órától foglalható?</p>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <select class="form-control" id="days_plus_cars">
                        @for($i = 0; $i < 7; $i++)
                        <option value="{{ $i }}"{{ $days_plus_cars == $i ? ' selected' : '' }}>+{{ $i }} óra</option>
                        @endfor
                    </select>
                </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <p class="font-weight-bold">Ebédszünet</p>
            </div>
            <div class="input-group col-sm-10 col-xl-8">
                <select class="form-control" id="ebedszunet_autos_from">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $ebedszunet_autos_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
                <div class="input-group-prepend">
                    <div class="input-group-text">-</div>
                </div>
                <select class="form-control" id="ebedszunet_autos_to">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $ebedszunet_autos_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <hr>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-12">
                <p class="font-weight-bold">Autószerviz foglalás aktív?</p>
            </div>
            <div class="col-sm-6 col-xl-4">
                <select class="form-control" id="cars_booking_active">
                    <option value="1"{{ $calendar_cars == 1 ? ' selected' : '' }}>Aktív</option>
                    <option value="0"{{ $calendar_cars == 0 ? ' selected' : '' }}>Inaktív</option>
                </select>
            </div>
        </div>
        {{-- <div class="row" style="margin-bottom: 20px;">
            <div class="col-sm-12">
                <p class="font-weight-bold">Kijelzett órák - Autószerviz:</p>
            </div>
            <div class="input-group col-sm-10 col-xl-8">
                <select class="form-control" id="car_open">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $car_open == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
                <div class="input-group-prepend">
                    <div class="input-group-text">-</div>
                </div>
                <select class="form-control" id="car_close">
                    @foreach ($hours_full as $hour)
                        <option value="{{ $hour }}"{{ $car_close == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                    @endforeach
                </select>
            </div>
        </div> --}}
        <div id="nyitvatartas_autoszerviz" style="min-height: 530px;">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12">
                    <p class="font-weight-bold">Nyitvatartás - Autószerviz:</p>
                </div>
                <div class="col-sm-12">
                    <p style="margin: 0;">Hétfő:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_car_mon_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_mon_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_car_mon_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_mon_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Kedd:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_car_tue_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_tue_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_car_tue_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_tue_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Szerda:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_car_wed_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_wed_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_car_wed_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_wed_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Csütörtök:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_car_thu_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_thu_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_car_thu_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_thu_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12">
                    <p class="bookings_settings_p">Péntek:</p>
                </div>
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="open_car_fri_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_fri_from == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="open_car_fri_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}"{{ $open_car_fri_to == $hour ? ' selected' : '' }}>{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12" style="margin-top: 30px;">
                    <button type="button" class="btn btn-primary bookings_settings_save" style="float: left; margin-top: 72px;">
                        <i class="fas fa-sync-alt"></i>Naptár beállítások frissítése
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <div id="rendkivuli_autoszerviz">
            <div class="row">
                <div class="col-sm-12">
                    <p class="font-weight-bold">Rendkívüli nyitvatartás hozzáadása - Autószerviz:</p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12">
                    <p style="margin: 0;">Dátum és idő kiválasztása:</p>
                </div>
                <div id="add_non_working_days" class="col-sm-8 col-xl-6">
                    <input id="extradates_car_open_date" class="form-control" data-toggle="datepicker" autocomplete="off" placeholder="Dátum pl.: 2020-02-02">
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="input-group col-sm-10 col-xl-8">
                    <select class="form-control" id="extradates_car_open_hours_from">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}">{{ $hour }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group-text">-</div>
                    </div>
                    <select class="form-control" id="extradates_car_open_hours_to">
                        @foreach ($hours_full as $hour)
                            <option value="{{ $hour }}">{{ $hour }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" id="extradates_car_open_add" class="btn btn-primary btn-sm" style="margin-bottom: 20px;">
                        <i class="fas fa-plus"></i>Rendkívüli hozzáadása
                    </button>
                </div>
            </div>
            <div class="row dates-list-box">
            <div id="rendkivuli_autoszerviz_blue">
                <div class="col-sm-6 col-xl-4" style="margin-bottom: 10px;">
                    <select id="extradates_car_open_year" class="form-control" style="width: auto;">
                        @for($i = 2020; $i < 2040; $i++)
                        <option value="{{ $i }}"<?php if($i == date('Y')) echo ' selected'; ?>>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div id="extradates_car_open_list" class="col-sm-12">
                    @foreach ($get_workdays_cars as $day)
                    <button type="button" data-id="{{ $day->id }}" class="btn btn-success btn-sm btn_dates btn_dates_open">{{ $day->date }} {{ str_replace('|', ' - ', $day->open_close) }}</button>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
        <hr>
        <div id="szabadnapok_autoszerviz">
            <div class="row" >
                <div class="col-sm-12">
                    <p class="font-weight-bold">Ünnepnapok / Szabadnapok hozzáadása - Autószerviz:</p>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-sm-12">
                    <p style="margin: 0;">Dátum kiválasztása:</p>
                </div>
                <div id="add_non_working_days" class="col-sm-8 col-xl-6">
                    <input id="extradates_car_close" class="form-control" data-toggle="datepicker" autocomplete="off" placeholder="Dátum pl.: 2020-02-02">
                </div>
                <div class="col-sm-12">
                    <div class="form-check">
                        <input id="extradates_car_close_yearly_repeat" class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Évente ismétlődő szabadnap?
                        </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" id="extradates_car_close_add" class="btn btn-primary btn-sm" style="margin-bottom: 20px;">
                        <i class="fas fa-plus"></i>Szabadnap hozzáadása
                    </button>
                </div>
            </div>
            <div class="row dates-list-box">
            <div id="szabadnapok_autoszerviz_blue">
                <div class="col-sm-6 col-xl-4" style="margin-bottom: 10px;">
                    <select id="extradates_car_close_year" class="form-control" style="width: auto;">
                        @for($i = 2020; $i < 2040; $i++)
                        <option value="{{ $i }}"<?php if($i == date('Y')) echo ' selected'; ?>>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div id="extradates_car_close_list" class="col-sm-12">
                    @foreach ($get_non_workdays_cars as $day)
                    <button type="button" data-id="{{ $day->id }}" class="btn btn-danger btn-sm btn_dates btn_dates_close">{{ $day->date }} {{ str_replace('|', ' - ', $day->open_close) }}</button>
                    @endforeach
                    <div style="clear:both;"></div>
                    @foreach ($get_non_workdays_cars_repeat as $day)
                    <button type="button" data-id="{{ $day->id }}" class="btn btn-danger btn-sm btn_dates btn_dates_close">{{ $day->date }} {{ str_replace('|', ' - ', $day->open_close) }}</button>
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

@include('admin.content.modals.booking-settings-rendkivuli')
@include('admin.content.modals.booking-settings-szabadnap')
@endsection

@push('styles')
    <!-- Dinamikus stílus fájlok ide: -->
    <!-- Custom CSS -->
    <link href="/adminset/css/datepicker.min.css" rel="stylesheet" />
    <link href="/adminset/css/custom/bookingssettings.css" rel="stylesheet" />
@endpush
@push('scripts')
    <!-- Dinamikus script fájlok ide: -->
    <!-- Custom JS -->
    <script type="text/javascript" src="/adminset/js/datepicker.min.js"></script>
    <script type="text/javascript" src="/adminset/js/custom/bookingssettings.js"></script>
@endpush