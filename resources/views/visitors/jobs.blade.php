@extends('layouts/visitors')
@section('content')

@foreach($blocks as $block)
{!! $block->content !!}
@endforeach

@endsection

@push('title')
    <title>Álláslehetőségek - {{ $page_name_full }}</title>
@endpush

@push('metas')
    <meta name="keywords" content="biatorbágy, állás, állások, állásajánlatok, gumi, autó, felni, felújítás, diagnosztika, szerelés, javítás, centírozás, bejelentkezés, nyitvatartás"/>
    <meta name="description" content="Cégünk aktuális állásajánlatait az alább oldalon tekintheti meg. Jelentkezzen nálunk telefonon vagy a Kapcsolat oldalon.">
    <meta property="og:description" content="Cégünk aktuális állásajánlatait az alább oldalon tekintheti meg. Jelentkezzen nálunk telefonon vagy a Kapcsolat oldalon."/>
    <meta property="og:site_name" content="{{ $page_name_full }}"/>
    <meta property="og:type" content="company"/>
    <meta property="og:title" content="Álláslehetőségek - {{ $page_name_full }}"/>
    <meta property="og:url" content="{{ $page_url }}"/>
    <meta property="og:image" content="{{ $page_url }}/images/gallery/muhely.jpg"/>
    <meta property="fb:admins" content="100000603172529"/>
    <meta property="fb:app_id" content="645926605487676"/>
@endpush