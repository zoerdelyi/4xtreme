@extends('admin/layouts/admin') 
@section('content')

@push('title') 
<title>Google Analytics követőkód - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <h2 class="admin_title">Google Analytics követőkód</h2>
</div>
<div class="row">
    <div class="col-md-12">
        <p class="plus_text">Illeszd be ide a Google Analytics követőkódot a látogatóid nyomonkövetéséhez.</p>
        <div class="row">
            <div class="col-md-6">
                <label>Google Analytics követőkód:</label><br>
                <textarea id="analytics_textarea" class="form-control" data-id="{{ $analytics_settings->id }}">{{ $analytics_settings->content }}</textarea>
            </div>
            <div class="col-md-4">
                <label for="analytics_on_off">Google Analytics engedélyezése:</label><br>
                <select id="analytics_on_off" class="form-control">
                    <option value="1"{{ $analytics_settings->enabled == 1 ? ' selected' : '' }}>Aktív</option>
                    <option value="0"{{ $analytics_settings->enabled == 0 ? ' selected' : '' }}>Inaktív</option>
                </select>
            </div>
            
        </div>
        
        <button type="button" id="settings_analtics_save" class="btn btn-primary">
                <i class="fas fa-cog"></i>Analytics beállítások frissítése
        </button>
    </div>
</div>

@endsection

@push('styles')
    <!-- Dinamikus stílus fájlok ide: -->
    <!-- Custom CSS -->
    <link href="/adminset/css/custom/settings.css" rel="stylesheet" />
@endpush
@push('scripts')
    <!-- Dinamikus script fájlok ide: -->
    <!-- Custom JS -->
    <script type="text/javascript" src="/adminset/js/custom/settings.js"></script>
@endpush