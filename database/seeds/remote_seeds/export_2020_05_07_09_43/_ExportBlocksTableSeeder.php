<?php

use Illuminate\Database\Seeder;

class _ExportBlocksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('blocks')->delete();
        
        \DB::table('blocks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Főoldal / Fő lapozó',
                'content' => '<section class="main-slider style-one">

<div class="tp-banner-container">
<div class="tp-banner">
<ul>

<li data-transition="fade" data-slotamount="1" data-masterspeed="100" data-thumb="/images/main-slider/1.jpg" data-saveperformance="off" data-title="Awesome Title Here">
<img src="/images/main-slider/1.jpg" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="-100" data-speed="1500" data-start="0" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><div class="big-title"><strong>MINŐSÉGI</strong> <br>GUMIS ÉS AUTÓS SZOLGÁLTATÁSOK</div></div>

<div class="tp-caption sfl sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="10" data-speed="1500" data-start="500" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><div class="text">Cégünk gumiszervízzel és autószervízzel is rendelkezik, így teljeskörű autós szolgáltatásokat biztosítunk ügyfeleink részére.</div></div>

<div class="tp-caption sfr sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="100" data-speed="1500" data-start="1000" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><a href="/kapcsolat" class="theme-btn btn-style-two">Lépjen velünk kapcsolatba!</a></div>

</li>

<li data-transition="fade" data-slotamount="1" data-masterspeed="100" data-thumb="/images/main-slider/2.jpg" data-saveperformance="off" data-title="Awesome Title Here">
<img src="/images/main-slider/2.jpg" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="-100" data-speed="1500" data-start="0" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><div class="big-title"><strong>TAPASZTALT</strong> <br>MUNKATÁRSAKKAL DOLGOZUNK</div></div>

<div class="tp-caption sfl sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="10" data-speed="1500" data-start="500" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><div class="text">A gépjárművek javítását képzett, és tapasztalt szakemberek végzik, átadás előtt minőségellenőrzést végzünk.</div></div>

<div class="tp-caption sfr sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="100" data-speed="1500" data-start="1000" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><a href="/kapcsolat" class="theme-btn btn-style-two">Lépjen velünk kapcsolatba!</a></div>

</li>

<li data-transition="fade" data-slotamount="1" data-masterspeed="100" data-thumb="/images/main-slider/3.jpg" data-saveperformance="off" data-title="Awesome Title Here">
<img src="/images/main-slider/3.jpg" alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat"> 

<div class="tp-caption sfl sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="-100" data-speed="1500" data-start="0" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><div class="big-title">MI <strong>VIGYÁZUNK</strong> <br>GÉPJÁRMŰVÉRE</div></div>

<div class="tp-caption sfl sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="10" data-speed="1500" data-start="500" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><div class="text">Munkatársaink magas tapasztalattal rendelkeznek és maximális körültekintés mellett végzik munkájukat. Nálunk az Ön autója a legjobb kezekben van!</div></div>

<div class="tp-caption sfr sfb tp-resizeme" data-x="left" data-hoffset="15" data-y="center" data-voffset="100" data-speed="1500" data-start="1000" data-easing="easeOutExpo" data-splitin="none" data-splitout="none" data-elementdelay="0.01" data-endelementdelay="0.3" data-endspeed="1200" data-endeasing="Power4.easeIn"><a href="/kapcsolat" class="theme-btn btn-style-two">Lépjen velünk kapcsolatba!</a></div>

</li>

</ul>

<div class="tp-bannertimer"></div>
</div>
</div>
</section>',
                'dark_mode' => 1,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Főoldal / Miért minket válasszon?',
                'content' => '<section class="why-choose-us">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>MIÉRT VÁLASSZON MINKET?</h2>
<div class="desc-text">Csúcstechnológiás gépeinkkel és minőségi anyagokkal magasszintü szolgáltatást nyújtunk.</div>
</div>


<div class="row clearfix">
<div class="col-lg-8 col-md-12 col-xs-12">
<div class="row clearfix">
<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-front-of-bus"></span></div>
<div class="count">01</div>
<h3>Modern munkakörnyezet</h3>
<div class="text">Műhelyünk a környék legmodernebb szervize, gumihotel szolgáltatással és kényelmes ügyfélváróval.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-technician-with-helmet"></span></div>
<div class="count">02</div>
<h3>Tapasztalt munkaerő</h3>
<div class="text">Kollégáink több évtizedes tapasztalattal rendelkeznek a szakmában.</div>
</div>
</div>
<div class="clearfix"></div>
<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-money-1"></span></div>
<div class="count">03</div>
<h3>Legjobb árak</h3>
<div class="text">A piacon lévő legjobb árakat biztosítjuk minden ügyfelünknek.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-24-hours-support"></span></div>
<div class="count">04</div>
<h3>Gyors kiszolgálás</h3>
<div class="text">Kollégáink biztosítják az ügyfelek minél gyorsabb és szakszerűbb kiszolgálását.</div>
</div>
</div>

</div>
</div>

<div class="image-column col-lg-4 col-md-12 col-xs-12 hidden-xs hidden-sm hidden-md">
<figure class="isolated-image wow bounceInUp" data-wow-delay="0ms" data-wow-duration="1500ms"><img class="img-responsive" src="/images/resource/featured-image-4.jpg" alt=""></figure>
</div>

</div>

</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-12-12 13:50:42',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Főoldal / Számláló',
            'content' => '<section class="fact-counter" style="background-image:url(/images/background/image-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<div class="counter-outer clearfix">
<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1000" data-stop="15">0</span>k+</div>
<div class="separator"></div>
<h4 class="counter-title">SZERVIZELT GÉPJÁRMŰ</h4>
</article>

<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1000" data-stop="16">0</span>k+</div>
<div class="separator"></div>
<h4 class="counter-title">ELÉGEDETT ÜGYFÉL</h4>
</article>

<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1000" data-stop="12">0</span>k+</div>
<div class="separator"></div>
<h4 class="counter-title">POZITÍV VISSZAJELZÉS</h4>
</article>

<!--Column-->
<article class="column counter-column col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="0ms">
<div class="count-outer"><span class="count-text" data-speed="1000" data-stop="18">0</span>k+</div>
<div class="separator"></div>
<h4 class="counter-title">PROBLÉMA MEGOLDVA</h4>
</article>

</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Főoldal / Services Style One',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Főoldal / Gallery Section one',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Főoldal / Team Style one',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Főoldal / Testimonial Section one',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Főoldal / News Section',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Rólunk / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Rólunk</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Rólunk</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Rólunk / Bemutatkozás',
                'content' => '<section class="about-section">
<div class="auto-container">

<!--Two Column-->
<div class="two-column">
<div class="row clearfix">
<!--Content 1# Column-->
<div class="content-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box">
<div class="default-title"><h3>A 4Xtreme Kft. története</h3></div>

<div class="text text-justify">A 4Xtreme Kft. jogelődjeivel 1994 óta működik gépjármű gumiabroncs kereskedelmi és szerelés, javítás szolgáltatás területen, 2001 óta jelenlegi telephelyünkön, Biatorbágyon. Műhelyünk biztonságos emelőgépekkel, a legmodernebb szerelő és centrírozógépekkel van felszerelve.</div>

<div class="text text-justify">Fő tevékenységünk személy, kisteher és egyéb jármű, új és használt gumiabroncsok értékesítése raktárról, szerelése, javítása 12-24 colig. Valamint acél és alumínium keréktárcsák eladása raktárkészletről illetve igény szerinti beszerzése, szerelése, javítása.</div>

<div class="text text-justify">Cégünk a Vredestein márkájú, holland gumiabroncsok kiemelt, területi forgalmazója. Mindemellett bármely egyéb típusú forgalomban levő gumiabroncsot is be tudunk szerezni rövid határidővel, illetve jelentős, folyamatosan bővülő raktárkészlettel állunk ügyfeleink rendelkezésére.</div>
</div>
</div>
<!--Image Column-->
<div class="image-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
<figure class="image-box"><img src="/images/gallery/muhely.jpg" alt=""></figure>
<div class="image-caption">Telephelyünk Biatorbágyon</div>
</div>
</div>
</div>
</div>

<!--Two Column-->
<div class="two-column">
<div class="row clearfix">
<!--Content 1# Column-->
<div class="content-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box">
<!--List Style One-->
<ul class="list-style-one">
<li>Gumihotel szolgáltatásunkkal lehetőség van gumiabroncsok szakszerű tárolására és ápolására is.</li>
<li>Szervizünk flottabázisként is működik. Gépjárműparkkal rendelkező cégeknek jelentős kedvezményeket tudunk nyújtani.</li>
<li>A megrendelői elégedettség elérése érdekében szolgáltatásainkat maximálisan, gyorsan és minőségi munkával igyekszünk biztosítani.</li>
<li>Autószervizünkben márkafüggetlen autójavítás, futóműállítás, autódiagnosztika, szolgáltatásokkal állunk kedves ügyfeleink rendelkezésére.</li>
</ul>
<a href="/kapcsolat" class="theme-btn btn-style-two">Csatlakozzon elégedett ügyfeleinkhez!</a>
</div>
</div>
<!--Image Column-->
<div class="image-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box wow slideInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
<figure class="image-box"><img src="/images/resource/blog-image-9.jpg" alt=""></figure>
<div class="image-caption">Gyors és minőségi munka</div>
</div>
</div>
</div>
</div>

<!--Two Column-->
<div class="two-column">

<div class="row clearfix">
<!--Image Column-->
<div class="image-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
<figure class="image-box"><img src="/images/resource/featured-image-5.jpg" alt=""></figure>
<div class="image-caption">Átadás előtt minőségellenőrzést végzünk</div>
</div>
</div>
<!--Content Column-->
<div class="content-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box">
<div class="default-title"><h3>Mért minket válasszon?</h3></div>

<div class="text text-justify">Márkafüggetlen autó és gumiszerviz lévén, bármilyen típusú gépjármű szervizelését vállaljuk. A gépjárművek javítását képzett, és tapasztalt szakemberek végzik, átadás előtt minőségellenőrzést végzünk.</div>

<!--List Style One-->
<ul class="list-style-one">
<li>Időpontot nemcsak személyesen, telefonon, hanem online is foglalhat.</li>
<li>Vállalkozásunk jól megközelíthető, Biatorbágyon, az 1-es főúthoz közel található!</li>
<li>A Megrendelőt hosszútávú partnerünknek tekintjük.</li>
<li>Fiatalos, jókedvű, szakmáját szerető csapat vagyunk.</li>
</ul>

<a href="/gumis/szolgaltatasok" class="theme-btn btn-style-two">Gumis Szolgáltatások</a>
<a href="/autos/szolgaltatasok" class="theme-btn btn-style-two" style="margin-top: 20px">Autós Szolgáltatások</a>
</div>
</div>

</div>

</div>

<!--Three Column Boxed-->
<div class="three-column-boxed">
<div class="row clearfix">
<!--Boxed COlumn-->
<div class="boxed-column col-md-4 col-sm-4 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-diamond-3"></span></div>
<h3>KÜLDETÉS</h3>
<div class="text">Cégünk küldetése, hogy a meghibásodott képkocsit a lehető legrövidebb időn belül megjavítva átadja ügyfelünk részére.</div>
</div>
</div>

<!--Boxed COlumn-->
<div class="boxed-column col-md-4 col-sm-4 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-eye"></span></div>
<h3>LÁTÁSMÓD</h3>
<div class="text">A munka megkezdése előtt megállapítjuk a konkrét műszaki hibát, árajánlatot adunk és az ajánlat visszaigazolását követően kezdjük meg a gépjármű javítását.</div>
</div>
</div>

<!--Boxed COlumn-->
<div class="boxed-column col-md-4 col-sm-4 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-target-1"></span></div>
<h3>CÉLJAINK</h3>
<div class="text">Az ügyfelek, minél színvonalasabb kiszolgálása. </div>
</div>
</div>

</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-12-12 14:00:15',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Rólunk / Lapozós galéria',
                'content' => '#@GALÉRIA@#',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-12-16 16:23:20',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Álláslehetőségek / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Álláslehetőségek</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Álláslehetőségek</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Álláslehetőségek / Állás blokk',
                'content' => '<section class="about-section">
<div class="auto-container">
<!--Two Column-->
<div class="two-column">

<div class="row clearfix">
<!--Image Column-->
<div class="image-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box wow slideInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
<figure class="image-box"><img src="/images/gallery/tire_worker.jpg" alt=""></figure>
<div class="image-caption">Tapasztalt gumiszerelőt keresünk</div>
</div>
</div>
<!--Content Column-->
<div class="content-column column col-lg-6 col-md-6 col-sm-12">
<div class="inner-box">
<div class="default-title"><h3>DOLGOZNI SZERETNE NÁLUNK?</h3></div>

<div class="text text-justify"><p>Szakképzett munkatársakra mindig szükségünk van. Jelentkezzen munkatársnak telefonon vagy a <a href="/kapcsolat">kapcsolat</a> oldalunk segítségével.</p></div>

<div class="default-title"><h3>JELENLEG ÜRES POZICIÓK CÉGÜNKNÉL:</h3></div>
<h3>Gumiszerelő</h3>
<p>Gumiszerelőket keresünk, hosszútávú munkavégzésre, igényes munkahelyre. Min. 3 év gyakorlattal várunk kollégát, akik precíz, pontos munkát tud végezni. Stabil munkahelyet versenyképes bért kínálunk!</p>
<!--List Style One-->
<ul class="list-style-one">
<li>Teljes munkaidő</li>
<li>3-5 év szakmai tapasztalat</li>
</ul>

<a href="/kapcsolat" class="theme-btn btn-style-two">Jelentkezzen poziciónkra</a>
</div>
</div>

</div>

</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Álláslehetőségek / Services Style Four',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Álláslehetőségek / Pricing Section',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Időpontok / Foglalási rendszer',
                'content' => '[@dynamic_block]booking[@dynamic_block]',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Autós szolgáltatások / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Autós Szolgáltatások</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Autós Szolgáltatások</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Autós szolgáltatások / Autószerviz Szolgáltatásaink',
                'content' => '<section class="why-choose-us" style="padding: 50px 0px 0px 0px;">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>Szolgáltatásaink - Autószerviz</h2>
<div class="desc-text">Nemcsak gumiszerviz, de autószerviz tevékenységeket is igénybe vehet nálunk. Autószervizünk szolgáltatásait az alábbi oldalon tekintheti meg. További információkért keresse kollégáinkat.</div>
</div>

</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Autós szolgáltatások / 2x4 blokk',
                'content' => '<section class="why-choose-us" style="padding: 50px 0px 0px 0px;">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>Szolgáltatásaink - Autószerviz</h2>
<div class="desc-text">Nemcsak gumiszerviz, de autószerviz tevékenységeket is igénybe vehet nálunk. Autószervizünk szolgáltatásait az alábbi oldalon tekintheti meg. További információkért keresse kollégáinkat.</div>
</div>

</div>
</section>

<section class="services-four">
<div class="auto-container">
<div class="row">
<div class="col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
<div class="row">
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box">
<span class="flaticon-motor"></span>
</div>
<h3>Motorfelújítás</h3>
<div class="clearfix"></div>
<ul>
<li>Hengerfejfelújítás</li>
<li>Szelepszárszimering csere</li>
<li>Szelepcsiszolás</li>
<li>Motorfelújítás</li>
<li>Dugattyú és gyűrűcsere</li>
<li>Hajtókar csapágyazás</li>
<li>Főtengely csapágyazás</li>
</ul>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-oil-2"></span></div>
<h3>Kötelező szerviz</h3>
<div class="clearfix"></div>
<ul>
<li>Olajcsere</li>
<li>Szűrőcserék</li>
<li>Fékjavítás</li>
<li>Kipufogójavítás</li>
<li>Folyadékok ellenörzése és mérése</li>
<li>Vezérléscsere</li>
</ul>
</div>
</div>
<div class="clearfix visible-sm-block"></div>
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box">
<span class="flaticon-setting-tool"></span>
</div>
<h3>Diagnosztika</h3>
<div class="clearfix"></div>
<ul>
<li>OBD</li>
<li>ABS</li>
<li>Légzsák</li>
<li>Klíma</li>
<li>Komfort</li>
<li>Szerviz nullázás</li>
</ul>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-mechanic-tools"></span></div>
<h3>Futómű javítás, állítás</h3>
<div class="clearfix"></div>
<ul>
<li>Gömbfejek</li>
<li>Szilentek</li>
<li>Kormánymű</li>
<li>Csapágyak</li>
<li>Futómű-beálláítás</li>
</ul>
</div>
</div>
<div class="clearfix"></div>
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box">
<span class="flaticon-smoking-sign"></span>
</div>
<h3>Klíma</h3>
<div class="clearfix"></div>
<ul>
<li>Töltés</li>
<li>Nyomáspróba</li>
<li>Fertőtlenítés</li>
<li>Javítás</li>
</ul>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box">
<span class="flaticon-pipe-valve"></span>
</div>
<h3>Erőátvítel</h3>
<div class="clearfix"></div>
<ul>
<li>Kuplung</li>
<li>Féltengely</li>
<li>Kardán</li>
</ul>
</div>
</div>
<div class="clearfix visible-sm-block"></div>
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box">
<span class="flaticon-sports-car"></span>
</div>
<h3>Flotta ajánlatok</h3>
<div class="clearfix"></div>
<ul>
<li>Hozom - viszem</li>
<li>Kedvezmények</li>
</ul>
</div>
</div>
<!--Service Block-->
<div class="service-block col-md-3 col-sm-6 col-xs-12">
<figure class="isolated-image wow bounceInRight" data-wow-delay="0ms" data-wow-duration="1500ms"><img class="img-responsive motor_beuszo" src="/images/resource/motor_beuszo.jpg" alt="" draggable="false"></figure>
</div>
</div>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-14 10:58:17',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Autós szolgáltatások / Pricing Section',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Autós árlista / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Autós árlista</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Autós árlista</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Autós árlista / Táblázatok',
                'content' => '<section class="team-style-one">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>Autószervizes áraink</h2>
<div class="desc-text">
Autószervizünk árairól az alábbi oldalon tájékozódhat. További
információkért keresse kollégáinkat.
</div>
</div>
<div class="row">
<div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
<div class="spec-table">
<table class="table table-bordered">
<thead>
<tr>
<th>Személyautó</th>
<th>Átszerelés</th>
<th>Centrírozás</th>
<th>Komplett</th>
</tr>
</thead>
<tbody>
<tr>
<td>13"-14"-ig</td>
<td>500 Ft / db</td>
<td>500 Ft / db</td>
<td>1000 Ft / db</td>
</tr>
<tr>
<td>15"-16"-ig</td>
<td>650 Ft / db</td>
<td>600 Ft / db</td>
<td>1250 Ft / db</td>
</tr>
<tr>
<td>17"-18"-19"-ig</td>
<td>900 Ft / db</td>
<td>600 Ft / db</td>
<td>1500 Ft / db</td>
</tr>
<tr>
<td>20"-24"-ig</td>
<td>1400 Ft / db</td>
<td>600 Ft / db</td>
<td>2000 Ft / db</td>
</tr>
<tr>
<td colspan="5">Alufelni felár 250 Ft / db</td>
</tr>
</tbody>
</table>
</div>
<div class="spec-table">
<table class="table table-bordered">
<thead>
<tr>
<th>Kisteher és terepjáró</th>
<th>Átszerelés</th>
<th>Centrírozás</th>
<th>Komplett</th>
</tr>
</thead>
<tbody>
<tr>
<td></td>
<td>950 Ft / db</td>
<td>800 Ft / db</td>
<td>1750 Ft / db</td>
</tr>
</tbody>
</table>
</div>
<div class="spec-table">
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5">Egyéb</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2">Kerék le és fel szerelése + centrírozás:</td>
<td colspan="3">
500 Ft / db + a méretnek megfelelő centrírozás.
</td>
</tr>
<tr>
<td colspan="2">Defekt javítás:</td>
<td td="" colspan="2">
1200 Ft / db + a méretnek megfelelő szerelési ár.
</td>
</tr>
</tbody>
</table>
</div>
<div class="spec-table">
<table class="table table-bordered" style="margin-bottom: 20px;">
<thead>
<tr>
<th colspan="5">Szelep árak</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2">Gumi szelep:</td>
<td td="" colspan="2">150 Ft / db</td>
</tr>
<tr>
<td colspan="2">Króm szelep:</td>
<td td="" colspan="2">350 Ft / db</td>
</tr>
<tr>
<td colspan="2">Fém szelep:</td>
<td td="" colspan="2">600 Ft / db</td>
</tr>
</tbody>
</table>
</div>
<p class="table-description">
A feltüntetett árak ÁFA nélkül értendőek!
</p>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Gumis szolgáltatások / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Gumis Szolgáltatások</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Gumis Szolgáltatások</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Gumis szolgáltatások / 2x2 blokk',
                'content' => '<section class="why-choose-us">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>Szolgáltatásaink - Gumiszerviz</h2>
<div class="desc-text">A gumi minősége, szezonalitása, kora, kopottsága erősen befolyásolja a fékutat. Ha csak egy zebrányival később tud megállni a rossz minőségű gumi miatt, az már régen rossz.</div>
</div>
<div class="row clearfix">
<div class="col-lg-8 col-md-12 col-xs-12">
<div class="row clearfix">
<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-vehicle-wheel"></span></div>
<div class="count">01</div>
<h3>Gumiszerelés, centrírozás</h3>
<div class="text">Kerékszerelésnél olyan gépeket használunk, amelyekkel mindenfajta lemez- és alufelnit meg tudunk szerelni anélkül, hogy akár az gumiabroncsban, akár a keréktárcsában bármilyen sérülést okoznánk. A kerék csomagolásával autója tisztaságát tartjuk szem előtt.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-technician-with-helmet"></span></div>
<div class="count">02</div>
<h3>Gumijavítás</h3>
<div class="text">Amennyiben gumiját a futófelületen érte sérülés, akkor hozza be hozzánk, és mi megjavítjuk! A gumi oldalán, peremén keletkezett sérüléseket nem lehet javítani, mert balesetveszélyes!</div>
</div>
</div>
<div class="clearfix"></div>
<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-money-1"></span></div>
<div class="count">03</div>
<h3>Gumiabroncs - és keréktárolás</h3>
<div class="text">Vállaljuk a leszerelt téli vagy nyári kerekek illetve gumiabroncsok idényen kívüli szakszerű tárolását (tavasztól őszig; ősztől tavaszig), így Önnek csak egy telefonjába kerül, hogy másnapra az abroncsai előkészítésre kerüljenek a szereléshez.</div>
</div>
</div>

<!--Why Us Column-->
<div class="why-us-column col-md-6 col-sm-6 col-xs-12">
<div class="inner-box">
<div class="icon-box"><span class="flaticon-24-hours-support"></span></div>
<div class="count">04</div>
<h3>Ingyenes szaktanácsadás</h3>
<div class="text">Amennyiben gépjárműve gumiabroncsaival kapcsolatban bármilyen kérdése merülne fel, tapasztalt kollégáink örömmel állnak az Ön rendelkezésére.</div>
</div>
</div>

</div>
</div>

<div class="image-column col-lg-4 col-md-12 col-xs-12 hidden-xs hidden-sm hidden-md">
<figure class="isolated-image wow bounceInUp" data-wow-delay="0ms" data-wow-duration="1500ms"><img class="img-responsive" src="/images/resource/featured-image-1.jpg" alt=""></figure>
</div>

</div>

</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-12-12 13:51:51',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Gumis szolgáltatások / Services Style Four',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Gumis szolgáltatások / Pricing Section',
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
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Gumis árlista / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Gumis árlista</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Gumis árlista</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Gumis árlista / Táblázat',
                'content' => '<section class="team-style-one">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>Gumiszervizes áraink</h2>
<div class="desc-text">Gumiszervizünk árairól az alábbi oldalon tájékozódhat. A piacon lévő legjobb árakat biztosítjuk minden ügyfelünknek. További információkért keresse kollégáinkat.</div>
</div>
<div class="row">
<div class="col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
<div class="spec-table">
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Komplett szerelés</b></th>
</tr>
<tr>
<th scope="col"><b>Típus</b></th>
<th scope="col"><b>Méret</b></th>
<th scope="col"><b>Lemezfelni</b></th>
<th scope="col"><b>Alufelni</b></th>
</tr>
</thead>
<tbody>
<tr>
<td scope="row" rowspan="7">Személyautó</td>
<td>12"-14"-ig</td>
<td>1800 Ft / db</td>
<td>2000 Ft / db</td>
</tr>
<tr>
<td scope="row">15"-16"-ig</td>
<td>2000 Ft / db</td>
<td>2400 Ft / db</td>
</tr>
<tr>
<td scope="row">17"-18"-ig</td>
<td>2400 Ft / db</td>
<td>3000 Ft / db</td>
</tr>
<tr>
<td scope="row">19"</td><td>-</td>
<td>3500 Ft / db</td>
</tr>
<tr>
<td scope="row">20"</td>
<td>-</td>
<td>4500 Ft / db</td>
</tr>
<tr>
<td scope="row">21"</td>
<td>-</td>
<td>5000 Ft / db</td>
</tr>
<tr>
<td scope="row">22"</td>
<td>-</td>
<td>6000 Ft / db</td>
</tr>
<tr>
<td scope="row" rowspan="2">Kisteherautó, SUV, 4x4</td><td>14"-17"-ig</td>
<td>2700 Ft / db</td>
<td>3100 Ft / db</td>
</tr>
<tr>
<td scope="row">18"-től</td>
<td>3100 Ft / db</td>
<td>4000 Ft / db</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Gumiabroncs szerelés</b></th>
</tr>
<tr>
<th scope="col"><b>Típus</b></th>
<th scope="col"><b>Méret</b></th>
<th scope="col"><b>Lemezfelni</b></th>
<th scope="col"><b>Alufelni</b></th>
</tr>
</thead>
<tbody>
<tr>
<td scope="row" rowspan="4">Személyautó</td>
<td>12"-14"-ig</td>
<td>1000 Ft / db</td>
<td>1250 Ft / db</td>
</tr>
<tr>
<td scope="row">15"-16"-ig</td>
<td>1250 Ft / db</td>
<td>1500 Ft / db</td>
</tr>
<tr>
<td scope="row">17"-18"-ig</td>
<td>1500 Ft / db</td>
<td>1750 Ft / db</td>
</tr>
<tr>
<td scope="row">19-22"-ig</td><td>-</td>
<td>2000 Ft / db</td>
</tr>
<tr>
<td scope="row" rowspan="2">Kisteherautó, SUV, 4x4</td><td>14"-17"-ig</td>
<td>1500 Ft / db</td>
<td>1750 Ft / db</td>
</tr>
<tr>
<td scope="row">18"-tól</td>
<td>2000 Ft / db</td>
<td>2250 Ft / db</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Gumiabroncs szerelés + Centrírozás</b></th>
</tr>
<tr>
<th scope="col"><b>Típus</b></th>
<th scope="col"><b>Méret</b></th>
<th scope="col"><b>Lemezfelni</b></th>
<th scope="col"><b>Alufelni</b></th>
</tr>
</thead>
<tbody>
<tr>
<td scope="row" rowspan="4">Személyautó</td>
<td>12"-14"-ig</td>
<td>1500 Ft / db</td>
<td>1750 Ft / db</td>
</tr>
<tr>
<td scope="row">15"-16"-ig</td>
<td>1750 Ft / db</td>
<td>2000 Ft / db</td>
</tr>
<tr>
<td scope="row">17"-18"-ig</td>
<td>2000 Ft / db</td>
<td>2500 Ft / db</td>
</tr>
<tr>
<td scope="row">19-22"-ig</td><td>-</td>
<td>3000 Ft / db</td>
</tr>
<tr>
<td scope="row" rowspan="2">Kisteherautó, SUV, 4x4</td><td>14"-17"-ig</td>
<td>2000 Ft / db</td>
<td>2500 Ft / db</td>
</tr>
<tr>
<td scope="row">18"-tól</td>
<td>2500 Ft / db</td>
<td>3000 - 5000 Ft / db</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Kerék le- és Felszerelés</b></th>
</tr>
<tr>
<th scope="col"><b>Típus</b></th>
<th scope="col"><b>Méret</b></th>
<th scope="col"><b>Lemezfelni</b></th>
<th scope="col"><b>Alufelni</b></th>
</tr>
</thead>
<tbody>
<tr>
<td scope="row" rowspan="4">Személyautó</td>
<td>12"-14"-ig</td>
<td>1250 Ft / db</td>
<td>1250 Ft / db</td>
</tr>
<tr>
<td scope="row">15"-16"-ig</td>
<td>1500 Ft / db</td>
<td>1500 Ft / db</td>
</tr>
<tr>
<td scope="row">17"-18"-ig</td>
<td>1750 Ft / db</td>
<td>1750 Ft / db</td>
</tr>
<tr>
<td scope="row">19-22"-ig</td><td>-</td>
<td>2000 Ft / db</td>
</tr>
<tr>
<td scope="row" rowspan="2">Kisteherautó, SUV, 4x4</td><td>14"-17"-ig</td>
<td>1250 Ft / db</td>
<td>1500 Ft / db</td>
</tr>
<tr>
<td scope="row">18"-tól</td>
<td>1500 Ft / db</td>
<td>1750 - 2750 Ft / db</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Kerék le- és Felszerelés + </b>Centrírozás</th>
</tr>
<tr>
<th scope="col"><b>Típus</b></th>
<th scope="col"><b>Méret</b></th>
<th scope="col"><b>Lemezfelni</b></th>
<th scope="col"><b>Alufelni</b></th>
</tr>
</thead>
<tbody>
<tr>
<td scope="row" rowspan="4">Személyautó</td>
<td>12"-14"-ig</td>
<td>1500 Ft / db</td>
<td>1800 Ft / db</td>
</tr>
<tr>
<td scope="row">15"-16"-ig</td>
<td>1750 Ft / db</td>
<td>2100 Ft / db</td>
</tr>
<tr>
<td scope="row">17"-18"-ig</td>
<td>2000 Ft / db</td>
<td>2300 Ft / db</td>
</tr>
<tr>
<td scope="row">19-22"-ig</td><td>-</td>
<td>2500 Ft / db</td>
</tr>
<tr>
<td scope="row" rowspan="2">Kisteherautó, SUV, 4x4</td><td>14"-17"-ig</td>
<td>2100 Ft / db</td>
<td>2500 Ft / db</td>
</tr>
<tr>
<td scope="row">18"-tól</td>
<td>2500 Ft / db</td>
<td>3000 - 4000 Ft / db</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Gumihotel</b></th></tr><tr><th scope="col"><b>Típus</b></th>
<th scope="col"><b>Méret</b></th>
<th scope="col"><b>CSAK GUMIABRONCS</b></th>
<th scope="col"><b>KOMPLETT KERÉK</b></th>
</tr>
</thead>
<tbody>
<tr>
<td scope="row" rowspan="2">Személyautó</td>
<td>16"-ig</td>
<td>1500 Ft / db</td>
<td>1750 / db</td>
</tr>
<tr>
<td scope="row">17"-tól</td>
<td>1750 Ft / db</td>
<td>2000 Ft / db</td>
</tr>
<tr>
<td scope="row" rowspan="2">Kisteherautó, SUV, 4x4</td><td>14"-22"</td>
<td>1750 Ft / db</td>
<td>2000 Ft / db</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Egyéb</b></th>
</tr>
</thead>
<tbody>
<tr>
<td>Defektjavítás</td>
<td>2000 Ft / db + a méretnek megfelelő szerelési ár</td>
</tr>
<tr>
<td>Peremtömítés (csiszolás + tömítés)</td>
<td>1000 Ft / db + a méretnek megfelelő szerelési ár</td>
</tr>
<tr>
<td>Defekttűrő gumiabroncsok szerelése</td>
<td>500 Ft / db + a méretnek megfelelő szerelési ár</td>
</tr>
<tr>
<td>Komplett kerékmosás</td>
<td>3000 Ft / garnitúra</td>
</tr>
<tr>
<td>Gumizsák</td>
<td>250 Ft / db</td>
</tr>
</tbody>
</table>
<table class="table table-bordered">
<thead>
<tr>
<th colspan="5"><b>Selejt gumiabroncsok átvétele</b></th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="2">Nálunk vásárolt</td>
<td colspan="2">Ingyenes</td>
</tr>
<tr>
<td colspan="2">Hozott</td>
<td colspan="2">500 Ft / db</td>
</tr>
</tbody>
</table>
<p class="table-description">A feltüntetett árak az ÁFA-t tartalmazzák!</p>
<p class="table-description">A szerelések és centrírozások a szelepházak és súlyok árait tartalmazzák!</p>
</div>
</div>
</div>
</div></section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2020-03-11 19:35:29',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Kapcsolat / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Kapcsolat</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Kapcsolat</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-07 15:54:54',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Kapcsolat / Kapcsolat blokk',
                'content' => '<!--Contact Section-->
<section class="contact-section">
<div class="auto-container">
<div class="row clearfix">
<!--Column-->
<div class="column col-md-6 col-sm-12 col-xs-12">
<div class="default-title"><h3>LÉPJEN VELÜNK KAPCSOLATBA</h3></div>

<div class="contact-form default-form">
<form method="post" action="" id="contact-form">

<input type="hidden" name="_token" id="csrf_token">

<div class="form-group">
<div class="field-label"><span class="form_strong">Az Ön neve:</span> *</div>
<input type="text" name="username" value="" placeholder="" required="">
</div>

<div class="form-group">
<div class="field-label"><span class="form_strong">Email címe:</span> *</div>
<input type="email" name="email" value="" placeholder="" required="">
</div>

<div class="form-group">
<div class="field-label"><span class="form_strong">Tárgy:</span> *</div>
<label>
<input type="radio" name="subject" value="Érdeklődés" required="">
<span class="radio-text">Érdeklődés</span>
</label>
<br>
<label>
<input type="radio" name="subject" value="Állás" required="">
<span class="radio-text">Állásra jelentkezés</span>
</label>
<br>
<label>
<input type="radio" name="subject" value="Visszajelzés" required="">
<span class="radio-text">Visszajelzés</span>
</label>
</div> 

<div class="form-group">
<div class="field-label"><span class="form_strong">Telefonszáma:</span> *</div>
<input type="text" name="phone" value="" placeholder="" required="">
</div>

<div class="form-group">
<div class="field-label"><span class="form_strong">Üzenet / Megjegyzés:</span> *</div>
<textarea name="message" placeholder="" required=""></textarea>
</div>

<button type="submit" class="theme-btn btn-style-two">Küldés</button>

</form>

</div>
</div>

<!--Column-->
<div class="column col-md-6 col-sm-12 col-xs-12">
<div class="default-title"><h3>ELÉRHETŐSÉGEINK</h3></div>

<div class="inner-box">
<div class="contact-info">
<ul>
<li><div class="inner-box"><div class="icon-box"><span class="flaticon-navigation"></span></div><strong>CÉGNÉV ÉS ELÉRHETŐSÉG:</strong><span>4Xtreme Autó és Gumiszerviz Kft.<br>2051 Biatorbágy, Meggyfa utca 2.</span></div></li>
<li><div class="inner-box"><div class="icon-box"><span class="flaticon-envelope"></span></div><strong>CÉG ADATAI:</strong><span>Adószám: 12391134-2-13<br>Cégvezető: Erdélyi Zoltán</span></div></li>
<div class="clearfix"></div>
<li><div class="inner-box"><div class="icon-box"><span class="flaticon-clock-5"><br></span></div><strong>NYITVATARTÁS:</strong><strong>Gumiszerviz:</strong><span>H-P: 8:00 - 18:00<br>SZ: 8:00 - 13:00</span>
<strong>Autószerviz:</strong><span>H-P: 7:00 - 16:30<br>SZ: Zárva<br><br><br><br><br><br></span></div></li>
<li><div class="inner-box"><div class="icon-box"><span class="flaticon-technology-8"></span></div><strong>TELEFONSZÁMOK ÉS LEVELEZÉS:</strong>
<strong>Bejelentkezés autószervizbe:</strong><span>+36 23 313 003<br>+36 20 313 4444<br>autoszerviz@4xtreme.hu<br><b>Bejelentkezés gumiszervizbe:<br></b>+36 23 311 658<br>gumiszerviz@4xtreme.hu<br><b>Erdélyi Zoltán (cégvezető):</b><br>+36 20 927 4877<br>info@4xtreme.hu<br><br><br></span></div></li>
</ul>
</div>
</div>
</div>

</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2020-02-04 22:35:25',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Kapcsolat / Térkép blokk',
                'content' => '<!--Map Section-->
<section class="map-section">
<div class="map-outer">
<iframe src="https://www.google.com/maps/d/u/1/embed?mid=1A515D_rIPSF9a0Ihilf1XE-H6DGhi2an" width="100%" height="440" frameborder="0" style="border:0" allowfullscreen=""></iframe>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2020-01-17 09:28:44',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Fejléc / Jobb-felső információs blokk',
                'content' => '<!--Info Box-->
<div class="upper-column info-box">
<div class="icon-box"><span class="flaticon-technology-8"></span></div>
<strong style="line-height: 20px;">Hívjon Minket</strong>

<table class="table table-borderless" id="phone_table" style="width: auto; margin-bottom: 0;">
<tbody>
<tr>
<td style="border: none; padding: 0; line-height: 20px;" class="phone_table_tire">Gumiszerviz:</td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left; padding-right: 40px;"><a href="tel:+3623311658" class="phone_table_tire_num">+36 23 311 658</a></td>
</tr>
<tr>
<td style="border: none; padding: 0; line-height: 20px;"></td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;"><a href="tel:+36209274887" class="phone_table_tire_num">+36 20 927 4877</a></td>
</tr>
<tr>
<td style="border: none; padding: 0; line-height: 20px;" class="phone_table_car">Autószerviz:</td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;"><a href="tel:+3623313003" class="phone_table_car_num">+36 23 313 003</a></td>
</tr>
<tr>
<td style="border: none; padding: 0; line-height: 20px;"></td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;"><a href="tel:+36203134444" class="phone_table_car_num">+36 20 313 4444</a></td>
</tr>
</tbody>
</table>
<div style="clear:both;"></div>
</div>

<!--Info Box-->
<div class="upper-column info-box">
<div class="icon-box"><span class="flaticon-alarm-clock"></span></div>
<strong style="line-height: 20px;">Nyitvatartás</strong>
<table class="table table-borderless" style="width: auto; margin-bottom: 0;">
<tbody>
<tr>
<td style="border: none; padding: 0; line-height: 20px;">Gumiszerviz:</td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;">H-P: 8:00 - 18:00 Sz: 8:00 - 13:00</td>
</tr>
<tr>
<td style="border: none; padding: 0; line-height: 20px;">Autószerviz:</td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;">H-P: 7:00 - 16:30 Sz: Zárva</td>
</tr>
<!--<tr>
<td colspan="2" style="color: rgb(244, 65, 34); border: none; text-transform: none; text-align: left; padding: 10px 0px;"><span style="font-size: 15px; text-shadow: #333 1px 1px 1px;"><b>A korlátozás nyitvatartásunkat nem érinti!</b></span></td>
</tr>-->
</tbody>
</table>
<p style="color: rgb(244, 65, 34); border: none; text-transform: none; text-align: left; padding: 10px 0px; margin: 0;"><span style="font-size: 15px; text-shadow: #333 1px 1px 1px;"><b>A korlátozás nyitvatartásunkat nem érinti!</b></span></p>
</div>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2020-04-01 19:07:15',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Lábléc / 4x1 blokklista',
                'content' => '<!--Footer Section-->
<div class="widgets-section">
<div class="row clearfix">
<!--Big Column-->
<div class="big-column col-md-6 col-sm-12 col-xs-12">
<div class="row clearfix">

<!--Footer Column-->
<div class="footer-column col-md-6 col-sm-6 col-xs-12">
<div class="footer-widget about-widget">
<h2>Rólunk</h2>
<div class="widget-content">
<div class="text">A 4Xtreme Kft. jogelődjeivel 1994 óta működik gépjármű gumiabroncs kereskedelmi és szerelés, javítás szolgáltatás területen, 2001 óta jelenlegi telephelyünkön, Biatorbágyon. </div>
<div class="social-links">
<!--<a href="https://www.facebook.com/4xtremekft/" target="_blank"><span class="fa fa-facebook-f"></span></a>-->
<!--<a href="#" target="_blank"><span class="fa fa-instagram"></span></a>-->
</div>
</div>
</div>
</div>

<!--Footer Column-->
<div class="footer-column col-md-6 col-sm-6 col-xs-12">
<div class="footer-widget links-widget">
<h2>Szolgáltatásaink</h2>
<div class="widget-content">
<ul class="list">
<li><a href="/autos/szolgaltatasok">Autószervizes szolgáltatások</a></li>
<li><a href="/gumis/szolgaltatasok">Gumiszervizes szolgáltatások</a></li>
<li><a href="/gumis/arlista">Gumiszervizes árlista</a></li>
</ul>
</div>

</div>
</div>

</div>
</div>

<!--Big Column-->
<div class="big-column col-md-6 col-sm-12 col-xs-12">
<div class="row clearfix">

<!--Footer Column-->
<div class="footer-column col-md-6 col-sm-6 col-xs-12">
<div class="footer-widget work-hours">
<h2>Nyitvatartás</h2>
<div class="widget-content">
<h4>Gumiszerviz:</h4>
<p>H-P: 8:00 - 18:00</p>
<p>Sz: 8:00 - 13:00</p>
<br>
<h4>Autószerviz:</h4>
<p>H-P: 7:30 - 17:00</p>
<p>Sz: Zárva</p>
</div>
</div>
</div>

<!--Footer Column-->
<div class="footer-column col-md-6 col-sm-6 col-xs-12" id="mobile_phone_numbers" style="display: none;">
<div class="footer-widget contact-widget">
<h2>Hívjon Minket</h2>

<table class="table table-borderless" id="phone_table" style="width: auto; margin-bottom: 0;">
<tbody>
<tr>
<td style="border: none; padding: 0; line-height: 20px;" class="phone_table_tire">Gumiszerviz:</td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left; padding-right: 40px;"><a href="tel:+3623311658" class="phone_table_tire_num">+36 23 311 658</a></td>
</tr>
<tr>
<td style="border: none; padding: 0; line-height: 20px;"></td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;"><a href="tel:+36209274887" class="phone_table_tire_num">+36 20 927 4877</a></td>
</tr>
<tr>
<td style="border: none; padding: 0; line-height: 20px;" class="phone_table_car">Autószerviz:</td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;"><a href="tel:+3623313003" class="phone_table_car_num">+36 23 313 003</a></td>
</tr>
<tr>
<td style="border: none; padding: 0; line-height: 20px;"></td>
<td style="border: none; padding: 0; line-height: 20px; padding-left: 5px; text-align: left;"><a href="tel:+36203134444" class="phone_table_car_num">+36 20 313 4444</a></td>
</tr>
</tbody>
</table>
<div style="clear:both;"></div>
</div>
</div>

</div>
</div>
</div>
</div>',
                'dark_mode' => 0,
                'created_at' => '2019-11-07 15:54:54',
                'updated_at' => '2019-11-19 19:23:51',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Hírek / Oldal cím háttérrel',
            'content' => '<section class="page-title" style="background-image:url(/images/background/page-title-1.jpg);">
<div class="auto-container">
<div class="row clearfix">
<!--Title -->
<div class="title-column col-md-6 col-sm-12 col-xs-12">
<h1>Hírek</h1>
</div>
<!--Bread Crumb -->
<div class="breadcrumb-column col-md-6 col-sm-12 col-xs-12">
<ul class="bread-crumb clearfix">
<li><a href="/index">Főoldal</a></li>
<li class="active">Hírek</li>
</ul>
</div>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => NULL,
                'updated_at' => '2020-04-01 15:01:43',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Hírek / tartalom',
                'content' => '<section class="why-choose-us">
<div class="auto-container">
<!--Centered Title-->
<div class="centered-title">
<h2>Nyitvatartás a koronavírus alatt</h2><p>Kedves barátaink,<br><br>Tisztelt ügyfeleink és partnereink.<br><br><br>A 2020.03.27 megjelent kormányrendelet továbbra is lehetővé teszi az autó javító műhelyek működését és az ügyfelek általi felkeresését.<br><br>A rendelet 4. §. sorolja fel, hogy mely tevékenységek számítanak alapos indoknak a lakhely elhagyásához, ezen felsorolás p) pontja tartalmazza, hogy a:<br><br>p) a gépjármű- és kerékpárszerviz, a mezőgazdasági és erdészeti gépek és berendezések<br>javításával kapcsolatos szolgáltatások igénybevétele,<br><br>alapos indoknak számít.<br><br><br>41/2020 (III.11.) Korm. rendeletben megfogalmazott koronavírus elleni óvintézkedések maximális figyelembevétele mellett&nbsp;<b>a 4Xtreme Kft a szokásos nyitvatartási időben áll rendelkezésetekre.</b><br><br>Munkatársaink telefonon és email-ban elérhetőek és mindent megteszünk annak érdekében, hogy elérhetőek is maradjanak.<br><br>Igyekszünk minden segítséget megadni annak érdekében, hogy minél tovább biztosítani tudjuk a műhelyek zavartalan működését, amennyiben ez tőlünk függ.<br><br>Ez a mostani helyzet mindannyiunk számára komoly kihívással jár és sok nehézséget okoz, de úgy gondolom, hogy közösen és együttműködve felül tudunk kerekedni ezeken a nehézségeken.<br><br>Mindenkinek jó egészséget kívánunk,<br>Vigyázzatok magatokra és egymásra.<br><br> A 4Xtreme csapata.<br></p>
</div>
</div>
</section>',
                'dark_mode' => 0,
                'created_at' => NULL,
                'updated_at' => '2020-04-01 15:02:20',
            ),
        ));
        
        
    }
}