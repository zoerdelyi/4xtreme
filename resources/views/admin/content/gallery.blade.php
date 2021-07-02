@extends('admin/layouts/admin') 
@section('content')

@push('title') 
<title>Képgaléria - {{ $page_name }} Admin</title>
@endpush

<div class="row">
    <div id="gallery_holder" class="col-lg-12">
        
    </div>
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
    <link href="/adminset/css/custom/gallery.css" rel="stylesheet" />
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
    <script type="text/javascript" src="/adminset/js/custom/gallery.js"></script>
    <!-- Theme FIX JS on edit mode -->
    <script type="text/javascript" src="/adminset/js/custom/edit_theme_fix.js"></script>
@endpush