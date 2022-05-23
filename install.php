<?php
//Check if config exists
if (file_exists('config.php')) {
    header('location:index.php');
    die();
}

// Define Server
$url = "http://$_SERVER[HTTP_HOST]" . "/00183727-driverless" . '/';


//Initialize Empty Variable
$error = $host = $dbuname = $dbpwd = $dbname = "";
$v_err = $c_err = $m_err = $sess_err = $safe_err = "";


//PHP Version check
$php_version = phpversion();
if ($php_version < 5.6) {
    $v_err = false;
} else {
    $v_err = true;
}
//Curl Function Check
$curl_version = function_exists('curl_version');
if ($curl_version) {
    $c_err = true;
} else {
    $c_err = false;
}
//Session Check
session_start();
$_SESSION['IS_WORKING'] = 1;
if (!empty($_SESSION['IS_WORKING'])) {
    $sess_err = true;
} else {
    $sess_err = false;
}
//Mail Function
$mail = function_exists('mail');
if ($mail) {
    $m_err = true;
} else {
    $m_err = false;
}
// Safe mode check
if (ini_get("safe_mode")) {
    $safe_err = false;
} else {
    $safe_err = true;
}
//Error Exist prevent next
if (!$v_err || !$c_err || !$sess_err || !$m_err || !$safe_err) {
    $error = "Setting Mismatch";
} else {
    $error = "";
}

