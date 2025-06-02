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
    <title> Customers </title>
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
                                <h3 class="fw-bold mb-0">User Information</h3>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <!--<th>Total Order</th>-->
                                                <th>Created At</th>
                                                <!-- <th>Actions</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = mysqli_query($con, "SELECT * FROM user_info where status = 1 ORDER BY id DESC ");
                                            $a=0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $a++;
                                                ?>
                                                <tr>
                                                    <td><?php echo $a ?></td>
                                                    <td>
                                                        <a href="customer-detail?id=<?php echo $row['id']; ?>">
                                                            <span class="fw-bold ms-1">
                                                                <?php echo $row['name']; ?>
                                                            </span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['email']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['number']; ?>
                                                    </td>
                                                    <!--<td>-->
                                                    <!--    <span class="badge bg-success">18</span>-->
                                                    <!--</td>-->
                                                    <td>
                                                        <span class=""> <?php echo $row['datetime']; ?></span>
                                                    </td>
                                                    <!-- <td>
                                                        <div class="btn-group" role="group"
                                                            aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-toggle="modal" data-bs-target="#expedit"><i
                                                                    class="icofont-edit text-success"></i></button>
                                                            <button type="button"
                                                                class="btn btn-outline-secondary deleterow"><i
                                                                    class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td> -->
                                                </tr>

                                            <?php } ?>
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