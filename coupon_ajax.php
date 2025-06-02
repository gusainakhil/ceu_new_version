<?php
include "connect.php";
include "functions.php";

if (isset($_POST['coupon_code'])) {
    $coupon_code = $_POST['coupon_code'];

    $couponQuery = mysqli_query($con, "SELECT * FROM sales_promotion_coupon WHERE coupon_code='$coupon_code' AND status='1' AND coupons_status='Active' AND expire_date>=CURDATE() AND coupons_limit>=1 ");

    if ($couponQuery) {
        // Check if any rows were returned
        if (mysqli_num_rows($couponQuery) > 0) {
            $row = mysqli_fetch_assoc($couponQuery);
            $newSubTotal = $row['discount'];
            
            $response = [
                'couponPrice' => $newSubTotal,
                'coupon_code' => $row['coupon_code'],
                'statement' => 'Coupon applied successfully!'
            ];
            // $_SESSION['couponPrice'] = $newSubTotal;
        } else {
            $response = [
                'couponPrice' => 0,
                'coupon_code' => 0,
                'statement' => 'Invalid coupon code. Please try again.'
            ];
        }
    } else {
        $response = [
            'couponPrice' => 0,
            'coupon_code' => 0,
            'statement' => 'Error querying the database.'
        ];
    }

    // Send the response back to the client as JSON
    echo json_encode($response);
}else{
    header("Location: " . $_SERVER["HTTP_REFERER"]);
}
?>
