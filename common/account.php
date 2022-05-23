<?php
// Initialize the session
session_start();

//  if not logged in, redirect  to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}
// Include config file
require_once "../config.php";

//Initialize Empty Variable
$fname = $lname = $uname = $email = $pass =  $phone = $dob = $gender = $address = $city = $state = $pcode = $country = "";
$fname_err = $lname_err = $uname_err = $email_err = $pass_err =  $phone_err = $dob_err = $gender_err = $address_err = $city_err = $state_err = $pcode_err = $country_err = "";

//Page Title
$title = "Account -Driverless";

//Session Username
$uname = htmlspecialchars($_SESSION["username"]);

// Prepare SQL 
$sql = "SELECT * FROM users WHERE uname = ?";
if ($stmt = $mysqli->prepare($sql)) {
  // Bind Parameter
  $stmt->bind_param("s", $pa_uname);
  // Set parameters
  $pa_uname = $uname;
  //Excute Statement
  $stmt->execute();
  // Fetch result
  $result = $stmt->get_result();
  //Store to array
  if ($result->num_rows == 1) {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    //Rows to Vairable 

    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $address = $row['addrs'];
    $city = $row['city'];
    $state = $row['cstate'];
    $pcode = $row['pcode'];
  } else {
    echo "Sorry! Something Went Wrong!";
  }
  //Close Statement
  $stmt->close();
}

