<?php

// If already logged in redirect to Account Page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: account.php");
    exit;
}
// Include config file
require_once "../config.php";

// Page Title
$title = "Register New Account";


// Define Empty variables
$fname = $lname = $uname = $email = $pass =  $phone = $dob = $gender = $address = $city = $state = $pcode = $country = "";
$fname_err = $lname_err = $uname_err = $email_err = $pass_err =  $phone_err = $dob_err = $gender_err = $address_err = $city_err = $state_err = $pcode_err = $country_err = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate First Name
    $in_fname = trim($_POST["fname"]);
    if (empty($in_fname)) {
        $fname_err = "Please enter First Name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $in_fname)) {
        $fname_err = "Please enter a valid First Name.";
    } else {
        $fname = $in_fname;
    }
    // Validate Last Name
    $in_lname = trim($_POST["lname"]);
    if (empty($in_lname)) {
        $lname_err = "Please enter Last Name.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $in_lname)) {
        $lname_err = "Please enter a valid Last Name.";
    } else {
        $lname = $in_lname;
    }

    // Validate Email
    $in_email = trim($_POST["email"]);
    if (empty($in_email)) {
        $email_err = "Please enter an Email.";
    } elseif (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $in_email)) {
        $email_err = "Please enter a Valid Email.";
    } else {
        $email = $in_email;
    }
    //Validate Username
    $in_uname = trim($_POST["uname"]);
    if (empty($in_uname)) {
        $uname_err = "Please enter User Name.";
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/", $in_uname)) {
        $uname_err = "Please enter a valid User Name.";
    } else {
        // Prepare statement to Check If username EXISTS
        $sql = "SELECT uid, uname FROM users WHERE uname = ?";

        $stmt = $mysqli->prepare($sql);

        // Bind statement
        $stmt->bind_param("s", $pa_uname);

        // Set parameters
        $pa_uname = trim($in_uname);

        // Exceute statement
        $stmt->execute();

        // Store result
        $result = $stmt->get_result();

        // Check User name
        if ($result->num_rows == 1) {
            // Results Exist
            $uname_err = "Username is Already Taken by Another User! ";
        } else {
            // -If dont exist Results
            $uname = strtolower($in_uname);
        }
    }

    // Validate Pass
    $in_pass = trim($_POST['password']);
    // Pass strength 
    $uppercase = preg_match('@[A-Z]@', $in_pass);
    $lowercase = preg_match('@[a-z]@', $in_pass);
    $number    = preg_match('@[0-9]@', $in_pass);

    if (!$uppercase || !$lowercase || !$number || strlen($in_pass) < 6) {
        $pass_err = 'Password Should Contain: Minimum 6 characters, One Upper case and one Lower Case Letter and one number !';
    } else {
        $pass = password_hash(
            $in_pass,
            PASSWORD_BCRYPT
        );
    }
    // Validate Phone
    $in_phone = trim($_POST["phone"]);
    if (empty($in_phone)) {
        $phone_err = "Please enter Phone.";
    } elseif (!ctype_digit($in_phone)) {
        $phone_err = "Please enter a valid Phone.";
    } else {
        $phone = $in_phone;
    }
    // Validate DOB
    $in_dob = trim($_POST["dob"]);
    if (empty($in_dob)) {
        $dob_err = "Please Select Date of Birth.";
    } elseif ($in_dob == "DD/MM/YYYY") {
        $dob_err = "Please Select Date of Birth.";
    } else {
        $dob = $in_dob;
    }
    // Validate Gender
    $in_gender = trim($_POST["gender"]);
    if (empty($in_gender)) {
        $gender_err = "Please Select Gender";
    } else {
        $gender = $in_gender;
    }

    // Validate Address
    $in_add = trim($_POST["address"]);
    if (empty($in_add)) {
        $address_err = "Please enter an Address.";
    } else {
        $address = $in_add;
    }
    //Validate City
    $in_city = trim($_POST["city"]);
    if (empty($in_city)) {
        $city_err = "Please enter City.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/", $in_city)) {
        $city_err = "Please enter a valid City.";
    } else {
        $city = $in_city;
    }
    // Validate State
    $in_state = trim($_POST["state"]);
    if (empty($in_state)) {
        $state_err = "Please enter State.";
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/", $in_state)) {
        $state_err = "Please enter a valid State name.";
    } else {
        $state = $in_state;
    }
    // Validate Pcode
    $in_pcode = trim($_POST["pcode"]);
    if (empty($in_pcode)) {
        $pcode_err = "Please enter Post Code.";
    } elseif (!ctype_digit($in_pcode)) {
        $pcode_err = "Please enter a valid Post Code.";
    } else {
        $pcode = $in_pcode;
    }

    // Check input errors before inserting in database

    if (
        empty($fname_err) && empty($lname_err) && empty($uname_err) && empty($email_err) && empty($pass_err) && empty($phone_err) &&
        empty($dob_err) && empty($gender_err) && empty($address_err) && empty($city_err) && empty($state_err) && empty($pcode_err)
    ) {

        // insert statement
        $sql = "INSERT INTO users(fname, lname, uname, email, pass, phone, dob, gender, addrs, city, cstate, pcode) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        //Prepare Statement
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssssssssssss", $p_fname, $p_lname, $p_uname, $p_email, $p_pass, $p_phone, $p_dob, $p_gen, $p_address, $p_city, $p_state, $p_code);
            // Set parameters
            $p_fname = $fname;
            $p_lname = $lname;
            $p_uname = $uname;
            $p_email = $email;
            $p_pass = $pass;
            $p_phone = $phone;
            $p_dob = $dob;
            $p_gen = $gender;
            $p_address = $address;
            $p_city = $city;
            $p_state = $state;
            $p_code = $pcode;


            // Execute statement
            if ($stmt->execute()) {
                //Success Message

                // Redirect to Login page
                header("location: ../common/login.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        $stmt->close();
    }
}
//Include Header 
include_once(ROOT . 'includes/header.php');
?>
<style>
    #gender {
        color: #fff;
        border: 1px solid white;
        border-radius: 4px;
        background: transparent;
    }

    select option {
        background: #999;
    }
