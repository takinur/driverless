<?php
//Require Config
require_once "config.php";
//Set Tittle 
$title = "Technology we use -Autonomous Vehicle";

//Include Header
include_once(ROOT . 'includes/header.php');

?>


    <!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 d-flex align-items-center justify-content-center text-center">
            <div class="col-lg-10 justify-content-end align-items-center">
                <h1 class="text-uppercase text-white font-weight-bold">The World's Most Experinced Driver</h1>
                <hr id="tagline" style="border-top: 3px solid #F4623A;" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-50 font-weight-light mb-5">We’ve put the auto Driver through the world’s longest and toughest ongoing driving test, through millions of miles on public roads and billions of miles in simulation. That’s hundreds of years of human driving experience that benefits every vehicle in our fleet. With every mile we drive, we never stop learning.</p>
                <a class="btn btn-secondary btn-rounded btn-lg js-scroll-trigger font-weight-bolder" href="#vision" style="background-color: #F4623A;">Find Out More</a>
            </div>
        </div>
    </div>
</header>
<!-- Visions-->
<section class="page-section" id="vision" style="background-color: #F4623A;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0 text-capitalize">We're building self-driving technology you can Trust!</h2>
                <hr id="tagline" style=" border-top: 3px solid #fff;" />
                <p class="text-white-50 mb-4">Our mission is not to replace the personal freedom that driving provides, but rather to build technology to empower mobility products that offer choice.</p>
                <a class="btn btn-light btn-rounded btn-lg text-dark font-weight-bolder js-scroll-trigger" href="#services">Learn More!</a>
            </div>
        </div>
    </div>
</section>
<!--Third Part/Services-->
<section class="page-section bg-white" id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-center mt-0">Take one step further to future!</h2>
                <hr id="tagline" style="border-top: 3px solid #F4623A;" />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-map-marker-alt fa-4x mb-4" style="color: #F4623A;"></i>
                    <h3 class="h4 mb-2 text-dark">Test Locations</h3>
                    <p class="text-muted mb-0">We’ve tested the auto Driver across multiple locations in the U.K. By driving every day in different types of real-world conditions, we teach our Driver to navigate through all sorts of situations.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-street-view fa-4x mb-4" style="color: #F4623A;"></i>
                    <h3 class="h4 mb-2 text-dark">360° Experince</h3>
                    <p class="text-muted mb-0">Before the auto Driver can operate in any location, our team builds our own detailed three-dimensional maps that highlight information such as road profiles, curbs and sidewalks, lane markers, crosswalks, traffic lights, stop signs, and other road features.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fab fa-artstation fa-4x mb-4" style="color: #F4623A;"></i>
                    <h3 class="h4 mb-2 text-dark">Argument Reality</h3>
                    <p class="text-muted mb-0">The auto Driver's sensors and software scan constantly for objects around the vehicle—pedestrians, cyclists, vehicles, road work, obstructions—and continuously read traffic controls, from traffic light color and railroad crossing gates to temporary stop signs.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-cogs fa-4x mb-4" style="color: #F4623A;"></i>
                    <h3 class="h4 mb-2 text-dark">Advance A.I</h3>
                    <p class="text-muted mb-0">Our software predicts the movements of everything around us based on their speed and trajectory. Based on all this information, the auto Driver determines the exact trajectory, speed, lane, and steering maneuvers needed to progress along this route safely.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact-->
<section class="page-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mt-0">Let's Get In Touch!</h2>
                <hr id="tagline" style="border-top: 3px solid #F4623A;" />
                <p class="text-muted mb-5">Interested to get an Autonomous Car? Give us a call or send us an email and we will get back to you as soon as possible!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                <div>(00) 121212 1111</div>
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                <a class="d-block" href="mailto:info@autovh.com.uk">info@autovh.com.uk</a>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg text-center p-4">
                <a class="d-block" href="<?=SERVER .'contact.php'?> "><i class="fas fa-globe fa-3x mb-3 text-muted"></i>
                <br>More way to Contact!</a>
            </div>
        </div>
    </div>
</section>





<?php include_once(ROOT . 'includes/footer.php'); ?>