<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Allow POST method
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With"); // Allow specific headers
header('Content-Type: application/json');

include 'connect.php'; // Include your database connection file

// Read the JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (!isset($input['email'], $input['messgae'], $input['name'], $input['phone'])) {
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

// Sanitize inputs to prevent SQL injection
$email = mysqli_real_escape_string($con, trim($input['email']));
$messgae = mysqli_real_escape_string($con, trim($input['messgae']));
$name = mysqli_real_escape_string($con, trim($input['name']));
$phone = mysqli_real_escape_string($con, trim($input['phone']));

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['error' => 'Invalid email format']);
    exit;
}

// Validate phone number format (assuming 10 digits)
if (!preg_match('/^[0-9]{10}$/', $phone)) {
    echo json_encode(['error' => 'Invalid phone number format']);
    exit;
}

// Prepare the SQL query
$sql = "INSERT INTO contact_details (email, messgae, name, phone) 
        VALUES ('$email', 'messgae', '$name', '$phone')";

// Execute the query and handle the result
if (mysqli_query($con, $sql)) {
    echo json_encode([
        'success' => true,
        'messgae' => 'Data inserted successfully',
        'id' => mysqli_insert_id($con) // Return the newly created record ID
    ]);
} else {
    // Handle database errors
    echo json_encode([
        'success' => false,
        'error' => 'Failed to insert data',
        'details' => mysqli_error($con) // Include the database error for debugging
    ]);
}
?>
