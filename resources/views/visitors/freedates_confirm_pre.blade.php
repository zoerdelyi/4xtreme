@extends('layouts/visitors')


@section('content')

@if ( isset($message) && isset($hash) )
<div style="min-height: 50vh"></div>
<script>
if(confirm('<?php echo $message; ?>')){
    window.location.href = '/emails/delete_confirmed/<?php echo $hash; ?>';
}
</script>
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