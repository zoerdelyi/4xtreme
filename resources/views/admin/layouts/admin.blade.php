<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width">
    @stack('title')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Robot 2. szintű védelem -->
    <meta name="robots" content="noindex">
    <link rel="icon" type="image/png" href="/adminset/img/favicon.ico">
    <!-- Alapértelmezett stílus fájlok -->
    <link href="/adminset/css/custom/light-bootstrap-dashboard.css" rel="stylesheet">
    <link href="/adminset/css/bootstrap.css" rel="stylesheet">
    <link href="/adminset/css/pe-icon-7-stroke.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/adminset/css/font-awesome-all.css" rel="stylesheet">
    <link href="/adminset/css/custom/admin_new.css?{{ time() }}" rel="stylesheet">
    <link href="/adminset/css/fonts.css" rel="stylesheet">
    <link href="/css/colors.css" rel="stylesheet">
    <link href="/css/loader.css" rel="stylesheet">
    <link href="/adminset/css/custom/global.css" rel="stylesheet" />
@stack('styles')
</head>
<body>
    <div id="preloader" class="preloader"></div>
    <div class="wrapper">
    {{-- <div class="sidebar{{ Route::currentRouteName() == 'admin/booking/calendar' || Route::currentRouteName() == 'admin/booking' ? ' show_hide_menu_sidebar' : '' }}" data-color="purple" data-image=""> --}}
    <div class="sidebar" data-color="purple" data-image="">
            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="/admin" class="simple-text">{{ $page_name }} Admin</a>
                </div>
                <ul class="nav">@if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_PAGES_MENU))
                    <li class="nav-item{{ Route::currentRouteName() == 'admin/pages' ? ' active' : '' }}">
                        <a class="nav-link" href="/admin/pages">
                            <i class="fas fa-file"></i>
                            <p>Oldalak kezelése</p>
                        </a>
                    </li>
                    @endif
@if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_CALENDAR_MENU) ||
\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_DAILY_LIST_MENU) ||
\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_LIST_MENU) ||
\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_SERVICES_MENU) ||
\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_SETTINGS_MENU)
)
                        <li class="nav-item{{ (Route::currentRouteName() == 'admin/booking' || Route::currentRouteName() == 'admin/booking/calendar' || Route::currentRouteName() == 'admin/bookingtoday' || Route::currentRouteName() == 'admin/booking/services' || Route::currentRouteName() == 'admin/booking/settings') ? ' active' : '' }}">
                            <a class="nav-link parent-link" href="javascript:" style="cursor: default">
                                <i class="fas fa-calendar-alt"></i>
                                <p>Időpontfoglaló</p>
                            </a>
                        </li>
