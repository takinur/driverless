<?php
//Require Config
require_once "config.php";
//Set Tittle 
$title = "About US -Driverless";


//Include Header
include_once(ROOT . 'includes/header.php');



?>


<div class="wrapper">
  <div class="container-fluid">
    <h1 class="display-3 text-center">About Driverless Inc.</h1>
    <div class="row">
      <div class="card-columns">
        <div class="card">

          <div class="card-body">
            <h4 class="card-title">Frequently Asked Questions</h4>
            <p class="card-text">Please <a href="faq.php">visit this link </a> for all frequntly asked questions!</p>
          </div>
        </div>
        <div class="card">

          <div class="card-body">
            <h4 class="card-title">Contact US</h4>
            <p class="card-text">Reach to us by Contacting <a href="contact.php"> online. </a></p>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Technology</h4>
            <p class="card-text">Learn more about our advance AI and <a href="tech.php"> Technology.</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-6 text-center p-4">
        <h1 class="display-1 text-dark font-weight-bolder">01</h1>
      </div>
      <div class="col-md-6 text-left p-4">
        <h2 class="text-dark font-weight-bolder">What we do.</h2>
        <h4>Autonomous vehicle is a self-driving technology platform company. We build the software, hardware, maps, and cloud-support infrastructure that power self-driving vehicles.</h4>
      </div>
      <div class="col-md-6 text-center p-4">
        <h1 class="display-1 text-dark font-weight-bolder">02</h1>
      </div>
      <div class="col-md-6 text-left p-4">
        <h2 class="text-dark font-weight-bolder">Why we do it.</h2>
        <h4>Our purpose is to make getting around cities safe, easy, and enjoyable for all.</h4>
      </div>
      <div class="col-md-6 text-center p-4">
        <h1 class="display-1 text-dark font-weight-bolder">03</h1>
      </div>
      <div class="col-md-6 text-left p-4">
        <h2 class="text-dark font-weight-bolder">How we do it.</h2>
        <h4>Our team’s extensive experience in robotics and artificial intelligence complements our partners’ expertise in manufacturing high-quality vehicles at scale.</h4>
      </div>
    </div>
  </div>
</div>


<?php include_once(ROOT . 'includes/footer.php'); ?>