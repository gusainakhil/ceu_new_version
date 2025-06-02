<?php
include 'connect.php';
include 'functions.php';
date_default_timezone_set('Asia/Calcutta');


//contact.php
if ($_POST['type'] == '1') {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$message = str_replace("'","`",$_POST['message']);
	$name = $fname . ' ' . $lname;
	mysqli_query($con, "INSERT INTO contact_details (name,phone,email,messgae) VALUES ('$name','$phone','$email','$message')");
	echo "0";
}

//becomespeaker.php
if ($_POST['type'] == '2') {
	$name = $_POST['fname']. ' ' . $_POST['lname'];
	$email = $_POST['email'];
	$phone_no = $_POST['phone_no'];
	// $Qualification = $_POST['Qualification'];
	$experience = str_replace("'","`",$_POST['experience']);
	$bio = str_replace("'","`",$_POST['bio']);
	mysqli_query($con, "INSERT INTO speaker_info (name,email,phone_no,experience,bio) VALUES ('$name','$email','$phone_no','$experience','$bio')");
	// echo "INSERT INTO speaker_info (name,email,phone_no,experience,bio) VALUES ('$name','$email','$phone_no','$experience','$bio')";
	echo "0";
}

if ($_POST['type'] == '3') {
    $password = $_POST['password'];
    $user_id = $_SESSION['user_id'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = mysqli_prepare($con, "UPDATE user_info SET password = ? WHERE id = ?");
    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "si", $password, $user_id);
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Check if the query was successful
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "0";
        } else {
            echo "Failed to update password.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the SQL statement.";
    }
}


?>