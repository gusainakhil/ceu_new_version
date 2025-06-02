<?php 
// Include configuration file 
include "connect.php";



// STEP 1: Read POST data from PayPal
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();

foreach ($raw_post_array as $keyval) {
    $keyval = explode('=', $keyval);
    if (count($keyval) == 2) {
        $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
}

// STEP 2: Build the required acknowledgement message
$req = 'cmd=_notify-validate';
foreach ($myPost as $key => $value) {
    $value = urlencode($value);
    $req .= "&$key=$value";
}

// STEP 3: Post IPN data back to PayPal to validate
$paypal_url = (defined('PAYPAL_SANDBOX') && PAYPAL_SANDBOX)
    ? 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr'
    : 'https://ipnpb.paypal.com/cgi-bin/webscr';

$ch = curl_init($paypal_url);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

$res = curl_exec($ch);
curl_close($ch);

// STEP 4: Inspect PayPal validation result and act accordingly
if (strcmp($res, "VERIFIED") == 0) {
    // The IPN is verified, process it
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];

    // OPTIONAL: Connect to DB to store transaction




        $stmt = $con->prepare("INSERT INTO payments (item_name, item_number, payment_status, payment_amount, payment_currency, txn_id, receiver_email, payer_email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $item_name, $item_number, $payment_status, $payment_amount, $payment_currency, $txn_id, $receiver_email, $payer_email);
        $stmt->execute();


    $stmt->close();
    $con->close();

    // Log success
    file_put_contents('ipn_log.txt', "VERIFIED: $txn_id\n", FILE_APPEND);

} else {
    // IPN invalid, log for review
    file_put_contents('ipn_log.txt', "INVALID IPN\n", FILE_APPEND);
}
?>
