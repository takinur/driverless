<?php
//Require Config
require_once "config.php";
//Set Tittle
$title = "Frequently asked questions";


//Include Header
include_once(ROOT . 'includes/header.php');


?>
<div class="container-fluid">
<div class="row" >
    <div class="col-md-12">
        <div class="section-title text-center">
            <h1>Frequently Asked Questions</h1>         
            <p>Please read this F.A.Q section for you answers.</p>
        </div>
    </div>
</div>
    <?php include_once(ROOT . 'includes/faqContent.php');?>
</div>




<?php include_once(ROOT . 'includes/footer.php'); ?>