@extends('layouts/visitors')
@section('content')
    
@foreach($blocks as $block)
@if($block->content != '#@GALÉRIA@#')
{!! $block->content !!}
@else
@include('moduls/gallery') 
@endif
@endforeach

@endsection

@push('title')
    <title>Főoldal - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="Szervizünkben várjuk régi és új ügyfeleinket gumi, futómű, autószerviz, klimajavitás és egyéb gyrosszerviz szolgáltatásokkal."/>{{-- <meta name="description" content="Szervizünkben várjuk régi és új ügyfeleinket gumi, futómű és autószerviz, klimajavitás, egyéb gyrosszerviz és autógáz beépítés, javítás szolgáltatásokkal."/> --}}
    <meta property="og:description" content="Szervizünkben várjuk régi és új ügyfeleinket gumi, futómű, autószerviz, klimajavitás és egyéb gyrosszerviz szolgáltatásokkal."/>{{-- <meta property="og:description" content="Szervizünkben várjuk régi és új ügyfeleinket gumi, futómű és autószerviz, klimajavitás, egyéb gyrosszerviz és autógáz beépítés, javítás szolgáltatásokkal."/> --}}
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="Főoldal - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}"/>
    <meta property="og:image" content="{{ $page_url }}/images/gallery/muhely.jpg"/>
    <meta property="fb:admins" content="100000603172529"/>
    <meta property="fb:app_id" content="645926605487676"/>
@endpush

@push('styles')
    <!-- Egyedi stílus fájlok -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet">
@endpush
@push('scripts')
    <!-- Egyedi script fájlok -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
@endpush