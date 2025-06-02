<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php
include "connect.php";
include "functions.php";
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Order Details</title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">

    </script>
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

            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <?php
                                $order_detail = $_GET['order_detail'];
                                $a = 0;
                                $result = mysqli_query($con, "SELECT 
                                    u.pin_code AS pin_code,
                                    u.company_name AS company_name,
                                    u.country AS country,
                                    u.number AS number,
                                    u.job_profile AS job_profile,
                                    u.state AS state,
                                    u.city AS city,
                                    o.order_id AS order_id,
                                    o.course_id AS course_id,
                                    o.txn_id AS txn_id,
                                    o.selling_options AS selling_options,
                                    o.users_arr AS users_arr,
                                    o.coupon_discount AS coupon_discount,
                                    o.payment_fee AS payment_fee,
                                    o.amount AS amount,
                                    o.address AS address,
                                    o.payer_email AS email,
                                    o.trans_date AS trans_date,
                                    o.name AS name
                                FROM 
                                    user_info u
                                JOIN 
                                    order_details o ON u.id = o.user_id
                                WHERE 
                                    o.order_id = '$order_detail' ");
                                $row = mysqli_fetch_assoc($result);
                                // -- user_info.id = order_details.user_id and

                                    $a++;
                                ?>
                                    <h3 class="fw-bold mb-0">Order ID:
                                        <?php echo $row['order_id']; ?>
                                    </h3>

                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                        <div class="col">
                            <div class="alert-success alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Order Created at</div>
                                        <span class="small">
                                            <?php echo $row['trans_date']; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-danger alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-user fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">
                                            <?php echo $row['name']; ?>
                                        </div>
                                        <span class="small">
                                            <?php echo $row['email']; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-warning alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Transaction Id</div>
                                        <span class="small">
                                            <?php echo $row['txn_id']; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-info alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Contact No</div>
                                        <span class="small">
                                            <?php echo $row['number']; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3 row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 row-deck">

                        <div class="col">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Billing Address</h6>

                                </div>
                                <div class="card-body">
                                    <div class="row g-3">

                                        <div class="col-12">
                                            <!--<label class="form-label col-6 col-sm-5">Address:</label>-->
                                            <span>
                                                <?php echo $row['name'] . "<br><br>" . $row['company_name'] . "<br>" . $row['address'] . "<br>" . $row['city'] . ",&nbsp;" . $row['state'] . ",&nbsp;" . $row['pin_code'] . "<br>" . $row['country']; ?>
                                            </span>
                                        </div>
                                        <?php if(!empty($row['email'])){ ?>
                                        <div class="col-12">
                                            <span>
                                                <b>Email Address: </b><?php echo $row['email']; ?>
                                            </span>
                                        </div>
                                        <?php } ?>
                                        <?php if(!empty($row['job_profile'])){ ?>
                                            <div class="col-12">
                                                <span> <b>Job Profile: </b><?php echo $row['job_profile']; ?> </span>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($row['users_arr'])){ ?>
                        <div class="col">
                            <div class="card">
                                <div  class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Attendees Details </h6>
                                </div>
                                <div class="card-body">
                                   <div class="row clearfix g-3">
                                        <div class="col-sm-12">
                                            <div class="card mb-3" style="border:0;">
                                                <div class="card-body">
                                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Phone</th>
                                                                <th>Job Profile</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $array = stringToArray($row['users_arr']);
                                                                foreach ($array as $array) {
                                                                    $a++;
                                                                ?>
                                                                <tr>
                                                                    <td>
                                                                        <span class="fw-bold ms-1">
                                                                            <?php echo $array['0']; ?>
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        <?php echo $array['1']; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php  echo $array['2']; ?>
                                                                    </td>
                                                                    <?php if(!empty($array['3'])){ ?>
                                                                    <td>
                                                                        <?php  echo $array['3']; ?>
                                                                    </td>
                                                                    <?php } ?>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3">
                        <div class="col-xl-12 col-xxl-">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Order Summary</h6>
                                </div>
                                <div class="card-body">
                                    <div class="product-cart">
                                        <div class="checkout-table table-responsive">
                                            <table id="" class="table display dataTable table-hover align-middle" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="product">Product Image</th> -->
                                                        <th>Course Name</th>
                                                        <th>Selling options</th>

                                                        <th class="price">Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php
if (array_check($row['selling_options']) != "array") {
    // Check if the data is in JSON format
    $isJson = is_string($row['selling_options']) && is_array(json_decode($row['selling_options'], true)) && (json_last_error() == JSON_ERROR_NONE);

    if ($isJson) {
        $array = json_decode($row['selling_options'], true); // Decode JSON into an associative array
        foreach ($array as $key1 => $innerArray) {
            $price = 0;
        ?>
            <tr>
                <!-- Course Name -->
                <td style="word-wrap: break-word; max-width: 400px;">
                    <span class="text-primary">
                        <?php echo $key1; ?>
                    </span>
                </td>
                <td>
                    <table class="table summery-table">
                        <tbody>
                            <?php
                            foreach ($innerArray as $key => $value) {
                                $price += $value;
                            ?>
                                <tr id="tr_price">
                                    <td><?php echo $key; ?></td>
                                    <td>$<?php echo $value; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </td>

                <td>
                    <?php echo "<span>$</span>" . $price; ?>
                </td>
            </tr>
        <?php }
    } else { ?>
        <!-- Non-JSON Handling -->
        <tr>
            <td style="word-wrap: break-word; max-width: 400px;">
                <span class="text-primary">
                    <?php echo course($con, $row['course_id']); ?>
                </span>
            </td>
            <td>
                <table class="table summery-table">
<tbody>
    <?php
    $array = stringToArray($row['selling_options']);
    foreach ($array as $key => $value) { ?>
        <tr id="tr_price">
            <td style="font-weight: 100;"><?php echo htmlspecialchars($key); ?></td>
            <td>$<?php echo htmlspecialchars($value); ?></td>
        </tr>
    <?php } ?>
</tbody>


                </table>
            </td>

            <td>
                <?php echo "<span>$</span>" . $row['amount']; ?>
            </td>
        </tr>
    <?php }
} else {
    $array = stringToArray($row['selling_options']);
    foreach ($array as $key1 => $innerArray) {
        $price = 0;
    ?>
        <tr>
            <!-- Course Name -->
            <td style="word-wrap: break-word; max-width: 400px;">
                <span class="text-primary">
                    <?php echo $key1; ?>
                </span>
            </td>
            <td>
                <table class="table summery-table">
                    <tbody>
                        <?php
                        foreach ($innerArray as $key => $value) {
                            $price += $value;
                        ?>
                            <tr id="tr_price">
                                <td><?php print_r( $row['selling_options']) ?></td>
                                <td>$<?php echo $value; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </td>

            <td>
                <?php echo "<span>$</span>" . $price; ?>
            </td>
        </tr>
<?php }
}
?>


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap justify-content-end">
                                            <div class="checkout-total">
                                                <div class="single-total">
                                                    <p class="value">Subtotal Price:</p>
                                                    <p class="price">
                                                        <?php echo "<span>$</span>" . $row['amount']; ?>
                                                    </p>
                                                </div>

                                                <div class="single-total">
                                                    <p class="value">Discount (-):</p>
                                                    <p class="price">
                                                        <?php echo "<span>-$</span>" . $row['coupon_discount']; ?>
                                                    </p>
                                                </div>
                                                <!-- <div class="single-total">
                                                        <p class="value">payment fee:</p>
                                                        <p class="price">
                                                            <?php echo  "<span>-$</span>" . $row['payment_fee']; ?>
                                                        </p>
                                                    </div> -->
                                                <div class="single-total total-payable">
                                                    <p class="value">Total Payable:</p>
                                                    <p class="price">
                                                        <?php
                                                        $bal = $row['amount'];

                                                        echo "<span>$</span>" . $bal ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- Row end  -->
                </div>
            </div>

        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->

    <script>
        $(document).ready(function() {
            $('#myCartTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
        });
    </script>
</body>


</html>