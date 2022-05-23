<?php
// Initialize session
session_start();

// If not logged in redirect to Login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../common/login.php");
  exit;
}

// Include config file
require_once "../config.php";

//Page Title
$title = "Reset Password -Autonomous Vehicles";



// Define Empty variables 
$cpass = $npass = "";
$cpass_err = $npass_err = "";

//Session Username
$uname = htmlspecialchars($_SESSION["username"]);

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate New Pass
  $in_pass = trim($_POST['npass']);
  // Pass strength 
  $uppercase = preg_match('@[A-Z]@', $in_pass);
  $lowercase = preg_match('@[a-z]@', $in_pass);
  $number    = preg_match('@[0-9]@', $in_pass);

  if (!$uppercase || !$lowercase || !$number || strlen($in_pass) < 6) {
    $npass_err = 'Choose a Strong Password !';
  } else {
    $npass = password_hash(
      $in_pass,
      PASSWORD_BCRYPT
    );
  }

  // Validate Current Pass 
  $in_cpass = trim($_POST["cpass"]);
  if (empty($in_cpass)) {
    $cpass_err = "Please enter Password.";
  } else {
    // Prepare sql statement to verify Password
    $sql = "SELECT uname, pass FROM users WHERE uname = ?";
    $stmt = $mysqli->prepare($sql);
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
      if (password_verify($in_cpass, $hash_pass)) {
        //Password Matched

        //Close Statement
        $stmt->close();
      } else {
        // Wrong Password
        $cpass_err = "Incorrect Password!";
      }
    }
  }

  // Check error before Update

  if (empty($cpass_err) && empty($npass_err)) {
    // Prepare SQL 
    $sql = "UPDATE users SET pass=? WHERE uname = ?";
    if ($stmt = $mysqli->prepare($sql)) {
      // Bind parameters
      $stmt->bind_param("ss", $p_pass, $p_uname);
      // Set parameters
      $p_pass = $npass;
      $p_uname = $uname;

      // Execute statement
      if ($stmt->execute()) {
        // Setting a Success cookie
        setcookie("modified", "Password Changed Successfully!", time() + 10);
        //Redirect to account Page        
        header("location: account.php");
      } else {
        echo "Something went wrong. Please try again later.";
      }
    }
  } //Close Statement
  $stmt->close();
}
//Include Header
include_once(ROOT . 'includes/header.php');
?>
<div class="wrapper">
  <div class="container-fluid">
    <div class="alert bg-danger text-white alert-dismissible fade show text-center" role="alert" <?= (!empty($at)) ? '' : 'Hidden'; ?>>
      <strong>Too Many Login Attempt!</strong> Please try again after some Time.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <div class="row d-flex align-items-center justify-content-center">
        <div class="col-md-4" style="padding: 20px 30px ; border: 15px solid #ccc">
          <h2 class="text-center">Reset Password</h2>
          <h5 class="text-dark text-center">Please fill your credintials to Change Password!</h5> <br>
          <!-- Current Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="cpass" class="form-control <?= (!empty($cpass_err)) ? 'is-invalid' : ''; ?> ">
            <label class="form-label">Current Password</label>
            <div class="<?= (!empty($cpass_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $cpass_err; ?></div>
          </div>
          <!-- New Password input -->
          <div class="form-outline mb-4">
            <input type="password" name="npass" id="npass" class="form-control <?= (!empty($npass_err)) ? 'is-invalid' : ''; ?>" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Password Should Contain: Minimum 6 characters with One Upper case and one Lower Case Letter and one number !">
            <label class="form-label ">New Password</label>
            <div class="<?= (!empty($npass_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $npass_err; ?></div>
          </div>
          <!-- Password Retype -->
          <div class="form-outline mb-4">
            <input type="password" name="rpass" id="rpass" class="form-control">
            <label class="form-label ">Re-type Password</label>
            <div class="text-white" id="perror"> </div>
          </div>
          <!-- Submit button -->
          <a href="account.php" class="btn btn-danger">Cancel </a>
          <input type="submit" class="btn btn-dark " id="repass" value="Update" disabled>
        </div>
      </div>
    </form>
  </div>
</div>



<?php include_once(ROOT . 'includes/footer.php'); ?>