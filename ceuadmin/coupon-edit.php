<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<?php

include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $coupons_status = $_POST['coupons_status'];
    $start_date = $_POST['start_date'];
    $expire_date = $_POST['expire_date'];
    $coupon_code = $_POST['coupon_code'];
    $coupons_limit = $_POST['coupons_limit'];
    $discount = $_POST['discount'];

    $query = "UPDATE sales_promotion_coupon SET coupons_status='$coupons_status', start_date='$start_date',expire_date='$expire_date',coupon_code='$coupon_code',coupons_limit='$coupons_limit',discount='$discount' WHERE id='".$_GET['id']."'";
    // echo $query;
    mysqli_query($con, $query);
    header("Location: coupons-list");
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Coupons Edit </title>
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
                                <h3 class="fw-bold mb-0">Coupons Edit </h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <?php $id = $_GET['id'];
                    $result = mysqli_query($con, "SELECT * FROM sales_promotion_coupon where id =$id AND status = 1 ");
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <form id="add_coupon" method="post">
                        <div class="row clearfix g-3">
                            <div class="col-lg-4">
                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Coupon Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons_status" value="Active" <?php if ($row['coupons_status'] == "Active") {
                                                                                                                                    echo "checked";
                                                                                                                                } ?>>
                                            <label class="form-check-label">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="coupons_status" value="Future_Plan" <?php if ($row['coupons_status'] == "Future_Plan") {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?>>
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
                                                <input type="date" class="form-control w-100" name="start_date" value="<?php echo date("Y-m-d", strtotime($row['start_date'])); ?>" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">End Date</label>
                                                <input type="date" class="form-control w-100" name="expire_date" value="<?php echo date("Y-m-d", strtotime($row['expire_date'])); ?>" required>
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
                                                <input type="text" class="form-control" value="<?php echo $row['coupon_code']; ?>" name="coupon_code" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Coupons Limits</label>
                                                <input type="number" class="form-control" name="coupons_limit" value="<?php echo $row['coupons_limit']; ?>" required>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="form-label">Discount value</label>
                                                <input type="text" class="form-control" required name="discount" value="<?php echo $row['discount']; ?>">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4 text-uppercase px-5">Submit</button>

                                    </div>
                                </div>
                            </div>
                        </div><!-- Row End -->
                    </form>
                </div>
            </div>

            <!-- Modal Custom Settings-->


        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/template.js"></script>
</body>

</html>