<?php

use Illuminate\Database\Seeder;

class _ExportBlocksTemplatesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blocks_templates')->delete();
        
        \DB::table('blocks_templates')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Main Slider / Style One',
                'content' => '<section class="main-slider style-one">

<div class="tp-banner-container">
<div class="tp-banner">
<ul>

<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="/images/main-slider/1.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
<img src="/images/main-slider/1.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="-100"
data-speed="1500"
data-start="0"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="big-title"><strong>QUALITY</strong> <br>CAR MAINTENANCE</div></div>

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="10"
data-speed="1500"
data-start="500"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="text">Skate ipsum dolor sit amet, tuna-flip coping hurricane Brian <br>Brannon skate key skate or die bigspin risers.</div></div>

<div class="tp-caption sfr sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="100"
data-speed="1500"
data-start="1000"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><a href="#" class="theme-btn btn-style-two">contact Now</a></div>

</li>

<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="/images/main-slider/2.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
<img src="/images/main-slider/2.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="-100"
data-speed="1500"
data-start="0"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="big-title"><strong>EXPERIENCED</strong> <br>MECHANIC ENGINEERS</div></div>

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="10"
data-speed="1500"
data-start="500"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="text">Skate ipsum dolor sit amet, tuna-flip coping hurricane Brian <br>Brannon skate key skate or die bigspin risers.</div></div>

<div class="tp-caption sfr sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="100"
data-speed="1500"
data-start="1000"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><a href="#" class="theme-btn btn-style-two">contact Now</a></div>

</li>

<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="/images/main-slider/3.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
<img src="/images/main-slider/3.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="-100"
data-speed="1500"
data-start="0"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="big-title">WE <strong>CARE</strong> <br>ABOUT YOUR CAR</div></div>

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="10"
data-speed="1500"
data-start="500"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="text">Skate ipsum dolor sit amet, tuna-flip coping hurricane Brian <br>Brannon skate key skate or die bigspin risers.</div></div>

<div class="tp-caption sfr sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="100"
data-speed="1500"
data-start="1000"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><a href="#" class="theme-btn btn-style-two">contact Now</a></div>

</li>

</ul>

<div class="tp-bannertimer"></div>
</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Why Choose Us',
                'content' => '<section class="why-choose-us">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>WHY CHOOSE US</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>


<div class="row clearfix">
<div class="col-lg-8 col-md-12 col-xs-12">
<div class="row clearfix">
<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-front-of-bus"></span></div>
<div class="count">01</div>
<h3>Modern Workshop</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-technician-with-helmet"></span></div>
<div class="count">02</div>
<h3>Talented Workers</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-money-1"></span></div>
<div class="count">03</div>
<h3>Best Price</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-24-hours-support"></span></div>
<div class="count">04</div>
<h3>Quick Support</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

</div>
</div>

<div class="image-column col-lg-4 col-md-12 col-xs-12">
<figure class="isolated-image wow bounceInUp" data-wow-delay="0ms" data-wow-duration="1500ms"><img class="img-responsive" src="/images/resource/featured-image-1.jpg" alt=""></figure>
</div>

</div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Fact Counter',
            'content' => '<section class="fact-counter" style="background-image:url(/images/background/image-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<div class="counter-outer clearfix">
<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1000" data-stop="784">0</span></div>
<div class="separator"></div>
<h4 class="counter-title">VEHICLES SERVICED</h4>
</article>

<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1500" data-stop="1628">0</span></div>
<div class="separator"></div>
<h4 class="counter-title">HAPPY CUSTOMERS</h4>
</article>

<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1500" data-stop="2415">0</span></div>
<div class="separator"></div>
<h4 class="counter-title">REVIEWS DONE</h4>
</article>

<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1500" data-stop="1982">0</span></div>
<div class="separator"></div>
<h4 class="counter-title">PROBLEMS SOLVED</h4>
</article>

</div>
</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Services Style One',
                'content' => '<section class="services-one">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>OUR SERVICES</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<div class="tabs-outer">
<div class="circular-layer"></div>

<!--Tabs Box / Service Tabs-->
<div class="tabs-box service-tabs">

