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
    <title>  Course List </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!--plugin css file -->
    <link rel="stylesheet" href="assets/plugin/multi-select/css/multi-select.css"><!-- Multi Select Css -->
    <link rel="stylesheet" href="assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.css"><!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="assets/plugin/cropper/cropper.min.css"><!--Cropperer Css -->
    <link rel="stylesheet" href="assets/plugin/dropify/dist/css/dropify.min.css" /><!-- Dropify Css -->
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
                                <h3 class="fw-bold mb-0">Course</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <a class="btn btn-primary btn-set-task w-sm-100" href="course-add.php"><i class="icofont-plus-circle me-2 fs-6"></i>Add Course</a>
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
                                                    <th>Id</th>
                                                    <th>Course Name</th>
                                                    <!-- <th>Duration</th> -->
                                                    <th>Actions</th>
                                                    <th>Date and time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $a = 0;
                                                $c_sql = mysqli_query($con, "SELECT * FROM course_detail WHERE status='1' ORDER BY id DESC ");
                                                while ($c_row = mysqli_fetch_assoc($c_sql)) {
                                                    $a++;
                                                ?>
                                                    <tr>
                                                        <td><strong><?php echo $a; ?></strong></td>
                                                        <td>
                                                            <a href="course-edit?id=<?php echo $c_row['id'] ?>">
                                                                <span class="fw-bold ms-1"><?php echo $c_row['title']; ?></span>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <a class="btn btn-outline-secondary" href="course-edit?id=<?php echo $c_row['id'] ?>">
                                                                    <i class="icofont-edit text-success"></i>
                                                                </a>
                                                                <button class="btn btn-sm btn-outline-secondary view-course-btn" data-bs-target="#deletemodal" data-bs-toggle="modal" type="button" data-course-id="<?php echo $c_row['id'] ?>">
                                                                    <i class="icofont-ui-delete text-danger"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                        <!-- <td><?php echo $c_row['duration']; ?></td> -->
                                                        <td><?php echo $c_row['date'] . " " . $c_row['time']; ?></td>
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

            <!-- Add Course-->
            <div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="expaddLabel">Add Course</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="deadline-form">
                                <form>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 mx-auto">
                                            <label for="firstname" class="form-label">Course Name</label>
                                            <input type="text" class="form-control" id="firstname" required>
                                        </div>
                                        <div class="col-12">
                                            <div id="row">
                                                <div class="input-group row">
                                                    <div class="col-6">
                                                        <input type="text" class="form-control ">
                                                    </div>
                                                    <input type="text" class="form-control">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-danger" id="DeleteRow" type="button">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="newinput"></div>
                                            <button id="rowAdder" type="button" class="btn btn-dark">
                                                <span class="bi bi-plus-square-dotted">
                                                </span> ADD
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-4 mx-auto">Submit</button>
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
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Course</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="deadline-form">
                                <form>
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 mx-auto">
                                            <label for="firstname" class="form-label">Course Name</label>
                                            <input type="text" class="form-control" id="firstname" required>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mt-4 mx-auto">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
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
                            Are you sure you want to delete this file?
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
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="assets/plugin/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="assets/plugin/cropper/cropper.min.js"></script>
    <script src="assets/plugin/cropper/cropper-init.js"></script>
    <script src="assets/bundles/dropify.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/js/template.js"></script>

    <script>
        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var courseId = button.data('course-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?course_id=' + courseId;
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

        var stepsSlider2 = document.getElementById('slider-range2');
        var input3 = document.getElementById('minAmount2');
        var input4 = document.getElementById('maxAmount2');
        var inputs2 = [input3, input4];
        noUiSlider.create(stepsSlider2, {
            start: [149, 399],
            connect: true,
            step: 1,
            range: {
                'min': [0],
                'max': 2000
            },

        });

        stepsSlider2.noUiSlider.on('update', function(values, handle) {
            inputs2[handle].value = values[handle];
        });


        $("#rowAdder").click(function() {
            newRowAdd =
                '<div id="row"><div class="input-group row"><div class="col-6"><input type="text" class="form-control "></div><input type="text" class="form-control"><div class="input-group-prepend"><button class="btn btn-danger" id="DeleteRow" type="button"><i class="bi bi-trash"></i></button></div></div></div>';

            $('#newinput').append(newRowAdd);
        });
        $("body").on("click", "#DeleteRow", function() {
            $(this).parents("#row").remove();
        })
    </script>
</body>

</html>