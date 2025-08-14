<?php
include "connect.php";

header('Content-Type: application/json'); // 📢 Important for JS fetch

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $con->prepare("SELECT id FROM user_info WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->close();

        $token = bin2hex(random_bytes(50));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $con->prepare("UPDATE user_info SET reset_token = ?, reset_expires = ? WHERE email = ?");
        $stmt->bind_param("sss", $token, $expires, $email);
        $stmt->execute();
        $stmt->close();

        $reset_link = "https://ceuservices.com/reset_password.php?token=$token";
        $subject = "Reset Your Password";
        $message = "Click the following link to reset your password:\n\n$reset_link\n\nThis link is valid for 1 hour.";
        $headers = "From: no-reply@ceuservices.com";

        if (mail($email, $subject, $message, $headers)) {
            $response = ['status' => 'success', 'message' => '✅ Reset link has been sent to your email.'];
        } else {
            $response = ['status' => 'error', 'message' => '❌ Failed to send email.'];
        }
    } else {
        $response = ['status' => 'error', 'message' => '❌ No user found with that email.'];
    }
}

echo json_encode($response);
?>
