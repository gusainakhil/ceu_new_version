<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');
include "connect.php";

$requestMethod = $_SERVER['REQUEST_METHOD'];

// Check if the request method is POST
if ($requestMethod == 'POST') {
    // Get the raw POST data
    $inputData = json_decode(file_get_contents('php://input'), true);

        $email = mysqli_real_escape_string($con, $inputData['email']);
        $password = mysqli_real_escape_string($con, $inputData['password']);

        $log_query = mysqli_prepare($con, "SELECT * FROM user_info WHERE email=? AND status='1'");
        mysqli_stmt_bind_param($log_query, 's', $email);
        mysqli_stmt_execute($log_query);
        $result = mysqli_stmt_get_result($log_query);

        if (mysqli_num_rows($result) == 1) {
            $log_row = mysqli_fetch_assoc($result);

            // Verify password (consider using password_hash and password_verify)
            if ($log_row['password'] == $password) {
       
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['user_id'] = $log_row['id'];
                $_SESSION['name'] = $log_row['name'];
                $_SESSION['hash_id'] = $log_row['hash_id'];
                
                echo json_encode([
                    'status' => 1,
                    'message' => 'Login successful',
                    'user_id' => $log_row['id'],
                    'name' => $log_row['name']
                ]);
            } else {
                echo json_encode([
                    'status' => 0,
                    'message' => 'Invalid password'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 2,
                'message' => 'User not found or inactive'
            ]);
        }
    } 

else {
    echo json_encode([
        'status' => 405,
        'message' => 'Method not allowed'
    ]);
}
?>
