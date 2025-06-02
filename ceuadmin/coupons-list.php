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
    <title> Coupons List </title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

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
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Coupons</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <a href="coupon-add" class="btn btn-primary btn-set-task w-sm-100"><i class="icofont-plus-circle me-2 fs-6"></i>Add Coupons</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Coupons Code</th>
                                                <th>Discount</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Coupon Limit</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $a = 0;
                                        $result = mysqli_query($con, "SELECT * FROM sales_promotion_coupon 
                                        WHERE status = 1 
                                          AND (coupons_status = 'Active' OR coupons_status = 'Future_Plan') ");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $a++;
                                        ?>
                                            <tbody>

                                                <tr>
                                                    <td><span class="fw-bold ms-1"><?php echo $a; ?></span></td>
                                                    <td><span class="fw-bold ms-1"><?php echo $row['coupon_code']; ?></span></td>

                                                    <td><?php echo $row['discount']; ?></td>
                                                    <td><?php echo $row['start_date']; ?></td>
                                                    <td><?php echo $row['expire_date']; ?></td>

                                                    <td>
                                                        <?php if ($row['coupons_status'] == "Active") { ?>
                                                            <span class="badge bg-success">Active</span>
                                                        <?php } elseif ($row['coupons_status'] == "Future_Plan") { ?>
                                                            <span class="badge bg-warning">Future</span>
                                                        <?php } else { ?>
                                                            <span class="badge bg-danger">Expire</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $row['coupons_limit']; ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <a href="coupon-edit?id=<?php echo $row['id']; ?>" class="btn btn-outline-secondary"><i class="icofont-edit text-success"></i></a>
                                                            <button class="btn btn-sm btn-outline-secondary view-coupons-btn" data-bs-target="#deletemodal" data-bs-toggle="modal" type="button" data-coupons-id="<?php echo $row['id'] ?>">
                                                                <i class="icofont-ui-delete text-danger"></i>
                                                            </button>
                                                        </div>
                                                    </td>
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

            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deletemodalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="#" class="btn btn-danger" id="confirmDelete">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="assets/js/template.js"></script>
    
    <script>
        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var couponsId = button.data('coupons-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?coupons_id=' + couponsId;
            $('#confirmDelete').attr('href', deleteLink);
        });
        // project data table
        $(document).ready(function() {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
            $('.deleterow').on('click', function() {
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