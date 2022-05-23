<?php

//Initialize  session
session_start();

// If already logged in redirect to Account Page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: account.php");
  exit;
}
//Check if Ban time Over
if (isset($_SESSION['attempt_again'])) {
  $now = time();
  if ($now >= $_SESSION['attempt_again']) {
    unset($_SESSION['attempt']);
    unset($_SESSION['attempt_again']);
  }
}
//set login attempt
if (!isset($_SESSION['attempt'])) {
  $_SESSION['attempt'] = 0;
}

// Include config file
require_once "../config.php";
//Page Title
$title = "Login -Driverless";


// Define Empty variables 
$uname = $password = "";
$uname_err = $password_err = $at = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate uname
  if (empty(trim($_POST["uname"]))) {
    $uname_err = "Please enter User Name.";
  } else {
    $uname = strtolower(trim($_POST["uname"]));
  }

  // Validate Pass
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }


  // Check error before submit
  if (empty($uname_err) && empty($password_err)) {
    //If 3 attempts already
    if ($_SESSION['attempt'] == 3) {
      $at = true;
    } else {
      // Prepare SQL 
      $sql = "SELECT uname, pass FROM users WHERE uname = ?";
      if ($stmt = $mysqli->prepare($sql)) {
        // Bind Parameter
        $stmt->bind_param("s", $pa_uname);
        // Set parameters
        $pa_uname = $uname;
        //Excute Statement
        $stmt->execute();
        // Store result
        $stmt->store_result();
        //Check Username
        if ($stmt->num_rows == 1) {
          // Bind Results
          $stmt->bind_result($uname, $hash_pass);
          $stmt->fetch();
          //Verify Password
          if (password_verify($password, $hash_pass)) {
            //Password Matched
            session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $uname;
            //Unset attempt
            unset($_SESSION['attempt']);

            // Redirect to Home page
            header("location: ../index.php");
          } else {
            //Password Not Matched
            $password_err = "Incorrect password.";
            //Set Attempt for user
            $_SESSION['attempt']++;
            //Set Ban Duration
            if ($_SESSION['attempt'] == 3) {
              $_SESSION['attempt_again'] = time() + (10 * 60);
            }
          }
        } else { //User Not Found
          $uname_err = "Username not found!";
        }
      }
      // Close statement
      $stmt->close();
    } 
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
        <!-- Login Attempt Error -->
        <div class="alert bg-danger text-white alert-dismissible fade show text-center" role="alert" <?= (!empty($at)) ? '' : 'Hidden'; ?>>
          <strong>Too Many Login Attempt!</strong> Please try again after<b> <?= date('i', $_SESSION['attempt_again'] - time()); ?> Minute </b> approx.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card">
          <div class="row">
            <div class="col-sm-6 bg-secondary text-center text-white p-5">
              <p class="h2"> Wellcome Back</p>
              <p class="h4">Please login to your account. </p>
              <p class="h5" style="margin-top: 4em;">Join with us in Social Media</p>
              <!--Social Links -->
              <a href="https://www.fb.com/autonomus-vehicle" target="_blank" class="btn btn-primary" style="background-color: #3b5998" role="button">
                <i class="fab fa-facebook-f" aria-hidden="true"></i>
              </a>
              <a href="https://www.twitter.com/autonomus-vehicle" target="_blank" class="btn btn-primary" style="background-color: #55acee" role="button">
                <i class="fab fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="https://www.youtube.com/autonomus-vehicle" target="_blank" class="btn btn-primary" style="background-color: #ed302f" role="button">
                <i class="fab fa-youtube" aria-hidden="true"></i>
              </a>
              <a href="https://www.linkedin.com/autonomus-vehicle" target="_blank" class="btn btn-primary" style="background-color: #0082ca" role="button">
                <i class="fab fa-linkedin" aria-hidden="true"></i>
              </a>
            </div>
            <div class="col-md-6">
              <!---Login Form -->
              <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="row d-flex align-items-center justify-content-center p-5">
                  <div class="col-md">
                    <h2 class="text-center">Login</h2>
                    <h5 class="text-dark text-center text-muted">Please fill your credintials to login!</h5> <br>
                    <!-- Username input -->
                    <div class="form-outline mb-4">
                      <input type="text" name="uname" id="uname" class="form-control <?= (!empty($uname_err)) ? 'is-invalid' : ''; ?>" value="<?= $uname ?>">
                      <label class="form-label" for="uname">User Name</label>
                      <div class="<?= (!empty($uname_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $uname_err; ?></div>
                    </div>
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" name="password" id="input-pass" class="form-control <?= (!empty($password_err)) ? 'is-invalid' : ''; ?> ">
                      <label class="form-label" for="password">Password</label>
                      <span toggle="#input-pass" class="fa fa-fw fa-eye field-icon help-password"></span>
                      <div class="<?= (!empty($password_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $password_err; ?></div>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-dark btn-block btn-rounded" style="margin-bottom: 20px;">Sign in</button>
                    Don't have account? <a href="<?= SERVER . 'common/register.php' ?>">Register</a>
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