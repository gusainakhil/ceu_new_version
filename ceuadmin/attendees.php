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
    <title> Attendees Information </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">


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
                            <div
                                class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Attendees Information</h3>
                                <!-- <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-primary btn-set-task w-sm-100"
                                        data-bs-toggle="modal" data-bs-target="#expadd"><i
                                            class="icofont-plus-circle me-2 fs-6"></i>Add user</button>
                                </div> -->
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Order Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Job Profile</th>
                                                <!-- <th>Created At</th> -->
                                                <!-- <th>Actions</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($con, "SELECT * FROM order_details WHERE users_arr!='' ORDER BY id DESC ");
                                            $a=0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $array = stringToArray($row['users_arr']);
                                                foreach ($array as $array) {
                                                            $a++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $a ?></td>
                                                    
                                                    <td>
                                                        <a href="order-details?order_detail=<?php echo $row['order_id']; ?>">
                                                            <?php echo $row['order_id']; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold ms-1">
                                                            <?php echo $array['0']; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php echo $array['1']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $array['2']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $array['3']; ?>
                                                    </td>
                                                </tr>

                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/js/template.js"></script>

    <script>
        // project data table
        $(document).ready(function () {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [
                        { targets: [-1, -3], className: 'dt-body-right' }
                    ]
                });
            $('.deleterow').on('click', function () {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });
        });
    </script>
</body>


</html>