<!--Tab Buttons-->
<ul class="tab-buttons">
<li data-tab="#tab-one" class="tab-btn active-btn wow zoomInStable" data-wow-delay="0ms" data-wow-duration="1500ms" title="Engine Overhaul"><div class="icon-box"><span class="flaticon-motor"></span></div></li>
<li data-tab="#tab-two" class="tab-btn wow zoomInStable" data-wow-delay="100ms" data-wow-duration="1500ms" title="Power Steering"><div class="icon-box"><span class="flaticon-steering-wheel"></span></div></li>
<li data-tab="#tab-three" class="tab-btn wow zoomInStable" data-wow-delay="200ms" data-wow-duration="1500ms" title="Oil Change"><div class="icon-box"><span class="flaticon-oil-2"></span></div></li>
<li data-tab="#tab-four" class="tab-btn wow zoomInStable" data-wow-delay="300ms" data-wow-duration="1500ms" title="Smog Check"><div class="icon-box"><span class="flaticon-smoking-sign"></span></div></li>
<li data-tab="#tab-five" class="tab-btn wow zoomInStable" data-wow-delay="400ms" data-wow-duration="1500ms" title="Tyre Blancing"><div class="icon-box"><span class="flaticon-vehicle-wheel"></span></div></li>
<li data-tab="#tab-six" class="tab-btn wow zoomInStable" data-wow-delay="500ms" data-wow-duration="1500ms" title="Fleet Service"><div class="icon-box"><span class="flaticon-pipe-valve"></span></div></li>
</ul>

<!--Tabs Content-->
<div class="tabs-content">

<!--Tab / Active Tab-->
<div class="tab active-tab" id="tab-one">
<div class="content-box">
<div class="icon-box"><span class="flaticon-motor"></span></div>
<h3>Engine Overhaul</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

<!--Tab-->
<div class="tab" id="tab-two">
<div class="content-box">
<div class="icon-box"><span class="flaticon-steering-wheel"></span></div>
<h3>Power Steering</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

<!--Tab-->
<div class="tab" id="tab-three">
<div class="content-box">
<div class="icon-box"><span class="flaticon-oil-2"></span></div>
<h3>Oil Change</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

<!--Tab-->
<div class="tab" id="tab-four">
<div class="content-box">
<div class="icon-box"><span class="flaticon-smoking-sign"></span></div>
<h3>Smog Check</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

<!--Tab-->
<div class="tab" id="tab-five">
<div class="content-box">
<div class="icon-box"><span class="flaticon-vehicle-wheel"></span></div>
<h3>Tyre Balancing</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

<!--Tab-->
<div class="tab" id="tab-six">
<div class="content-box">
<div class="icon-box"><span class="flaticon-pipe-valve"></span></div>
<h3>Fleet Service</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

</div>

</div><!--End Tabs Box-->

</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Gallery Section one',
            'content' => '<section class="gallery-section-one" style="background-image:url(/images/background/image-2.jpg);">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>WORK GALLERY</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<!--Gallery Carousel-->
<div class="gallery-carousel">
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/1.jpg" alt=""></figure>
<a href="/images/gallery/1.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/2.jpg" alt=""></figure>
<a href="/images/gallery/2.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/3.jpg" alt=""></figure>
<a href="/images/gallery/3.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/4.jpg" alt=""></figure>
<a href="/images/gallery/4.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/1.jpg" alt=""></figure>
<a href="/images/gallery/1.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/2.jpg" alt=""></figure>
<a href="/images/gallery/2.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/3.jpg" alt=""></figure>
<a href="/images/gallery/3.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/4.jpg" alt=""></figure>
<a href="/images/gallery/4.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Team Style one',
                'content' => '<section class="team-style-one">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>MEET OUR SPECIALIST</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<!--Team Carousel-->
