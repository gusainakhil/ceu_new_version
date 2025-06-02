<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<?php
include "connect.php";
include "functions.php";
if (empty($_SESSION['username'])) {
    header("Location: login");
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">
        <?php include 'sidebar.php' ?>
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">
            <!-- Body: Header -->
            <?php include 'header.php' ?>
            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                     <div id="live-data"></div>
                    <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-5">
                        <div class="col">
                            <div class="alert-success alert mb-0">
                                <span><strong>Today</strong></span>
                                <div class="d-flex align-items-center">

                                    <div class="avatar rounded no-thumbnail bg-success text-light"><i class="icofont-dollar fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h1 mb-0"><strong>
                                                <?php
                                                $result = mysqli_query($con, "SELECT COUNT(*) as num_sales FROM order_details WHERE date_format(trans_date,'%y-%m-%d') = date_format(sysdate(),'%y-%m-%d') AND payment_status = 'completed';");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['num_sales'];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>

                                            </strong>
                                        </div>
                                        <span class="small">
                                            <strong>$
                                                <?php
                                                $result = mysqli_query($con, "SELECT SUM(amount) as total_amount
                                    FROM order_details
                                     WHERE  DATE(trans_date) = CURDATE() and payment_status = 'completed';");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['total_amount'] !== null ? $row['total_amount'] : 0;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-danger alert mb-0">
                                <span><strong> Week</strong> </span>
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="icofont-coins fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h1 mb-0"><strong>
                                                <?php
                                                $result = mysqli_query($con, "SELECT COUNT(*) as num_sales
                              FROM order_details
                              WHERE YEAR(trans_date) = YEAR(CURDATE())
                              AND WEEK(trans_date) = WEEK(CURDATE()) AND payment_status = 'completed';");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['num_sales'];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>


                                            </strong></div>
                                        <span class="small"><strong>
                                                $
                                                <?php
                                                $result = mysqli_query($con, "SELECT SUM(amount) as total_amount
                              FROM order_details
                              WHERE WEEK(trans_date) = WEEK(CURDATE()) AND payment_status = 'completed';");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['total_amount'] !== null ? $row['total_amount'] : 0;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>


                                            </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-dark alert mb-0">
                                <span><strong>Month</strong></span>
                                <div class="d-flex align-items-center">

                                    <div class="avatar rounded no-thumbnail bg-success text-light"><i class="icofont-money-bag fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h1 mb-0"><strong>
                                                <?php
                                                $result = mysqli_query($con, "SELECT COUNT(*) as num_sales
                                                FROM order_details
                                                WHERE YEAR(trans_date) = YEAR(CURDATE())
                                                AND MONTH(trans_date) = MONTH(CURDATE()) AND payment_status = 'completed';
                              ;");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['num_sales'];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>

                                            </strong>
                                        </div>
                                        <span class="small">
                                            <strong>$
                                                <?php
                                                $result = mysqli_query($con, "SELECT SUM(amount) as total_amount
                                                FROM order_details
                                                WHERE YEAR(trans_date) = YEAR(CURDATE())
                                                AND MONTH(trans_date) = MONTH(CURDATE()) AND payment_status = 'completed';
                                                ;");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['total_amount'] !== null ? $row['total_amount'] : 0;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>
                                            </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="alert-warning alert mb-0">
                                <span><strong>Year</strong></span>
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="icofont-money fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h1 mb-0"><strong>
                                                <?php
                                                $result = mysqli_query($con, "SELECT COUNT(*) as num_sales
                              FROM order_details
                              WHERE YEAR(trans_date) = YEAR(CURDATE()) AND payment_status = 'completed';");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['num_sales'];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>

                                            </strong>
                                        </div>
                                        <span class="small"><strong>$
                                                <?php
                                                $result = mysqli_query($con, "SELECT SUM(amount) as total_amount
                              FROM order_details
                              WHERE YEAR(trans_date) = YEAR(CURDATE()) AND payment_status = 'completed';");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['total_amount'] !== null ? $row['total_amount'] : 0;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>

                                            </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-info alert mb-0">
                                <span><strong>Till</strong></span>
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-info text-light"><i class="icofont-bank" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h1 mb-0"><strong>
                                                <?php
                                                $result = mysqli_query($con, "SELECT COUNT(*) as num_orders
                              FROM order_details where  payment_status = 'completed' ;");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['num_orders'];
                                                } else {
                                                    echo "0";
                                                }
                                                ?>



                                            </strong></div>
                                        <span class="small"><strong>$
                                                <?php
                                                $result = mysqli_query($con, "SELECT SUM(amount) as total_amount
                              FROM order_details where  payment_status = 'completed' ;");

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo $row['total_amount'] !== null ? $row['total_amount'] : 0;
                                                } else {
                                                    echo "0";
                                                }
                                                ?>

                                            </strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12">
                            <div class="tab-filter d-flex align-items-center justify-content-between mb-3 flex-wrap">
                                <ul class="nav nav-tabs tab-card tab-body-header rounded  d-inline-flex w-sm-100">
                                    <!-- <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                            href="#summery-today">Today</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#summery-week">Week</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#summery-month">Month</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                            href="#summery-year">Year</a></li>
                                </ul> -->
                                    <!-- <div class="date-filter d-flex align-items-center mt-2 mt-sm-0 w-sm-100">
                                    <div class="input-group">
                                        <input type="date" class="form-control">
                                        <button class="btn btn-primary" type="button"><i class="icofont-filter fs-5"></i></button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="tab-content mt-1">
                                <div class="tab-pane fade show active" id="summery-today">
                                    <div class="row g-1 g-sm-3 mb-3 row-deck">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">CUSTOMERS</span>
                                                        <div><span class="fs-6 fw-bold me-2">
                                                                <?php
                                                                // Assuming $con is a valid MySQLi connection

                                                                $query = "SELECT COUNT(*) AS user_info
                                                                 FROM user_info
                                                                 WHERE status='1'";

                                                                $result = mysqli_query($con, $query);

                                                                if ($result) {
                                                                    // Fetch the result as an associative array
                                                                    $row = mysqli_fetch_assoc($result);

                                                                    // Output the number of courses
                                                                    echo $row['user_info'];
                                                                } else {
                                                                    // Handle query error
                                                                    echo "Error: " . mysqli_error($con);
                                                                }

                                                                // Close the database connection (optional but recommended)

                                                                ?>
                                                            </span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">SPEAKER</span>
                                                        <div><span class="fs-6 fw-bold me-2">
                                                                <?php
                                                                $query = "SELECT COUNT(*) AS num_speakers
                                                                     FROM speaker_info
                                                             WHERE status='1'";
                                                                $result = mysqli_query($con, $query);
                                                                if ($result) {
                                                                    $row = mysqli_fetch_assoc($result);
                                                                    echo $row['num_speakers'];
                                                                } else {

                                                                    echo "0";
                                                                }

                                                                ?>

                                                            </span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">WEBINARS</span>
                                                        <div><span class="fs-6 fw-bold me-2">
                                                                <?php
                                                                // Assuming $con is a valid MySQLi connection

                                                                $query = "SELECT COUNT(*) AS course_info
                                                                 FROM course_detail
                                                                 WHERE status='1'";

                                                                $result = mysqli_query($con, $query);

                                                                if ($result) {
                                                                    // Fetch the result as an associative array
                                                                    $row = mysqli_fetch_assoc($result);

                                                                    // Output the number of courses
                                                                    echo $row['course_info'];
                                                                } else {
                                                                    // Handle query error
                                                                    echo "Error: " . mysqli_error($con);
                                                                }

                                                                // Close the database connection (optional but recommended)

                                                                ?>
                                                            </span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-sale-discount fs-3 color-santa-fe"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">DAILY AVERAGE SELL</span>
                                                        <div><span class="fs-6 fw-bold me-2">$
                                                                <?php


                                                                $query = "SELECT AVG(amount) as average_sale FROM order_details WHERE DATE(trans_date) = CURDATE()";

                                                                $result = mysqli_query($con, $query);

                                                                if ($result) {
                                                                    // Fetch the result as an associative array
                                                                    $row = mysqli_fetch_assoc($result);

                                                                    // Output the number of courses
                                                                    echo round($row['average_sale']);
                                                                } else {
                                                                    // Handle query error
                                                                    echo "Error: " . mysqli_error($con);
                                                                }

                                                                // Close the database connection (optional but recommended)

                                                                ?>
                                                            </span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-calculator-alt-2 fs-3 color-danger"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">TOTAL SELL</span>
                                                        <div><span class="fs-6 fw-bold me-2">$
                                                                <?php
                                                                $query = "SELECT SUM(amount) as average_sale FROM order_details ";
                                                                $result = mysqli_query($con, $query);
                                                                if ($result) {

                                                                    $row = mysqli_fetch_assoc($result);

                                                                    echo $row['average_sale'];
                                                                } else {

                                                                    echo "Error: " . mysqli_error($con);
                                                                }
                                                                ?>
                                                            </span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-calculator-alt-1 fs-3 color-lightblue"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Top Selling Item</span>
                                                        <div><span class="fs-6 fw-bold me-2">....</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-star fs-3 color-lightyellow"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div> <!-- row end -->
                                </div>



                            </div>
                        </div>
                    </div><!-- Row end  -->


                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                    <h6 class="m-0 fw-bold">10 Recent Transactions</h6>
                                </div>
                                <div class="card-body">
                                    <table id="" class="table table-hover align-middle mb-0" style="width: 100%;">
                                        <!--<table id="myDataTable" class="table table-hover align-middle mb-0"style="width: 100%;">-->
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>ORDER Id</th>
                                                <th>webinar</th>
                                                <th>selling option</th>
                                                <th>Date & Time</th>
                                                <th>Status</th>

                                                <!--<th>Status</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $a = 0;
                                            $result = mysqli_query($con, "SELECT 
                                                order_details.id,
                                                order_details.order_id,
                                                order_details.course_id,
                                                order_details.amount,
                                                order_details.selling_options,
                                                order_details.trans_date,
                                                order_details.payment_status,
                                                user_info.id,
                                                course_detail.id,
                                                course_detail.title
                                            FROM order_details
                                                JOIN user_info ON order_details.user_id = user_info.id
                                                  JOIN course_detail ON order_details.course_id = course_detail.id
                                                  
                                                ORDER BY order_details.id DESC
                                       LIMIT 10;
                                            ");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $a++;
                                            ?>
                                                <tr>
                                                    <td><?php echo $a ?></td>
                                                    <td><strong>
                                                            <a href="order-details?order_detail=<?php echo $row['order_id']; ?>"><?php echo $row['order_id']; ?></a>
                                                        </strong></td>

                                                    <td><span> <?php echo $row['title']; ?> </span></td>
                                                    <!--    <td>   -->
                                                    <!--<?php echo "<span>$</span>" . $row['amount']; ?>-->
<td class="tm_width_2">
    <?php
    // Get the selling_options field value
    $data = $row['selling_options'];

    // Print the data as a normal string
    echo htmlspecialchars($data);
    ?>
</td>




</td>

                                                    <td><?php echo $row['trans_date']; ?> </td>

                                                    <td>
                                                <span class="badge 
                                                    <?php 
                                                    if ($row['payment_status'] == 'Incomplete') {
                                                        echo 'bg-danger'; // Red color for incomplete status
                                                    } else {
                                                        echo 'bg-success'; // Green color for other statuses
                                                    }
                                                    ?>">
                                                    <?php echo $row['payment_status']; ?>
                                                </span>
                                            </td>

                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <!-- Plugin Js -->
    <script src="assets/bundles/apexcharts.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <!-- Jquery Page Js -->
    <script src="assets/js/template.js"></script>
    <script>
        function fetchLiveData() {
            $.ajax({
                url: "fetch_live_data1.php",
                type: "GET",
                success: function (data) {
                    $("#live-data").html(data);
                }
            });
        }

        setInterval(fetchLiveData, 1000); // Fetch data every 1 seconds
        fetchLiveData(); // Load data initially
    </script>


    <script>
        $('#myDataTable')
            .addClass('nowrap')
            .dataTable({
                responsive: true,
                columnDefs: [{
                    targets: [-1, -3],
                    className: 'dt-body-right'
                }]
            });
    </script>
</body>


</html>