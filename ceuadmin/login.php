


<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<?php
include 'connect.php';
include 'functions.php';


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $log_query = mysqli_query($con, "SELECT * FROM admin_login WHERE username='$username' ");
        if (mysqli_num_rows($log_query) == 1) {
            $log_row = mysqli_fetch_assoc($log_query);
            if ($log_row['password'] == $password) {
                $_SESSION['username'] = $username;
                $_SESSION['company_name'] = $log_row['company_name'];
                header("Location: index.php");
            } else {
                echo "<script>
            Swal.fire({
                title: 'Something went wrong!',
                text: 'Seems like Password is Wrong',
                icon: 'error'
              });</script>";
                header("Location: login.php");
            }
        } else {
            echo "<script>
            Swal.fire({
                title: 'Something went wrong!',
                text: 'Seems like Username is Wrong',
                icon: 'error'
              });</script>";
            header("Location: login.php");
        }
    }
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CEUTrainers | Signin </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">
    <!-- Google Code  -->
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                                    <!-- <i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i> -->
                                </div>
                                <div class="mb-5">
                                    <h2 class="color-900 text-center">A few clicks is all it takes.</h2>
                                </div>
                                <!-- Image block -->
                                <div class="">
                                    <img src="assets/images/login-img.svg" alt="login-img">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
                                <!-- Form -->
                                <form class="row g-1 p-3 p-md-4" method="Post">
                                    <div class="col-12 text-center mb-5">
                                        <h1>Sign in</h1>
                                        <span>Free access to our dashboard.</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control form-control-lg" placeholder="name@example.com">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <div class="form-label">
                                                <span class="d-flex justify-content-between align-items-center">
                                                    Password
                                                </span>
                                            </div>
                                            <input type="password" name="password" class="form-control form-control-lg" placeholder="***************">
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="Submit" class="btn btn-lg btn-block btn-primary lift text-uppercase" atl="signin">SIGN IN</button>
                                    </div>
                                </form>
                                <!-- End Form -->

                            </div>
                        </div>
                    </div> <!-- End Row -->

                </div>
            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/js/template.js"></script>
    
</body>

</html>