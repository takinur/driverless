<?php
$news_email = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if(isset($_GET['nemail'])){
    $news_email = trim($_GET['nemail']);
  }
 
}
if (!empty($news_email)) {

  // Prepare SQL 
  $sql = "INSERT INTO newsletter(news_email) VALUES(?)";
  if ($stmt = $mysqli->prepare($sql)) {
    // Bind parameters
    $stmt->bind_param("s", $p_mail);
    // Set parameters
    $p_mail = $news_email;

    // Execute statement
    if ($stmt->execute()) {
      //Refresh Current Page                
      echo "<script>alert('Thank you For Newsletter Sign Up!')</script>";
    } else {
      echo "Something went wrong. Please try again later.";
    }
  }
  // Close statement
  $stmt->close();
  //close Connection
  $mysqli->close();
}

?>


<!-- Footer -->
<footer class="bg-dark text-center text-lg-start">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase text-info">Driverless inc</h5>
        <p>
          We aim to provide automatic driving vehicles with the best driver around the world.
          -We are building a self driving technology You can Trust and get benifited.
        </p>
      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0 justify-content-center">
        <ul class="list-unstyled mb-0">
          <li>
            <a href="<?= SERVER ?>" class="text-white">Home</a>
          </li>
          <li>
            <a href="<?= SERVER . 'tech' ?>" class="text-white">Technology</a>
          </li>
          <li>
            <a href="<?= SERVER . 'contact' ?>" class="text-white">Contact</a>
          </li>
          <li>
            <a href="<?= SERVER . 'about' ?>" class="text-white">About</a>
          </li>
        </ul>
      </div>
      <!--Grid column-->
      <!--Grid column-->
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0 ">
        <h4 class="text-uppercase text-white" style="margin-left: 15px;">Follow Us</h5>
          <div class="col justify-content-center" style="margin-top:20px">
            <!--Social Links -->
            <a href="https://www.fb.com/autonomus-vehicle" target="_blank" class="btn btn-primary btn-lg btn-floating text-white">
              <i class="fab fa-facebook-f" aria-hidden="true"></i>
            </a>
            <a href="https://www.twitter.com/autonomus-vehicle" target="_blank" class="btn btn-primary btn-lg btn-floating text-white">
              <i class="fab fa-twitter" aria-hidden="true"></i>
            </a>
            <a href="https://www.youtube.com/autonomus-vehicle" target="_blank" class="btn btn-primary btn-lg btn-floating text-white">
              <i class="fab fa-youtube" aria-hidden="true"></i>
            </a>
            <a href="https://www.linkedin.com/autonomus-vehicle" target="_blank" class="btn btn-primary btn-lg btn-floating text-white">
              <i class="fab fa-linkedin" aria-hidden="true"></i>
            </a>
          </div>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
    <!--News Letter Subscription --->
    <div class="row auto d-flex justify-content-center">
      <div class="col-md-4">
        <h5 class="text-white">Subscribe to News letter. </h5>
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET">
          <div class="input-group">
            <div class="form-outline form-white">
              <input type="text" id="newsletter" name="nemail" class="form-control" />
              <label class="form-label" for="newsletter">Email</label>
            </div>
            <input type="submit" value="Subscribe" class="btn btn-secondary btn-rounded">
        </form>
      </div>
    </div>
  </div>
  </div>
  <!-- Grid container -->
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    <a class="text-white" href="<?= SERVER ?>">Driverless Inc</a>
    &copy;<?= date("Y"); ?> All Right Reserved.
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
</body>


<!-- Bootstrap JS-->
<script type="text/javascript" src="<?= SERVER . 'assets/js/bootstrap.min.js'; ?>"></script>
<!-- MDB JS -->
<script type="text/javascript" src="<?= SERVER . 'assets/js/mdb.min.js'; ?>"></script>
<!---Calender--->
<script src="<?= SERVER . 'assets/js/bootstrap-datepicker.min.js'; ?>"></script>
<!--Custom JS -->
<script type="text/javascript" src="<?= SERVER . 'assets/js/main.js'; ?>"></script>

</html>