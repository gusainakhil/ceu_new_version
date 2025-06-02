<?php


include 'connect.php'; // Assuming this file sets up the $con variable
include 'functions.php';

date_default_timezone_set('Asia/Calcutta'); // Set the default timezone

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['password'];
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
    $id = $_SESSION['user_id'];

    // Use prepared statements to prevent SQL injection
    if ($stmt = $con->prepare("UPDATE user_info SET password = ? WHERE id = ?")) {
        $stmt->bind_param("si", $hashed_password, $id);

        if ($stmt->execute()) {
            echo "Password updated successfully.";
        } else {
            echo "Error updating password: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
} else {
    echo "Invalid request method.";
}

$con->close(); // Close the database connection
?>