<div class="team-carousel">
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-1.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Jack Wilshere</h4>
<div class="designation">Founder</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-2.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Benson Paul</h4>
<div class="designation">Senior Mechanic</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-3.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Jane Wilkings</h4>
<div class="designation">Mechanic</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-4.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Bentick Lenney</h4>
<div class="designation">Car Painter</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-1.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Jack Wilshere</h4>
<div class="designation">Founder</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-2.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Benson Paul</h4>
<div class="designation">Senior Mechanic</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-3.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Jane Wilkings</h4>
<div class="designation">Mechanic</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<!--Member Style One-->
<div class="member-style-one">
<div class="inner-box">
<figure class="image-box"><a href="mailto:mail@mail.com"><img src="/images/resource/team-image-4.jpg" alt=""></a></figure>
<div class="lower-content">
<div class="info">
<h4>Bentick Lenney</h4>
<div class="designation">Car Painter</div>
</div>
<div class="social-links">
<a href="#"><span class="fa fa-facebook-f"></span></a>
<a href="#"><span class="fa fa-twitter"></span></a>
<a href="#"><span class="fa fa-google-plus"></span></a>
<a href="#"><span class="fa fa-rss"></span></a>
</div>
</div>
</div>
</div>
</div>

</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Testimonial Section one',
            'content' => '<section class="testimonial-section-one" style="background-image:url(/images/background/animation-image-1.png);">

<!--Floated Right Image-->
<figure class="right-floated-image wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/resource/featured-image-2.png" alt=""></figure>

<div class="auto-container">
<div class="inner-container">

<!--Centered Title-->
<div class="centered-title">
<h2>WORDS FROM OUR CUSTOMER</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<div class="carousel-outer">

<!--Slider Content-->
<ul class="testimonial-slider-content">
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
</ul>

<div class="styled-dots"></div>

<div class="pagers-outer">
<!--Slider Pager-->
<ul class="testimonial-slider-pager">
<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-1.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>
<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-2.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-3.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-1.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-2.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-3.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>
</ul>
</div>

</div>

</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'News Section',
                'content' => '<section class="news-section">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>LATEST FROM OUR BLOG</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<div class="row clearfix">
<!--News Item-->
<div class="news-item col-lg-6 col-md-6 col-sm-12 col-xs-12">
<div class="inner-box">
<figure class="image-box"><a href="blog-single.html"><img src="/images/resource/blog-image-1.jpg" alt=""></a><div class="date"><span class="day">18</span>Jul</div></figure>
</div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
<!--News Item-->
<div class="news-item">
<div class="inner-box">
<div class="row clearfix">

<div class="image-column col-lg-5 col-md-5 col-sm-5 col-xs-12">
<figure class="image-box"><a href="blog-single.html"><img src="/images/resource/blog-image-2.jpg" alt=""></a><div class="date"><span class="day">18</span>Jul</div></figure>
</div>
<div class="content-column col-lg-7 col-md-7 col-sm-7 col-xs-12">
<div class="content-box">
<h3><a href="blog-single.html">Got a dream and we just know</a></h3>
<div class="text">Spare ribs porchetta tenderloin, landjaeger pork jerky turducken rump pork chop filet mignon ball tip cow. </div>
<ul class="post-info clearfix">
<li><a href="#"><span class="icon flaticon-folder"></span> Car Service</a></li>
<li><a href="#"><span class="icon flaticon-shapes-1"></span> Comments</a></li>
</ul>
</div>
</div>

</div>
</div>
</div>

<!--News Item-->
<div class="news-item">
<div class="inner-box">
<div class="row clearfix">

<div class="image-column col-lg-5 col-md-5 col-sm-5 col-xs-12">
<figure class="image-box"><a href="blog-single.html"><img src="/images/resource/blog-image-3.jpg" alt=""></a><div class="date"><span class="day">18</span>Jul</div></figure>
</div>
<div class="content-column col-lg-7 col-md-7 col-sm-7 col-xs-12">
<div class="content-box">
<h3><a href="blog-single.html">Time To Change Your Winter Tyres</a></h3>
<div class="text">Spare ribs porchetta tenderloin, landjaeger pork jerky turducken rump pork chop filet mignon ball tip cow. </div>
<ul class="post-info clearfix">
<li><a href="#"><span class="icon flaticon-folder"></span> Car Service</a></li>
<li><a href="#"><span class="icon flaticon-shapes-1"></span> Comments</a></li>
</ul>
</div>
</div>

