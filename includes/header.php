<?php

//Start session if not Initialized already
if (session_id()) {
  //Already Started
} else {
  //Start New
  session_start();
}
//If loggedin get Session Username
$logged = false;
if (isset($_SESSION["loggedin"]) == true) {
  $logged = true;
  $us_name = htmlspecialchars($_SESSION["username"]);
}
//Current Page Link
$cu_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


?>

<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $title ?></title>
  <!--Font Awesome-->
  <link rel="stylesheet" href="<?= SERVER . 'assets/css/all.css'; ?>">
  <!--Bootstrap-->
  <link rel="stylesheet" href="<?= SERVER . 'assets/css/bootstrap.min.css '; ?>">
  <!--MDB-->
  <link rel="stylesheet" href="<?= SERVER . 'assets/css/mdb.min.css '; ?>">
  <!--Calender-->
  <link rel="stylesheet" href="<?= SERVER . 'assets/css/bootstrap-datepicker.min.css'; ?>" />
  <!--Custom Style-->
  <link rel="stylesheet" href="<?= SERVER . 'assets/css/style.css '; ?>">
  <!--Jquery---->
  <script type="text/javascript" src="<?= SERVER . 'assets/js/jquery.min.js'; ?>"></script>  

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?= SERVER ?>"><img src="<?= SERVER ?>assets/img/logoWhite.png"> </a>
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <!-- Links -->
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link text-white" aria-current="page" href="<?= SERVER . 'tech' ?>"><i class="fas fa-car"></i>Technology</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?= SERVER . 'faq' ?>"><i class="fas fa-info-circle"></i> F.A.Q</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="<?= SERVER . 'contact' ?>"><i class="fa fa-envelope"></i> Contact </a>
            </li>
            <!-- Navbar dropdown -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user"></i> <?= ($logged != true) ? 'Profile' : ucfirst($us_name); ?>
              </a>
              <!-- Dropdown menu -->
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" <?= $logged != true ? 'href="#" data-mdb-toggle="modal" data-mdb-target="#loginModal"' : 'href="' . SERVER . 'common/account"'; ?>><?= $logged != true ? 'Login' : 'My Account' ?></a></li>
                <li><a class="dropdown-item" <?= $logged != true ? 'href="' . SERVER . 'common/register"' : 'href="' . SERVER . 'common/logout.php?redirect=' . $cu_url . '"'; ?>><?= $logged != true ? 'Sign Up' : 'Logout' ?></a></li>
                <li>
                  <hr class="dropdown-divider" style="opacity: .25;" />
                </li>
                <li>
                  <a class="dropdown-item" href="<?= SERVER . 'about' ?>">About</a>
                </li>
              </ul>
            </li>
          </ul>
          <!-- Links -->
        </div>
      </div>
    </nav>
    <!--Modal for Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
          <div class="modal-header text-white bg-success">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="btn-close text-white" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5>Connect with:</h5>
            <form action="<?= SERVER . 'common/login.php' ?>" method="post">
              <div class="row mb-4 d-flex justify-content-center">
                <!-- Username input -->
                <div class="form-outline mb-4">
                  <input type="text" name="uname" id="uname" class="form-control" />
                  <label class="form-label" for="uname">User Name</label>
                </div>
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="input-pwd" name="password" class="form-control" />
                  <label class="form-label" for="password">Password</label>
                  <span toggle="#input-pwd" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
              </div>
              <!-- Submit button -->
              <button type="submit" class="btn btn-dark btn-rounded btn-block">Sign in</button>
              <div class="col">
                Don't have account? <a href="<?= SERVER . 'common/register' ?>">Register</a>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
 