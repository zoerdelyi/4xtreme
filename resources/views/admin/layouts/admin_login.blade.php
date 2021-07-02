<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="/adminset/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin - 4Xtreme</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Alapértelmezett stílus fájlok -->
    <link href="/adminset/css/light-bootstrap-dashboard.css" rel="stylesheet" />
    <link href="/adminset/css/bootstrap.css" rel="stylesheet">
    <link href="/adminset/css/pe-icon-7-stroke.css" rel="stylesheet" />
    <link href="/adminset/css/custom/admin_new.css" rel="stylesheet" />
@stack('styles')
</head>
<body class="text-center">
@yield('content')
    <!-- Alapértelmezett script fájlok -->
    <script type="text/javascript" src="/adminset/js/jquery.min.js"></script>
    <script type="text/javascript" src="/adminset/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/adminset/js/custom/admin_new.js"></script>
@stack('scripts')
</body>
</html>