</div>
</div>
</div>

</div>

</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Why Choose Us / Style Two',
                'content' => '<section class="why-choose-us style-two">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>WHY CHOOSE US</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>


<div class="row clearfix">
<!--Why Us Column-->
<div class="why-us-column col-lg-3 col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-front-of-bus"></span></div>
<div class="count">01</div>
<h3>Modern Workshop</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-lg-3 col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-technician-with-helmet"></span></div>
<div class="count">02</div>
<h3>Talented Workers</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-lg-3 col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-money-1"></span></div>
<div class="count">03</div>
<h3>Best Price</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-lg-3 col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-24-hours-support"></span></div>
<div class="count">04</div>
<h3>Quick Support</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

</div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Services Style Two',
                'content' => '<section class="services-two">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>OUR SERVICES</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<div class="outer-box">
<div class="vertical-bar"></div>

<!--Main Image Box-->
<div class="main-image-box">
<figure class="image wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/resource/featured-image-3.jpg" alt=""></figure>
</div>

<div class="clearfix">
<!--Left Column-->
<div class="left-column">
<!--Service Block-->
<div class="service-block">
<div class="inner-box">
<div class="dots"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
<div class="icon-box"><span class="flaticon-steering-wheel"></span></div>
<h3>Power Steering</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block">
<div class="inner-box">
<div class="dots"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
<div class="icon-box"><span class="flaticon-smoking-sign"></span></div>
<h3>Smog Check</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block">
<div class="inner-box">
<div class="dots"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
<div class="icon-box"><span class="flaticon-pipe-valve"></span></div>
<h3>Fleet Service</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

</div>

<!--Right Column-->
<div class="right-column">
<!--Service Block-->
<div class="service-block">
<div class="inner-box">
<div class="dots"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
<div class="icon-box"><span class="flaticon-motor"></span></div>
<h3>Engine Overhaul</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block">
<div class="inner-box">
<div class="dots"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
<div class="icon-box"><span class="flaticon-oil-2"></span></div>
<h3>Oil Change</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block">
<div class="inner-box">
<div class="dots"><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
<div class="icon-box"><span class="flaticon-vehicle-wheel"></span></div>
<h3>Tyre Balancing</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

</div>

</div>

</div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Shop Section',
                'content' => '<section class="shop-section">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>SHOPPING AREA</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<div class="row clearfix">
<!--Shop Item-->
<div class="default-shop-item col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/resource/products/1.jpg" alt=""><div class="overlay-box"><a href="shop-single.html" class="theme-btn"><span class="fa fa-shopping-cart"></span> ADD TO CART</a></div></figure>
<div class="lower-content">
<h3><a href="shop-single.html">Shock Absorber</a></h3>
<div class="price">$ 845.00</div>
<div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span></div>
</div>
</div>
</div>

<!--Shop Item-->
<div class="default-shop-item col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/resource/products/2.jpg" alt=""><div class="overlay-box"><a href="shop-single.html" class="theme-btn"><span class="fa fa-shopping-cart"></span> ADD TO CART</a></div></figure>
<div class="lower-content">
<h3><a href="shop-single.html">Gear Box</a></h3>
<div class="price">$ 625.00</div>
<div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span></div>
</div>
</div>
</div>

<!--Shop Item-->
<div class="default-shop-item col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/resource/products/3.jpg" alt=""><div class="overlay-box"><a href="shop-single.html" class="theme-btn"><span class="fa fa-shopping-cart"></span> ADD TO CART</a></div></figure>
<div class="lower-content">
<h3><a href="shop-single.html">Exhaust Engine</a></h3>
<div class="price">$ 1015.00</div>
<div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span></div>
</div>
</div>
</div>

<!--Shop Item-->
<div class="default-shop-item col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/resource/products/4.jpg" alt=""><div class="overlay-box"><a href="shop-single.html" class="theme-btn"><span class="fa fa-shopping-cart"></span> ADD TO CART</a></div></figure>
<div class="lower-content">
<h3><a href="shop-single.html">Alloy Wheel</a></h3>
<div class="price">$ 442.00</div>
<div class="rating"><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star-o"></span></div>
</div>
</div>
</div>

