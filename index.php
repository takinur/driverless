<?php
//Check if config available
if (!file_exists('config.php')) {
  header('location:install.php');
  die();
}
//Require Config
require_once "config.php";
//Set Tittle and Current Page
$title = "Wellcome -Driverless Inc";


//Multidimensional Array for Banners
//Set source url, alt text and lbl with extra text(if NEED) 
//Resize images
$banner = [
  '1st_slider' => ['url' => 'assets/img/model-s.jpg', 'alt' => 'Model S', 'lbl' => 'The Model S ', 'text' => 'Most advanced Electric car'],
  '2nd_slider' => ['url' => 'assets/img/model-u.jpg', 'alt' => 'Testing auto car', 'lbl' => 'Test cars for development', 'text' => ''],
  '3rd_slider' => ['url' => 'assets/img/tech-n.png', 'alt' => 'Atrifical', 'lbl' => 'Advance AI', 'text' => ''],
  '1st_banner' => ['url' => 'assets/img/model-t.jpg', 'alt' => 'model-t', 'lbl' => '', 'text' => ''],
  '2nd_banner' => ['url' => 'assets/img/model-r.jpg', 'alt' => 'model r', 'lbl' => '', 'text' => ''],

];

//Include Header
include_once(ROOT . 'includes/header.php');

