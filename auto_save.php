<?php
session_start();
include "connect.php"; // Database connection

// User ka IP address get karein
$ip_address = $_SERVER['REMOTE_ADDR'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $field = $_POST['field']; // Field name
    $value = $_POST['value']; // Field value

    // Check if IP already exists AND created_at is within last 1 hour
    $check = mysqli_query($con, "SELECT * FROM checkout_data WHERE ip_address = '$ip_address' AND created_at >= NOW() - INTERVAL 1 HOUR");
    
    if (mysqli_num_rows($check) > 0) {
        // Update existing record
        $query = "UPDATE checkout_data SET $field = '$value', updated_at = NOW() WHERE ip_address = '$ip_address'";
    } else {
        // Insert new record
        $query = "INSERT INTO checkout_data (ip_address, $field, created_at, updated_at) VALUES ('$ip_address', '$value', NOW(), NOW())";
    }

    if (mysqli_query($con, $query)) {
        echo "Data saved!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
