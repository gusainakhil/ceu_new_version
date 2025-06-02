<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php
include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login");
}

function resizeAndCompressImage($sourcePath, $destinationPath)
{
    list($width, $height) = getimagesize($sourcePath);
    $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));

    $resizedImage = imagecreatetruecolor(185, 185);
    imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, 185, 185, $width, $height);
    imagejpeg($resizedImage, "assets/images/industry/" . $destinationPath . ".webp", 50);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['type'] == "3") {
        $key = "";
        $values = "";
        $key .= "industry_name, ";
        $values .= "'" . $_POST['industry_name'] . "', ";
        $industry_name = $_POST['industry_name'];
        if (isset($_FILES['image']['tmp_name'])) {
            $rand = random($_POST['industry_name']);
            $image = $rand . '.webp';
            resizeAndCompressImage($_FILES['image']['tmp_name'], $rand);
            $key .= "image ";
            $values .= "'" . $image . "' ";
        }
        mysqli_query($con, "INSERT INTO industry ($key) VALUES ($values)");
        // echo "INSERT INTO industry ($key) VALUES ($values)";
        // header("Location: Industries");
    } elseif ($_POST['type'] == "5") {
        $image="";
        if (!empty($_FILES['image12345']['tmp_name'])) {
            $rand = random($_POST['industry_name12']);
            $image = $rand . '.webp';
            resizeAndCompressImage($_FILES['image12345']['tmp_name'], $rand);
            $image = ", image='".$image."'";
        }

        mysqli_query($con, "UPDATE industry SET industry_name='" . $_POST['industry_name12'] . "' $image WHERE id='" . $_POST['id12'] . "' ");
        echo "UPDATE industry SET industry_name='" . $_POST['industry_name12'] . "' $image WHERE id='" . $_POST['id12'] . "' ";
        // header("Location: Industries");
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Testimonial List </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!--plugin css file -->
    <link rel="stylesheet" href="assets/plugin/nouislider/nouislider.min.css">

    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">
    <!-- Google Code  -->
    <style>
        .avatar-upload {
            position: relative;
            max-width: 205px;
            margin: 50px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input+label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 192px;
            height: 192px;
            position: relative;
            border-radius: 100%;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .avatar-upload .avatar-preview>div {
            width: 100%;
            height: 100%;
            border-radius: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
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
                                <h3 class="fw-bold mb-0">Testimonial</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Testimonial</button>
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
                                                    <th>Name</th>
                                                    <th>Designation</th>
                                                    <th>Message</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $a=0;
                                                $result = mysqli_query($con, "SELECT * FROM testimonial where status = 1 ORDER BY id DESC ");
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $a++;
                                                ?>
                                                    <tr>
                                                        <td><strong><?php echo $a; ?></strong></td>
                                                        <td>
                                                            <img class="avatar rounded" src="<?php if (!empty($row['image'])) {
                                                                                                    echo "assets/images/testimonial/" . $row['image'];
                                                                                                } else { ?>assets/images/xs/avatar1.svg<?php } ?>" alt="">
                                                            <span class="fw-bold ms-1"><?php echo $row['name']; ?></span>
                                                        </td>
                                                        <td><?php echo $row['designation']; ?></td>
                                                        <td><?php echo $row['message']; ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                                <button type="button" class="btn btn-outline-secondary edit_testimonial" data-bs-toggle="modal" data-bs-target="#expedit" data-industry-id="<?php echo $row['id'] ?>">
                                                                    <i class="icofont-edit text-success editbtn"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-outline-secondary view-industry-btn" data-bs-target="#deletemodal" data-bs-toggle="modal" type="button" data-industry-id="<?php echo $row['id'] ?>">
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
            <!-- Add Industry-->
            <div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="expaddLabel">Add Testimonial</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="deadline-form">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row g-3 align-items-center">
                                        <div class="col-12 mx-auto">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' name="image" id="imageUpload" accept=".png, .jpg, .jpeg" required />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('assets/images/xs/avatar1.svg');">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="type" value="3">
                                            <label for="firstname" class="form-label">Testimonial Name</label>
                                            <input type="text" class="form-control" id="firstname" name="industry_name" placeholder="type industry name.." required>
                                            
                                            <label for="firstname" class="form-label">Designation</label>
                                            <input type="text" class="form-control" id="firstname" name="industry_name" placeholder="type industry name.." required>

                                            <label for="firstname" class="form-label">Message</label>
                                            <input type="text" class="form-control" id="firstname" name="industry_name" placeholder="type industry name.." required>
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
                    <div class="modal-content" id="edit_testimonial">
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
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="confirmDelete">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Plugin -->
    <script src="assets/plugin/nouislider/nouislider.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/template.js"></script>

    <script>
        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var industryId = button.data('industry-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?industry_id=' + industryId;
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

        $(document).ready(function() {
            $("#addindustry").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: "signin_ajax.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        // alert(data)
                        if (data == "0") {
                            Swal.fire('Success!', 'Industry  added', 'success');
                        } else {
                            Swal.fire('Error!', 'Please try again. Your industry is no added.', 'error');
                        }
                        location.reload();
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong. Please try again later.', 'error');
                    }

                });
            });
        });

        $(document).ready(function() {
            $(".edit_testimonial").on("click", function() {
                var industry = $(this).data("industry-id");
                $.ajax({
                    url: "industry.php",
                    method: "POST",
                    data: {
                        industry_id: industry
                    },
                    success: function(response) {
                        $("#edit_testimonial").html(response);
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