</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Testimonial Section one / Dark Version',
            'content' => '<section class="testimonial-section-one dark-version" style="background-image:url(/images/background/image-3.jpg);">

<!--Floated Right Image-->
<figure class="right-floated-image"><img src="/images/resource/featured-image-2.png" alt=""></figure>

<div class="auto-container">
<div class="inner-container">

<!--Centered Title-->
<div class="centered-title">
<h2>WORDS FROM OUR CUSTOMER</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<div class="carousel-outer">

<!--Slider Content-->
<ul class="testimonial-slider-content">
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
<!--Slide Item-->
<li class="slide-item"><div class="text">Our professionals know how to handle a wide range of car services. Whether you drive a passenger car or medium sized truck or SUV</div></li>
</ul>

<div class="styled-dots"></div>

<div class="pagers-outer">
<!--Slider Pager-->
<ul class="testimonial-slider-pager">
<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-1.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>
<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-2.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-3.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-1.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-2.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>

<!--Pager Item-->
<li class="pager-item">
<div class="inner-box">
<figure class="author-thumb"><img src="/images/resource/testi-image-3.jpg" alt=""></figure>
<div class="title">Dolph Ziggler</div>
<div class="location">Sydney, Australia</div>
</div>
</li>
</ul>
</div>

</div>

</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Main Slider / Style Two',
                'content' => '<section class="main-slider style-two">

<div class="tp-banner-container">
<div class="tp-banner">
<ul>

<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="/images/main-slider/3.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
<img src="/images/main-slider/3.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="-20"
data-speed="1500"
data-start="0"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="big-title">WE <strong>CARE</strong> <br>ABOUT YOUR CAR</div></div>

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="90"
data-speed="1500"
data-start="500"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="text">Skate ipsum dolor sit amet, tuna-flip coping hurricane Brian <br>Brannon skate key skate or die bigspin risers.</div></div>

<div class="tp-caption sfr sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="180"
data-speed="1500"
data-start="1000"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><a href="#" class="theme-btn btn-style-two">contact Now</a></div>

</li>


<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="/images/main-slider/2.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
<img src="/images/main-slider/2.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="-20"
data-speed="1500"
data-start="0"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="big-title"><strong>EXPERIENCED</strong> <br>MECHANIC ENGINEERS</div></div>

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="90"
data-speed="1500"
data-start="500"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="text">Skate ipsum dolor sit amet, tuna-flip coping hurricane Brian <br>Brannon skate key skate or die bigspin risers.</div></div>

<div class="tp-caption sfr sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="180"
data-speed="1500"
data-start="1000"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><a href="#" class="theme-btn btn-style-two">contact Now</a></div>

</li>

<li data-transition="fade" data-slotamount="1" data-masterspeed="1000" data-thumb="/images/main-slider/1.jpg"  data-saveperformance="off"  data-title="Awesome Title Here">
<img src="/images/main-slider/1.jpg"  alt=""  data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="-20"
data-speed="1500"
data-start="0"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="big-title"><strong>QUALITY</strong> <br>CAR MAINTENANCE</div></div>

<div class="tp-caption sfl sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="90"
data-speed="1500"
data-start="500"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><div class="text">Skate ipsum dolor sit amet, tuna-flip coping hurricane Brian <br>Brannon skate key skate or die bigspin risers.</div></div>

<div class="tp-caption sfr sfb tp-resizeme"
data-x="left" data-hoffset="15"
data-y="center" data-voffset="180"
data-speed="1500"
data-start="1000"
data-easing="easeOutExpo"
data-splitin="none"
data-splitout="none"
data-elementdelay="0.01"
data-endelementdelay="0.3"
data-endspeed="1200"
data-endeasing="Power4.easeIn"><a href="#" class="theme-btn btn-style-two">contact Now</a></div>

</li>

</ul>

<div class="tp-bannertimer"></div>
</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Why Choose Us / Style Three',
                'content' => '<section class="why-choose-us style-three">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>WHY CHOOSE US</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>


