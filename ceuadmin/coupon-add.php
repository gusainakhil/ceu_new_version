<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<?php
include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login.php");
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Coupons Add </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">

</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- sidebar -->
        <?php include 'sidebar.php' ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php include 'header.php' ?>

            <!-- Body: Body -->
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Coupons Add</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <form id="add_coupon" method="post">
                        <div class="row clearfix g-3">
                            <div class="col-lg-4">
                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Coupon Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons_status" value="Active" checked>
                                            <label class="form-check-label">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons_status" value=" Future_Plan">
                                            <label class="form-check-label">
                                                Future Plan
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Date Schedule</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" class="form-control w-100" name="start_date" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">End Date</label>
                                                <input type="date" class="form-control w-100" name="expire_date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Coupon Information</h6>
                                    </div>
                                    <div class="card-body">

                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-6">
                                                <label class="form-label">Coupons Code</label>
                                                <input type="text" class="form-control" name="coupon_code" required>
                                            </div>


                                            <div class="col-md-6">
                                                <label class="form-label">Coupons Limits</label>
                                                <input type="number" class="form-control" name="coupons_limit" required>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Discount value</label>
                                                <input type="text" class="form-control" required name="discount">
                                                <input type="hidden" value="6" name="type">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Custom Settings-->


        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Jquery Page Js -->
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Include SweetAlert library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/template.js"></script>
<script>
    $(document).ready(function() {
        $("#add_coupon").submit(function(e) {
            e.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: "signin_ajax.php",
                method: "POST",
                data: $(this).serialize(),
                success: function(data) {
                    //  alert(data)
                    if (data == "0") {
                        Swal.fire('Success!', 'coupon added', 'success');
                    } else {
                        Swal.fire('Error!', 'Please try again. Your category is no submitted.', 'error');
                    }
                    window.location.href = "coupon-list";
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later.', 'error');
                }

            });
        });
    });
</script>

</html>