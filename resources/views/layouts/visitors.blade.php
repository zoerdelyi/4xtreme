<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
@stack('title')
@stack('metas')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="all">
    <meta name="author" content="4xtreme.hu">
    <!-- Alapértelmezett stílus fájlok -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/revolution-slider.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
@stack('styles')
    <link href="/css/custom.css?{{ time() }}" rel="stylesheet">
    <!--Favicon-->
    <link rel="shortcut icon" href="/images/favicon.png" type="image/x-icon">{!! $alnalytics !== '' ? "\n\t".$alnalytics : '' !!}
</head>
<body>
    <div class="page-wrapper">
        <!-- Preloader -->
        <div id="preloader" class="preloader"></div>
        <!-- Main Header-->
        <header class="main-header header-style-one">
            <!--Header-Upper-->
            <div class="header-upper">
                <div class="auto-container">
                    <div class="clearfix">
                        <div class="pull-left logo-outer">
                            <div class="logo">
                                <a href="/">
                                    <img src="/images/logo_final.png" style="text-align: left;" alt="{{ $page_name }}" title="{{ $page_name }}">
                                    <p class="logo_text" style="margin: 0;font-size: 14px;font-weight: bold;color: #111;text-align: center;font-family: OpenSansCustom;margin-top: 0px;margin-bottom: -4px;display:none;">Gumi és Autószerviz</p>
                                </a>
                            </div>
                        </div>
                        
                        <div class="pull-right upper-right clearfix hidden-xs hidden-sm">
                            
                            @foreach($block_header as $block)
                            {!! $block->content !!}
                            @endforeach
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--Header-Lower-->
            <div class="header-lower">
                <div class="auto-container">
                    <div class="nav-outer clearfix">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-header">
                                <!-- Toggle Button -->    	
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    @foreach($menus as $key => $menu)
                                    @if($menu->is_parent == 0 && $menu->parent == 0 && $menu->active == 1)
                                    @if($menu->seoname == 'idopontfoglalo')
                                    {{-- @auth --}}
                                    <li {!! Route::currentRouteName() == $menu->seoname ? 'class="current-menu-item"' : '' !!}>
                                        <a href="/{{ $menu->seoname }}"{!! ($menu->highlighted == 1) ? ' class="menu_highlighted"' : '' !!}>{{ $menu->name }}</a>
                                    </li>
                                    {{-- @endauth --}}
                                    @else
                                    <li {!! Route::currentRouteName() == $menu->seoname ? 'class="current-menu-item"' : '' !!}>
                                        <a href="/{{ $menu->seoname }}"{!! ($menu->highlighted == 1) ? ' class="menu_highlighted"' : '' !!}>{{ $menu->name }}</a>
                                    </li>
                                    @endif
                                    @elseif($menu->is_parent == 1 && $menu->parent == 0)
                                        <li class="dropdown">
                                            <a href="#" {!! strpos(Route::currentRouteName(), $menu->seoname) !== false ? 'class="custom-parent"' : '' !!}>{{ $menu->name }}</a>
                                        <ul>
                                    @elseif($menu->parent != 0 && $menu->is_parent == 0)
                                        @if($menu->active == 1)
                                        <li>
                                            <a href="/{{ $menu->seoname }}" {!! Route::currentRouteName() == $menu->seoname ? 'class="custom-children"' : '' !!}>{{ $menu->name }}</a>
                                        </li>
                                        @endif
                                        @if( isset($ids_order[$menu->menu_order+1]) )
                                            @if( isset($menus[$ids_order[$menu->menu_order+1]-1]) )
                                                @if( $menus[$ids_order[$menu->menu_order+1]-1]->parent == 0 )    
                                        </ul>
                                    </li>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </nav><!-- Main Menu End-->
                        
                        <!--Social Links-->
                        <div class="social-links">
                            @if($social_facebook->enabled == 1)
                            <a href="{{ $social_facebook->content }}" target="_blank"><span class="fa fa-facebook-f"></span></a>
                            @endif
                            @if($social_instagram->enabled == 1)
                            <a href="{{ $social_instagram->content }}" target="_blank"><span class="fa fa-instagram"></span></a>
                            @endif
                        </div>
                        
                    </div>
                </div>
            </div>
            <!--Sticky Header-->
            <div class="sticky-header">
                <div class="auto-container clearfix">
                    <!--Logo-->
                    <div class="logo pull-left">
                        <div class="logo"><a href="/"><img src="/images/logo_final.png" alt="{{ $page_name }}" title="{{ $page_name }}"></a></div>
                    </div>
                    <!--Right Col-->
                    <div class="right-col pull-right">
                        <!-- Main Menu -->
                        <nav class="main-menu">
                            <div class="navbar-header">
                                <!-- Toggle Button -->    	
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    @foreach($menus as $key => $menu)
                                    @if($menu->is_parent == 0 && $menu->parent == 0 && $menu->active == 1)
                                    <li {!! Route::currentRouteName() == $menu->seoname ? 'class="current-menu-item"' : '' !!}>
                                        <a href="/{{ $menu->seoname }}">{{ $menu->name }}</a>
                                    </li>
                                    @elseif($menu->is_parent == 1 && $menu->parent == 0)
                                    <li class="dropdown"><a href="#">{{ $menu->name }}</a>
                                        <ul>
                                    @elseif($menu->parent != 0 && $menu->is_parent == 0)
                                        @if($menu->active == 1)
                                        <li {!! Route::currentRouteName() == $menu->seoname ? 'class="current-menu-item"' : '' !!}>
                                            <a href="/{{ $menu->seoname }}">{{ $menu->name }}</a>
                                        </li>
                                        @endif
                                        @if( isset($ids_order[$menu->menu_order+1]) )
                                            @if( isset($menus[$ids_order[$menu->menu_order+1]-1]) )
                                                @if( $menus[$ids_order[$menu->menu_order+1]-1]->parent == 0 )    
                                        </ul>
                                    </li>
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </nav><!-- Main Menu End-->
                    </div>
                </div>
            </div><!--End Sticky Header-->
        </header>
        <!--End Main Header -->
    @yield('content')
        <!--Main Footer-->
        <footer class="main-footer" style="background-image:url(/images/background/animation-image-2.png);">
            <div class="auto-container">
                
                @foreach($block_footer as $block)
                {!! $block->content !!}
                @endforeach
                
                <!--Footer Bottom-->
                <div class="footer-bottom">
                <p style="display: inline-block;">4Xtreme Kft. | Autó és Gumiszerviz <span class="footer_separator">|</span></p>
                <p style="display: inline-block;">Biatorbágy &copy; {{ date('Y') }}</p>
                </div>
            
            </div> 
        </footer>
    </div>
    <!--End pagewrapper-->
    <!--Scroll to top-->
    <div class="scroll-to-top scroll-to-target" data-target=".main-header"><span class="icon fa fa-long-arrow-up"></span></div>
    <!-- Alapértelmezett script fájlok -->
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/revolution.min.js"></script>
    <script src="/js/jquery.fancybox.pack.js"></script>
    <script src="/js/jquery.fancybox-media.js"></script>
    <script src="/js/owl.js"></script>
    <script src="/js/wow.js"></script>
@stack('scripts')
    <script src="/js/script.js"></script>
</body>
</html>
