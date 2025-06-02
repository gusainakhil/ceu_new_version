<?php
// Allow all origins or replace * with specific origin
header("Access-Control-Allow-Origin: *");

// Allow specific methods including OPTIONS for preflight
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// Allow necessary headers
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Handle preflight request (OPTIONS method)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Respond with 200 OK status for preflight requests
    http_response_code(200);
    exit; // Stop the script execution here for OPTIONS requests
}

include 'connect.php';

// Set the Content-Type to JSON for API response
header('Content-Type: application/json');

// Read the raw input data
$rawData = file_get_contents("php://input");

// Debugging: Log the raw data
error_log("Raw data received: " . $rawData);

// Decode the incoming JSON data
$data = json_decode($rawData, true);

// Check if the data is valid
if ($data === null) {
    http_response_code(400); // Bad Request
    echo json_encode([
        "status" => "error",
        "message" => "Invalid JSON data",
        "raw_data" => $rawData,
        "json_error" => json_last_error_msg()
    ]);
    exit;
}

// Check if required fields are set
$requiredFields = ['name', 'email', 'number', 'country', 'address', 'pin_code', 'course_id', 'job_profile', 'state'];
foreach ($requiredFields as $field) {
    if (!isset($data[$field])) {
        http_response_code(400); // Bad Request
        echo json_encode(["status" => "error", "message" => "Missing required field: $field"]);
        exit;
    }
}

// Extract data from JSON
$name = $data['name'];
$email = $data['email'];
$number = $data['number'];
$country = $data['country'];
$address = $data['address'];
$pin_code = $data['pin_code'];
$course_id = $data['course_id'];
$job_profile = $data['job_profile'];
$state = $data['state'];

// Prepare the SQL query to insert data into the table
$sql = $con->prepare("INSERT INTO cancel_payment (name, email, number, country, address, pin_code, course_id, job_profile, state)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters to the SQL query
$sql->bind_param("sssssssss", $name, $email, $number, $country, $address, $pin_code, $course_id, $job_profile, $state);

// Execute the query and handle success/failure
if ($sql->execute()) {
    http_response_code(201); // Created
    echo json_encode(["status" => "success", "message" => "Record inserted successfully"]);
} else {
    http_response_code(500); // Internal Server Error
    echo json_encode(["status" => "error", "message" => "Error: " . $sql->error]);
}

// Close the SQL statement and database connection
$sql->close();
$con->close();
?>