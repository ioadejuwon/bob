<?php
    session_start();
    include_once "inc/config.php"; // Include config at the beginning
    include_once "inc/drc.php"; // Include config at the beginning
    if(isset($_SESSION['unique_id'])) {
        if(isset($_GET['id'])){
            $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT * FROM bobthebuilder WHERE unique_id = ?");
            $stmt->bind_param("s", $logout_id);
            $stmt->execute();
            $stmt->close();
            session_unset();
            session_destroy();
            header("location: ". LOGIN);
        }
    } else {  
        header("location: ". LOGIN);
        echo "You are not logged in.";
    }