<div class="row clearfix">
<div class="col-lg-8 col-md-12 col-xs-12">
<div class="row clearfix">
<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-front-of-bus"></span></div>
<h3>Modern Workshop</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-technician-with-helmet"></span></div>
<h3>Talented Workers</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-money-1"></span></div>
<h3>Best Price</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-24-hours-support"></span></div>
<h3>Quick Support</h3>
<div class="text">Turkey biltong filet mignon cupim meatball chicken andouille short loin pork loin pork chop shank kielbasa tri-tip.</div>
</div>
</div>

</div>
</div>

<div class="image-column col-lg-4 col-md-12 col-xs-12">
<figure class="isolated-image wow bounceInUp" data-wow-delay="0ms" data-wow-duration="1500ms"><img class="img-responsive" src="/images/resource/featured-image-4.jpg" alt=""></figure>
</div>

</div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Services Style Three',
                'content' => '<section class="services-three">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>OUR SERVICES</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>

<div class="row clearfix">

<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-motor"></span></div>
<h3>Engine Overhaul</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-steering-wheel"></span></div>
<h3>Power Steering</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-oil-2"></span></div>
<h3>Oil Change</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-smoking-sign"></span></div>
<h3>Smog Check</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-vehicle-wheel"></span></div>
<h3>Tyre Balancing</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-pipe-valve"></span></div>
<h3>Fleet Service</h3>
<div class="text">Bacon andouille shank meatloaf leberkas bresaola jerky pork loin t-bone landjaeger strip steak.</div>
</div>
</div>

</div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Gallery Section one',
                'content' => '<section class="gallery-section-one light-version">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>WORK GALLERY</h2>
<div class="desc-text">Primo slide feeble ollie north Steve Chumney helipop disaster powerslide. Cab flip full-cab method air durometer downhill masonite. Tail slob air poseur death box bearings wall ride.</div>
</div>
</div>

<!--Gallery Carousel-->
<div class="gallery-carousel">
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/5.jpg" alt=""></figure>
<a href="/images/gallery/5.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/6.jpg" alt=""></figure>
<a href="/images/gallery/6.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/7.jpg" alt=""></figure>
<a href="/images/gallery/7.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/8.jpg" alt=""></figure>
<a href="/images/gallery/8.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/5.jpg" alt=""></figure>
<a href="/images/gallery/5.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/6.jpg" alt=""></figure>
<a href="/images/gallery/6.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/7.jpg" alt=""></figure>
<a href="/images/gallery/7.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>
<!--Slide Item-->
<div class="slide-item">
<div class="default-portfolio-item">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/8.jpg" alt=""></figure>
<a href="/images/gallery/8.jpg" class="lightbox-image overlay-link" title="Image Caption Here" data-fancybox-group="example-gallery"><div class="icon-box"><span class="flaticon-signs"></span></div></a>
</div>
</div>
</div>

</div>

</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Page Title',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>About</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="index.html">Home</a></li>
<li><a href="#">Pages</a></li>
<li class="active">About Us</li>
</ul>
</div>
</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'About Section',
                'content' => '<section class="about-section">
<div class="auto-container">

<!--Two Column-->
<div class="two-column">

<div class="row clearfix">
<!--Image Column-->
<div class="image-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
<figure class="image-box"><img src="/images/resource/featured-image-5.jpg" alt=""></figure>
<div class="image-caption">About Us</div>
</div>
</div>

<!--Content Column-->
<div class="content-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box">
<div class="default-title"><h3>WHY CHOOSE US</h3></div>

<div class="text">We offer a full range of garage services to vehicle owners located in all over    areas. All mechanic services are performed by highly qualified mechanics. We can handle any car problem.</div>

<!--List Style One-->
<ul class="list-style-one">
<li>Modern Workshop</li>
<li>Talented Workers</li>
<li>Best Price</li>
<li>Quick Support</li>
</ul>

<a href="services.html" class="theme-btn btn-style-two">SEE OUR SERVICES</a>
</div>
</div>

</div>

</div>

