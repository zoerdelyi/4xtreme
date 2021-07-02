@extends('layouts/visitors')
@section('content')

@foreach($blocks as $block)
{!! $block->content !!}
@endforeach

@endsection

@push('title')
    <title>Gumis Szolgáltatások - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, gumis, szolgáltatások, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="A gumi minősége, szezonalitása, kora, kopottsága erősen befolyásolja a fékutat. Ha csak egy zebrányival később tud megállni a rossz minőségű gumi miatt, az már régen rossz.">
    <meta property="og:description" content="A gumi minősége, szezonalitása, kora, kopottsága erősen befolyásolja a fékutat. Ha csak egy zebrányival később tud megállni a rossz minőségű gumi miatt, az már régen rossz."/>
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="Gumis Szolgáltatások - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}"/>
    <meta property="og:image" content="{{ $page_url }}/images/gallery/szerelo_gep.jpg"/>
    <meta property="fb:admins" content="100000603172529"/>
    <meta property="fb:app_id" content="645926605487676"/>
@endpush
