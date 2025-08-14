<!DOCTYPE html>

<?php
include "connect.php";
include "functions.php";

?>
<html>


<head>
    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>
        CEUTrainers | Online Education Platform
    </title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />

    <!-- CSS
	============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css" />
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css" />
    <link rel="stylesheet" href="assets/css/vendor/magnifypopup.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/odometer.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/animation.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css" />
    <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/tipped.min.css" />
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Site Stylesheet -->
       <link rel="canonical" href="https://ceuservices.com/login.php" />
    <link rel="stylesheet" href="assets/css/app.css" />

    <style type="text/css">
        #double li {
            width: 50%;
        }
    </style>
</head>

<body>
    <div id="main-wrapper" class="main-wrapper">

        <?php include "header.php" ?>

        <div class="edu-breadcrumb-area ">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">Log In</h1>
                        <h3 class="heading-title">We're Always <span class="color-secondary">Eager to Have</span> You!</h3>
                        <span class="shape-line" style="color:#1ab69d"><i class="icon-19"></i></span>
                    </div>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape" />
                </li>
                <li class="shape-3 scene"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape" />
                </li>
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape" />
                </li>
            </ul>
        </div>

        <div class="row g-5 justify-content-center my-5">
            <div class="col-lg-5 my-5">
                <div class="login-form-box">
                    <h3 class="title">Sign in</h3>
                    <form method="post" id="login_form">
                        <div class="form-group">
                            <label for="current-log-email">Email Address*</label>
                            <input type="email" name="email" id="current-log-email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <label for="current-log-password">Password*</label>
                            <input type="password" name="password" id="current-log-password" placeholder="Password" required>
                            <span class="password-show"><i class="icon-76"></i></span>
                        </div>
                        <div class="form-group chekbox-area">
                            <div class="edu-form-check">
                                <input type="checkbox" id="remember-me">
                                <label for="remember-me">Remember Me</label>
                            </div>

                            <a href="forgot_password.php" class="password-reset">Lost your password?</a>
                            <input type="hidden" name="type" value="login">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="edu-btn btn-medium" name="submit" value="submit">Sign in <i class="icon-4"></i></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>


        <?php include "footer.php" ?>


    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- JS
	============================================ -->
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- Jquery Js -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/sal.min.js"></script>
    <script src="assets/js/vendor/backtotop.min.js"></script>
    <script src="assets/js/vendor/magnifypopup.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/odometer.min.js"></script>
    <script src="assets/js/vendor/isotop.min.js"></script>
    <script src="assets/js/vendor/imageloaded.min.js"></script>
    <script src="assets/js/vendor/lightbox.min.js"></script>
    <script src="assets/js/vendor/paralax.min.js"></script>
    <script src="assets/js/vendor/paralax-scroll.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="assets/js/vendor/svg-inject.min.js"></script>
    <script src="assets/js/vendor/vivus.min.js"></script>
    <script src="assets/js/vendor/tipped.min.js"></script>
    <script src="assets/js/vendor/smooth-scroll.min.js"></script>
    <script src="assets/js/vendor/isInViewport.jquery.min.js"></script>
    <!--Calender Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
    <script>
    
    $(document).ready(function () {
        $('.password-show').click(function () {
            var passwordInput = $('#current-log-password');
            var passwordIcon = $(this).find('i');

            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
            } else {
                passwordInput.attr('type', 'password');
            }
        });
    });
    
        $(document).ready(function() {
            $("#login_form").on("submit", function(ea) {
                ea.preventDefault();
                $.ajax({
                    url: "login_form.php",
                    method: "POST",
                    data: $("#login_form").serialize(),
                    success: function(data) {
                        if (data == "1") {
                            // Email exists, show success message and redirect to dashboard.php
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Successfully Login!',
                            }).then((result) => {
                                window.location.href = "dashboard";
                            });
                        } else if (data == "2") {
                            // Email doesn't exist, show info message and refresh the page
                            Swal.fire({
                                icon: 'info',
                                title: 'Info!',
                                text: 'Seems like Email Address doesn\'t exist in our database!'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Seems like Password is wrong!'
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>


</html>