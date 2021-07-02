@extends('admin/layouts/admin')
@section('content')

@push('title') 
<title>Foglalt időpontok - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <h2 class="admin_title">Foglalt időpontok</h2>
</div>
<div class="div_preloader"></div>
<div id="calendar_holder" class="d-none">
    <div class="list_intro_layer">
        <div class="row">
            <div class="col-12">
                <hr>
                <h3 class="text-center">Lista választása</h3>
                <hr>
            <p class="text-center">A lista megtekintéséhez kérem válasszon az alábbi lehetőség{{ $calendar_options == 2 ? 'ek' : '' }} közül!</p>
            </div>
        </div>
        <div class="row select_elements">
            @if($calendar_options != 0)
                @if($calendar_tires == 1)
                @if($calendar_options < 2)
                <div class="col-12 select_type">
                @else
                <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-4 offset-lg-1 offset-xl-2 select_type">
                @endif
                    {{-- <p class="select_booking_type d-none" data-c_type="tire">GUMISZERVIZ<br>IDŐPONTOK</p> --}}
                    <p class="list_select_booking_type" data-c_type="tire">GUMISZERVIZ<br>IDŐPONTOK</p>
                </div>
                @endif
                @if($calendar_cars == 1)
                @if($calendar_options < 2)
                <div class="col-12 select_type">
                @else
                <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-4 select_type">
                @endif
                    {{-- <p class="select_booking_type d-none" data-c_type="car">AUTÓSZERVIZ<br>IDŐPONTOK</p> --}}
                    <p class="list_select_booking_type" data-c_type="car">AUTÓSZERVIZ<br>IDŐPONTOK</p>
                </div>
                @endif
            @else
            <div class="col-12">
            <h1 class="text-center" style="color: #911615;">Az időpontfoglalás jelenleg ki van kapcsolva!</h1>
            </div>
            @endif
        </div>
    </div>
</div>
<div id="idopontok_gumiszerviz" class="row d-none">
    <div class="col-md-12 white_bg">
        <h4>Gumiszerviz időpontok</h4>
        <div class="table-responsive mt-3" id="tires_holder" data-paginates="{{ $paginate }}">
        {{-- <div id="filters_holder" style="margin-bottom: 10px;">
            <input type="text" id="daterangepicker" placeholder="Dátumok kiválasztása" style="min-width: 200px;padding: 2px 7px;">
            <br>
        </div> --}}
        <!-- tf = tire_filter | cf = car filter -->
        <table class="table filter_table">
            <thead>
                <tr>
                    <th>
                        Sorok száma:
                        <select id="tf_maxitems" style="float: right;height: 28px;">
                            <option value="0">Összes</option>
                            <option value="5">5</option>
                            <option value="25">25</option>
                            <option value="50" selected>50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                        </select>
                    </th>
                </tr>
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    {{-- <th scope="col">Létrehozva</th> --}}
                    {{-- <th scope="col">Rendszám</th> --}}
                    <th scope="col"><input type="text" id="tf_licence_plate" placeholder="Rendszám" autocomplete="off"></th>
                    <th scope="col">Állapot</th>
                    {{-- <th scope="col">Módosítva</th> --}}
                    {{-- <th scope="col">Komment</th> --}}
                    <th scope="col"><input type="text" id="tf_comment" placeholder="Komment" autocomplete="off"></th>
                    {{-- <th scope="col">Időpont</th> --}}
                    {{-- <th scope="col"><input type="search" id="tf_date" placeholder="Dátumok kiválasztása" placeholder="Időpont" autocomplete="off" style="border: solid 1px;min-width: 200px;"></th> --}}
                    <th scope="col">Dátum
                        <div class="input-group d-none">
                            <input type="search" id="tf_date" placeholder="Dátumok kiválasztása" placeholder="Időpont" autocomplete="off" style="border: solid 1px;min-width: 200px;" data-from="{{ $start_date }}" data-to="{{ $end_date }}" value="{{ $start_date.' - '.$end_date }}">
                            <button class="btn search_x_clear" id="tf_date_clear">
                            <i class="fa fa-times"></i>
                            </button>
                        </div>
                     </th>
                    {{-- <th scope="col">Dátum</th> --}}
                    {{-- <th scope="col">Befejezés</th> --}}
                    {{-- <th scope="col">Név</th> --}}
                    <th scope="col"><input type="text" id="tf_name" placeholder="Név" autocomplete="off"></th>
                    {{-- <th scope="col">Email</th> --}}
                    {{-- <th scope="col">Telefon</th> --}}
                    <th scope="col"><input type="text" id="tf_phone" placeholder="Telefon" autocomplete="off"></th>
                    <th scope="col">Szolgáltatás</th>
                    <th scope="col">Gumi tárolás?</th>
                    <th scope="col">Autó</th>
                    <th scope="col">Rendezve?</th>
                    {{-- <th scope="col">Fiz. tip?</th> --}}
                    <th scope="col">
                        <select id="tf_payment_type">
                            <option value="" selected>Összes</option>
                            <option value="1">Készpénz</option>
                            <option value="2">Bankkártya</option>
                            <option value="3">Átutalás</option>
                        </select>
                    </th>
                </tr>
            </thead>
            <tbody id="tires_body">
                @include('admin.content.tables.tires_table')
            </tbody>
        </table>
        </div>
    </div>
