@extends('admin/layouts/admin') 
@section('content')

@push('title') 
<title>{{ $page->name }} szerkesztése - {{ $page_name }} Admin</title>
@endpush

<div id="admin_top">
    <h2 class="admin_title">{{ $page->name }} szerkesztése</h2>
    <div id="top_right">
        <a href="/admin/pages" role="button" class="btn btn-primary back_button">
            <i class="fas fa-arrow-circle-left"></i><span>Vissza</span>
        </a>
        <button type="button" id="order_save" class="btn btn-success">
            <i class="fas fa-save"></i>Elrendezés mentése
        </button>
    </div>
</div>
<input type="hidden" value="{{ $page->id }}" name="page_id" id="page_id">
<ul id="draggablePanelList" class="list-unstyled sortable">
    @foreach($blocks as $block)
    <li class="panel panel-info" data-id="{{ $block->id }}">
        <div class="panel-list-heading">
            <i class="fas fa-arrows-alt handle"></i>
            <p class="block_name">{{ $block->name }}</p>
            <div class="right_block">
                <span class="block_id">blokk id: {{ $block->id }}</span>
                <div class="dark-mode">
                    <i class="fas fa-moon"></i>
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" data-id="{{ $block->id }}" {{$block->dark_mode == 1 ? 'checked' : ''}}>
                        <span class="custom-control-indicator"></span>
                    </label>
                </div>
                <button type="button" class="btn btn-success update_block" data-id="{{ $block->id }}">
                    <i class="fas fa-save"></i><span>Mentés</span>
                </button>
                <div class="edit_block">
                    <i class="fas fa-edit"></i><span>Szerkesztés</span>
                </div>
                <div class="remove_block">
                    <i class="fas fa-trash-alt"></i><span>Eltávolítás</span>
                </div>
            </div>
        </div>
        <div 
        <div class="panel-list-body">
            <!-- Bootstrap Isolate - kompatibilitási fix -->
            <div class="bootstrap-iso">
                <textarea class="block_content summernote">{{ $block->content }}</textarea>
            </div>
            <button type="button" class="btn btn-success update_block" data-id="{{ $block->id }}">
                    <i class="fas fa-save"></i><span>Módosítások mentése</span>
            </button>
        </div>
    </li>
    @endforeach
</ul>

<button type="button" id="new_block_add" class="btn btn-primary">
    <i class="fas fa-plus-square"></i>Új blokk hozzáadása
</button>
<div id="new_block_hidden">
    <select id="new_block_hidden_select">
            @foreach ($blocks_all as $block)
                <option value="{{ $block->id }}">[ {{ $block->id }} ] - {{ $block->name }}</option>
            @endforeach
        </select>
    <button type="button" id="new_block_hidden_create" class="btn btn-success">
        Hozzáadás
    </button>
</div>
@endsection

@push('styles')
    <!-- Dinamikus stílus fájlok: -->
    <!-- Bootstrap Isolate - kompatibilitási fix -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap-iso.css">
    <!-- Codemirror -->
    <link rel="stylesheet" type="text/css" href="/adminset/css/codemirror.css">
    <link rel="stylesheet" type="text/css" href="/adminset/css/codemirror_monokai.css">
    <!-- Alap template CSS -->
    <link href="/css/style.css" type="text/css" rel="stylesheet" />
    <link href="/css/custom.css" type="text/css" rel="stylesheet">
    <!-- Summernote-->
    <link href="/adminset/css/summernote.css" type="text/css" rel="stylesheet">
    <link href="/adminset/css/custom/summernote_image.css" type="text/css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/adminset/css/custom/edit.css" type="text/css" rel="stylesheet" />
    <!-- Theme FIX CSS on edit mode -->
    <link href="/adminset/css/custom/edit_theme_fix.css" type="text/css" rel="stylesheet" />
    <!-- Additional JS to header - must place here -->
    <script type="text/javascript" src="/adminset/js/popper.min.js"></script>
@endpush
@push('scripts')
    <!-- Dinamikus script fájlok: -->
    <!-- jQuery Sortable -->
    <script type="text/javascript" src="/adminset/js/Sortable.min.js"></script>
    <!-- include codemirror -->
    <script type="text/javascript" src="/adminset/js/codemirror.js"></script>
    <script type="text/javascript" src="/adminset/js/codemirror_xml.js"></script>
    <!-- Summernote-->
    <script src="/adminset/js/custom/summernote_custom.js" type="text/javascript"></script>
    <script src="/adminset/js/custom/summernote-hu-HU.js" type="text/javascript"></script>
    <!-- Custom JS -->
    <script type="text/javascript" src="/adminset/js/custom/edit.js"></script>
    <!-- Theme FIX JS on edit mode -->
    <script type="text/javascript" src="/adminset/js/custom/edit_theme_fix.js"></script>
@endpush