?>
<div class="wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <!-- Carousel wrapper -->
        <div id="carouselDarkVariant" class="carousel slide carousel-fade " data-mdb-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="0" class="active"></li>
            <li data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="1"></li>
            <li data-mdb-target="#carouselDarkVariant" data-mdb-slide-to="2"></li>
          </ol>
          <!-- Inner -->
          <div class="carousel-inner">
            <!-- First item -->
            <div class="carousel-item active">
              <img src="<?= $banner['1st_slider']['url'] ?>" class="d-block w-100" alt="<?= $banner['1st_slider']['alt'] ?>" />
              <div class="carousel-caption d-none d-md-block">
                <h5><?= $banner['1st_slider']['lbl'] ?></h5>
                <p><?= $banner['1st_slider']['text'] ?></p>
              </div>
            </div>
            <!-- Second item -->
            <div class="carousel-item">
              <img src="<?= $banner['2nd_slider']['url'] ?>" class="d-block w-100" alt="<?= $banner['2nd_slider']['alt'] ?>" />
              <div class="carousel-caption d-none d-md-block">
                <h5><?= $banner['2nd_slider']['lbl'] ?></h5>
                <p><?= $banner['2nd_slider']['text'] ?></p>
              </div>
            </div>
            <!-- Third item -->
            <div class="carousel-item">
              <img src="<?= $banner['3rd_slider']['url'] ?>" class="d-block w-100" alt="<?= $banner['3rd_slider']['alt'] ?>" />
              <div class="carousel-caption d-none d-md-block">
                <h5><?= $banner['3rd_slider']['lbl'] ?></h5>
                <p><?= $banner['3rd_slider']['text'] ?></p>
              </div>
            </div>
          </div>
          <!-- Inner -->
          <!-- Controls -->
          <a class="carousel-control-prev" href="#carouselDarkVariant" role="button" data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselDarkVariant" role="button" data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </a>
        </div>
        <!-- Carousel wrapper -->
      </div>
      <div class="col-md-4">
        <div class="row">
          <!-- Banners -->
          <div class="col-md-12">
            <img src="<?= $banner['1st_banner']['url'] ?>" class="d-block w-100" alt="<?= $banner['1st_banner']['alt'] ?>" />
            <div class="carousel-caption d-none d-md-block">
              <h5><?= $banner['1st_banner']['lbl'] ?></h5>
              <p><?= $banner['1st_banner']['text'] ?></p>
            </div>
          </div>
          <div class="col-md-12" style="margin-top: 10px;">
            <img src="<?= $banner['2nd_banner']['url'] ?>" class="d-block w-100" alt="<?= $banner['2nd_banner']['alt'] ?>" />
            <div class="carousel-caption d-none d-md-block">
              <h5><?= $banner['2nd_banner']['lbl'] ?></h5>
              <p><?= $banner['2nd_banner']['text'] ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!---Introductions-->
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h1 class="card-title display-4 text-center text-dark font-weight-bold text-uppercase">Committed to doing it the right way.</h1>
          <p class="card-text">
            Safety is more than a value, it’s our way of working every day. We don’t subscribe to unrealistic timelines. And we don’t play into industry hype. We’re guided by leaders who have devoted their lives to robotics and who know that the success of self-driving depends on collaboration between automakers, technology providers, governments, and communities.
          </p>
        </div>
      </div>
    </div>
    <!--- 3 Headlines --->
    <div class="row g-4">
      <div class="col-md-6 text-center p-4" data-aos="fade-in" data-aos-duration="1000">
        <h1 class="display-1 text-dark font-weight-bolder">01</h1>
      </div>
      <div class="col-md-6 text-left p-4" data-aos="fade-in" data-aos-duration="1000">
        <h2 class="text-dark font-weight-bolder">What we do.</h2>
        <h4>Autonomous vehicle is a self-driving technology platform company. We build the software, hardware, maps, and cloud-support infrastructure that power self-driving vehicles.</h4>
      </div>
      <div class="col-md-6 text-center p-4" data-aos="fade-in" data-aos-duration="1000">
        <h1 class="display-1 text-dark font-weight-bolder">02</h1>
      </div>
      <div class="col-md-6 text-left p-4" data-aos="fade-in" data-aos-duration="1000">
        <h2 class="text-dark font-weight-bolder">Why we do it.</h2>
        <h4>Our purpose is to make getting around cities safe, easy, and enjoyable for all.</h4>
      </div>
      <div class="col-md-6 text-center p-4" data-aos="fade-in" data-aos-duration="1000">
        <h1 class="display-1 text-dark font-weight-bolder">03</h1>
      </div>
      <div class="col-md-6 text-left p-4" data-aos="fade-in" data-aos-duration="1000">
        <h2 class="text-dark font-weight-bolder">How we do it.</h2>
        <h4>Our team’s extensive experience in robotics and artificial intelligence complements our partners’ expertise in manufacturing high-quality vehicles at scale.</h4>
      </div>
    </div>
    <!--Offer with Timer-->
    <div class="row">
      <div class="col" data-aos="zoom-in-left" data-aos-duration="1200">
        <div class="bg-image">
          <img src="assets/img/offer.jpg" class="img-fluid" />
          <div class="mask display-1 text-info d-flex justify-content-center  font-weight-bold">Exclusive winter offer</div>
          <div class="mask d-inline-block g-2 display-1 " id="timer">
            <div class="d-flex justify-content-center align-items-center h-100">
              <div class="float-left p-4 text-primary " id="days"></div>
              <div class="float-left p-4 text-success" id="hours"></div>
              <div class="float-left p-4 text-danger" id="minutes"></div>
              <div class="float-left p-4 text-dark" id="seconds"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="section feature-box">
      <!--Section heading-->
      <h1 class="section-heading pt-4" data-aos="fade-right" data-aos-duration="1500">Why Autonomous Vehicles?</h1>
      <!--Section description-->
      <p class="section-description lead text-dark" data-aos="fade-right" data-aos-duration="1400">Autonomously driven vehicles hold the promise to improve road safety and offer new mobility options to millions of people.</p>
      <!--Grid row-->
      <div class="row features-big">
        <!--Grid column-->
        <div class="col-md-4 mb-r" data-aos="zoom-in-down" data-aos-duration="1000">
          <h3> <i class="fab fa-airbnb text-secondary"></i>
            Advance AI </h3>
          <p class="grey-text">We briefly developed advance AI that can estimate future. We build technology to empower mobility products that offer choice</p>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-4 mb-r" data-aos="zoom-in-down" data-aos-duration="1000">
          <h3> <i class="fas fa-shield-alt text-secondary"></i>
            Secure</h3>
          <p class="text-grey">Our servers are encrypted with multiple verification process and we dont sell / Share customers personnal Informations to any third party. </p>
        </div>
        <!--Grid column-->
        <!-- Never Stop V -->
        <!--Grid column-->
        <div class="col-md-4 mb-r" data-aos="zoom-in-down" data-aos-duration="1000">
          <h3> <i class="fas fa-share-alt text-success"></i>
            Safe </h3>
          <p class="text-grey">Safety is at the heart of everything we do. Our aim is to be as rigorous and innovative in our safety practices as we are with our technology.</p>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </section>
    <!---Twitter FEED --->
    <div class="row d-flex justify-content-center g-3">
      <div class="col-md-4 p-4">
        <a class="twitter-timeline" data-width="520" data-height="600" href="https://twitter.com/CARandDRIVER?ref_src=twsrc%5Etfw">Update from Twitter</a>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
      <div class="col-md-6 p-4">
        <!-- Content from CEO or  unsure -->
        <div class="card">
          <h4 class="card-header">Company with great vision</h4>
          <div class="card-body">
            <h5 class="card-title"> Every City is Unique </h5>
            <p class="card-text">
              <br>
              Road infrastructure, laws and regulations, bicycle use, foot traffic, and driving habits are among the variables that make each city unique.
              <br><br>
              Just as endurance athletes put their bodies to the test by varying their workout routines, we train our self-driving technology in multiple cities so that it doesn’t become overtuned to one environment.
              <br><br>
              We know that if we can build technology that works in diverse environments, we can boost our positive impact — and hasten the arrival of our technology’s benefits. <br> <br> <br>
              We’re making it safe and easy to get around - without the need for anyone in the driver’s seat.<br>
              Today we’re testing in six cities so that we can scale faster tomorrow. <br>
              <hr /> Our mission is not to replace the personal freedom that driving provides, but rather to build technology to empower mobility products that offer choice
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Google Map --->
  <div class="row text-center g-3">
    <div class="col-lg-12 justify-content-end align-items-center">
      <h1 class="text-uppercase text-darkfont-weight-bold">Visit us anyday between 10:00 to 19:00 UK time.</h1>
      <hr id="tagline" style="border-top: 3px solid #F4623A;" />
    </div>
    <div class="col d-flex justify-content-lg-center">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d151986.00551788133!2d-2.3635472397725374!3d53.4723679049385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487a4d4c5226f5db%3A0xd9be143804fe6baa!2sManchester%2C%20UK!5e0!3m2!1sen!2sbd!4v1611136638700!5m2!1sen!2sbd" width="1230" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
  </div>
  <!-- Relevent Site Links -->
  <section class="section feature-box">
    <!--Section heading-->
    <h1 class="section-heading pt-4 text-center text-dark">Follow our Journey</h1>
    <hr id="tagline" style="border-top: 3px solid #F4623A; margin-left:47%;" />
    <!--Grid row-->
    <div class="row features-big justify-content-center">
      <!--Grid column-->
      <div class="col-md-4 mb-r">
        <div class="card">
          <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
            <img src="assets/img/gt-thumb.png" class="img-fluid" />
            <a href="https://groundtruthautonomy.com">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
            </a>
          </div>
          <div class="card-body">
            <h5 class="card-title text-dark">Ground Truth</h5>
            <p class="card-text">
              GROUND TRUTH is an inside look at the development and deployment of self-driving technology from the test benches to simulation labs, and from closed test tracks to city streets.
            </p>
            <a href="https://groundtruthautonomy.com" class="btn btn-outline-primary">Learn More&nbsp;<i class="fas fa-greater-than"></i></a>
          </div>
        </div>
      </div>
      <!--Grid column-->
      <div class="col-md-4 mb-r">
        <div class="card">
          <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
            <img src="assets/img/ltad.png" class="img-fluid" />
            <a href="https://ltad.com">
              <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>
            </a>
          </div>
          <div class="card-body">
            <h5 class="card-title text-dark">Let's Talk Autonomous Driving</h5>
            <p class="card-text">
              Let’s Talk Autonomous Driving is the world’s first public education initiative around autonomous driving technology. It brings together a diverse group of communities and interests to save lives.
            </p>
            <a href="https://ltad.com" class="btn btn-outline-primary">Learn More &nbsp;<i class="fas fa-greater-than"></i></a>
          </div>
        </div>
      </div>
      <!--Grid row-->
  </section>
</div>

<!-- Animated Scroll Style--->
<link rel="stylesheet" href="assets/css/aos.css">
<script src="assets/js/aos.js"></script>
<script>
  AOS.init();
</script>

<?php include_once(ROOT . 'includes/footer.php'); ?>