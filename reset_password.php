<?php
include "connect.php";

$token = $_GET['token'] ?? '';
$message = '';

// Step 1: Handle POST submission (reset password)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password']; // ⚠️ Not hashed as per your request

    // Check if token is still valid
    $stmt = $con->prepare("SELECT * FROM user_info WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $stmt = $con->prepare("UPDATE user_info SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $new_password, $token);
        $stmt->execute();

        $message = '<div style="color:green;">✅ Password has been reset successfully.</div>';
    } else {
        $message = '<div style="color:red;">❌ Invalid or expired token.</div>';
    }
} else {
    // Step 2: GET request to show form if token is valid
    $stmt = $con->prepare("SELECT * FROM user_info WHERE reset_token = ? AND reset_expires > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $message = '<div style="color:red;">❌ Invalid or expired token.</div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Forget password</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="CEUTrainers" />
    <meta name="keywords" content="CEUTrainers, CEU, Trainers, Continuing Education, Online Courses" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css" />
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css" />
    <link rel="stylesheet" href="assets/css/vendor/magnifypopup.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/odometer.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/animation.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui-min.css" />
    <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/tipped.min.css" />
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />


    <?php

    include "header.php";

    ?>
</head>

<body>
    <div class="edu-breadcrumb-area ">
        <div class="container">
            <div class="login-form-box">
                <h3 class="title">Update Password</h3>


                <?= $message ?>

                <?php if ($_SERVER['REQUEST_METHOD'] !== 'POST' && isset($user)) : ?>
                    <form method="post">
                        <div class="form-group">
                            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                            <label>New Password:</label><br>
                            <input type="text" name="new_password" placeholder="Enter your new password" required><br><br>
                            
                            <button class="edu-btn btn-medium" type="submit">Reset Password</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>

        </div>
    </div>
    </div>
  <?php  include "footer.php"; ?>

</body>

</html>