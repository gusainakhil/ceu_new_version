<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputData = json_decode(file_get_contents('php://input'), true);
    if (isset($inputData['user_id'])) {
        $user_id = mysqli_real_escape_string($con, $inputData['user_id']);

        $u_sql = mysqli_prepare($con, "SELECT name, email, number, job_profile, address, address2, city, state, country, pin_code FROM user_info WHERE id=?");
        mysqli_stmt_bind_param($u_sql, 'i', $user_id);
        mysqli_stmt_execute($u_sql);
        $user_result = mysqli_stmt_get_result($u_sql);
        $user_info = mysqli_fetch_assoc($user_result);
        $o_sql = mysqli_prepare($con, "SELECT order_details.order_id,
                                              order_details.trans_date,
                                              order_details.coupon_discount,
                                              order_details.amount,
                                              order_details.txn_id,
                                              course_detail.title
                                       FROM   order_details
                                              JOIN course_detail ON order_details.course_id = course_detail.id
                                       WHERE  order_details.user_id = ?");
        mysqli_stmt_bind_param($o_sql, 'i', $user_id);
        mysqli_stmt_execute($o_sql);
        $order_result = mysqli_stmt_get_result($o_sql);
    
        $orders = [];
        while ($row = mysqli_fetch_assoc($order_result)) {
            $orders[] = $row;
        }

        if ($user_info) {
            echo json_encode([
                'status' => 200,
                'message' => 'User data and orders fetched successfully',
                'user_info' => $user_info,
                'orders' => $orders
            ]);
        } else {
            echo json_encode([
                'status' => 404,
                'message' => 'User not found'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Invalid request. user_id is required'
        ]);
    }
} else {
    echo json_encode([
        'status' => 405,
        'message' => 'Method not allowed'
    ]);
}
?>