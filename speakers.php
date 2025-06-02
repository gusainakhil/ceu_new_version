<!DOCTYPE html>
<?php
include "connect.php";
include "functions.php";

?>
<html>

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Speaker Details </title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />
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
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>
    <link rel="stylesheet" href="assets/css/app.css" />
          <link rel="canonical" href="https://ceuservices.com/speakers" />
</head>

<body>
        <div id="main-wrapper" class="main-wrapper">

        
        <?php include "header.php" ?>


            <div class="edu-breadcrumb-area ">
                <div class="container">
                    <div class="breadcrumb-inner">

                        <div class="page-title">
                            <h1 class="title">Our <span class="color-secondary">Esteemed</span> Speakers</h1>
                            <h3 class="heading-title">Learn from the<span class="color-secondary"> Best,</span> become the Best! </span></h3>
                            <span class="shape-line" style="color:#1ab69d"><i class="icon-19"></i></span>
                        </div>
                    </div>
                </div>

                <ul class="shape-group">
                    <li class="shape-1">
                        <span></span>
                    </li>
                    <li class="shape-2 scene"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape"></li>
                    <li class="shape-3 scene"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape"></li>
                    <li class="shape-4">
                        <span></span>
                    </li>
                    <li class="shape-5 scene"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape"></li>
                </ul>


            </div>


            <div class="edu-team-area team-area-2 edu-section-gap">
                <div class="container">
                    
                    <div class="row g-5">
                        <!-- Start Instructor Grid  -->

                        <?php
                        $sp_sql=mysqli_query($con,"SELECT * FROM speaker_info WHERE speaker_status='1' AND status='1' ");
                        while($sp_row=mysqli_fetch_assoc($sp_sql)){
                        ?>
                        <div class="col-lg-4 col-md-6" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="edu-team-grid team-style-2">
                                <div class="inner">
                                    <div class="thumbnail-wrap">
                                        <div class="thumbnail">
                                            <a href="speaker-detail.php?id=<?php echo $sp_row['id'] ?>">
                                            <?php 
                                                $images="";
                                                if(!empty($sp_row['images'])){
                                                    $images.="ceuadmin/assets/images/speaker/".$sp_row['images'];
                                                }else{
                                                    $images.="ceuadmin/assets/images/xs/avatar6.svg";
                                                }
                                                ?>
                                                <img src="<?php echo $images ?>" />
                                            </a>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><a href="speaker-detail.php?id=<?php echo $sp_row['id'] ?>"><?php echo $sp_row['name'] ?></a></h5>
                                        <span class="designation"><?php echo $sp_row['designation'] ?></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }?>


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