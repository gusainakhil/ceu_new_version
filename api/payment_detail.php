<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins or replace * with specific origin
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow specific methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allow necessary headers
include 'connect.php';
$hash_id = bin2hex(random_bytes(16));
$Site = 1;
$date = new DateTime('now', new DateTimeZone('America/Chicago'));
$payment_date = $date->format('Y-m-d H:i:s');

$prefix = "CEU";
$randomNumber = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
$userID = $prefix . $randomNumber;



// Function to log raw data in case of an error
function logRawData($con, $input, $errorMessage) {
    $rawData = file_get_contents('php://input'); // Fetch raw POST data
    $stmt = $con->prepare("INSERT INTO rawdata (raw, link, datetime) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $rawData, $errorMessage); // Bind raw data and error message
    $stmt->execute();
    $stmt->close();
}

// Function to send email
function sendEmail($to, $subject, $body, $headers) {
    return mail($to, $subject, $body, $headers);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $address2 = $input['address2'] ?? '';
    $coupon_discount = $input['coupon_discount'] ?? '';

    $requiredFields = ['name', 'email', 'country', 'number', 'city', 'pin_code', 'course_id', 'attendees'];
    foreach ($requiredFields as $field) {
        if (empty($input[$field])) {
            $errorMessage = "Missing required field: $field";
            logRawData($con, $input, $errorMessage);
            echo json_encode(["status" => "error", "message" => $errorMessage]);
            exit;
        }
    }

    try {
        // Check if the email already exists
        $emailCheckStmt = $con->prepare("SELECT id FROM user_info WHERE email = ?");
        $emailCheckStmt->bind_param("s", $input['email']);
        $emailCheckStmt->execute();
        $emailCheckStmt->store_result();

        if ($emailCheckStmt->num_rows > 0) {
            // Email exists, fetch the user ID
            $emailCheckStmt->bind_result($user_id);
            $emailCheckStmt->fetch();
            // Do not close the statement yet, we need it later for sending email
        } else {
            // Email does not exist, proceed with insertion into user_info

            // Generate password
            $input['password'] = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

            // Insert into user_info table
            $stmt = $con->prepare("INSERT INTO user_info (name, email, password, country, number, city, address, pin_code, course_id, status, hash_id, address2, company_name, job_profile, state, site ,user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)");
            $stmt->bind_param(
                "sssssssssisisssis",
                $input['name'],
                $input['email'],
                $input['password'],
            
                $input['country'],
                $input['number'],
                $input['city'],
                $input['address'],
                $input['pin_code'],
                $input['course_id'],
                $input['status'],
                $hash_id,
                $address2,
                $input['company_name'],
                $input['job_profile'],
                $input['state'],
                $Site,
                $userID
            );
            if (!$stmt->execute()) {
                throw new Exception("Error inserting into user_info: " . $stmt->error);
            }

            // Get the last inserted user ID
            $user_id = $con->insert_id; // Fetch the id from user_info
            $stmt->close();
        }

        // Insert into order_details table
        $stmt2 = $con->prepare("INSERT INTO order_details (user_id, course_id, name, address, order_id, coupon_discount, PayerID, order_status, card_name, amount, selling_options, txn_id, cc, payer_email, payment_fee, payment_gross, payment_status, payment_type, handling_amount, shipping, txn_type, payment_date, hash_id, site) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param(
            "issssssssssssssssssssssi",
            $user_id, // Use the fetched or inserted user_info id as user_id
            $input['course_id'],
            $input['name'],
            $input['address'],
            $input['order_id'],
            $coupon_discount,
            $input['PayerID'],
            $input['order_status'],
            $input['card_name'],
            $input['amount'],
            $input['selling_options'],
            $input['txn_id'],
            $input['cc'],
            $input['payer_email'],
            $input['payment_fee'],
            $input['payment_gross'],
            $input['payment_status'],
            $input['payment_type'],
            $input['handling_amount'],
            $input['shipping'],
            $input['txn_type'],
            $payment_date,
            $hash_id,
            $Site
        );
        if (!$stmt2->execute()) {
            throw new Exception("Error inserting into order_details: " . $stmt2->error);
        }

        // Get the last inserted order ID
        $order_id = $con->insert_id;
        $stmt2->close();

        // Insert attendees into ceu_attende_details table
        $attendees = $input['attendees'];
        $attendeeStmt = $con->prepare("INSERT INTO ceu_attende_details (order_id, name, email, jobtitle, number) VALUES (?, ?, ?, ?, ?)");
        foreach ($attendees as $attendee) {
            $attendeeStmt->bind_param(
                "sssss",
                $order_id, // Use the fetched order_id
                $attendee['name'],
                $attendee['email'],
                $attendee['jobTitle'],
                $attendee['phone']
            );

            if (!$attendeeStmt->execute()) {
                throw new Exception("Error inserting attendee: " . $attendeeStmt->error);
            }
        }
        $attendeeStmt->close();

        // Skip sending email if the user already exists
        if ($emailCheckStmt->num_rows == 0) {
            // Send email to the user (only if email does not exist)
            $to = $input['email'];
            $subject = "Order Confirmation";
            $body = "
    Dear {$input['name']},\n\n
    Thank you for your order. Below are your order details:\n
    - User name : {$input['email']}
    
    - Password: {$input['password']}
    
    Best regards,
    Your Company
    https://ceu-trainers.com/login
";

            $headers = "From: no-reply@ceuservices.com\r\n";

            if (!sendEmail($to, $subject, $body, $headers)) {
                throw new Exception("Error sending email to the user.");
            }
        }

        // Close the emailCheckStmt here, after we have done everything with it
        $emailCheckStmt->close();

        echo json_encode(["status" => "success", "message" => "Records inserted and email sent successfully"]);
    } catch (Exception $e) {
        logRawData($con, $input, $e->getMessage());
        echo json_encode(["status" => "error", "message" => "An error occurred: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$con->close();
?>
