<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow all HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With"); // Allow specific headers
header('Content-Type: application/json');
include 'connect.php'; // Include your database connection file

$sql = " SELECT * FROM `gateway_integration` where status='1' LIMIT 1 ";
$result = mysqli_query($con, $sql);

$gateway = [];
while ($row = mysqli_fetch_assoc($result)) {
  
    $gateway[] = $row;
}

echo json_encode($gateway);
?>