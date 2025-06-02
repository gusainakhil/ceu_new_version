<?php
session_start();
$_SESSION['s_fname']= $_POST['fname'];
$_SESSION['s_lname']= $_POST['lname'];
$_SESSION['s_email']= $_POST['email'];
$_SESSION['s_hash_id']= $_POST['hash_id'];
$_SESSION['s_number']= $_POST['number'];
$_SESSION['s_address']= $_POST['address'];
$_SESSION['s_address2']= $_POST['address2'];
$_SESSION['s_order_id']= $_POST['order_id'];
$_SESSION['s_state']= $_POST['state'];
$_SESSION['s_pin_code']= $_POST['pin_code'];
$_SESSION['s_course_id']= $_POST['course_id'];
$_SESSION['s_city']= $_POST['city'];
$_SESSION['s_couponCode']= $_POST['couponCode'];
$_SESSION['s_amount']= $_POST['amount'];
$_SESSION['s_coupon_price']= $_POST['coupon_price'];
$_SESSION['s_selling_options']= $_POST['selling_options'];
$_SESSION['s_company_name']= $_POST['company_name'];
$_SESSION['s_job_profile']= $_POST['job_profile'];
$_SESSION['s_country']= $_POST['country'];

    // header("Location: " . $_SERVER["HTTP_REFERER"]);
?>
