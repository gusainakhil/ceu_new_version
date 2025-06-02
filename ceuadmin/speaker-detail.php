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
    <title> speaker Detail </title>
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
                                <h3 class="fw-bold mb-0">speaker Detail</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <?php
                    $id = $_GET['id'];
                    $result = mysqli_query($con, "SELECT * FROM speaker_info where id = $id AND  status = 1  ");
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="row g-3 mb-xl-3">
                            <div class="col-xxl-4 col-xl-12 col-lg-12 col-md-12">
                                <div class="row row-cols-1 ">
                                    <div class="col">
                                        <div class="card profile-card">
                                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                                <h6 class="mb-0 fw-bold ">Profile</h6>
                                            </div>
                                            <div class="card-body d-flex profile-fulldeatil flex-column">
                                                <div class="profile-block text-center w220 mx-auto">
                                                    
                                                    <a href="#">
                                                        <img src="assets/images/speaker/<?php echo $row['images']; ?>" alt="" class="avatar xl rounded img-thumbnail shadow-sm">
                                                    </a>

                                                </div>
                                                <div class="profile-info w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">
                                                        <?php echo $row['name']; ?>
                                                    </h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block"><?php echo $row['designation']; ?></span>
                                                    <p class="mt-2"><?php echo $row['bio']; ?></p>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">
                                                                    <?php echo $row['phone_no']; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">
                                                                    <?php echo $row['email']; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-xl-12">
                                                        <div class="d-flex align-items-center">
                                                            <i class="icofont-birthday-cake"></i>
                                                            <span class="ms-2"></span>
                                                        </div>
                                                    </div> -->
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <?php
                                                                $resumePath = $row['resume'];
                                                                // if (!empty($resumePath)) {
                                                                //     echo '<iframe src="assets/images/speaker/' . $resumePath . '" style="width:1000px; height:600px;" frameborder="0"></iframe>';
                                                                // } else {
                                                                 
                                                                //     echo 'Resume not found';
                                                                // }
                                                                ?>
                                                                </span>
                                                                <span class="ms-2">

                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>


                                </div>
                            </div>
                            <div class="col-xxl-8 col-xl-12 col-lg-12 col-md-12">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">speaker Webinar</h6>
                                    </div>
                                    <div class="card-body">

                                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                                            <thead>

                                                <tr>

                                                    <th>S.NO</th>
                                                    <th>course Title</th>
                                                    <th> Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $a = 0;
                                                $id = $_GET['id'];
                                                $result = mysqli_query($con, "SELECT title ,date  FROM  course_detail where speaker = $id AND  status = 1  ORDER BY id DESC ");
                                                while ($row = mysqli_fetch_assoc($result)) {

                                                    $a++;
                                                ?>
                                                    <tr>
                                                        <td> <?php echo $a; ?></td>
                                                        <td style=" word-break: break-all;"> <?php echo $row['title']; ?>

                                                        </td>
                                                        <td>
                                                            <?php echo $row['date']; ?>
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
    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <script src="assets/bundles/apexcharts.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/js/template.js"></script>

    <script src="assets/js/page/profile.js"></script>
    <script>
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
    </script>
</body>


</html>