<?php


include_once 'config.php';
include_once "drc.php";

include_once 'randno.php';
session_start();

$error = null;

$url = $_GET['url'];

if (isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pword = mysqli_real_escape_string($conn, $_POST['pword']);
    if(!empty($email) && !empty($pword)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = "SELECT email, fname, pword_hash, user_id FROM bob_admin WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email); // Bind the parameter to the placeholder
            mysqli_stmt_execute($stmt); // Execute the query
            mysqli_stmt_bind_result($stmt, $resultEmail, $fname, $resultPasswordHash, $user_id);// Bind the result variable
            mysqli_stmt_fetch($stmt); // Fetch the result
            if($resultEmail && password_verify($pword, $resultPasswordHash)){
                $_SESSION['user_id'] = $user_id;
                 //Send Login email to Vendor
                if (!empty($url)) {
                    header("Location: $url");
                    
                } else {
                    header("Location: ".DASHBOARD);
                }   
                
            }else{
                // $error = "Looks like you entered the wrong email address or password!";
                $error = "<p class='fw-300 text-error-1'>Looks like you entered the wrong email address or password!</p>"; 
            }
        }else{
            // $error = "Invalid Email address";
            $error = "<p class='fw-300 text-error-1'>Invalid Email address.</p>"; 
        } 
    }else{
        // $error = "Please enter your details";
        $error = "<p class='fw-300 text-error-1'>Please enter your details.</p>"; 
    }
}elseif(isset($_SESSION['user_id'])){
    if (!empty($url)) {
        header("Location: $url");
    } else {
        header("Location: ".DASHBOARD);
    }
}




if(isset($_POST['signup'])){
    if($_POST['fname'] == '' OR $_POST['lname'] == '' OR $_POST['email'] == '' OR $_POST['username'] == '' OR $_POST['pword'] == '' OR $_POST['cword'] == '' ){
        $error = "Please fill all the inputs with your details";
    } else {
        $email = trim($_POST['email']); //Get Email
        $fname = trim($_POST['fname']); //Get First Name
        $lname = trim($_POST['lname']); //Get Last Name
        $pword = $_POST['pword'];
        $cword = $_POST['cword'];
        $username = $_POST['username'];
        // $username = $fname.'-'.$uid;
        // $uname = str_replace(' ','', $username);
        $fullname = $fname. ' '. $lname;

        $unique_id;
    
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Validate Email Address
            $sql = "SELECT email FROM bob_admin WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $email); // Bind the parameter to the placeholder
            mysqli_stmt_execute($stmt); // Execute the query
            mysqli_stmt_bind_result($stmt, $resultEmail); // Bind the result variable
            mysqli_stmt_fetch($stmt); // Fetch the result

            
            if ($resultEmail) { // Check if the email exists
                $error = "<p class='fw-300 text-error-1'>Looks like '".$email."' already exists. Please, try to <a href='".ADMIN_LOGIN."'>log in</a>?</p>"; // Email already exists in the database
                session_destroy();
            } elseif($cword != $pword){
                // $error =  "Password is not the same as Confirm Password!";
                $error =  "<p class='fw-300 text-error-1'>Password is not the same as Confirm Password!!</p>";

                session_destroy();
            }else{
                $pwordhash = password_hash($pword, PASSWORD_BCRYPT); // Encrypt Password 

                $insert = "INSERT INTO bob_admin (user_id, fname, lname, email, username, email_verify, pword_hash) VALUES (?, ?, ?, ?, ?, 0, ?)";
                $stmt = mysqli_prepare($conn, $insert); // Prepare the SQL statement
                mysqli_stmt_bind_param($stmt, "ssssss", $unique_id, $fname, $lname, $email, $username, $pwordhash); // Bind values to the placeholders

                
                if (mysqli_stmt_execute($stmt)) {
                    echo "I inserted into users here";
                    
                    $_SESSION['user_id'] = $unique_id;
                    header("location: ".DASHBOARD."?id=".$unique_id);

                    mysqli_stmt_close($stmt); // Close the statement before opening another one
                    exit();
                } else {
                    $error =  "<p class='fw-300 text-error-1'>There is an error with one of your inputs!</p>"; // Send an "error" response if the insertion fails
                    session_destroy();
                }
            }
        }else{
            $error = "Invalid Email address";
            session_destroy();
        } 
    }             
}else{
    // // redirect to dashboard if in session (signed in)
    // if(isset($_SESSION['unique_id'])){
    //     header("Location: ".DASHBOARD);
    //   }
}

