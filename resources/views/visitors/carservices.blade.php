@extends('layouts/visitors')
@section('content')

@foreach($blocks as $block)
{!! $block->content !!}
@endforeach

@endsection

@push('title')
    <title>Autós Szolgáltatások - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, autós, szolgáltatások, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="Nemcsak gumiszerviz, de autószerviz tevékenységeket is igénybe vehet nálunk. Autószervizünk szolgáltatásait az alábbi oldalon tekintheti meg. További információkért keresse kollégáinkat.">
    <meta property="og:description" content="Nemcsak gumiszerviz, de autószerviz tevékenységeket is igénybe vehet nálunk. Autószervizünk szolgáltatásait az alábbi oldalon tekintheti meg. További információkért keresse kollégáinkat."/>
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="Autós Szolgáltatások - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}"/>
    <meta property="og:image" content="{{ $page_url }}/images/gallery/szerelo_gep.jpg"/>
    <meta property="fb:admins" content="100000603172529"/>
    <meta property="fb:app_id" content="645926605487676"/>
@endpush
