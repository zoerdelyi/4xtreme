@extends('layouts/visitors')


@section('content')

@if ( isset($msg_sent) && isset($msg_type) )
    <div id="alert_holder" class="auto-container" style="margin-top: 20px;">
        <div class="alert alert-{{ $msg_type }}" role="alert" style="margin: 0;">
            <b>{{ $msg_sent }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
@endif


        <div class="row bootstrap-calendar">
            <div class="col-md-12">

<div id="admin_top">
    <div class="auto-container">
        <h2 class="admin_title float-left" data-c_type="">Időpontfoglaló Naptár</h2>
        <button type="button" id="booking_restart" class="btn btn-primary float-right mb-3 d-none"><i class="fa fa-undo"></i>Főmenü</button>
    </div>
    <div class="clearfix"></div>
</div>
<div class="div_preloader"></div>
<div id="calendar_holder" style="min-height: 600px">
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
            <li class="page-item disabled" id="enable_prev"><a class="page-link cal_next_prev" data-next_prev="prev" href="#"><span aria-hidden="true">&laquo;</span> Előző</a></li>
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
    </div>
</div>
@include('visitors.modals.booking-visitors-modal')
@include('visitors.modals.booking-visitors-success')

</div>
</div>
@endsection

@push('title')
    <title>Időpontfoglalás - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, időpontfoglalás, időpont, foglalás, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="Az alábbi oldalon lehetősége van az Autószervizünkbe és a Gumiszervizünkbe időpontot foglalni. Foglaljon cégünkhöz időpontot kényelmesen, rövid idő alatt.">
    <meta property="og:description" content="Az alábbi oldalon lehetősége van az Autószervizünkbe és a Gumiszervizünkbe időpontot foglalni. Foglaljon cégünkhöz időpontot kényelmesen, rövid idő alatt."/>
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Időpontfoglalás - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}/idopontfoglalo"/>
    <meta property="og:image" content="{{ $page_url }}/images/gallery/muhely.jpg"/>
    <meta property="fb:admins" content="100000603172529"/>
    <meta property="fb:app_id" content="645926605487676"/>
@endpush

@push('styles')
    <!-- Custom CSS -->
    <link href="/css/loader.css" rel="stylesheet">
    <link href="/css/calendar/bootstrap-calendar.css" rel="stylesheet" />
    <link href="/css/calendar/calendar.css?{{ time() }}" rel="stylesheet" />
@endpush
@push('scripts')
    <!-- Custom JS -->
    <script type="text/javascript" src="/js/calendar/timer.jquery.min.js"></script>
    <script type="text/javascript" src="/js/calendar/booking.js?{{ time() }}"></script>
    <script type="text/javascript" src="/js/calendar/calendar.js?{{ time() }}"></script>
@endpush