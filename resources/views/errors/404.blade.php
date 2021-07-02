@extends('layouts/visitors')
@section('content')
    <!--Page Title-->
    <section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
    	<div class="auto-container">
        	<div class="row clearfix">
            	<!--Title -->
            	<div class="title-column col-md-6 col-sm-12 col-xs-12">
                	<h1>404 Error</h1>
                </div>
                <!--Bread Crumb -->
                <div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">404</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    
    <!--Error Section-->
    <section class="error-section">
    	<div class="auto-container">
			
            <figure class="error-image wow tada" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/error-image.png" alt=""></figure>
            
            <h3><span class="theme_color">Whoop’s!</span><br>What you’re looking for isn’t here.</h3>
            <div class="btn-box"><a href="index.html" class="theme-btn btn-style-two">Back to home &ensp; <span class="fa fa-long-arrow-right"></span></a></div>

        </div>
    </section>
@endsection
