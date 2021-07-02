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
    <title>Rólunk - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, bemutatkozás, rólunk, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="Cégünk, mely Biatorbágy legrégebbi autó és gumiszervizeként ismert, várja  régi és új ügyfeleit 20 éves szakmai tapasztalattal, kedvező árakkal, akciókkal, rugalmas, forgalomhoz igazodó nyitvatartással és kulturált váróhelységgel."/>
    <meta property="og:description" content="Cégünk, mely Biatorbágy legrégebbi autó és gumiszervizeként ismert, várja  régi és új ügyfeleit 20 éves szakmai tapasztalattal, kedvező árakkal, akciókkal, rugalmas, forgalomhoz igazodó nyitvatartással és kulturált váróhelységgel."/>
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="Rólunk - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}"/>
    <meta property="og:image" content="{{ $page_url }}/images/gallery/szerelo_gep.jpg"/>
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