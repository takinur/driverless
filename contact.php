<?php
//Require Config
require_once "config.php";
//Set Tittle
$title = "Contact -Autonomous Vehicle";

$name = $email = $msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $msg = trim($_POST["message"]);
}
//Check if input value exist or not
if (!empty($name) && !empty($email) && !empty($msg)) {
    // Prepare SQL 
    $sql = "INSERT INTO contact (m_name, m_email, message_text) VALUES(?, ?, ?)";
    if ($stmt = $mysqli->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sss", $pname, $pmail, $pmsg);
        // Set parameters
        $pname = $name;
        $pmail = $email;
        $pmsg = $msg;
        // Execute statement
        if ($stmt->execute()) {
            //Success                
            //echo "<script>alert('Thank you For Message!')</script>";
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }
    // Close statement
    $stmt->close();
}
//Include Header
include_once(ROOT . 'includes/header.php');

?>




<div class="wrapper">
    <div class="container-fluid">
        <div class="row d-flex justify-content-center text-center">
            <h1 class="text-info font-weight-bold"> Contact us</h1>
            <!-- Show success when submitted -->
            <div class="alert alert-info text-center" role="alert" <?= (!empty($name)) ? '' : 'hidden'; ?>>
                Your name: <?= $name ?> <br>
                Email : <?= $email ?> <br>
                Message:<?= $msg ?> <br>
              <b>  is received for query. Thanks for contacting US.</b>
            </div>
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body d-flex justify-content-center" style="background-color: #ebf0ef;">
                        <div class="row">
                            <div class="col-md-12  text-center">
                                <h2 class="text-dark">General Enquries</h2>
                            </div>
                            <div class="col d-flex justify-content-center text-left">
                                <p>For all general enquiries, please use the below details to call or email Us. <br>
                                    <b> Phone Number:</b> (00) 121212 1111 <br>
                                    <b> Email: </b> info@autovh.com.uk <br>
                                    <b> Postal Address:</b> PO Box 123, Dred street, Heigh Park, 7055
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex justify-content-center text-center" style="background-color: #f1f7f0;">
                        <div class="row">
                            <div class="col-md-12  text-center">
                                <h2 class="text-dark">Other Enquries</h2>
                                <p>For all other enquiries, please send a message.</p>
                            </div>
                            <div class="col-md-12">
                                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                    <!--Name Input -->
                                    <div class="form-outline mb-4">
                                        <input type="text" name="name" id="name" class="form-control" required value="<?= ($logged != true) ? '' : ucfirst($us_name); ?>" />
                                        <label class="form-label" for="name">Name</label>
                                    </div>
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" id="email" class="form-control" required />
                                        <label class="form-label" for="email">Email address</label>
                                    </div>
                                    <!-- Message input -->
                                    <div class="form-outline mb-4">
                                        <textarea class="form-control" name="message" id="message" rows="4" required></textarea>
                                        <label class="form-label" for="message">Message</label>
                                    </div>
                                    <!-- Checkbox -->
                                    <div class="form-check d-flex justify-content-center mb-4">
                                        <input class="form-check-input me-2" data-mdb-toggle="modal" data-mdb-target="#faqModal" type="checkbox" id="faq" />
                                        <label class="form-check-label" for="faq">
                                            Have you checked our <a href="#" data-mdb-toggle="modal" data-mdb-target="#faqModal"> F.A.Q</a> ?
                                        </label>
                                    </div>
                                    <input type="submit" id="faqsend" class="btn btn-info btn-rounded btn-block" value="Send">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Modal for FAQ -->
                    <div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header text-white bg-success">
                                    <h5 class="modal-title" id="faqModalLabel">Frequently asked questions.</h5>
                                    <button type="button" class="btn-close text-white" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-info" role="alert">Please read this FAQ before sending Message to US!</div>
                                    <hr />
                                    <div class="row g-3">
                                        <?php include_once(ROOT . 'includes/faqContent.php'); ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-mdb-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include_once(ROOT . 'includes/footer.php'); ?>