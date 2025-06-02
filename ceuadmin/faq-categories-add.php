<?php
include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login.php");
}

// echo basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['type'])) {
        if ($_POST['type'] == "add") {

            mysqli_query($con, "INSERT INTO faq_category (category) VALUES ('".$_POST['category']."') ");
            // echo "INSERT INTO faq_category VALUES ('" . $_POST['category'] . "') ";
        }
    } elseif (!empty($_POST['type12'])) {
        if ($_POST['type12'] == "upload") {

            mysqli_query($con, "UPDATE faq_category SET category='" . $_POST['category12'] . "' WHERE id='" . $_POST['id'] . "' ");
            // echo "UPDATE category SET category='" . $_POST['category12'] . "' WHERE id='" . $_POST['id'] . "' ";
        }
    }
    header("Refresh:0");

}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Add FAQ </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!--plugin css file -->
    <link rel="stylesheet" href="assets/plugin/multi-select/css/multi-select.css"><!-- Multi Select Css -->
    <link rel="stylesheet" href="assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.css"><!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css"><!-- Datatable Css -->
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css"><!-- Datatable Css -->

    <!-- Project css file  -->
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
                                <h3 class="fw-bold mb-0">Faq Category</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <a class="btn btn-primary btn-set-task w-sm-100" data-bs-target="#expadd" data-bs-toggle="modal" type="button"><i class="icofont-plus-circle me-2 fs-6"></i>Add Faq Category</a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3">

                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                            <div class="sticky-lg-top">

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Category</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = mysqli_query($con, "SELECT * FROM faq_category where status='1'");
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                        <td><strong><?php echo $row['id']; ?></strong></td>
                                                        <td><span class="fw-bold ms-1"><?php echo $row['category']; ?></span></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-secondary edit_faq" data-bs-toggle="modal" data-bs-target="#expedit" type="button" data-faqcate-id="<?php echo $row['id'] ?>">
                                                                    <i class="icofont-edit text-success"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary view-faq-btn" data-bs-target="#deletemodal" data-bs-toggle="modal" type="button" data-faq-id="<?php echo $row['id'] ?>">
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
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>

            <!-- Add Faq category-->
            <div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="expaddLabel">Add Categories</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="deadline-form">
                                <form method="post" id="faq-categories-add">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 mx-auto">
                                            <label for="firstname" class="form-label">Categories Name</label>
                                            <input type="text" class="form-control" id="firstname" name="category" placeholder="type category name.." required>
                                            <input type="hidden" name="type" value="add">
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-4 mx-auto">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="expedit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content" id="edit_faq">

                    </div>
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

    <!-- Jquery Plugin -->
    <script src="assets/plugin/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="assets/js/template.js"></script>

    <script>
        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var faqId = button.data('faq-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?faq_id=' + faqId;
            $('#confirmDelete').attr('href', deleteLink);
        });

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
        });

        $(document).ready(function() {
            $(".edit_faq").on("click", function() {
                var faq = $(this).data("faqcate-id");
                // alert(faq);
                $.ajax({
                    url: "faq.php",
                    method: "POST",
                    data: {
                        faq_id: faq
                    },
                    success: function(response) {
                        $("#edit_faq").html(response);
                    },
                    error: function(response) {
                        alert(response);
                    }
                });
            });
        });
    </script>
</body>

</html>