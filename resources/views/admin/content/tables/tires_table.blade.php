@php $ossz_penz = 0; @endphp
@foreach ($tires as $tire)
<?php

$start_time = strtotime($tire['start_time']);
$now_hour = \Carbon\Carbon::now()->timezone('Europe/Budapest')->timestamp;
$now_hour_plus_one = \Carbon\Carbon::now()->timezone('Europe/Budapest')->timestamp+3600;

$in_current_hour = '';
if($start_time >= $now_hour && $start_time < $now_hour_plus_one){
    $in_current_hour = ' style="background:#d9ecff;"';
}
?>
    <tr{!! $in_current_hour !!}>
        {{-- <td>{{ $tire['booking_id'] }}</td> --}}
        {{-- <td>{{ date('Y-m-d H:i', strtotime($tire['created_at'])) }}</td> --}}
        <td class="font-weight-bold"><div class="noselect cal_not_free" data-id="{{ $tire['id'] }}" data-start="{{ $tire['start_time'] }}" data-end="{{ $tire['end_time'] }}" data-nice="{{ $tire['start_time'] }} - {{ $tire['end_time'] }}">{{ $tire['licence_plate'] }}</div></td>
        <td>{!! ($tire['confirmed'] == NULL) ? '<span class="booking_unconfirmed">Megerősítés alatt</span>' : '<span class="booking_confirmed">Megerősítve</span>' !!}</td>
        {{-- <td>{{ $tire['updated_at'] }}</td> --}}
        <td>{!! $tire['comment'] == 'NOTSET' || $tire['comment'] == '' ? '-' : nl2br($tire['comment']) !!}</td>
        <td class="font-weight-bold nowrap">{{ date('Y. m. d. H:i', strtotime('+'.(($tire['plus_mins'] != null) ? (($tire['plus_mins'] >= 30) ? $tire['plus_mins']-30 : $tire['plus_mins'] ) : 0).' minutes', strtotime($tire['start_time']))) }}</td>
        {{-- <td>{{ date('Y-m-d H:i', strtotime($tire['start_time'])) }}</td> --}}
        <td>{{ $tire['visotors_name'] == 'NOTSET' || $tire['visotors_name'] == '' ? '-' : $tire['visotors_name'] }}</td>
        {{-- <td>{{ $tire['visotors_email'] == 'NOTSET' || $tire['visotors_email'] == '' ? '-' : $tire['visotors_email'] }}</td> --}}
        <td>{{ $tire['visotors_phone'] == 'NOTSET' || $tire['visotors_phone'] == '' ? '-' : $tire['visotors_phone'] }}</td>
        <td>{{ $tire['services_tires_name'] == 'NOTSET' || $tire['services_tires_name'] == '' ? '-' : $tire['services_tires_name'] }}</td>
        <td>{!! ($tire['tire_parking'] == 1) ? '<span class="text-success">Igen</span>' : '<span class="text-danger">Nem</span>' !!}</td>
        {{-- <td>{{ $tire['car_brand'] }} {{ $tire['car_type'] }}</td> --}}
        {{-- <td>{{ ($tire['car_brand_id'] != 1) ? $tire['car_brand'] : $tire['car_brand_other'] }} {{ ($tire['car_type_id'] != 1) ? $tire['car_type'] : $tire['car_type_other'] }}</td> --}}
        {{-- <td>{{ ($tire['car_brand'] != 'NOTSET') ? ( ($tire['car_brand_id'] != 1) ? $tire['car_brand'] : $tire['car_brand_other'] ) : '-' }} {{ ($tire['car_brand'] != 'NOTSET') ? ( ($tire['car_type_id'] != 1) ? $tire['car_type'] : $tire['car_type_other'] ) : '' }}</td> --}}
        <td>
            @php
                if($tire['car_brand_id'] != 1 && $tire['car_type_id'] != 1){ // márka és típus létezik
                    
                    echo $tire['car_brand'].' '.$tire['car_type'];
    
                }elseif($tire['car_brand_id'] != 1 && $tire['car_type_id'] == 1){ // márka adott, típus egyedi
                    
                    echo $tire['car_brand'].' '.$tire['car_type_other'];
    
                }elseif($tire['car_brand_id'] == 1 && $tire['car_type_id'] == 1){ // márka egyedi, típus egyedi
                    
                    echo $tire['car_brand_other'].' '.$tire['car_type_other'];
    
                }
                else{ // márka és típus sincs megadva
                    
                    echo '-';
    
                }
            @endphp
        </td>

        <td class="nowrap">{!! ($tire['payment_total']) ? number_format($tire['payment_total'], 0, ',', '.').' Ft' : '<span class="text-danger">Nem</span>' !!}</td>
        {{-- <td>{!! ($tire['payment_total']) ? '<span class="text-success">Igen</span>' : '<span class="text-danger">Nem</span>' !!}</td> --}}
        <td>@switch($tire['payment_type']) @case(1) Készpénz @break @case(2) Bankkártya @break @case(3) Átutalás @break @default - @endswitch</td>
    </tr>
    @php $ossz_penz += $tire['payment_total']; @endphp
@endforeach
<tr class="total_payment">
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><b>Összesen:</b></td>
    <td colspan="2"><b>{{ number_format($ossz_penz, 0, ',', '.') }} Ft</b></td>
</tr>
<tr>
    <td colspan="100%">
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $tires->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>