@extends('admin/layouts/admin')
@section('content')

@push('title') 
<title>Időpontfoglaló Naptár - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <div>
        <h2 class="admin_title float-left" data-c_type="">Időpontfoglaló Naptár</h2>
        <button type="button" id="booking_restart" class="btn btn-primary float-right mb-3 d-none"><i class="fas fa-undo"></i>Főmenü</button>
    </div>
    <div class="clearfix"></div>
</div>
<div class="div_preloader"></div>
<div id="calendar_holder">
    <div class="intro_layer">
        <div class="row">
            <div class="col-12">
                <hr>
                <h3 class="text-center">Naptár választása</h3>
                <hr>
            <p class="text-center">A foglalás megkezdéséhez kérem válasszon az alábbi naptár{{ $calendar_options == 2 ? 'ak' : '' }} közül!</p>
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
                    <p class="select_booking_type" data-c_type="tire">GUMISZERVIZ<br>IDŐPONTFOGLALÁS</p>
                </div>
                @endif
                @if($calendar_cars == 1)
                @if($calendar_options < 2)
                <div class="col-12 select_type">
                @else
                <div class="col-12 col-sm-12 col-md-6 col-lg-5 col-xl-4 select_type">
                @endif
                    <p class="select_booking_type" data-c_type="car">AUTÓSZERVIZ<br>IDŐPONTFOGLALÁS</p>
                </div>
                @endif
            @else
            <div class="col-12">
            <h1 class="text-center" style="color: #911615;">Az időpontfoglalás jelenleg ki van kapcsolva!</h1>
            </div>
            @endif
        </div>
    </div>
    <div class="calendar_layer">
    <div id="update_without_preloader"></div>
    <div style="clear: both;"></div>
    <nav aria-label="Naptár lapozó" class="d-flex justify-content-center">
        <ul class="pagination">
            {{-- <li class="page-item disabled" id="enable_prev"><a class="page-link cal_next_prev" data-next_prev="prev" href="#"><span aria-hidden="true">&laquo;</span> Előző</a></li> --}}
            <li class="page-item" id="enable_prev"><a class="page-link cal_next_prev" data-next_prev="prev" href="#"><span aria-hidden="true">&laquo;</span> Előző</a></li>
            <li class="page-item" id="enable_next"><a class="page-link cal_next_prev" data-next_prev="next" href="#">Következő <span aria-hidden="true">&raquo;</span></a></li>
        </ul>
    </nav>
    <div class="clearfix"></div>
    <div class="row row-no-padding">
        <!-- Időpontok -->
        <div class="tower_block col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2" id="cal_times">
            <div class="cal_titles text-white" style="border-left: solid 1px black;">
                <p>Időpont</p>
                <p><br></p>
            </div>
            <div class="cal_dates"></div>
        </div>
        <!-- Napok loopolása -->
    <?php
    // TODO: TESZT TÖRÖLNI:
    // print_r( $calendar_start_datas );
    // exit;
    ?>
        @for($index = 0; $index < 5; $index++)
    @php
    if($index == 1){
        $out = 'd-none d-sm-block';
    }elseif($index == 2){
        $out = 'd-none d-md-block';
    }elseif($index == 3){
        $out = 'd-none d-xl-block';
    }elseif($index == 3){
        $out = 'd-none d-xl-block';
    }
    @endphp
        <div class="tower_block dynamic_dates col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2 {{ (isset($out)) ? $out : '' }}" id="cal_{{ $index+1 }}" data-date="">
            <div class="cal_titles text-white">
                <p class="cal_day"></p>
                <p class="cal_day_name"></p>
            </div>
            <div class="cal_free_space">
            
            </div>
        </div>
        @endfor
    </div>
    <p class="font-weight-bold">Színkódok magyarázata:</p>
    <div id="calendar_color_codes" class="row row-no-padding">
        <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2 cal_free_description">
            <div class="desc_free">Szabad időpont</div>
            <div class="desc_progressed ">Foglalás alatt</div>
            <div class="desc_progressed ">Megerősítés alatt</div>
            <div class="desc_reserved">Megerősített</div>
            <div class="desc_paid">Rendezve</div>
            <div class="desc_closed">Bezárt</div>
        </div>
    </div>
    </div>
</div>
@include('admin.content.modals.booking-modal')
@include('admin.content.modals.booking-preview-modal')
@include('admin.content.modals.booking-edit-modal')
@include('admin.content.modals.booking-success')
@endsection

@push('styles')
    <!-- Custom CSS -->
    <link href="/adminset/css/custom/calendar.css?{{ time() }}" rel="stylesheet" />
@endpush
@push('scripts')
    <!-- Custom JS -->
    <script type="text/javascript" src="/adminset/js/custom/timer.jquery.min.js"></script>
    <script type="text/javascript" src="/adminset/js/custom/booking.js?{{ time() }}"></script>
    <script type="text/javascript" src="/adminset/js/custom/calendar.js?{{ time() }}"></script>
@endpush
