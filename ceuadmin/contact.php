<?php
include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login.php");
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact </title>
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
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold py-3 mb-0">Contact</h3>

                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="list-view">
                            <div class="row clearfix g-3">
                                <?php
                               $result = mysqli_query($con, "SELECT * FROM contact_details WHERE status='1' ORDER BY id DESC");

                                ?>
                                <div class="col-lg-12">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                                <thead>

                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Person Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Message</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $a=0;
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $a++; ?>
                                                        <tr>
                                                            <td><?php echo $a; ?></td>
                                                            <td>
                                                                <img class="avatar rounded-circle" src="assets/images/xs/avatar6.svg" alt="">
                                                                <span class="fw-bold ms-1"><?php echo $row['name']; ?></span>
                                                            </td>
                                                            <td><?php echo $row['email']; ?></td>
                                                            <td><?php echo $row['phone']; ?></td>
                                                            <td><?php echo $row['messgae']; ?></td>
                                                            <td>
                                                                <button class="btn btn-sm btn-outline-secondary view-contact-btn" data-bs-target="#deletemodal" data-bs-toggle="modal" type="button" data-contact-id="<?php echo $row['id'] ?>">
                                                                    <i class="icofont-ui-delete text-danger"></i>
                                                                </button>
                                                            </td>
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
            </div>
            <!-- Edit Contact-->
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

    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/js/template.js"></script>
    <script>
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

        
        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var contactId = button.data('contact-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?contact_id=' + contactId;
            $('#confirmDelete').attr('href', deleteLink);
        });
    </script>
</body>

</html>