@endif
                        {{-- @if(str_contains(Route::currentRouteName(), 'admin/booking')) --}}
                        <ul style="list-style: none;">
                            @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_CALENDAR_MENU))
                            <li class="nav-item{{ Route::currentRouteName() == 'admin/booking/calendar' ? ' active' : '' }}">
                                <a class="nav-link" href="/admin/booking/calendar">
                                    <i class="fas fa-calendar-alt"></i>
                                    <p>Naptár</p>
                                </a>
                            </li>
                            @endif
                            @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_DAILY_LIST_MENU))
                            <li class="nav-item{{ Route::currentRouteName() == 'admin/bookingtoday' ? ' active' : '' }}">
                                <a class="nav-link" href="/admin/bookingtoday">
                                    <i class="fas fa-list"></i>
                                    <p>Napi foglalások</p>
                                </a>
                            </li>
                            @endif
                            @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_LIST_MENU))
                            <li class="nav-item{{ Route::currentRouteName() == 'admin/booking' ? ' active' : '' }}">
                                <a class="nav-link" href="/admin/booking">
                                    <i class="fas fa-list"></i>
                                    <p>Összegzés</p>
                                </a>
                            </li>
                            @endif
                            @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_SERVICES_MENU))
                            <li class="nav-item{{ Route::currentRouteName() == 'admin/booking/services' ? ' active' : '' }}">
                                <a class="nav-link" href="/admin/booking/services">
                                    <i class="fas fa-concierge-bell"></i>
                                    <p>Szolgáltatások</p>
                                </a>
                            </li>
                            @endif
                            @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_BOOKING_SETTINGS_MENU))
                            <li class="nav-item{{ Route::currentRouteName() == 'admin/booking/settings' ? ' active' : '' }}">
                                <a class="nav-link" href="/admin/booking/settings">
                                    <i class="fas fa-sliders-h"></i>
                                    <p>Funkciók</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                        @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_MENUS_MENU))
                    <li class="nav-item{{ Route::currentRouteName() == 'admin/gallery' ? ' active' : '' }}">
                        <a class="nav-link" href="/admin/gallery">
                            <i class="fas fa-image"></i>
                            <p>Képgaléria</p>
                        </a>
                    </li>
                    @endif
                    @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_SETTINGS_MENU))
                    <li class="nav-item{{ (Route::currentRouteName() == 'admin/menu' || Route::currentRouteName() == 'admin/users' || Route::currentRouteName() == 'admin/permissions' || Route::currentRouteName() == 'admin/analytics' || Route::currentRouteName() == 'admin/social') ? ' active' : '' }}">
                        <a class="nav-link parent-link" href="javascript:" style="cursor: default">
                            <i class="fas fa-cog"></i>
                            <p>Beállítások</p>
                        </a>
                    </li>
                    @endif
                    <ul style="list-style: none;">
                    @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_MENUS_MENU))
                    <li class="nav-item{{ Route::currentRouteName() == 'admin/menu' ? ' active' : '' }}">
                        <a class="nav-link" href="/admin/menu">
                            <i class="fas fa-bars"></i>
                            <p>Menüelemek</p>
                        </a>
                    </li>
                    @endif
                    @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_USERS_MENU))
                    <li class="nav-item{{ Route::currentRouteName() == 'admin/users' ? ' active' : '' }}">
                        <a class="nav-link" href="/admin/users">
                            <i class="fas fa-users"></i>
                            <p>Felhasználók</p>
                        </a>
                    </li>
                    @endif
                    @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_PERMISSIONS_MENU))
                    <li class="nav-item{{ Route::currentRouteName() == 'admin/permissions' ? ' active' : '' }}">
                        <a class="nav-link" href="/admin/permissions">
                            <i class="fas fa-unlock"></i>
                            <p>Jogosultságok</p>
                        </a>
                    </li>
                    @endif
                    @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_PERMISSIONS_MENU))
                    <li class="nav-item{{ Route::currentRouteName() == 'admin/analytics' ? ' active' : '' }}">
                        <a class="nav-link" href="/admin/analytics">
                            <i class="fas fa-chart-pie"></i>
                            <p>Google Analytics</p>
                        </a>
                    </li>
                    @endif
                    @if (\App\Http\Controllers\Admin\PermissionsAdminController::hasPermission(\App\Enums\PermissionsEnum::ENABLE_ADMIN_PERMISSIONS_MENU))
                    <li class="nav-item{{ Route::currentRouteName() == 'admin/social' ? ' active' : '' }}">
                        <a class="nav-link" href="/admin/social">
                            <i class="fas fa-thumbs-up"></i>
                            <p>Közösségi ikonok</p>
                        </a>
                    </li>
                    @endif
                        {{-- @endif --}}
                   
                    
                </ul>
            </div>
        </div>

        {{-- <div class="main-panel{{ Route::currentRouteName() == 'admin/booking/calendar' || Route::currentRouteName() == 'admin/booking' ? ' show_hide_menu_main-panel' : '' }}"> --}}
        <div class="main-panel">
            <nav id="navbar" class="navbar navbar-default navbar-expand-lg">
                <div class="container-fluid">
                    <button class="btn btn-sm align-middle btn-primary ml-auto mr-3 order-lg-last" style="visibility: hidden;float: left;height: 0px;padding: 0;margin: 0;    width: 3px !important;" type="button">Always visible here!</button>
                    <button href="" id="navbar_mobile_toggler" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="nav navbar-nav mr-auto">
                            <li class="nav-item d-none d-lg-block">
                                <a class="nav-link" href="javascript:" id="desktop_menu_toggle">
                                    <span class="no-icon"><i class="fas fa-bars" style="font-size: 16px;line-height: 19.2px;"></i> Menü</span>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="/admin">
                                    <span class="no-icon">Admin főoldal</span>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link" href="/" target="_blank">
                                    <span class="no-icon">Váltás éles weboldalra</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/users">
                                    <span class="no-icon">Bejelentkezve: {{ Auth::user()->name }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Kijelentkezés</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
@yield('content')
                        </div>
                    </div>
                </div>
            </div>


            <!-- Footer -->
<footer class="page-footer font-small blue">

    <!-- Screen detector -->
    <div id="device-size-detector">
        <div id="xs" data-route="{{ Route::currentRouteName() }}" class="d-block d-sm-none"></div>
        <div id="sm" data-route="{{ Route::currentRouteName() }}" class="d-none d-sm-block d-md-none"></div>
        <div id="md" data-route="{{ Route::currentRouteName() }}" class="d-none d-md-block d-lg-none"></div>
        <div id="lg" data-route="{{ Route::currentRouteName() }}" class="d-none d-lg-block d-xl-none"></div>
        <div id="xl" data-route="{{ Route::currentRouteName() }}" class="d-none d-xl-block"></div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
            <p class="copyright">{{ $page_name }} | Admin felület | &copy; {{ date('Y') }}</p>
    </div>
    <!-- Copyright -->

  </footer>
  <!-- Footer -->

        </div>
    </div>
    <!-- Alapértelmezett script fájlok -->
    <script type="text/javascript" src="/adminset/js/jquery.min.js"></script>
    <script type="text/javascript" src="/adminset/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/adminset/js/custom/light-bootstrap-dashboard.js"></script>
    <script type="text/javascript" src="/adminset/js/bootstrap-notify.js"></script>
    <script type="text/javascript" src="/adminset/js/custom/admin_new.js?{{ time() }}"></script>
@stack('scripts')
</body>
</html>