<!--Three Column Boxed-->
<div class="three-column-boxed">
<div class="row clearfix">
<!--Boxed COlumn-->
<div class="boxed-column col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-diamond-3"></span></div>
<h3>MISSION</h3>
<div class="text">Short ribs salami shank pork loin, rump bacon tenderloin leberkas doner beef ribs frankfurter pork belly jowl shoulder.</div>
</div>
</div>

<!--Boxed COlumn-->
<div class="boxed-column col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-eye"></span></div>
<h3>VISION</h3>
<div class="text">Short ribs salami shank pork loin, rump bacon tenderloin leberkas doner beef ribs frankfurter pork belly jowl shoulder.</div>
</div>
</div>

<!--Boxed COlumn-->
<div class="boxed-column col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-target-1"></span></div>
<h3>GOALS</h3>
<div class="text">Short ribs salami shank pork loin, rump bacon tenderloin leberkas doner beef ribs frankfurter pork belly jowl shoulder.</div>
</div>
</div>

</div>
</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'What We Do',
                'content' => '<section class="what-we-do">
<div class="auto-container">

<div class="row clearfix">

<!--Content Column-->
<div class="content-column column col-lg-7 col-md-7 col-sm-12">
<div class="inner-box">
<div class="default-title"><h3>WE OFFER DIFFERENT SERVICES</h3></div>

<div class="text">
<p>Rump kielbasa ground round, picanha turkey beef ribs tri-tip prosciutto strip steak. Beef ribs shoulder chicken doner boudin prosciutto ground round. Tongue chicken chuck boudin. Pork brisket swine ground round cupim bresaola, andouille hamburger biltong t-bone capicola shankle chicken.</p>
<p>Prosciutto beef ribs meatball pork chop. Pig shoulder t-bone landjaeger. Jowl biltong pork chop alcatra picanha beef pancetta tongue. Tail meatloaf biltong tenderloin fatback, porchetta capicola cupim drumstick ham hock turkey shankle pig. Pig sirloin pork loin cow. Rump landjaeger pastrami tail prosciutto.</p>
<p></p>
</div>


<a href="contact.html" class="theme-btn btn-style-two">Get Quote</a>
</div>
</div>

<!--Isolated Image-->
<figure class="isolated-image image-box wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/resource/featured-image-6.jpg" alt=""></figure>

</div>


</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Services Style Four',
                'content' => '<section class="services-four">
<div class="auto-container">

<div class="row clearfix">

<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-motor"></span></div>
<h3>Engine Overhaul</h3>
<div class="text">Meatball fatback jowl, turducken landjaeger pork belly ham hock tongue kielbasa doner cow. Shank jerky chuck capicola drumstick.</div>
</div>
</div>

<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-steering-wheel"></span></div>
<h3>Power Steering</h3>
<div class="text">Meatball fatback jowl, turducken landjaeger pork belly ham hock tongue kielbasa doner cow. Shank jerky chuck capicola drumstick.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-oil-2"></span></div>
<h3>Oil Change</h3>
<div class="text">Meatball fatback jowl, turducken landjaeger pork belly ham hock tongue kielbasa doner cow. Shank jerky chuck capicola drumstick.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-smoking-sign"></span></div>
<h3>Smog Check</h3>
<div class="text">Meatball fatback jowl, turducken landjaeger pork belly ham hock tongue kielbasa doner cow. Shank jerky chuck capicola drumstick.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-vehicle-wheel"></span></div>
<h3>Tyre Balancing</h3>
<div class="text">Meatball fatback jowl, turducken landjaeger pork belly ham hock tongue kielbasa doner cow. Shank jerky chuck capicola drumstick.</div>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-pipe-valve"></span></div>
<h3>Fleet Service</h3>
<div class="text">Meatball fatback jowl, turducken landjaeger pork belly ham hock tongue kielbasa doner cow. Shank jerky chuck capicola drumstick.</div>
</div>
</div>

</div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Pricing Section',
                'content' => '<section class="pricing-section">
<div class="auto-container">
<div class="default-title">
<h3>Checkout Our Price List</h3>
</div>

<div class="row clearfix">

