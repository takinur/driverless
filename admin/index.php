<?php
// Initialize the session
session_start();

//  if not logged in, redirect  to login page
if (!isset($_SESSION["adloggedin"]) || $_SESSION["adloggedin"] !== true) {
    header("location: admin-auth.php");
    exit;
}
// Include config file
require_once "../config.php";

// Page Title
$title = "Wellcome -Admin";




//Include Header
include_once(ROOT . 'includes/header.php');
?>
<h1 class="display-5 text-center"> Do not share you administrator password with anyone! </h1>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 justify-content-end text-end">
        <a href="../common/logout.php" class="btn btn-danger"> &nbsp;&nbsp;&nbsp;Sign Out&nbsp;&nbsp; &nbsp;</a>
        </div>
    </div>
</div>

<!-- Messages-->
<section class="page-section bg-white">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-center mt-0">Questions From Users!</h2>
                <hr id="tagline" style="border-top: 3px solid #F4623A;" />
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center text-center align-items-center">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th class="font-weight-bold" scope="col">ID</th>
                            <th class="font-weight-bold" scope="col">Name of Sender</th>
                            <th class="font-weight-bold" scope="col">Email</th>
                            <th class="font-weight-bold" scope="col">Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //Retrive Contact messages
                        $sql = "SELECT * FROM contact";
                        if ($stmt = $mysqli->prepare($sql)) {
                            //Excute Statement
                            $stmt->execute();
                            // Fetch result
                            $result = $stmt->get_result();
                        }
                        //Close Statement
                        $stmt->close();

                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>

                                <td><?= $row['m_id'] ?></td>
                                <td><?= $row['m_name'] ?></td>
                                <td><?= $row['m_email'] ?></td>
                                <td><?= $row['message_text'] ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!--News Letter-->
<section class="page-section bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-center mt-0">Newsletter Subscribers Emails</h2>
                <hr id="tagline" style="border-top: 3px solid #F4623A;" />
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-center text-center align-items-center">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th class="font-weight-bold" scope="col">ID</th>
                            <th class="font-weight-bold" scope="col">Email of Subscriber</th>
                            <th class="font-weight-bold" scope="col">Remarks (If avaiable)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //Retrive Newsletter
                        $sql = "SELECT * FROM newsletter";
                        if ($stmt = $mysqli->prepare($sql)) {
                            //Excute Statement
                            $stmt->execute();
                            //Fetch result
                            $result = $stmt->get_result();
                        }
                        //Close Statement
                        $stmt->close();
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) { ?>
                            <tr>

                                <td><?= $row['news_id'] ?></td>
                                <td><?= $row['news_email'] ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!-- Contact-->
<section class="page-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mt-0">Let's Get In Touch with Developer!</h2>
                <hr id="tagline" style="border-top: 3px solid #F4623A;" />
                <p class="text-muted mb-5"> Get Help for you application without any Hassle!</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                <div>000000000000</div> 
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                <a class="d-block" href="mailto:developer@ta.com">developer@ta.com</a>
            </div>
        </div>
    </div>
</section>
<!-- Never Stop V -->
<!-- Include Footer -->
<?php include_once(ROOT . 'includes/footer.php'); ?>