<?php
include "connect.php";
include "functions.php";
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    mysqli_query($con,"UPDATE speaker_info SET status='1' WHERE id='".$_GET['id']."' ");
    header("Refresh:0");
}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Become A speaker </title>
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
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Become A Speaker</h3>

                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row clearfix g-3">
                        <div class="col-sm-12">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                        <thead>
                                            <?php
                                            $result = mysqli_query($con, "SELECT * FROM speaker_info WHERE status='1' AND speaker_status='0'  ");
                                            $a=0;
                                            ?>
                                            <tr>
                                                <th>Id</th>
                                                <th>Speaker Name</th>
                                                <th>Email Address</th>
                                                <th>Phone</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_assoc($result)) {
                                                $a++;
                                                ?>
                                                <tr>
                                                    <td><strong><?php echo $a; ?></strong></td>
                                                    <td>
                                                        <img class="avatar rounded" src="assets/images/xs/avatar6.svg" alt="">
                                                        <span class="fw-bold ms-1"><?php echo $row['name']; ?></span>
                                                    </td>
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['phone_no']; ?></td>
                                                    <!-- <td>02</td> -->
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button class="btn btn-sm btn-outline-secondary view-become-btn" data-bs-target="#deletemodal" data-bs-toggle="modal" type="button" data-become-id="<?php echo $row['id']; ?>">
                                                                <i class="icofont-edit text-success"></i>
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
                            <h5 class="modal-title" id="deletemodalLabel">Confirm Approval</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to approve?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="#" class="btn btn-danger" id="confirmDelete">Approve</a>
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
            var becomeId = button.data('become-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?become_id=' + becomeId;
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