//Process submitted credentials to config file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = $_POST['host'];
    $dbuname = $_POST['dbuname'];
    $dbpwd = $_POST['dbpwd'];
    $dbname = $_POST['dbname'];

    $con = @mysqli_connect($host, $dbuname, $dbpwd, $dbname);
    if (mysqli_connect_error()) {
        $error = mysqli_connect_error();
    } else {
        copy("config-dist.php", "config.php");
        $file = "config.php";
        file_put_contents($file, str_replace("server_add", $url, file_get_contents($file)));
        file_put_contents($file, str_replace("db_host", $host, file_get_contents($file)));
        file_put_contents($file, str_replace("db_username", $dbuname, file_get_contents($file)));
        file_put_contents($file, str_replace("db_password", $dbpwd, file_get_contents($file)));
        file_put_contents($file, str_replace("db_name", $dbname, file_get_contents($file)));



        // Create Rquired Tables 
        $tbluser = "CREATE TABLE users (
                    uid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    fname varchar(50) NOT NULL,
                    lname varchar(50) NOT NULL,
                    uname varchar(30) NOT NULL,
                    email varchar(70) NOT NULL,
                    pass varchar(60) NOT NULL,
                    phone varchar(15) NOT NULL,
                    dob varchar(20) NOT NULL,
                    gender varchar(15) NOT NULL,
                    addrs varchar(255) NOT NULL,
                    city varchar(30) NOT NULL,
                    cstate varchar(30) NOT NULL,
                    pcode varchar(5) NOT NULL
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        $tblnewsletter = "CREATE TABLE newsletter (
            news_id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            news_email varchar(80) NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        $tblcontact = "CREATE TABLE contact (
            m_id int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            m_name varchar(80) NULL,
            m_email varchar(80) NULL,
            message_text varchar(255) NULL

            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";


        $tables = [$tbluser, $tblnewsletter, $tblcontact];
        //Execute Query
        foreach ($tables as $t => $sql) {
            if (mysqli_query($con, $sql)) {
                //Redirect to Home page                
               header('location:index.php');
            } else {
                echo "Error creating table: " . mysqli_error($con);
            }
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Installation -Driverless</title>
    <!--Font Awesome-->
    <link rel="stylesheet" href="assets/css/all.css">
    <!--Bootstrap-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--MDB-->
    <link rel="stylesheet" href="assets/css/mdb.min.css">
    <!--Calender-->
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css" />
    <!--Custom Style-->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--Jquery---->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="row d-flex justify-content-center g-6 text-center p-lg-5">
            <?php //Display input fileds
            if ((isset($_GET['step'])) && $_GET['step'] == 2) {
            ?>
                <h1 class="diplay-1 ">Database Configuration</h1>
                <div class="alert bg-secondary text-white text-center" role="alert">
                    Create a Database with selecting Collation setting <b>utf8mb4_general_ci </b>
                </div>
                <div class="alert bg-danger text-white alert-dismissible fade show text-center" role="alert" <?= (!empty($error)) ? '' : 'Hidden'; ?>>
                    <?= $error ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="col-md-8 p-5">
                    <form method="post">
                        <!-- Host input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="host" class="form-control" placeholder="localhost" required value="<?= $host ?>">
                            <label class="form-label">Host</label>
                        </div>
                        <!-- User Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="dbuname" class="form-control" required value="<?= $dbuname ?>">
                            <label class="form-label">Database User Name</label>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="text" name="dbpwd" class="form-control" value="<?= $dbpwd ?>">
                            <label class="form-label">Database User Password</label>
                        </div>
                        <!-- Databse Name -->
                        <div class="form-outline mb-4">
                            <input type="text" name="dbname" class="form-control" required value="<?= $dbname ?>">
                            <label class="form-label">Database Name</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Save</button>
                    </form>
                </div>
            <?php } else { //Show 1st Step 
            ?>
                <h1 class="diplay-1 ">Pre-Installation Check</h1>
                <div class="col-md-8 p-5">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="font-weight-bold" scope="col">PHP Settings</th>
                                <th class="font-weight-bold" scope="col">Current Settings</th>
                                <th class="font-weight-bold" scope="col">Required Settings</th>
                                <th class="font-weight-bold" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">PHP Version</th>
                                <td><?= $php_version ?></td>
                                <td>5.6+</i></td>
                                <td><i class="fas <?= ($v_err != true) ? 'fa-ban text-danger' : 'fa-check-circle text-success'; ?> "></i></td> <!-- Never Stop V -->
                            </tr>
                            <tr>
                                <th scope="row">Curl Install</th>
                                <td><?= ($c_err == false) ? 'Disabled' : 'Enabled' ?></td>
                                <td>Enabled</td>
                                <td><i class="fas <?= ($c_err == false) ? 'fa-ban text-danger' : 'fa-check-circle text-success'; ?> "></i></td>
                            </tr>
                            <tr>
                                <th scope="row">Session</th>
                                <td><?= ($sess_err == false) ? 'No' : 'Working' ?></td>
                                <td>Working</td>
                                <td><i class="fas <?= ($sess_err == false) ? 'fa-ban text-danger' : 'fa-check-circle text-success'; ?> "></i></td>
                            </tr>
                            <tr>
                                <th scope="row">Mail Function</th>
                                <td><?= ($mail == false) ? 'Off' : 'On' ?></td>
                                <td>On</td>
                                <td><i class="fas <?= ($m_err == false) ? 'fa-ban text-danger' : 'fa-check-circle text-success'; ?> "></i></td>
                            </tr>
                            <tr>
                                <th scope="row">Safe Mode</th>
                                <td><?= ($safe_err == true) ? 'Off' : 'On' ?></td>
                                <td>Off</td>
                                <td><i class="fas <?= ($safe_err == false) ? 'fa-ban text-danger' : 'fa-check-circle text-success'; ?> "></i></td>
                            </tr>
                            <tr>
                                <th scope="row"></th>
                                <td colspan="2"></td>
                                <td>
                                    <?php
                                    if ($error == '') {
                                    ?>
                                        <a role="button" class="btn btn-dark" href="?step=2">Next</a>
                                    <?php
                                    } else {
                                    ?> <a class="btn btn-danger text-white" role="button">Error</a>
                                    <?php    }
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- Bootstrap JS-->
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <!-- MDB JS -->
    <script type="text/javascript" src="assets/js/mdb.min.js"></script>
    <!---Calender--->
    <script src="assets/js/bootstrap-datepicker.min.js"></script>
    <!--Custom JS -->
    <script type="text/javascript" src="assets/js/main.js"></script>
</body>

</html>