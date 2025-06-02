<?php
include 'connect.php';
// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization');

// Get input data
$data = json_decode(file_get_contents("php://input"), true);


// Check if required fields are set
if (!isset($data['name']) || !isset($data['email']) || !isset($data['message'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

$name = mysqli_real_escape_string($con, $data['name']);
$email = mysqli_real_escape_string($con, $data['email']);
$message = mysqli_real_escape_string($con, $data['message']);

// Insert query
$query = "INSERT INTO contact_details (name, email, messgae) VALUES ('$name', '$email', '$message')";

if (mysqli_query($con, $query)) {
    echo json_encode(['status' => 'success', 'message' => 'Contact details saved successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save contact details']);
}

mysqli_close($con);
?>
