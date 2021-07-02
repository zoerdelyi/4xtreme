@extends('admin/layouts/admin') 
@section('content')

@push('title') 
<title>Közösségi ikon beállítások - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <h2 class="admin_title">Közösségi ikon beállítások</h2>
</div>
<div class="row" id="social_settings">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <p class="social_name">Facebook:</p>
                </div>
                <div class="col-md-2 col-sm-2">
                    <select id="social_fb_on" class="form-control line_input">
                        <option value="1"{{ $social_facebook->enabled == 1 ? ' selected' : '' }}>Aktív</option>
                        <option value="0"{{ $social_facebook->enabled == 0 ? ' selected' : '' }}>Inaktív</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                    <input type="text" id="social_fb_url" class="form-control line_input" value="{{ $social_facebook->content }}" placeholder="Facebook közösség URL">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-sm-2">
                    <p class="social_name">Instagram:</p>
                </div>
                <div class="col-md-2 col-sm-2">
                    <select id="social_ig_on" class="form-control line_input">
                        <option value="1"{{ $social_instagram->enabled == 1 ? ' selected' : '' }}>Aktív</option>
                        <option value="0"{{ $social_instagram->enabled == 0 ? ' selected' : '' }}>Inaktív</option>
                    </select>
                </div>
                <div class="col-md-6 col-sm-6">
                <input type="text" id="social_ig_url" class="form-control line_input" value="{{ $social_instagram->content }}" placeholder="Instagram közösség URL">
                </div>
            </div>
            <div class="row">
                <div class="col-md-44 col-sm-4">
                    <button type="button" id="social_settings_save" class="btn btn-primary">
                        <i class="fas fa-sync-alt"></i>Közösségi beállítások frissítése
                    </button>
                </div>
            </div>
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