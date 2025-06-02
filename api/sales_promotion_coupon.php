<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow all HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With"); // Allow specific headers
header('Content-Type: application/json');

include 'connect.php'; // Include your database connection file

// Read and decode the JSON data from the POST request body
$request_body = file_get_contents('php://input');
$data = json_decode($request_body, true);

// Get the `coupon_code` from the JSON data
$coupon_code = isset($data['coupon_code']) ? mysqli_real_escape_string($con, $data['coupon_code']) : null;

// Check if the required parameter is provided
if (!$coupon_code) {
    echo json_encode(['error' => 'Coupon code is required']);
    exit;
}

// Build the SQL query dynamically
$sql = "SELECT id, coupon_code, discount 
        FROM sales_promotion_coupon 
        WHERE coupons_limit >= 1 
          AND expire_date >= CURDATE() 
          AND coupons_status = 'Active' 
          AND status = '1' 
          AND coupon_code = '$coupon_code'";

$query_result = mysqli_query($con, $sql);

$result = [];
if ($query_result) {
    while ($row = mysqli_fetch_assoc($query_result)) {
        $result[] = $row; // Collect each row of the result into the array
    }
}

// Return the results as JSON
if (!empty($result)) {
    echo json_encode($result);
} else {
    echo json_encode(['message' => 'Invalid coupon code']);
}
?>