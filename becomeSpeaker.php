<!DOCTYPE html>

<html>

<?php
include "connect.php";
include "functions.php";
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" c ontent="text/html;charset=utf-8" />
    <title>Become A speaker</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
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
    <!-- <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script> -->
       <link rel="canonical" href="https://ceuservices.com/becomeSpeaker" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
    <style type="text/css">
        .circle {
            height: 50px;
            width: 50px;
            background-color: rgba(255, 0, 0, 0.4);
            border-radius: 50%;
        }

        .circle1 {
            height: 50px;
            width: 50px;
            background-color: rgba(26, 182, 157, 0.4);
            border-radius: 50%;
        }

        .square {
            text-align: center;
            height: 100px;
            width: 320px;
            padding: 25px;
            background-color: #fff;
            border-radius: 50px 8px 50px 8px;
            box-shadow: 3px 3px 5px 5px rgba(0, 0, 0, 0.05);
        }

        .square1 {
            text-align: center;
            height: 100px;
            width: 320px;
            padding: 25px;
            background-color: #fff;
            border-radius: 8px 50px 8px 50px;
            box-shadow: 3px 3px 5px 5px rgba(0, 0, 0, 0.05);
        }

        .content1 {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 10px;
            text-align: center;

        }
        
        input{
            color: white !important;
        }
    </style>
</head>

<body>
    <div id="main-wrapper" class="main-wrapper">


        <?php include "header.php" ?>

        <div class="edu-breadcrumb-area ">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">

                        <h1 class="title">Become A Speakers</h1>
                        <h3 class="text-center heading-title">Mentor Young <span class="color-secondary">Learners</span></h3>
                        <span class="shape-line" style="color:#1ab69d"><i class="icon-19"></i></span>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="contact-us-info">
                    <div class="row">
                        <div class="col-xs-6 content1" style="background:transparent;">
                            <p style="font-size:19px;color:black;background:transparent;">Trainings are difficult or impossible without expert guidance. Your guidance help trainees grasp complex concepts and apply them effectively. Your expertise, experience, and insights are invaluable for helping learners achieve their goals and develop mastery in their field.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offset-xl-3 col-lg-6 mt-5 mb-5">
                <div class="contact-form">
                    <div class="section-title" style="text-align:center">

                    </div>
                    <form class="rnt-contact-form rwt-dynamic-form" id="Becomespeaker" method="POST">
                        <div class="row row--10">
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input type="text" name="fname" placeholder="First name " required />
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" name="lname" placeholder="Last name" required />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input type="number" name="phone_no" id="contact-phone" placeholder="Phone number" required />
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="email" name="email" placeholder="Enter your Email " required />
                                    </div>

                                    <input type="hidden" name="type" value="2">
                                </div>
                            </div>
                            <div class="form-group col-12">
                                <textarea name="experience" cols="30" rows="2" placeholder="Qualification and Experience" required></textarea>
                            </div>
                            <div class="form-group col-12">
                                <textarea name="bio" id="contact-message" cols="30" rows="2" placeholder="Bio " required></textarea>
                            </div>
                            <center>
                                <div class="form-group col-12">
                                    <button class="rn-btn edu-btn btn-medium submit-btn" name="submit" type="submit">Join Us<i class="icon-4"></i></button>
                                </div>
                            </center>
                        </div>
                    </form>
                </div>
            </div>


            <section class="why-choose-area-2 section-gap-large">
                <div class="container edublink-animated-shape">

                    <div class="row g-5">
                        <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="why-choose-box features-box color-primary-style">
                                <div class="icon">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Address</h4>
                                    <p style="font-size:large">304 S. Jones Blvd #5255,<br />
                                        Las Vegas, NV, 89107<br />
                                        United States</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="why-choose-box features-box color-secondary-style">
                                <div class="icon">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">E-Mail</h4>
                                    <p style="font-size:large">
                                        support@ceutrainers.com
                                        contact@ceutrainers.com
                                        info@ceutrainers.com
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                            <div class="why-choose-box features-box color-extra08-style">
                                <div class="icon">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">Hours of Operation</h4>
                                    <p style="font-size:large">Mon - Fri : 09:00 - 20:00<br>
                                        Sat : 10:00 - 14:00<br />
                                        Sun : Closed
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <ul class="shape-group">
                        <li class="shape-5" data-sal-delay="500" data-sal="fade" data-sal-duration="200">
                            <span></span>
                        </li>
                    </ul>
                </div>

            </section>


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




        <?php include "footer.php" ?>


    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

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
    <!-- Include SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $("#Becomespeaker").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: "signin_ajax.php",
                    method: "POST",
                    data: $('#Becomespeaker').serialize(),
                    success: function(data) {
                        console.log(data)
                        if (data == "0") {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Your form has been submitted!',
                            }).then(() => {
                                location.reload(true);
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Something went Wrong. Your form was not submitted.',
                            }).then(() => {
                                location.reload(true);
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went Wrong. Please try again later.',
                        }).then(() => {
                            location.reload(true);
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>