<!--Pricing Column-->
<div class="pricing-column col-md-4 col-sm-6 col-xs-12">
<div class="inner-box hvr-float-shadow">
<div class="plan-title">Basic Plan</div>
<div class="lower-content">
<div class="price-header"><span class="price"><sup>$</sup> 49</span> <sub>/ Month</sub></div>
<ul class="spec-list">
<li>Yearly Car Inspection</li>
<li>Full Polishing</li>
<li>Outside Car Wash</li>
<li>Wheel Balancing</li>
<li>Speed Drive and Test</li>
<li>Rush Inhibitor</li>
</ul>

<a href="#" class="theme-btn btn-style-one">Get Started</a>
</div>
</div>
</div>

<!--Pricing Column-->
<div class="pricing-column best-plan col-md-4 col-sm-6 col-xs-12">
<div class="inner-box hvr-float-shadow">
<div class="plan-title">Premium Plan</div>
<div class="lower-content">
<div class="price-header"><span class="price"><sup>$</sup> 59</span> <sub>/ Month</sub></div>
<ul class="spec-list">
<li>Yearly Car Inspection</li>
<li>Full Polishing</li>
<li>Outside Car Wash</li>
<li>Wheel Balancing</li>
<li>Speed Drive and Test</li>
<li>Rush Inhibitor</li>
</ul>

<a href="#" class="theme-btn btn-style-one">Get Started</a>
</div>
</div>
</div>

<!--Pricing Column-->
<div class="pricing-column col-md-4 col-sm-6 col-xs-12">
<div class="inner-box hvr-float-shadow">
<div class="plan-title">Ultimate Plan</div>
<div class="lower-content">
<div class="price-header"><span class="price"><sup>$</sup> 99</span> <sub>/ Month</sub></div>
<ul class="spec-list">
<li>Yearly Car Inspection</li>
<li>Full Polishing</li>
<li>Outside Car Wash</li>
<li>Wheel Balancing</li>
<li>Speed Drive and Test</li>
<li>Rush Inhibitor</li>
</ul>

<a href="#" class="theme-btn btn-style-one">Get Started</a>
</div>
</div>
</div>

</div>
</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Portfolio Section',
                'content' => '<section class="gallery-section">
<div class="auto-container">

<div class="row masonry-container clearfix">
<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/9.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/9.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/10.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/10.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/11.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/11.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/12.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/12.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/13.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/13.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/14.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/14.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/15.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/15.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/16.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/16.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>

<!--Portofolio Item Two-->
<div class="portfolio-item-two masonry-item col-md-4 col-sm-6 col-xs-12">
<div class="inner-box">
<figure class="image-box"><img src="/images/gallery/17.jpg" alt=""></figure>
<div class="overlay-box">
<div class="content">
<a href="/images/gallery/17.jpg" class="lightbox-image" title="Image Caption Here" data-fancybox-group="example-gallery"><span class="icon flaticon-signs"></span></a>
<h3><a href="#">BRAKE REPAIR</a></h3>
</div>
</div>
</div>
</div>


</div>

<div class="padd-top-20 text-center"><a href="#" class="theme-btn btn-style-two">Load More &ensp; <span class="fa fa-refresh"></span></a></div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Error Section',
                'content' => '<section class="error-section">
<div class="auto-container">

<figure class="error-image wow tada" data-wow-delay="0ms" data-wow-duration="1500ms"><img src="/images/icons/error-image.png" alt=""></figure>

<h3><span class="theme_color">Whoop’s!</span><br>What you’re looking for isn’t here.</h3>
<div class="btn-box"><a href="index.html" class="theme-btn btn-style-two">Back to home &ensp; <span class="fa fa-long-arrow-right"></span></a></div>

<!--Search The Website-->
<div class="search-website">
<form method="post" action="index.html">
<div class="form-group">
<input type="search" name="search" value="" required placeholder="Keyword Here">
<button type="submit" class="theme-btn"><span class="fa fa-search"></span></button>
</div>
</form>
</div>

</div>
</section>',
                'created_at' => '2019-08-10 12:02:23',
                'updated_at' => '2019-08-10 12:02:23',
            ),
        ));
        
        
    }
}