@php $ossz_penz = 0; @endphp
@foreach ($cars as $car)
<?php

$start_time = strtotime($car['start_time']);
$now_hour = \Carbon\Carbon::now()->timezone('Europe/Budapest')->timestamp;
$now_hour_plus_one = \Carbon\Carbon::now()->timezone('Europe/Budapest')->timestamp+3600;

$in_current_hour = '';
if($start_time >= $now_hour && $start_time < $now_hour_plus_one){
    $in_current_hour = ' style="background:#d9ecff;"';
}
?>
    <tr{!! $in_current_hour !!}>
        {{-- <td>{{ $car['booking_id'] }}</td> --}}
        {{-- <td>{{ date('Y-m-d H:i', strtotime($car['created_at'])) }}</td> --}}
        <td class="font-weight-bold"><div class="noselect cal_not_free" data-id="{{ $car['id'] }}" data-start="{{ $car['start_time'] }}" data-end="{{ $car['end_time'] }}" data-nice="{{ $car['start_time'] }} - {{ $car['end_time'] }}">{{ $car['licence_plate'] }}</div></td>
        <td>{!! ($car['confirmed'] == NULL) ? '<span class="booking_unconfirmed">Megerősítés alatt</span>' : '<span class="booking_confirmed">Megerősítve</span>' !!}</td>
        {{-- <td>{{ $car['updated_at'] }}</td> --}}
        <td>{!! $car['comment'] == 'NOTSET' || $car['comment'] == '' ? '-' : nl2br($car['comment']) !!}</td>
        <td class="font-weight-bold nowrap">{{ date('Y. m. d. H:i', strtotime('+'.(($car['plus_mins'] != null) ? (($car['plus_mins'] >= 30) ? $car['plus_mins']-30 : $car['plus_mins'] ) : 0).' minutes', strtotime($car['start_time']))) }}</td>
        {{-- <td>{{ date('Y-m-d H:i', strtotime($car['end_time'])) }}</td> --}}
        <td>{{ $car['visotors_name'] == 'NOTSET' || $car['visotors_name'] == '' ? '-' : $car['visotors_name'] }}</td>
        {{-- <td>{{ $car['visotors_email'] == 'NOTSET' || $car['visotors_email'] == '' ? '-' : $car['visotors_email'] }}</td> --}}
        <td>{{ $car['visotors_phone'] == 'NOTSET' || $car['visotors_phone'] == '' ? '-' : $car['visotors_phone'] }}</td>
        <td>{{ $car['services_cars_name'] == 'NOTSET' || $car['services_cars_name'] == '' ? '-' : $car['services_cars_name'] }}</td>
        {{-- <td>{{ $car['car_brand'] }} {{ $car['car_type'] }}</td> --}}
        {{-- <td>{{ ($car['car_brand_id'] != 1) ? $car['car_brand'] : $car['car_brand_other'] }} {{ ($car['car_type_id'] != 1) ? $car['car_type'] : $car['car_type_other'] }}</td> --}}
        <td>
        @php
            if($car['car_brand_id'] != 1 && $car['car_type_id'] != 1){ // márka és típus létezik
                
                echo $car['car_brand'].' '.$car['car_type'];

            }elseif($car['car_brand_id'] != 1 && $car['car_type_id'] == 1){ // márka adott, típus egyedi
                
                echo $car['car_brand'].' '.$car['car_type_other'];

            }elseif($car['car_brand_id'] == 1 && $car['car_type_id'] == 1){ // márka egyedi, típus egyedi
                
                echo $car['car_brand_other'].' '.$car['car_type_other'];

            }
            else{ // márka és típus sincs megadva
                
                echo '-';

            }
        @endphp
        </td>
        <td class="nowrap">{!! ($car['payment_total']) ? number_format($car['payment_total'], 0, ',', '.').' Ft' : '<span class="text-danger">Nem</span>' !!}</td>
        {{-- <td>{!! ($car['payment_total']) ? '<span class="text-success">Igen</span>' : '<span class="text-danger">Nem</span>' !!}</td> --}}
        <td>@switch($car['payment_type']) @case(1) Készpénz @break @case(2) Bankkártya @break @case(3) Átutalás @break @default - @endswitch</td>
    </tr>
    @php $ossz_penz += $car['payment_total']; @endphp
@endforeach
<tr class="total_payment">
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
            {!! $cars->links('pagination::bootstrap-4') !!}
        </div>
    </td>
</tr>