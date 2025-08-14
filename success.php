<?php
include 'connect.php';  
// Include DB config
require 'config.php';

// Get PayPal data from URL
$paymentStatus = $_GET['payment_status'] ?? '';
$payerName = ($_GET['first_name'] ?? '') . ' ' . ($_GET['last_name'] ?? '');
$txnId = $_GET['txn_id'] ?? '';
$amount = $_GET['mc_gross'] ?? '';
$currency = $_GET['mc_currency'] ?? '';
$itemName = $_GET['item_name'] ?? '';
$paymentDate = $_GET['payment_date'] ?? date('Y-m-d');
$payer_id =  $_GET['PayerID'] ?? '';
 $payer_email = $_GET['payer_email'] ?? ''; 
$payment_fee = $_GET['payment_fee'] ?? '';
$payment_type = $_GET['payment_type'] ?? ''; 
$handling_amount = $_GET['handling_amount'] ?? ''; 
$txn_type = $_GET['txn_type'] ?? ''; 

// Update order in DB using txn_id or item_number (you can also use item_number)

    // Prevent duplicate update
    $stmt = $con->prepare("SELECT * FROM order_details WHERE txn_id = ?");
    $stmt->bind_param("s", $txnId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // No existing txn, try to update using item_number or latest unpaid order
        $itemNumber = $_GET['item_number'] ?? '';
        $update = $con->prepare("UPDATE order_details 
SET payment_status = ?, name = ?, txn_id = ?, payment_gross = ?, cc = ?, payment_date = ?,  
    PayerID = ?, payer_email = ?, payment_fee = ?, payment_type = ?, handling_amount = ?, txn_type = ? 
WHERE order_id = ?
");
       $update->bind_param("sssssssssssss", 
    $paymentStatus, $payerName, $txnId, $amount, $currency, $paymentDate,
    $payer_id, $payer_email, $payment_fee, $payment_type, $handling_amount, $txn_type, $itemNumber
);

        $update->execute();
        $update->close();
    }

    $stmt->close();
    $con->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Success</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0fdf4;
            padding-top: 80px;
        }
        .card {
            max-width: 700px;
            margin: 0 auto;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #28a745;
            color: white;
            font-size: 1.7rem;
            border-radius: 15px 15px 0 0;
        }
        .card-body {
            font-size: 1.1rem;
        }
        .btn-back {
            margin-top: 25px;
        }
        .payment-details {
            text-align: left;
        }
        .payment-details strong {
            width: 150px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="card">
            <div class="card-header">
                🎉 Payment Successful!
            </div>
            <div class="card-body">
                <p class="lead">Thank you <strong><?= htmlspecialchars($payerName) ?></strong> for your payment.</p>
                <div class="payment-details mx-auto mt-4 mb-4">
                    <p><strong>Transaction ID:</strong> <?= htmlspecialchars($txnId) ?></p>
                    <p><strong>Course:</strong> <?= htmlspecialchars($itemName) ?></p>
                    <p><strong>Amount Paid:</strong> <?= htmlspecialchars($amount) ?> <?= htmlspecialchars($currency) ?></p>
                    <p><strong>Status:</strong> <?= htmlspecialchars($paymentStatus) ?></p>
                    <p><strong>Date:</strong> <?= htmlspecialchars($paymentDate) ?></p>
                </div>
                <a href="index.php" class="btn btn-success btn-back">← Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
