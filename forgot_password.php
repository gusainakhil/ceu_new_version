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
        <div class="breadcrumb-inner">
            <div class="page-title">
                <h1 class="title">Forgot Password</h1>
                <h3 class="heading-title">We’re Here to Help You Recover Your Account!</h3>
                <span class="shape-line" style="color:#1ab69d"><i class="icon-19"></i></span>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1">
                <span></span>
            </li>
            <li class="shape-2 scene"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape" /></li>
            <li class="shape-3 scene"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape" /></li>
            <li class="shape-4">
                <span></span>
            </li>
            <li class="shape-5 scene"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape" /></li>
        </ul>
    </div>
</div>

<div class="row g-5 justify-content-center my-5">
    <div class="col-lg-5 my-5">
        <div class="login-form-box">
            <h3 class="title">Reset Password</h3>
            <form method="post" id="forgot_password_form">
                <div class="form-group">
                    <label for="forgot-email">Email Address*</label>
                    <input type="email" name="email" id="forgot-email" placeholder="Enter your email address" required>
                </div>
                <div class="form-group position-relative">
                    <button type="submit" class="edu-btn btn-medium" id="submitBtn" name="submit" value="submit">
                        <span id="btnText">Send Reset Link <i class="icon-4"></i></span>
                        <span id="loader" style="display: none; margin-left: 10px;">
                            <i class="fa fa-spinner fa-spin"></i>
                        </span>
                    </button>
                </div>
                <div id="responseBox" style="display:none; padding: 10px; margin-top: 15px; border-radius: 5px;"></div>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>

<script>
document.getElementById('forgot_password_form').addEventListener('submit', function(e) {
    e.preventDefault();

    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const loader = document.getElementById('loader');
    const responseBox = document.getElementById('responseBox');

    // UI: disable button and show loader
    submitBtn.disabled = true;
    loader.style.display = 'inline-block';
    btnText.style.opacity = '0.6';

    const formData = new FormData(this);

    fetch('send_reset_link.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        responseBox.innerText = data.message;
        responseBox.style.display = 'block';
        responseBox.style.backgroundColor = data.status === 'success' ? '#d4edda' : '#f8d7da';
        responseBox.style.color = data.status === 'success' ? '#155724' : '#721c24';
        responseBox.style.border = data.status === 'success' ? '1px solid #c3e6cb' : '1px solid #f5c6cb';
    })
    .catch(err => {
        responseBox.innerText = 'Something went wrong.';
        responseBox.style.display = 'block';
        responseBox.style.backgroundColor = '#f8d7da';
        responseBox.style.color = '#721c24';
        responseBox.style.border = '1px solid #f5c6cb';
    })
    .finally(() => {
        // UI: re-enable button and hide loader
        submitBtn.disabled = false;
        loader.style.display = 'none';
        btnText.style.opacity = '1';
    });
});
</script>

<!-- Include FontAwesome for spinner if not already included -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</body>
</html> 