</div>
<div id="idopontok_autoszerviz" class="row d-none">
    <div class="col-md-12 white_bg">
        <h4>Autószerviz időpontok</h4>
        <div class="table-responsive mt-3" id="cars_holder" data-paginates="{{ $paginate }}">
        <table class="table filter_table">
            <thead>
                <tr>
                    <th>
                        Sorok száma:
                        <select id="cf_maxitems" style="float: right;">
                            <option value="0">Összes</option>
                            <option value="5">5</option>
                            <option value="25">25</option>
                            <option value="50" selected>50</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="500">500</option>
                        </select>
                    </th>
                </tr>
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    {{-- <th scope="col">Létrehozva</th> --}}
                    {{-- <th scope="col">Rendszám</th> --}}
                    <th scope="col"><input type="text" id="cf_licence_plate" placeholder="Rendszám"></th>
                    <th scope="col">Állapot</th>
                    {{-- <th scope="col">Módosítva</th> --}}
                    {{-- <th scope="col">Komment</th> --}}
                    <th scope="col"><input type="text" id="cf_comment" placeholder="Komment"></th>
                    {{-- <th scope="col">Időpont</th> --}}
                    <th scope="col">Dátum
                        <div class="input-group d-none">
                            <input type="search" id="cf_date" placeholder="Dátumok kiválasztása" placeholder="Időpont" autocomplete="off" style="border: solid 1px;min-width: 200px;" data-from="{{ $start_date }}" data-to="{{ $end_date }}" value="{{ $start_date.' - '.$end_date }}">
                            <button class="btn search_x_clear" id="cf_date_clear">
                            <i class="fa fa-times"></i>
                            </button>
                        </div>
                     </th>
                    {{-- <th scope="col">Dátum</th> --}}
                    {{-- <th scope="col">Befejezés</th> --}}
                    {{-- <th scope="col">Név</th> --}}
                    <th scope="col"><input type="text" id="cf_name" placeholder="Név"></th>
                    {{-- <th scope="col">Email</th> --}}
                    {{-- <th scope="col">Telefon</th> --}}
                    <th scope="col"><input type="text" id="cf_phone" placeholder="Telefon"></th>
                    <th scope="col">Szolgáltatás</th>
                    <th scope="col">Autó</th>
                    <th scope="col">Rendezve?</th>
                    {{-- <th scope="col">Fiz. tip?</th> --}}
                    <th scope="col">
                        <select id="cf_payment_type">
                            <option value="" selected>Összes</option>
                            <option value="1">Készpénz</option>
                            <option value="2">Bankkártya</option>
                            <option value="3">Átutalás</option>
                        </select>
                    </th>
                </tr>
            </thead>
            <tbody id="cars_body">
                @include('admin.content.tables.cars_table')
            </tbody>
        </table>
        </div>
        
    </div>
</div>
<style>
.total_payment{
    display: none;
}
</style>
{{-- @include('admin.content.modals.booking-modal') --}}
@include('admin.content.modals.booking-preview-modal')
@include('admin.content.modals.booking-edit-modal')
@include('admin.content.modals.booking-success')
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!-- Custom CSS -->
    <link href="/adminset/css/custom/calendar.css?{{ time() }}" rel="stylesheet" />
    <link href="/adminset/css/custom/booking.css?{{ time() }}" rel="stylesheet" />
@endpush
@push('scripts')
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <!-- Custom JS -->
    <script type="text/javascript" src="/adminset/js/custom/timer.jquery.min.js"></script>
    <script type="text/javascript" src="/adminset/js/custom/booking.js?{{ time() }}"></script>
    <script type="text/javascript" src="/adminset/js/custom/calendar.js?{{ time() }}"></script>
    <script type="text/javascript" src="/adminset/js/custom/booking_list_today.js?{{ time() }}"></script>
@endpush