<?php

//Initialize  session
session_start();

// If already logged in redirect to Admin Panel
if (isset($_SESSION["adloggedin"]) && $_SESSION["adloggedin"] === true) {
  header("location: index.php");
  exit;
}

// Include config file
require_once "../config.php";
//Page Title
$title = "Administration -Driverless";


// Define Empty variables 
$uname = $password = $err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Name
  $uname = strtolower(trim($_POST["uname"]));

  // Password  
  $password = trim($_POST["password"]);

  if ($uname == 'admin' && $password == 'Admin123') {
    session_start();
    $_SESSION["adloggedin"] = true;
    // Redirect to Admin page
    header("location: index.php");
  } else {
    //Password Not Matched
    $err = "Incorrect password or Username.";
  }
}
//Include Header
include_once(ROOT . 'includes/header.php');
?>
<style>
  .image {
    min-height: 100vh;
  }

  .bg-image {
    background-image: url('../assets/img/offer.jpg');
    background-size: cover;
    background-position: center center;
  }
</style>
<div class="wrapper">
  <div class="container-fluid">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8">
        <!-- Login  Error -->
        <div class="alert bg-info text-white alert-dismissible fade show text-center" role="alert" <?= (!empty($err)) ? '' : 'Hidden'; ?>>
          <strong> <?=$err?>  </strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card">
          <div class="row">
            <div class="col-sm-6 bg-secondary text-center text-white p-5">
              <p class="h2"> Wellcome Back</p>
              <p class="h4">Please login to your account. </p>
              <p class="h5" style="margin-top: 4em;">Having trouble to login?</p>
              <a href="#" class="btn btn-outline-black" > <b>Developer Contact!</b> </a>
            </div>
            <div class="col-md-6">
              <!---Login Form -->
              <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="row d-flex align-items-center justify-content-center p-5">
                  <div class="col-md">
                    <h2 class="text-center">Administration</h2>
                    <h5 class="text-dark text-center text-muted">Please fill your credintials to login!</h5> <br>
                    <!-- Username input -->
                    <div class="form-outline mb-4">
                      <input type="text" name="uname" id="uname" class="form-control">
                      <label class="form-label" for="uname">User Name</label>                      
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" name="password" id="input-pass" class="form-control ">
                      <label class="form-label" for="password">Password</label>
                      <span toggle="#input-pass" class="fa fa-fw fa-eye field-icon help-password"></span>                      
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-dark btn-block btn-rounded" style="margin-bottom: 20px;">Sign in</button>
                    Forget Password? <a href="#">Reset</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Footer -->
<?php include_once(ROOT . 'includes/footer.php'); ?>