@extends('admin/layouts/admin') 
@section('content')

@push('title') 
<title>Menüelemek rendezése - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <h2 class="admin_title">Menüelemek rendezése</h2>
    <div id="top_right">
        <button type="button" id="order_save" class="btn btn-success">
            <i class="fas fa-save"></i>Mentés
        </button>
    </div>
</div>
<div class="row" id="menu_order">
    <div class="col-lg-5 col-md-5 col-sm-6">
        <div class="dd">
            <ol class="dd-list">
                @foreach($menus as $key => $menu)
                @if($menu->is_parent == 0 && $menu->parent == 0)
                <!-- Szingli -->
                <li class="dd-item" data-menu_order="{{ $menu->id }}">
                    <div class="dd-handle{{ $menu->active == 0 ? ' menu_inactive' : '' }}{{ $menu->highlighted == 1 ? ' menu_highlighted' : '' }}">{{ $menu->name }}</div>
                </li>
                @elseif($menu->is_parent == 1 && $menu->parent == 0)
                <li class="dd-item" data-menu_order="{{ $menu->id }}">
                    <!-- Parent -->
                    <div class="dd-handle{{ $menu->active == 0 ? ' menu_inactive' : '' }}{{ $menu->highlighted == 1 ? ' menu_highlighted' : '' }}">{{ $menu->name }}</div>
                    <ol class="dd-list">
                @elseif($menu->parent != 0 && $menu->is_parent == 0)
                        <li class="dd-item" data-menu_order="{{ $menu->id }}">
                            <!-- Children -->
                            <div class="dd-handle{{ $menu->active == 0 ? ' menu_inactive' : '' }}{{ $menu->highlighted == 1 ? ' menu_highlighted' : '' }}">{{ $menu->name }}</div>
                        </li>

                    @if( isset($ids_order[$menu->menu_order+1]) )
                        @if( isset($menus[$ids_order[$menu->menu_order+1]-1]) )
                            @if( $menus[$ids_order[$menu->menu_order+1]-1]->parent == 0 )
                                    
                    </ol>
                </li>
                            @endif
                        @endif
                    @endif
                @endif
                @endforeach
            </ol>
        </div>
    </div>
</div>
<div class="row" id="menu_settings">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-6">
                <h2 class="admin_title" style="margin-bottom: 25px;">Menüelemek szerkesztése</h2>
                <select id="menu_items" class="form-control line_input">
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                @endforeach
                </select>

                <select id="menu_active" class="menu_live_change form-control line_input">
                    <option value="1"{{ $menus[0]->active == 1 ? ' selected' : '' }}>Aktív</option>
                    <option value="0"{{ $menus[0]->active == 0 ? ' selected' : '' }}>Inaktív</option>
                </select>

                <select id="menu_highlighted" class="menu_live_change form-control line_input">
                    <option value="1"{{ $menus[0]->highlighted == 1 ? ' selected' : '' }}>Kiemelve</option>
                    <option value="0"{{ $menus[0]->highlighted == 0 ? ' selected' : '' }}>Nincs kiemelve</option>
                </select>
            </div>
            {{-- <div class="col-md-3 col-sm-3">
                <input type="text" class="form-control" id="menu_seoname" value="{{ $menus_first->seoname }}">
            </div>
            <div class="col-md-3 col-sm-3">
                <select id="menu_page" class="form-control">
                @foreach($pages as $page)
                    <option value="{{ $page->id }}">Oldal: {{ $page->name }}</option>
                @endforeach
                </select>
            </div> --}}
            {{-- <div class="col-md-3 col-sm-3">
                <button type="button" id="menu_settings_save" class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i>Nem kell
                </button>
            </div> --}}
        </div>
    </div>
</div>

@endsection

@push('styles')
    <!-- Dinamikus stílus fájlok ide: -->
    <!-- Nestable -->
    <link rel="stylesheet" href="/adminset/css/jquery.nestable.min.css" />
    <!-- Custom CSS -->
    <link href="/adminset/css/custom/menus.css" rel="stylesheet" />
@endpush
@push('scripts')
    <!-- Dinamikus script fájlok ide: -->
    <!-- jQuery UI-->
    <script src="/adminset/js/jquery-ui.min.js"></script>
    <!-- Nestable -->
    <script src="/adminset/js/jquery.nestable.min.js"></script>
    <!-- Custom JS -->
    <script type="text/javascript" src="/adminset/js/custom/menus.js"></script>
@endpush