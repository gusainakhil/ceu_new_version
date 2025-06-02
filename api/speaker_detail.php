<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow all HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With"); // Allow specific headers
header('Content-Type: application/json');

include 'connect.php'; // Include your database connection file

$sql = "SELECT name , designation ,images FROM speaker_info WHERE speaker_status='1' AND status='1' ";
$query_result = mysqli_query($con, $sql);

$result = [];
if ($query_result) {
    while ($row = mysqli_fetch_assoc($query_result)) {
        $result[] = $row; // Collect each row of the result into the array
    }
}

echo json_encode($result); // Return the results as JSON
?>
