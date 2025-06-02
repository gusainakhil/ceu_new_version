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
    $resizedImage = imagecreatetruecolor(400, 400);
    imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, 400, 400, $width, $height);
    imagejpeg($resizedImage, "assets/images/speaker/" . $destinationPath . ".webp", 100);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['type'])) {
        if ($_POST['type'] == "3") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone_no = $_POST['phone_no'];
            $bio = $_POST['bio'];
            $designation = $_POST['designation'];

            if (isset($_FILES['images123']['tmp_name'])) {
                $rand = random($_POST['name']);
                $images = $rand . '.webp';
                resizeAndCompressImage($_FILES['images123']['tmp_name'], $rand);
            }

            if (isset($_FILES['images123']['tmp_name'])) {
                $uploadDir = "assets/images/speaker/" . $rand . "_resume.pdf";
                // $uploadFile = $uploadDir . basename($_FILES["resume"]["name"]);
                $resume = $rand . "_resume.pdf";
                move_uploaded_file($_FILES["resume"]["tmp_name"], $uploadDir);
            }

            mysqli_query($con, "INSERT INTO speaker_info (name, email, phone_no, bio, designation, images, resume,speaker_status) VALUES ('$name', '$email', '$phone_no', '$bio', '$designation', '$images', '$resume','1')");

            header("Location: speaker");
        }
    } elseif (!empty($_POST['type12'])) {

        if ($_POST['type12'] == "upload") {

            $key="";
            $key.= "name='".$_POST['name12']."', ";
            $key.= "email='".$_POST['email12']."', ";
            $key.= "phone_no='".$_POST['phone_no12']."', ";
            $key.= "bio='".$_POST['bio12']."', ";
            $key.= "designation='".$_POST['designation12']."', ";

            $id = $_POST['id12'];

            if (!empty($_FILES['images12345']['tmp_name'])) {
                $rand = random($_POST['name12']);
                $images12 = $rand . '.webp';
                resizeAndCompressImage($_FILES['images12345']['tmp_name'], $rand);
                $key.= "images='".$images12."', ";
            }

            
            if (!empty($_FILES['resume12']['tmp_name'])) {
                $uploadDir = "assets/images/speaker/" . $rand . "_resume.pdf";
                // $uploadFile = $uploadDir . basename($_FILES["resume"]["name"]);
                $resume = $rand . "_resume.pdf";
                move_uploaded_file($_FILES["resume12"]["tmp_name"], $uploadDir);
                $key.= "resume='".$resume."', ";

            }
            $key = rtrim($key, ', ');

            mysqli_query($con, "UPDATE speaker_info SET $key WHERE id='$id' ");

            header("Location: speaker");
        }
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>  Speaker </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">
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
            <div class="body d-flex py-lg-3 py-md-2">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Speaker Information</h3>
                                <div class="col-auto d-flex w-sm-100">
                                    <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Speaker</button>
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
                                                <th>Id</th>
                                                <th>Speaker Name</th>
                                                <!-- <th>Register  Date</th> -->
                                                <th>Mail</th>
                                                <th>Phone</th>
                                                <th>Designation</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $a=0;
                                            $result = mysqli_query($con, "SELECT * FROM speaker_info WHERE status='1' ORDER BY id DESC");
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $a++;
                                            ?>
                                                <tr>
                                                    <td><strong><?php echo $a ?></strong></td>
                                                    <td>
                                                        <a href="speaker-detail?id=<?php echo $row['id']; ?>  ">
                                                            <img class="avatar rounded" src="assets/images/speaker/<?php echo $row['images']; ?>" alt="">
                                                            <span class="fw-bold ms-1"><?php echo $row['name']; ?></span>
                                                        </a>
                                                    </td>
                                                    <!-- <td>
                                                18/01/2021
                                                </td> -->
                                                    <td><?php echo $row['email']; ?></td>
                                                    <td><?php echo $row['phone_no']; ?></td>
                                                    <td><?php echo $row['designation']; ?></td>
                                                    <!-- <td>02</td> -->
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary edit_speaker" data-speaker-id="<?php echo $row['id'] ?>" data-bs-toggle="modal" data-bs-target="#expedit">
                                                                <i class="icofont-edit text-success"></i>
                                                            </button>
                                                            <button class="btn btn-sm btn-outline-secondary view-speaker-btn" data-bs-target="#deletemodal" data-bs-toggle="modal" type="button" data-speaker-id="<?php echo $row['id'] ?>">
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
            <!-- Add Speaker-->
            <div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold" id="expaddLabel">Add Speaker</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="add_speaker" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="deadline-form">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-12">
                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' name="images123" id="imageUpload" accept=".png, .jpg, .jpeg" required />
                                                    <label for="imageUpload"></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview" style="background-image: url('assets/images/xs/avatar1.svg');">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="item" class="form-label">Speaker Name</label>
                                            <input type="text" class="form-control" name="name">
                                        </div>

                                        <div class="col-sm-3">
                                            <label for="depone" class="form-label">Designation</label>
                                            <input type="text" class="form-control" name="designation">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="abc11" class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email">
                                            <input type="hidden" name="type" value="3">
                                        </div>
                                        <div class="col-sm-3">
                                            <label for="abc111" class="form-label">Phone</label>
                                            <input type="number" class="form-control" name="phone_no">
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="abc" class="form-label">Bio</label>
                                            <textarea name="bio" id="editor" required></textarea>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="asdgbc" class="form-label">Resume</label>
                                            <input type='file' class="form-control w-100" name="resume" id="imageUpload" accept=".pdf" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Edit Speaker-->
            <div class="modal fade" id="expedit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content" id="edit_speaker">

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

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->

    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/template.js"></script>

    <script>
        CKEDITOR.replace('editor').on('change', function(event) {
            var editorValue = event.editor.getData();
            console.log("CKEditor Value:", editorValue);
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

        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var speakerId = button.data('speaker-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?speaker_id=' + speakerId;
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

        $(document).ready(function() {
            $(".edit_speaker").on("click", function() {
                var speaker = $(this).data("speaker-id");
                $.ajax({
                    url: "editspeaker.php",
                    method: "POST",
                    data: {
                        speaker_id: speaker
                    },
                    success: function(response) {
                        $("#edit_speaker").html(response);
                    },
                    error: function(response) {
                        alert(response);
                    }
                });
            });
        });

        // $(document).ready(function() {
        //     $("#add_speaker").submit(function(e) {
        //         e.preventDefault(); // Prevent the default form submission

        //         $.ajax({
        //             url: "signin_ajax.php",
        //             method: "POST",
        //             data: $(this).serialize(),
        //             success: function(data) {
        //                 alert(data)
        //                 if (data == "0") {
        //                     Swal.fire('Success!', 'category added', 'success');
        //                 } else {
        //                     Swal.fire('Error!', 'Please try again. Your category is no submitted.', 'error');
        //                 }
        //                 location.reload();
        //             },
        //             error: function() {
        //                 Swal.fire('Error!', 'Something went wrong. Please try again later.', 'error');
        //             }

        //         });
        //     });
        // });
    </script>
</body>


</html>