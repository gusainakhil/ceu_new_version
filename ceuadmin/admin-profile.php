<!doctype html>
<html class="no-js" lang="en" dir="ltr">
<?php
include "connect.php";
include "functions.php";
if (empty($_SESSION['username'])) {
    header("Location: login");
}

function resizeAndCompressImage($sourcePath, $destinationPath)
{
    list($width, $height) = getimagesize($sourcePath);
    $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));
    $newHeight = (900 / $width) * $height;

    $resizedImage = imagecreatetruecolor(900, $newHeight);
    imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, 900, $newHeight, $width, $height);
    imagejpeg($resizedImage, "assets/images/admin/" . $destinationPath . ".webp", 100);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['type'] == "admin") {
        $key = "";
        $values = "";
        $rand=random($_POST['company_name']);
        $fields = ['email','company_name','address','phone_number'];
        foreach ($fields as $field) {
            if (!empty($_POST[$field])) {
                $key .= $field . "= '" . str_replace("'", "`", $_POST[$field]) . "', ";
            }
        }

        if (!empty($_FILES['logo']['tmp_name'])) {
            $logo = $rand . '.webp';
            resizeAndCompressImage($_FILES['logo']['tmp_name'], $rand);
            $key .= "logo= '" . $logo  . "',";
        // echo "logo";
        }

        // echo $key;
        $key = rtrim($key, ', ');
        mysqli_query($con,"UPDATE admin_login SET $key WHERE id='1' ");
        // echo "UPDATE admin_login SET $key WHERE id='1' ";
    } elseif ($_POST['type'] == "credentials") {

        mysqli_query($con, "UPDATE admin_login SET username='".$_POST['username']."', password='".$_POST['password']."' WHERE id='1'");
        // echo "UPDATE admin_login SET username='".$_POST['username']."', password='".$_POST['password']."' WHERE id='1'";
        
    }
    header("Location: admin-profile");
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Admin Profile </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->
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
                                <h3 class="fw-bold mb-0">Admin Profile</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3">
                        <div class="col-xl-4 col-lg-5 col-md-12">
                            <div class="card profile-card flex-column mb-3">
                                <?php
                                $result = mysqli_query($con, "SELECT * FROM admin_login ");
                                $row = mysqli_fetch_assoc($result);
                                $images = "";
                                if (!empty($row['logo'])) {
                                    $images .= "assets/images/admin/" . $row['logo'];
                                } else {
                                    $images .= "assets/images/lg/avatar4.svg";
                                } ?>
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Welcome <span style="color:#7258db;"> <?php echo $row['company_name']; ?></span> In Admin panel </h6>
                                </div>
                                <div class="card-body d-flex profile-fulldeatil flex-column">
                                    <div class="profile-block text-center w220 mx-auto">
                                        <img src="<?php echo $images; ?>" id="imagePreview" alt="" class="avatar xl rounded img-thumbnail shadow-sm">
                                    </div>
                                    <div class="profile-info w-100">
                                        <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center"><span style="color:#7258db;"> <?php echo $row['company_name']; ?> </span></h6>
                                        <!-- <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span> -->
                                        <div class="row g-2 pt-2">
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center">
                                                    <i class="icofont-ui-touch-phone"></i>
                                                    <span class="ms-2"><?php echo $row['phone_number']; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center">
                                                    <i class="icofont-email"></i>
                                                    <span class="ms-2"><?php echo $row['email']; ?></span>
                                                </div>
                                            </div>
                                            <!-- <div class="col-xl-12">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-birthday-cake"></i>
                                                        <span class="ms-2">19/03/1980</span>
                                                    </div>
                                                </div> -->
                                            <div class="col-xl-12">
                                                <div class="d-flex align-items-center">
                                                    <i class="icofont-address-book"></i>
                                                    <span class="ms-2"><?php echo $row['address']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card auth-detailblock">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">credentials Details</h6>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authchange"><i class="icofont-edit"></i></button>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-5">User Name :</label>
                                            <span><strong><?php echo $row['username']; ?></strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-12">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Profile Settings</h6>
                                </div>
                                <div class="card-body">

                                    <form class="row g-4" id="profile_update" method="post" enctype="multipart/form-data">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Company Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" value="<?php echo $row['company_name']; ?>" name="company_name">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile Number <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="phone_number" value="<?php echo $row['phone_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input class="form-control" type="text" name="email" value="<?php echo $row['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label">Upload Logo</label>
                                                <input class="form-control" type="file" id="imageUpload" name="logo">
                                                <input type="hidden" value="admin" name="type">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <textarea class="form-control" aria-label="With textarea" name="address"><?php echo $row['address']; ?></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="submit" name="submit" value="submit" class="btn btn-primary text-uppercase px-5">update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Password-->
            <div class="modal fade" id="authchange" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="expeditLabel"> Edit credentials
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="deadline-form">
                                <form id="credentials" method="POST">
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6">
                                            <label for="item1" class="form-label">User Name</label>
                                            <input type="text" class="form-control" value="<?php echo $row['username']; ?>" name="username">
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="taxtno111" class="form-label">Password</label>
                                            <input type="password" class="form-control" value="<?php echo $row['password']; ?>" name="password">
                                            <input type="hidden" name="type" value="credentials">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Edit profile-->

        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/template.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>

    <!-- Jquery Page Js -->
</body>

</html>