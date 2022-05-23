<?php

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Validate First Name
    $in_fname = trim($_POST["fname"]);
    if (empty($in_fname)) {
        $fname_err = "Please enter First Name.";
    } elseif ( !preg_match("/^[a-zA-Z\s]+$/",$in_fname)) {
        $fname_err = "Please enter a valid First Name.";
    } else {
        $fname = $in_fname;
    }
    // Validate Last Name
    $in_lname = trim($_POST["lname"]);
    if (empty($in_lname)) {
        $lname_err = "Please enter Last Name.";
    } elseif ( !preg_match("/^[a-zA-Z\s]+$/",$in_lname)) {
        $lname_err = "Please enter a valid Last Name.";
    } else {
        $lname = $in_lname;
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
    }
    else {
        $address = $in_add;
    }
    //Validate City
    $in_city= trim($_POST["city"]);
    if (empty($in_city)) {
        $city_err = "Please enter City.";
    } elseif (!preg_match("/^[a-zA-Z\s]+$/",$in_city)) {
        $city_err = "Please enter a valid City.";
    } else {
        $city = $in_city;
    }
    // Validate State
    $in_state = trim($_POST["state"]);
    if (empty($in_state)) {
        $state_err = "Please enter State.";
    } elseif (!preg_match("/^[a-zA-Z0-9\s]+$/",$in_state)) {
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


    if (empty($fname_err) && empty($lname_err) && empty($phone_err) && empty($dob_err) && empty($gender_err) &&
        empty($address_err) && empty($city_err) && empty($state_err) && empty($pcode_err) ) {
        
        // insert statement
        $sql = "UPDATE users SET fname=?, lname=?, phone=?, dob=?, gender=?, addrs=?, city=?, cstate=?, pcode=? WHERE uname=?";
        
        //Prepare Statement
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssssssssss", $p_fname, $p_lname, $p_phone, $p_dob, $p_gen, $p_address, $p_city, $p_state, $p_code,  $p_uname);
            // Set parameters
             $p_fname = $fname;
             $p_lname = $lname;            
             $p_phone= $phone;
             $p_dob = $dob;
             $p_gen= $gender;
             $p_address =$address;
             $p_city = $city;
             $p_state = $state;
             $p_code = $pcode;
             $p_uname = $uname;
           
            // Execute statement
            if ($stmt->execute()) {
                //Refresh Current Page and success Message
               
               echo(
                 "<meta http-equiv='refresh' content='3'>" .
               "<script>                 
               $(window).on('load', function() {
                $('#alertModal').modal('show');
              }); 
    
              $('#msg').html('Profile Updated!'); 
              </script>");
            
            }else {
                echo "Something went wrong. Please try again later.";
            }
        }
        // Close statement
        $stmt->close(); 
         // Close connection
       $mysqli->close(); 
    }     
   else{
        //Erorr Exist-Open Modal Again
        
        echo "<script>

        $(window).on('load', function() {
            $('#profileModal').modal('show');
          }); 
        
        </script>";
    }
      
}