</style>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row g-3 text-center">
                            <h1 class="text-info font-weight-bold"> Register new account</h1>
                            <div class="col-sm-6 text-center text-white p-4" style="background-color: #616161;">
                                <p class="h2"> General Infomation</p>
                                <!--First Name -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="fname" class="form-control <?= (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?= $fname ?>" maxlength="40">
                                    <label class="form-label" for="uname">First Name</label>
                                    <div class="<?= (!empty($fname_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $fname_err; ?></div>
                                </div>
                                <!--Last Name -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="lname" class="form-control <?= (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?= $lname ?>" maxlength="40">
                                    <label class="form-label">Last Name</label>
                                    <div class="<?= (!empty($lname_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $lname_err; ?></div>
                                </div>
                                <!--Username -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="uname" class="form-control <?= (!empty($uname_err)) ? 'is-invalid' : ''; ?>" value="<?= $uname ?>" maxlength="20">
                                    <div class="<?= (!empty($uname_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $uname_err; ?></div>
                                    <label class="form-label">User Name</label>
                                </div>
                                <!--Password -->
                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="input-pass" name="password" class="form-control <?= (!empty($pass_err)) ? 'is-invalid' : ''; ?> " data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Password Should Contain: Minimum 6 characters with One Upper case and one Lower Case Letter and one number !">
                                    <span toggle="#input-pass" class="fa fa-fw fa-eye field-icon help-password"></span>
                                    <div class="<?= (!empty($pass_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $pass_err; ?></div>
                                    <label class="form-label">Password</label>
                                </div>
                                <!--DOB -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="dob" class="form-control <?= (!empty($dob_err)) ? 'is-invalid' : ''; ?>" value="<?= (!empty($dob)) ? $dob : 'DD/MM/YYYY'; ?>">
                                    <span class="fas fa-calendar-alt field-icon"></span>
                                    <div class="<?= (!empty($dob_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $dob_err; ?></div>
                                    <label class="form-label">Date of Birth</label>
                                </div>
                                <!--Gender -->
                                <div class="form">
                                    <select name="gender" id="gender" class="form-control <?= (!empty($gender_err)) ? 'is-invalid' : ''; ?>" value="<?= $gender ?>">
                                        <option value="">Gender</option>
                                        <option value="Male" <?= ($gender == 'Male') ? 'selected="selected"' : ''; ?>>Male</option>
                                        <option value="Female" <?= ($gender == 'Female') ? 'selected="selected"' : ''; ?>>Female</option>
                                        <option value="Other" <?= ($gender == 'Other') ? 'selected="selected"' : ''; ?>>Other</option>
                                    </select>
                                    <div  class="<?= (!empty($gender_err)) ? 'invalid-tooltip text-white' : ''; ?>" style="margin-top: -50px;"><?= $gender_err; ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 text-center text-white p-4" style="background-color: #3f3f3f;">
                                <p class="h2"> Contact Details</p>
                                <!--Email -->
                                <div class="form-outline form-white mb-4">
                                    <input type="email" name="email" class="form-control <?= (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?= $email ?>">
                                    <div class="<?= (!empty($email_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $email_err; ?></div>
                                    <label class="form-label">Email</label>
                                </div>
                                <!--Phone -->
                                <div class="form-outline form-white mb-4">
                                    <input type="tel" name="phone" class="form-control <?= (!empty($phone_err)) ? 'is-invalid' : ''; ?>" value="<?= $phone ?>">
                                    <div class="<?= (!empty($phone_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $phone_err; ?></div>
                                    <label class="form-label">Phone Number</label>
                                </div>
                                <!--Address -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="address" class="form-control <?= (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?= $address ?>">
                                    <div class="<?= (!empty($address_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $address_err; ?></div>
                                    <label class="form-label">Address</label>
                                </div>
                                <!--City -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="city" class="form-control <?= (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?= $city ?>" maxlength="20">
                                    <div class="<?= (!empty($city_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $city_err; ?></div>
                                    <label class="form-label">City</label>
                                </div>
                                <!--State -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="state" class="form-control <?= (!empty($state_err)) ? 'is-invalid' : ''; ?>" value="<?= $state ?>">
                                    <div class="<?= (!empty($state_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $state_err; ?></div>
                                    <label class="form-label">State</label>
                                </div>
                                <!--zip -->
                                <div class="form-outline form-white mb-4">
                                    <input type="text" name="pcode" class="form-control <?= (!empty($pcode_err)) ? 'is-invalid' : ''; ?>" value="<?= $pcode ?>" maxlength="20">
                                    <div class="<?= (!empty($pcode_err)) ? 'invalid-tooltip text-white' : ''; ?>"><?= $pcode_err; ?></div>
                                    <label class="form-label">ZIP/Post Code</label>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center p-3">
                            <div class="col-sm-8 text-center">
                                <input class="form-check-input me-2" type="checkbox" value="" required />
                                <label class="form-check-label"> I agree to <a href="#">Terms and Condtions.</a> </label>
                            </div>
                            <div class="col-sm-8 p-3">
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-secondary btn-rounded btn-block">sign UP</button>
                                Already have account? <a href="<?= SERVER . 'common/login.php' ?>">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include_once(ROOT . 'includes/footer.php'); ?>