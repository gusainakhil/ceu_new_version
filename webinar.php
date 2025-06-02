<!DOCTYPE html>
<html>
<?php
include "connect.php";
include "functions.php";
?>

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Webinars</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />
    <link rel="canonical" href="https://ceuservices.com/webinar" />

    <!-- CSS
    ============================================ -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css" />
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css" />
    <link rel="stylesheet" href="assets/css/vendor/magnifypopup.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/odometer.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/animation.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css" />
    <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/tipped.min.css" />
    <!--<link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />-->
    <!--<script src="assets/Calender/EventCalender.js" type="text/javascript"></script>-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
    <style type="text/css">
        .parentSpace {
            width: 100%;
            display: block;
            color: white;
        }

        .left {
            float: left;
            width: 50%;
        }

        .right {
            float: right;
            width: 50%;
        }

        input {
            height: 50px;
            border-collapse: collapse;
            border-radius: 3px 3px 3px 3px;
            background-color: #fff;
            border-width: 0px;
        }
    </style>
</head>

<body>

    <div id="main-wrapper" class="main-wrapper">

        <?php include "header.php" ?>


        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">Webinars</h1>
                        <h3 class="title">Elevate your <span class="color-secondary"> skills & expertise</span>
                            with our webinars</h3>
                        <span class="shape-line" style="color:#1AB69D"><i class="icon-19"></i></span>
                    </div>

                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape" />
                </li>
                <li class="shape-3 scene"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape" />
                </li>
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape" />
                </li>
            </ul>
        </div>
        <div class="container "
            style="background-color:#1AB69D;padding:30px 60px 30px 60px;border-radius: 5px 5px 5px 5px; margin-top:60px; margin-bottom:-30px">
            <div class="row">

                <div class="col-xs-12 col-md-3 ">
                    <!-- <form class="example"  style="border-collapse:collapse;"> -->
                    <input type="search" placeholder="Search by title, instructor..." name="search" />
                    <!-- </form> -->
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="contact-form">
                        <div class="form-group col-12">
                            <select id="Select1" name="Event Types" style="background-color:#fff; margin-bottom:5px;">
                                <option value="" disabled selected hidden>Event</option>
                                <option value="0"> Live</option>
                                <option value="1"> Recorded</option>
                                <option value="2"> Packages</option>
                                <option value="3"> Long Hour Webinar</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="contact-form">
                        <div class="form-group col-12">
                            <select id="Select2" name="Industry"style="background-color:#fff; margin-bottom:5px;">
                                <option value="" disabled selected hidden>Credits</option>
                                <option value="0">HRCI</option>
                                <option value="1">SHRM</option>
                                <option value="2">CPE</option>
                                <option value="3">APA</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-3">
                    <div class="contact-form">
                        <div class="form-group col-12">
                            <select id="industry" name="Industry" style="background-color:#fff; margin-bottom:5px;">
                                <option value="" disabled selected hidden> Industry</option>
                                <option value="0">Human Resource</option>
                                <option value="1">Payroll & Taxation</option>
                                <option value="2">BFSI & Accounting</option>
                                <option value="3">Housing & Construction</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="edu-course-area course-area-1 gap-tb-text">
            <div class="container">
                <div class="row g-5">

                    <?php
                    $course_sql = mysqli_query($con, "SELECT *
FROM course_detail
WHERE status = '1'
ORDER BY STR_TO_DATE(date, '%M %e, %Y') DESC ");
                    while ($c_row = mysqli_fetch_assoc($course_sql)) {
                        $date = $c_row['date'];
                        $timestamp = strtotime($date);
                        $day = date('d', $timestamp);
                        $month = date('M', $timestamp);
                        ?>

                        <div class="col-lg-4 col-md-6" data-sal-delay="100" data-sal="slide-up" data-sal-duration="800">
                            <div class="edu-event event-style-1">
                                <div class="inner">
                                    <div class="thumbnail">
                                        <a href="course-details.php?id=<?php echo $c_row['slug'] ?>">
                                            <?php
                                            $images = "";
                                            if (!empty($c_row['course_thumbail'])) { 
                                                $images .= "ceuadmin/assets/images/course/" . $c_row['course_thumbail'];
                                            } else {
                                                $images .= "ceuadmin/assets/images/course/ceutrainers.webp";
                                            }
                                            ?>
                                            <img src="<?php echo $images ?>"s alt="Course Meta">
                                        </a>

                                    </div>
                                    <div class="content">
                                        <div class="event-date">
                                            <span class="day">
                                                <?php echo $day; ?>
                                            </span>
                                            <span class="month">
                                                <?php echo $month; ?>
                                            </span>
                                        </div>
                                        <div class="event-date"
                                            style="background-color:#1AB69D ; top:-25px; left:20px;width:150px;height:50px;border-radius: 5px;">
                                            <span style="font-size:medium;text-align:center"><i class="icon-33"
                                                    style="color:white"></i>
                                                <?php echo $c_row['time'] ?> EST
                                            </span>
                                        </div>
                                        <h5 class="title"><a href="course-details.php?id=<?php echo $c_row['slug'] ?>">
                                                <?php echo $c_row['title'] ?>
                                            </a></h5>

                                        <p>
                                            <i class="fa fa-clock-o" style="font-size:16px;color:red"></i>
                                            &nbsp;Duration:
                                            <?php echo $c_row['duration'] ?> Mins &nbsp;
                                            &nbsp;<span><i class="fa fa-volume-up" style="font-size:16px;color:red"></i>
                                                <?php echo speaker($con, $c_row['speaker']) ?>
                                            </span>
                                        </p>
                                        <div class="read-more-btn">
                                            <a class="edu-btn btn-small btn-secondary"
                                                href="course-details.php?id=<?php echo $c_row['slug'] ?>">Learn More <i
                                                    class="icon-4"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>

        <?php include "footer.php" ?>

    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- JS
    ============================================ -->
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- Jquery Js -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/sal.min.js"></script>
    <script src="assets/js/vendor/backtotop.min.js"></script>
    <script src="assets/js/vendor/magnifypopup.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/odometer.min.js"></script>
    <script src="assets/js/vendor/isotop.min.js"></script>
    <script src="assets/js/vendor/imageloaded.min.js"></script>
    <script src="assets/js/vendor/lightbox.min.js"></script>
    <script src="assets/js/vendor/paralax.min.js"></script>
    <script src="assets/js/vendor/paralax-scroll.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="assets/js/vendor/svg-inject.min.js"></script>
    <script src="assets/js/vendor/vivus.min.js"></script>
    <script src="assets/js/vendor/tipped.min.js"></script>
    <script src="assets/js/vendor/smooth-scroll.min.js"></script>
    <script src="assets/js/vendor/isInViewport.jquery.min.js"></script>
    <!--Calender Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>

    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }
    </script>
</body>


</html>