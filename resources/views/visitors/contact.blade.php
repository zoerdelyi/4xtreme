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

@foreach($blocks as $block)
{!! $block->content !!}
@endforeach

@endsection

@push('title')
    <title>Kapcsolat - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, kapcsolat, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="Az alábbiakban megtalálja elérhetőségeinket, valamint üzenetküldésre is van lehetősége. Kollégáink az ügyfelek minél gyorsabb és szakszerűbb kiszolgálását biztosítják.">
    <meta property="og:description" content="Az alábbiakban megtalálja elérhetőségeinket, valamint üzenetküldésre is van lehetősége. Kollégáink az ügyfelek minél gyorsabb és szakszerűbb kiszolgálását biztosítják."/>
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="Kapcsolat - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}"/>
    <meta property="og:image" content="{{ $page_url }}/images/gallery/map.jpg"/>
    <meta property="fb:admins" content="100000603172529"/>
    <meta property="fb:app_id" content="645926605487676"/>
@endpush
