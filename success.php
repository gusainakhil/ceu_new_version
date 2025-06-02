<?php
include 'connect.php';
include 'functions.php';

ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Log raw session data
$link = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$session_array = json_encode($_SESSION);

$stmt = $con->prepare("INSERT INTO rawdata (raw, link) VALUES (?, ?)");
$stmt->bind_param("ss", $session_array, $link);
$stmt->execute();
$stmt->close();

    // Sanitize session variables
    $fields = [
        's_fname', 's_lname', 's_email', 's_hash_id', 's_number', 's_address', 
        's_address2', 's_order_id', 's_state', 's_pin_code', 's_course_id', 
        's_city', 's_amount', 's_couponCode', 's_coupon_price', 
        's_selling_options', 's_company_name', 's_job_profile', 's_country'
    ];
    $data = [];
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($con, $_SESSION[$field] ?? '');
    }

    // Check for duplicate cart hash ID
    $stmt = $con->prepare("SELECT id FROM order_details WHERE cart_hash_id=?");
    $stmt->bind_param("s", $data['s_hash_id']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows >= 1) {
        $stmt->close();
        header("Location: index");
        exit;
    }
    $stmt->close();

    // Validate payment response
    $required_get = ['payment_status', 'amt', 'PayerID', 'tx'];
    foreach ($required_get as $key) {
        if (empty($_GET[$key])) {
            header("Location: index");
            exit;
        }
    }

    $datetime = date("Y-m-d H:i:s");
    $user_id = username();
    $password = password(); // Consider using password_hash()
    $hash_id1 = random($data['s_email']);

    // Check if user exists
    $stmt = $con->prepare("SELECT id FROM user_info WHERE email=?");
    $stmt->bind_param("s", $data['s_email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_exists = $result->num_rows > 0;
    $stmt->close();

    if ($user_exists) {
        // Update user
        $update_query = "UPDATE user_info SET country=?, number=?, city=?, pin_code=?, course_id=?, address2=?, company_name=?, job_profile=?, state=?, name=?, address=? WHERE email=?";
        $stmt = $con->prepare($update_query);
        $name = $data['s_fname'] . " " . $data['s_lname'];
        $stmt->bind_param(
            "ssssssssssss",
            $data['s_country'], $data['s_number'], $data['s_city'], $data['s_pin_code'],
            $data['s_course_id'], $data['s_address2'], $data['s_company_name'],
            $data['s_job_profile'], $data['s_state'], $name, $data['s_address'], $data['s_email']
        );
        $stmt->execute();
        $stmt->close();
    } else {
        // Insert user
        $insert_query = "INSERT INTO user_info (email, country, number, city, pin_code, course_id, address2, company_name, job_profile, state, name, user_id, password, datetime, hash_id, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($insert_query);
        $name = $data['s_fname'] . " " . $data['s_lname'];
        $stmt->bind_param(
            "ssssssssssssssss",
            $data['s_email'], $data['s_country'], $data['s_number'], $data['s_city'], $data['s_pin_code'],
            $data['s_course_id'], $data['s_address2'], $data['s_company_name'], $data['s_job_profile'],
            $data['s_state'], $name, $user_id, $password, $datetime, $hash_id1, $data['s_address']
        );
        $stmt->execute();
        $stmt->close();
        sendemail($con, $data['s_email'], $password);
    }

    // Get user id
    $stmt = $con->prepare("SELECT id FROM user_info WHERE email=?");
    $stmt->bind_param("s", $data['s_email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_row = $result->fetch_assoc();
    $stmt->close();

    // Prepare payment data
    $payment_fields = ['payment_status', 'amt', 'PayerID', 'tx', 'cc', 'payer_email', 'payment_fee', 'payment_gross', 'payment_type', 'handling_amount', 'shipping', 'txn_type', 'payment_date'];
    $payment_data = [];
    foreach ($payment_fields as $field) {
        $payment_data[$field] = mysqli_real_escape_string($con, $_GET[$field] ?? '');
    }
    $payment_data['hash_id'] = random($datetime);

    // Insert order details
    $order_query = "INSERT INTO order_details (user_id, course_id, order_id, amount, PayerID, payment_status, selling_options, txn_id, cc, payer_email, payment_fee, payment_gross, payment_type, handling_amount, shipping, txn_type, payment_date, hash_id, name, address, coupon_discount, cart_hash_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($order_query);
    $name = $data['s_fname'] . " " . $data['s_lname'];
    $stmt->bind_param(
        "isssssssssssssssssssss",
        $user_row['id'], $data['s_course_id'], $data['s_order_id'], $data['s_amount'], $payment_data['PayerID'],
        $payment_data['payment_status'], $data['s_selling_options'], $payment_data['tx'], $payment_data['cc'],
        $payment_data['payer_email'], $payment_data['payment_fee'], $payment_data['amt'], $payment_data['payment_type'],
        $payment_data['handling_amount'], $payment_data['shipping'], $payment_data['txn_type'],
        $payment_data['payment_date'], $payment_data['hash_id'], $name, $data['s_address'],
        $data['s_coupon_price'], $data['s_hash_id']
    );
    $stmt->execute();
    $stmt->close();

    // Update cart status
    $cart_ids = explode(',', $data['s_hash_id']);
    $cart_update_query = "UPDATE cart SET cart_status='1', user_id=? WHERE hash_id=? AND cart_status='0'";
    $stmt = $con->prepare($cart_update_query);
    foreach ($cart_ids as $cart_id) {
        $stmt->bind_param("ss", $user_id, $cart_id);
        $stmt->execute();
    }
    $stmt->close();

    // Send order email and reset session
    order_email($con, $data['s_hash_id'], $data['s_email']);

    session_regenerate_id(true);
    $_SESSION = [
        'email' => $data['s_email'],
        'password' => $password,
        'user_id' => user_last_id($con),
        'name' => $data['s_fname'] . " " . $data['s_lname'],
        'hash_id' => $hash_id1
    ];

    header("Location: https://ceuservices.com/payment-done?order_id={$data['s_hash_id']}");
    exit;


ob_end_flush();
?>
