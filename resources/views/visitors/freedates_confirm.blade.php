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
    <div style="min-height: 50vh"></div>
@endif

@endsection

@push('title')
    <title>Időpontfoglalás megerősítés - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, időpontfoglalás, időpont, foglalás, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="Az alábbi oldalon lehetősége van az Autószervizünkbe és a Gumiszervizünkbe időpontot foglalni. Foglaljon cégünkhöz időpontot kényelmesen, rövid idő alatt.">
    <meta property="og:description" content="Az alábbi oldalon lehetősége van az Autószervizünkbe és a Gumiszervizünkbe időpontot foglalni. Foglaljon cégünkhöz időpontot kényelmesen, rövid idő alatt."/>
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="Időpontfoglalás - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}"/>
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