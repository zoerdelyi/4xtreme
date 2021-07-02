@extends('admin/layouts/admin')
@section('content')

@push('title') 
<title>Szolgáltatások kezelése - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <h2 class="admin_title">Szolgáltatások kezelése</h2>
    <p class="plus_text">Autószervizes és gumiszervizes szolgáltatásokat adhat hozzá, szerkeszthet és törölhet ezen az oldalon.</p>
</div>
<button data-toggle="modal" data-target="#servieModal" class="btn btn-primary" style="margin-bottom: 15px;">
    <i class="fa fa-plus"></i><span> Szolgáltatás hozzáadása
</span>
</button>
<div class="row">
    <!-- Gumiszerviz blokk -->
    <div class="col-md-6 settings_block" style="border-right: solid 1px #971817;">
        <h3 class="text-center">Gumiszerviz szolgáltatások</h3>
        <hr>
        <table id="tire-service-list" class="table">
            <thead>
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Név</th>
                    {{-- <th scope="col">Bruttó ár</th> --}}
                    {{-- <th scope="col">Nettó ár</th> --}}
                    <th scope="col" style="width: 1%; white-space: nowrap;">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tireServices as $tireService)
                @if($tireService->id != 1)
                <tr class="tire-service-block-{{ $tireService->id }}">
                    {{-- <th scope="row"> {{ $tireService->id }}</th> --}}
                    <td class="tire-name-{{ $tireService->id }}">{{ $tireService->name }}</td>
                    {{-- <td class="tire-gross-price-{{ $tireService->id }}">{{ $tireService->gross_price }} Ft</td> --}}
                    {{-- <td class="tire-net-price-{{ $tireService->id }}">{{ $tireService->net_price }} Ft</td> --}}
                    <td>
                        <button class="btn btn-primary btn-sm editServiceButton" style="white-space: nowrap; margin-bottom: 5px;" data-service-id="{{$tireService->id}}" data-service-type="tire">
                            <i class="far fa-edit"></i><span>Szerkesztés</span>
                        </button>
                        <button class="btn btn-danger btn-sm removeServiceButton" data-service-id="{{$tireService->id}}" data-service-type="tire">
                            <i class="fas fa-trash-alt"></i><span>Eltávolítás</span>
                        </button>
                    </td>
                </tr>
                <tr class="hide tire-service-edit-block-{{ $tireService->id }}">
                    <td colspan="5">
                        <form>
                            <div class="form-group row">
                                <label for="tire-serviceName{{ $tireService->id }}" class="col-sm-3 col-form-label">Szolgáltatás
                                    neve</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="tire-serviceName{{ $tireService->id }}"
                                        id="tire-serviceName{{ $tireService->id }}" value="{{ $tireService->name }}"><br>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="tire-serviceGrossPrice{{ $tireService->id }}" class="col-sm-3 col-form-label">Bruttó
                                    ár</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="tire-serviceGrossPrice{{ $tireService->id }}"
                                        id="tire-serviceGrossPrice{{ $tireService->id }}" value="{{ $tireService->gross_price }}"><br>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group row">
                                <label for="tire-serviceNetPrice{{ $tireService->id }}" class="col-sm-3 col-form-label">Nettó
                                    ár</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="tire-serviceNetPrice{{ $tireService->id }}"
                                        id="tire-serviceNetPrice{{ $tireService->id }}" value="{{ $tireService->net_price }}"><br>
                                </div>
                            </div> --}}
                            <button type="button" class="btn btn-primary btn-sm update_service"
                                data-service-id="{{ $tireService->id }}" data-service-type="tire">
                                <i class="fas fa-save"></i><span>Módosítások mentése</span>
                            </button>
                        </form>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Autószerviz blokk -->
    <div class="col-md-6 settings_block">
        <h3 class="text-center">Autószerviz szolgáltatások</h3>
        <hr>
        <table id="car-service-list" class="table">
            <thead>
                <tr>
                    {{-- <th scope="col">ID</th> --}}
                    <th scope="col">Név</th>
                    {{-- <th scope="col">Bruttó ár</th> --}}
                    {{-- <th scope="col">Nettó ár</th> --}}
                    <th scope="col" style="width: 1%; white-space: nowrap;">
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carServices as $carService)
                @if($carService->id != 1)
                    <tr class="car-service-block-{{ $carService->id }}">
                        {{-- <th scope="row"> {{ $carService->id }}</th> --}}
                        <td class="car-name-{{ $carService->id }}" >{{ $carService->name }}</td>
                        {{-- <td class="car-gross-price-{{ $carService->id }}">{{ $carService->gross_price }} Ft</td> --}}
                        {{-- <td class="car-net-price-{{ $carService->id }}">{{ $carService->net_price }} Ft</td> --}}
                        <td>
                            <button class="btn btn-primary btn-sm editServiceButton" style="white-space: nowrap; margin-bottom: 5px;" data-service-id="{{$carService->id}}" data-service-type="car">
                                <i class="far fa-edit"></i><span>Szerkesztés</span>
                            </button>
                            <button class="btn btn-danger btn-sm removeServiceButton" data-service-id="{{$carService->id}}" data-service-type="car">
                                <i class="fas fa-trash-alt"></i><span>Eltávolítás</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="hide car-service-edit-block-{{ $carService->id }}">
                        <td colspan="5">
                            <form>
                                <div class="form-group row">
                                <label for="car-serviceName{{ $carService->id }}" class="col-sm-3 col-form-label">Szolgáltatás neve</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="car-serviceName{{ $carService->id }}" id="car-serviceName{{ $carService->id }}" value="{{ $carService->name }}"><br>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label for="car-serviceGrossPrice{{ $carService->id }}" class="col-sm-3 col-form-label">Bruttó ár</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="car-serviceGrossPrice{{ $carService->id }}" id="car-serviceGrossPrice{{ $carService->id }}" value="{{ $carService->gross_price }}"><br>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group row">
                                    <label for="car-serviceNetPrice{{ $carService->id }}" class="col-sm-3 col-form-label">Nettó ár</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="car-serviceNetPrice{{ $carService->id }}" id="car-serviceNetPrice{{ $carService->id }}" value="{{ $carService->net_price }}"><br>
                                    </div>
                                </div> --}}
                                <button type="button" class="btn btn-primary btn-sm update_service" data-service-id="{{ $carService->id }}" data-service-type="car">
                                        <i class="fas fa-save"></i><span>Módosítások mentése</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@include('admin.content.modals.service-modal')
@endsection

<!-- Dinamikus stílus fájlok ide: -->
@push('styles')
    <link href="/adminset/css/custom/services.css" rel="stylesheet" />
@endpush
<!-- Dinamikus script fájlok ide: -->
@push('scripts')
<!-- Custom JS -->
    <script type="text/javascript" src="/adminset/js/custom/services.js"></script>
@endpush