//Include Header
include_once(ROOT . 'includes/header.php');
?>
<div class="wrapper">
  <div class="container-fluid">

    <div class=" text-center d-flex justify-content-center">
      <h1>Hi, <b><?= ucfirst($uname); ?></b>. Good to see you again.</h1>
    </div>
    <hr />
    <!--Modal for Message /Alert-->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content text-center">
          <div class="modal-header text-white bg-danger">
            <h5 class="modal-title" id="alertModalLabel">Information</h5>
            <button type="button" class="btn-close text-white" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ">
            <h5 id="msg"><?= (isset($_COOKIE["modified"])) ? $_COOKIE["modified"] . "<script> $(window).on('load', function() {
            $('#alertModal').modal('show');
          }); </script>" : ''; ?></h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">
              OK
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="container emp-profile">
      <div class="row">
        <div class="col-md-6">
          <div class="profile-head">
            <h4 class="text-success">
              <?= $fname . " " . $lname; ?>
            </h4>
            <h5>
              <?= $email; ?>
            </h5><br>
            <a href="reset-password.php" class="btn btn-dark">Change Password</a>
            <hr />
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active font-weight-bold" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Address</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-info" data-mdb-toggle="modal" data-mdb-target="#profileModal">
            <span class=''>Edit Profile</span>
          </button> <br> <br>
          <a href="../common/logout.php" class="btn btn-danger"> &nbsp;&nbsp;&nbsp;Sign Out&nbsp;&nbsp; &nbsp;</a>
        </div>
      </div>
      <div class="col-md-8">
        <div class="tab-content profile-tab" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">User Name:</label>
              </div>
              <div class="col-md-6">
                <p> <?= $uname; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">Email:</label>
              </div>
              <div class="col-md-6">
                <p> <?= $email; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">Phone:</label>
              </div>
              <div class="col-md-6">
                <p> <?= $phone; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">Date Of Birth:</label>
              </div>
              <div class="col-md-6">
                <p><?= $dob; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">Gender:</label>
              </div>
              <div class="col-md-6">
                <p><?= $gender; ?></p>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">Street:</label>
              </div>
              <div class="col-md-6">
                <p><?= $address; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">City:</label>
              </div>
              <div class="col-md-6">
                <p><?= $city; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">State:</label>
              </div>
              <div class="col-md-6">
                <p><?= $state; ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="text-dark font-weight-bold">Post Code:</label>
              </div>
              <div class="col-md-6">
                <p><?= $pcode; ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include_once(ROOT . 'common/update-profile.php'); ?>

  <div class="container">
    <!--Modal for Profile UPDATE -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content text-center">
          <div class="modal-header text-white bg-success">
            <h5 class="modal-title" id="profileModalLabel">Update Profile</h5>
            <button type="button" class="btn-close text-white" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="alert alert-info" role="alert">To Change Username or Email, Please Contact Administrator!</div>
            <hr />
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="row g-3">
                <div class="col-sm">
                  <div class="form-outline mb-4">
                    <input type="text" name="fname" class="form-control <?= (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?= $fname ?>" maxlength="40">
                    <label class="form-label" for="uname">First Name</label>
                    <div class="<?= (!empty($fname_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $fname_err; ?></div>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-outline mb-4">
                    <input type="text" name="lname" class="form-control <?= (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?= $lname ?>" maxlength="40">
                    <label class="form-label">Last Name</label>
                    <div class="<?= (!empty($lname_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $lname_err; ?></div>
                  </div>
                </div>
              </div>
              <div class="row g-3">
                <div class="col-sm">
                  <div class="form-outline mb-4">
                    <input type="tel" name="phone" class="form-control <?= (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?= $phone ?>">
                    <div class="<?= (!empty($phone_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $phone_err; ?></div>
                    <label class="form-label">Phone Number</label>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-outline mb-4">
                    <input type="text" name="dob" class="form-control <?= (!empty($dob_err)) ? 'is-invalid' : ''; ?>" value="<?= (!empty($dob)) ? $dob : 'DD/MM/YYYY'; ?>" readonly>
                    <div class="<?= (!empty($dob_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $dob_err; ?></div>
                    <label class="form-label">Date of Birth</label>
                  </div>
                </div>
              </div>
              <div class="row g-3">
                <div class="col-sm-4">
                  <div class="form col-mb-2">
                    <select name="gender" style="background-color: transparent;" id="gender" class="form-control <?= (!empty($gender_err)) ? 'is-invalid' : ''; ?>" value="<?= $gender ?>">
                      <option value="">Gender</option>
                      <option value="Male" <?= ($gender == 'Male') ? 'selected="selected"' : ''; ?>>Male</option>
                      <option value="Female" <?= ($gender == 'Female') ? 'selected="selected"' : ''; ?>>Female</option>
                      <option value="Other" <?= ($gender == 'Other') ? 'selected="selected"' : ''; ?>>Other</option>
                    </select>
                    <div class="<?= (!empty($gender_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $gender_err; ?></div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline mb-4">
                    <input type="text" name="address" class="form-control <?= (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?= $address ?>">
                    <div class="<?= (!empty($address_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $address_err; ?></div>
                    <label class="form-label">Address</label>
                  </div>
                </div>
              </div>
              <div class="row g-3">
                <div class="col-sm">
                  <div class="form-outline mb-4">
                    <input type="text" name="city" class="form-control <?= (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?= $city ?>" maxlength="20">
                    <div class="<?= (!empty($city_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $city_err; ?></div>
                    <label class="form-label">City</label>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-outline mb-4">
                    <input type="text" name="state" class="form-control <?= (!empty($state_err)) ? 'is-invalid' : ''; ?>" value="<?= $state ?>">
                    <div class="<?= (!empty($state_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $state_err; ?></div>
                    <label class="form-label">State</label>
                  </div>
                </div>
                <div class="col-sm">
                  <div class="form-outline mb-4">
                    <input type="text" name="pcode" class="form-control <?= (!empty($pcode_err)) ? 'is-invalid' : ''; ?>" value="<?= $pcode ?>" maxlength="20">
                    <div class="<?= (!empty($pcode_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $pcode_err; ?></div>
                    <label class="form-label">ZIP Code</label>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">
              Cancel
            </button>
            <input type="submit" class="btn btn-info " value="Update">
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once(ROOT . 'includes/footer.php'); ?>