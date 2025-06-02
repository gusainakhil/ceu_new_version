<?php
// 1) DB & Session Init
include 'config.php';
include 'connect.php';  
include 'functions.php';


// 2) Validate and Sanitize Input
// Billing Details
$fname        = mysqli_real_escape_string($con, $_POST['fname']);
$lname        = mysqli_real_escape_string($con, $_POST['lname']);
$company_name = mysqli_real_escape_string($con, $_POST['company_name']);
$job_profile  = mysqli_real_escape_string($con, $_POST['job_profile']);
$number       = mysqli_real_escape_string($con, $_POST['number']);
$email        = mysqli_real_escape_string($con, $_POST['email']);
$country      = mysqli_real_escape_string($con, $_POST['country']);
$city         = mysqli_real_escape_string($con, $_POST['city']);
$address1     = mysqli_real_escape_string($con, $_POST['address1']);
$address2     = mysqli_real_escape_string($con, $_POST['address2']);
$state        = mysqli_real_escape_string($con, $_POST['state']);
$pin_code     = mysqli_real_escape_string($con, $_POST['pin_code']);
$coupon_code  = mysqli_real_escape_string($con, $_POST['coupon_code'] ?? '');
$coupon_price = floatval($_POST['coupon_price'] ?? 0);

// Hidden fields from “Your Orders” section
$course_id       = mysqli_real_escape_string($con, $_POST['course_id']);
$cart_hash_id    = mysqli_real_escape_string($con, $_POST['cart_hash_id']);
$amount          = floatval($_POST['amount']);            // Order Total after coupon
$currency_code   = mysqli_real_escape_string($con, $_POST['currency_code']);
$item_name       = mysqli_real_escape_string($con, $_POST['item_name']);
$order_id        = mysqli_real_escape_string($con, $_POST['item_number']); 

// Selling options (string)
$selling_options = mysqli_real_escape_string($con, $_POST['selling_options']);

// 3) Generate User if not exists / Update if exists
$name_full = $fname . ' ' . $lname;
$hash_id1  = random($email);             
$datetime  = date("Y-m-d H:i:s");

// Check if user exists
$stmt = $con->prepare("SELECT id FROM user_info WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    // Existing user → Update
    $stmt->bind_result($existing_user_id);
    $stmt->fetch();
    $stmt->close();

    $upd = $con->prepare("UPDATE user_info 
        SET country=?, number=?, city=?, pin_code=?, course_id=?, address2=?, company_name=?, job_profile=?, state=?, name=?, address=? 
        WHERE email = ?");
    $upd->bind_param(
        "ssssssssssss",
        $country, $number, $city, $pin_code, $course_id, $address2, $company_name, $job_profile, $state, $name_full, $address1, $email
    );
    $upd->execute();
    $upd->close();
    $user_id = $existing_user_id;
} else {
    // New user → Insert
    $user_id = null;
    // use user_names function from functions.php
    $user_names = username();

    $passwd = password(); 
    $ins = $con->prepare("INSERT INTO user_info 
        (email, country, number, city, pin_code, course_id, address2, company_name, job_profile, state, name, user_id, password, datetime, hash_id, address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $ins->bind_param(
        "ssssssssssssssss",
        $email, $country, $number, $city, $pin_code, $course_id, $address2, $company_name, $job_profile, $state,
        $name_full, $user_names , $passwd, $datetime, $hash_id1, $address1
    );
    $ins->execute();
    $user_id = $ins->insert_id;
    $ins->close();
    // sendemail($con, $email, $passwd);
}

// 4) Generate Order ID if not provided
if (empty($order_id)) {
    $order_id = 'ORD-' . strtoupper(random($email)); // functions.php 
}
$order_status = 'Pending'; 
$order_date   = date("Y-m-d H:i:s");

$ins_order = $con->prepare("INSERT INTO order_details 
    (user_id, course_id, order_id, amount, payment_status, selling_options, txn_id, cc, payer_email, payment_fee, payment_gross, payment_type, handling_amount, shipping, txn_type, payment_date, hash_id, name, address, coupon_discount, cart_hash_id)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
$empty_str = '';
$zero_val  = 0;
$payment_status = 'Incomplete'; // Initially set to Incomplete
// $selling_options = ''; // Assuming this is a string of options, adjust as needed

$ins_order->bind_param(
    "issiissssssssssssssss",
    $user_id,
    $course_id,
    $order_id,
    $amount,
    $payment_status,
    $selling_options,
    $empty_str,        // txn_id
    $empty_str,        // cc
    $empty_str,        // payer_email
    $zero_val,         // payment_fee
    $amount,           // payment_gross (initially order amount)
    $empty_str,        // payment_type
    $zero_val,         // handling_amount
    $zero_val,         // shipping
    $empty_str,        // txn_type
    $empty_str,        // payment_date
    $hash_id1,         // hash_id (unique internal)
    $name_full,        // name
    $address1,         // address
    $coupon_price,     // coupon_discount
    $cart_hash_id,

);
$ins_order->execute();
$ins_order->close();

// 5) Insert Attendee Details into ceu_attende_details
$user_names   = $_POST['user_name']  ?? [];
$user_emails  = $_POST['user_email'] ?? [];
$user_phones  = $_POST['user_phone'] ?? [];
$job_titles   = $_POST['jobtitle']   ?? [];

$ins_attendee = $con->prepare("INSERT INTO ceu_attende_details 
    (name, email, number, jobtitle, order_id) 
    VALUES ( ?, ?, ?, ?, ?)");
$today = date("Y-m-d H:i:s");

foreach ($user_names as $idx => $att_name) {
    $att_email = $user_emails[$idx] ?? '';
    $att_phone = $user_phones[$idx] ?? '';
    $att_job   = $job_titles[$idx] ?? '';

    $ins_attendee->bind_param(
        "ssssi",
        $att_name,
        $att_email,
        $att_phone,
        $att_job,
        $order_id
    );
    $ins_attendee->execute();
}
$ins_attendee->close();

// 6) Update Cart Status to "1" (Paid) for the given cart_hash_id
$cart_ids_arr = explode(',', $cart_hash_id);
$upd_cart = $con->prepare("UPDATE cart SET cart_status='1', user_id=? WHERE hash_id=? AND cart_status='0'");
foreach ($cart_ids_arr as $cid) {
    $upd_cart->bind_param("ss", $user_id, $cid);
    $upd_cart->execute();
}
$upd_cart->close();

// 7) Redirect to PayPal with order details
$paypal_url = PAYPAL_URL; // Use the constant defined in config.php
$params = [
    'cmd'           => '_xclick',
    'business'      => PAYPAL_ID,   // PayPal ID
    'item_name'     => $item_name,
    'item_number'   => $order_id,
    'amount'        => number_format($amount, 2, '.', ''), 
    'currency_code' => PAYPAL_CURRENCY,
    'return'        => PAYPAL_RETURN_URL,  
    'cancel_return' => PAYPAL_CANCEL_URL ,
    'notify_url'    => PAYPAL_NOTIFY_URL, 
];

header("Location: {$paypal_url}?" . http_build_query($params));
exit;
