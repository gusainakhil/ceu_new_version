<!DOCTYPE html>
<?php
include "../connect.php";
include "../functions.php";

$sql = mysqli_query($con, "SELECT course_detail.*, speaker_info.* FROM course_detail JOIN speaker_info ON course_detail.speaker = speaker_info.id WHERE course_detail.slug = '" . $_GET['id'] . "';");

$_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];

$c_row = mysqli_fetch_assoc($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $course_hash_id = $_POST['course_hash_id']; 
    $hash_id = $_POST['hash_id'];
    $array = str_replace("'", '"', $_POST['array']);
    $old_sql=mysqli_query($con,"SELECT * FROM cart WHERE user_id='$user_id'  AND cart_status='1' ");
    if(mysqli_num_rows($old_sql)>0){
        $old_row=mysqli_fetch_assoc($old_sql);
        if($course_hash_id==$old_row['course_hash_id']){
            mysqli_query($con, "UPDATE cart SET course_id='$course_id',course_hash_id='$course_hash_id',hash_id='$hash_id',array='$array' WHERE course_hash_id='$course_hash_id' ");
            echo "UPDATE cart SET course_id='$course_id',course_hash_id='$course_hash_id',hash_id='$hash_id',array='$array' WHERE course_hash_id='$course_hash_id' ";
        }else{
            mysqli_query($con, "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','$array')");
            echo "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','".$array."')";
        }
    }else{
        mysqli_query($con, "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','$array')");
        echo "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','".$array."')";
    }
    // header("Refresh:0");    
    
}

?>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>CEUTrainers | Online Education Platform</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/Favicon.png" />

    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/icomoon.css" />
    <link rel="stylesheet" href="../assets/css/vendor/remixicon.css" />
    <link rel="stylesheet" href="../assets/css/vendor/magnifypopup.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/odometer.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/lightbox.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/animation.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/jqueru-ui-min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../assets/css/vendor/tipped.min.css" />
    <link href="../assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <!-- <script src="assets/Calender/EventCalender.js" type="text/javascript"></script> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="../assets/css/app.css" />
    <style type="text/css">
        .parentSpace {
            width: 100%;
            display: block;
            color: white;
        }

        .left {
            float: left;
            width: 87%;
        }

        .right {
            float: right;
            width: 5%;

        }

        .center {
            float: right;
            width: 8%;
        }


        .legend .row:nth-of-type(odd) div {
            background-color: #fff;
        }

        .legend .row:nth-of-type(even) div {
            background: #FFF;
        }

        .legend .row:hover div {
            background-color: #1AB39A;
        }


        .text {
            color: #808080;
        }


        .tooltip {
            position: relative;
            display: inline-block;

        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 250px;
            background-color: #C8F7EF;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 2px 5px 5px 5px;
            top: 20px;
            right: 105%;
            font-size: xx-small;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        #clockdiv {
            color: #fff;
            display: inline-block;
            font-weight: 500;
            text-align: center;
            font-size: 15px;
            margin-bottom: 20px;
            margin-top: 50px;
        }

        #clockdiv>div {
            display: inline-block;
            padding: 12px 15px;
            margin-right: 5px;
            border: 3px solid #FB0351;
            border-radius: 50%;
        }

        #clockdiv div>span {
            display: inline-block;
            width: 55px;
            height: 35px;
            font-family: "Nunito", sans-serif;
            font-size: 30px;
            font-weight: bold;
            color: #0E1851;
        }

        .smalltext {
            padding-top: 0px;
            font-size: 12px;
            text-transform: uppercase;
            color: #0E1851;
            font-weight: bold;
        }
    </style>

</head>

<body>

    <div id="main-wrapper" class="main-wrapper">


        <?php include "../header.php" ?>


        <div class="online-academy-cta-wrapper edu-cta-banner-area bg-image">
            <div class="container">
                <div class="edu-cta-banner">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-breadcrumb-area" style="background-color: transparent;padding: 15px 0 15px;">
                                    <!-- <ul class="edu-breadcrumb">
                                        <li class="breadcrumb-item"><a href="index-one.html">Home</a></li>
                                        <li class="separator"><i class="icon-angle-right"></i></li>
                                        <li class="breadcrumb-item"><a href="course-one.html">Courses</a></li>
                                        <li class="separator"><i class="icon-angle-right"></i></li>
                                        <li class="breadcrumb-item active" aria-current="page">Course Details</li>
                                    </ul> -->
                                    <h2 class="title"><?php echo $c_row['title'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-breadcrumb-area" style="background-color: transparent;padding: 15px 0 15px;">
                                    <!-- <ul class="edu-breadcrumb">
                                        <li class="breadcrumb-item"><a href="index-one.html">Home</a></li>
                                        <li class="separator"><i class="icon-angle-right"></i></li>
                                        <li class="breadcrumb-item"><a href="course-one.html">Courses</a></li>
                                        <li class="separator"><i class="icon-angle-right"></i></li>
                                        <li class="breadcrumb-item active" aria-current="page">Course Details</li>
                                    </ul> -->
                                    <div class="breadcrumb-inner">
                                        <ul class="course-meta">
                                            <li><i class="icon-58"></i>by <?php echo speaker($con, $c_row['speaker']) ?></li>
                                            <li><i class="fa fa-hourglass-start"></i><?php echo $c_row['duration'] ?></li>
                                            <li><i class="fa fa-calendar"></i><?php echo $c_row['date'] ?></li>

                                        </ul>
                                        <ul class="course-meta">
                                            <li><i class="icon-61"></i>
                                                01:00 pm (EST) |
                                                12:00 pm (CST) |
                                                11:00 am (MST) |
                                                10:00 am (PST)
                                            </li>
                                        </ul>
                                        <!-- <div id="demo"></div> -->


                                        <div id="clockdiv">
                                            <div>
                                                <span class="days" id="days"></span>
                                                <div class="smalltext">Days</div>
                                            </div>
                                            <div>
                                                <span class="hours" id="hours"></span>
                                                <div class="smalltext">Hours</div>
                                            </div>
                                            <div>
                                                <span class="minutes" id="minutes"></span>
                                                <div class="smalltext">Mins</div>
                                            </div>
                                            <div>
                                                <span class="seconds" id="seconds"></span>
                                                <div class="smalltext">Secs</div>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="edu-btn"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">

                            <div class="course-sidebar-3 sidebar-top-position">
                                <div class="edu-course-widget widget-course-summery">
                                    <div class="inner">
                                        <div class="thumbnail">
                                            <img src="../ceuadmin/dist/assets/images/course/<?php echo $c_row['course_thumbail'] ?>" alt="Courses">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="shape-group">
                            <li class="shape-01 scene">
                                <img data-depth="2.5" src="assets/images/cta/shape-10.png" alt="shape">
                            </li>
                            <li class="shape-02 scene">
                                <img data-depth="-2.5" src="assets/images/cta/shape-09.png" alt="shape">
                            </li>
                            <li class="shape-03 scene">
                                <img data-depth="-2" src="assets/images/cta/shape-08.png" alt="shape">
                            </li>
                            <li class="shape-04 scene">
                                <img data-depth="2" src="assets/images/about/shape-13.png" alt="shape">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <section class="edu-section-gap course-details-area">
            <div class="container">
                <div class="row row--30">
                    <div class="col-lg-7">
                        <div class="course-details-content">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Description</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="instructor" aria-selected="false">Speaker</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="carriculam-tab" data-bs-toggle="tab" data-bs-target="#carriculam" type="button" role="tab" aria-controls="carriculam" aria-selected="false">Credits</button>
                                </li>

                                <!-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">Reviews</button>
                                </li> -->
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="course-tab-content">
                                        <div class="course-overview">
                                            <h3 class="heading-title">Course Description</h3>
                                            <div style="text-align: justify;text-justify: inter-word;">
                                                <?php echo $c_row['description'] ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="carriculam" role="tabpanel" aria-labelledby="carriculam-tab">
                                    <div class="course-tab-content">
                                        <div class="course-curriculam">
                                            <h3 class="heading-title">Course Curriculum</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor inc idid unt ut labore et dolore magna aliqua enim ad minim veniam, quis nostrud exerec tation ullamco laboris nis aliquip commodo consequat.</p>
                                            <div class="course-lesson">
                                                <h5 class="title">Week 1-4</h5>
                                                <p>Advanced story telling techniques for writers: Personas, Characters &amp; Plots</p>
                                                <ul>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Introduction</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Course Overview</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Local Development Environment Tools</div>
                                                        <div class="badge-list">
                                                            <span class="badge badge-primary">0 Question</span>
                                                            <span class="badge badge-secondary">10 Minutes</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Course Exercise / Reference Files</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Code Editor Installation (Optional if you have one)</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Embedding PHP in HTML</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="course-lesson">
                                                <h5 class="title">Week 5-8</h5>
                                                <p>Advanced story telling techniques for writers: Personas, Characters &amp; Plots</p>
                                                <ul>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Defining Functions</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i>Function Parameters</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Return Values From Functions</div>
                                                        <div class="badge-list">
                                                            <span class="badge badge-primary">0 Question</span>
                                                            <span class="badge badge-secondary">10 Minutes</span>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Global Variable and Scope</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i>Newer Way of creating a Constant</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                    <li>
                                                        <div class="text"><i class="icon-65"></i> Constants</div>
                                                        <div class="icon"><i class="icon-68"></i></div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="instructor" role="tabpanel" aria-labelledby="instructor-tab">
                                    <div class="course-tab-content">
                                        <div class="course-instructor">
                                            <div class="thumbnail">
                                                <?php
                                                $images = "";
                                                if (!empty($c_row['images'])) {
                                                    $images .= "../ceuadmin/dist/assets/images/speaker/" . $c_row['images'];
                                                } else {
                                                    $images .= "../ceuadmin/dist/assets/images/xs/avatar6.svg";
                                                }
                                                ?>
                                                <img src="<?php echo $images ?>" alt="Author Images">
                                            </div>
                                            <div class="author-content">
                                                <h6 class="title"><?php echo $c_row['name'] ?></h6>
                                                <span class="subtitle">Speaker</span>
                                                <p><?php echo $c_row['bio'] ?></p>
                                                <ul class="social-share">
                                                    <li><a href="#"><i class="icon-facebook"></i></a></li>
                                                    <li><a href="#"><i class="icon-twitter"></i></a></li>
                                                    <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                                                    <li><a href="#"><i class="icon-youtube"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="course-tab-content">
                                        <div class="course-review">
                                            <h3 class="heading-title">Course Rating</h3>
                                            <p>5.00 average rating based on 7 rating</p>
                                            <div class="row g-0 align-items-center">
                                                <div class="col-sm-4">
                                                    <div class="rating-box">
                                                        <div class="rating-number">5.0</div>
                                                        <div class="rating">
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                            <i class="icon-23"></i>
                                                        </div>
                                                        <span>(7 Review)</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="review-wrapper">

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                5 <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">7</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                4 <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">0</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                4 <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">0</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                4 <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">0</span>
                                                        </div>

                                                        <div class="single-progress-bar">
                                                            <div class="rating-text">
                                                                4 <i class="icon-23"></i>
                                                            </div>
                                                            <div class="progress">
                                                                <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <span class="rating-value">0</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Start Comment Area  -->
                                            <div class="comment-area">
                                                <h3 class="heading-title">Reviews</h3>
                                                <div class="comment-list-wrapper">
                                                    <!-- Start Single Comment  -->
                                                    <div class="comment">
                                                        <div class="thumbnail">
                                                            <img src="assets/images/blog/comment-01.jpg" alt="Comment Images">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="rating">
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                            </div>
                                                            <h5 class="title">Haley Bennet</h5>
                                                            <span class="date">Oct 10, 2021</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Comment  -->
                                                    <!-- Start Single Comment  -->
                                                    <div class="comment">
                                                        <div class="thumbnail">
                                                            <img src="assets/images/blog/comment-02.jpg" alt="Comment Images">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="rating">
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                            </div>
                                                            <h5 class="title">Simon Baker</h5>
                                                            <span class="date">Oct 10, 2021</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Comment  -->
                                                    <!-- Start Single Comment  -->
                                                    <div class="comment">
                                                        <div class="thumbnail">
                                                            <img src="assets/images/blog/comment-03.jpg" alt="Comment Images">
                                                        </div>
                                                        <div class="comment-content">
                                                            <div class="rating">
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                                <i class="icon-23"></i>
                                                            </div>
                                                            <h6 class="title">Richard Gere</h6>
                                                            <span class="date">Oct 10, 2021</span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                        </div>
                                                    </div>
                                                    <!-- End Single Comment  -->
                                                </div>
                                            </div>
                                            <!-- End Comment Area  -->
                                            <div class="comment-form-area">
                                                <h3 class="heading-title">Write a Review</h3>
                                                <div class="rating-icon">
                                                    <h6 class="title">Rating Here</h6>
                                                    <div class="rating">
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                        <i class="icon-23"></i>
                                                    </div>
                                                </div>
                                                <form class="comment-form">
                                                    <div class="row g-5">
                                                        <div class="form-group col-lg-6">
                                                            <input type="text" name="comm-title" id="comm-title" placeholder="Review Title">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <input type="text" name="comm-name" id="comm-name" placeholder="Reviewer name">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <input type="email" name="comm-email" id="comm-email" placeholder="Reviewer email">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <textarea name="comm-message" id="comm-message" cols="30" rows="5" placeholder="Review summary"></textarea>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <button type="submit" class="edu-btn submit-btn">Submit Review <i class="icon-4"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- <div class="course-sidebar-3 sidebar-top-position">
                            <div class="edu-course-widget widget-course-summery">
                                <div class="inner">
                                    <div class="content">
                                        <h4 class="widget-title">Course Includes:</h4>
                                        <ul class="course-item">
                                            <li>
                                                <span class="label"><i class="icon-60"></i>1 Attendee:</span>
                                                <span class="value price">$180.00</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-62"></i>2 Attendee:</span>
                                                <span class="value price">$180.00</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-61"></i>3 Attendee:</span>
                                                <span class="value price">$180.00</span>
                                            </li>
                                            <li>
                                                <span class="label">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19.84" height="17.75" viewBox="0 0 19.84 17.75" data-inject-url="https://edublink.html.devsblink.com/assets/images/svg-icons/books.svg" class="svgInject">
                                                        <defs>
                                                            <style>
                                                                .cls-1 {
                                                                    fill: #181818;
                                                                    fill-rule: evenodd;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <path class="cls-1" d="M1244.3,708.6c-0.57-1.6-1.78-.867-1.43-1.008l-2.52,1.008v-1.314a0.719,0.719,0,0,0-.65-0.658h-9.86a0.6,0.6,0,0,0-.66.658v16.43a0.6,0.6,0,0,0,.66.657h9.86a0.6,0.6,0,0,0,.65-0.657v-11.83s3.14,8.9,3.82,10.812a1.069,1.069,0,0,0,1.44.361s2.23-.89,3.01-1.206a1,1,0,0,0,.28-1.423Zm-3.79,1.262,2.59-1.069,1.01,2.695-2.35,1.016Zm-1.47,2.024h-3.29v-3.943h3.29v3.943Zm-4.6-3.943v3.943h-3.95v-3.943h3.95Zm-3.95,5.258h3.95v9.858h-3.95V713.2Zm5.26,0h3.29v9.858h-3.29V713.2Zm6.46,0.388,2.45-.933,3.06,8.347-2.45.994Z" transform="translate(-1229.19 -706.625)" style="stroke-dasharray: 208, 210; stroke-dashoffset: 0;"></path>
                                                    </svg>
                                                    4 Attendee:</span>
                                                <span class="value price">$180.00</span>

                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-63"></i>Enrolled:</span>
                                                <span class="value">65 students</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-59"></i>Language:</span>
                                                <span class="value">English</span>
                                            </li>
                                            <li>
                                                <span class="label"><i class="icon-64"></i>Certificate:</span>
                                                <span class="value">Yes</span>
                                            </li>
                                        </ul>
                                        <div class="read-more-btn">
                                            <a href="#" class="edu-btn">Start Now <i class="icon-4"></i></a>
                                        </div>
                                        <div class="share-area">
                                            <h4 class="title">Share On:</h4>
                                            <ul class="social-share">
                                                <li><a href="#"><i class="icon-facebook"></i></a></li>
                                                <li><a href="#"><i class="icon-twitter"></i></a></li>
                                                <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                                                <li><a href="#"><i class="icon-youtube"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="container legend">
                            <div class="course-sidebar-3 sidebar-top-position">
                                <div class="edu-course-widget widget-course-summery">
                                    <div class="inner">

                                        <h3 style="text-align:center;padding-top:15px;color:#1AB69D"><u style="padding-bottom:6px;text-decoration:none;
                                        border-bottom:2px solid #1AB69D;">Registration Options</u></h3>
                                        <hr style="margin-top:-18px">

                                        <div class="content">
                                            <?php

                                            // print_r($data);
                                            $data = stringToArray($c_row['selling_option']);
                                            $a = 0;
                                            foreach ($data as $key => $innerArray) { ?>

                                                <hr>
                                                <h3 class="text" style="text-align:center;color:Black"><?php echo $key ?></h3>
                                                <hr>
                                                <?php foreach ($innerArray as $name => $amount) {
                                                    $a++; ?>

                                                    <div class=" row edu-form-check" style="margin: 10px 0">
                                                        <div class="edu-form-check">

                                                            <input type="checkbox" id="cat-check<?php echo $a; ?>" class="parentSpace" data-cname="<?php echo $name; ?>" data-amount="<?php echo $amount; ?>">
                                                            <label for="cat-check<?php echo $a; ?>" class="text left" style="font-size:large;font-weight:bold">
                                                                <?php echo $name ?><span class="text center">$<?php echo $amount ?></span>
                                                            </label>

                                                            <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                                <span class="tooltiptext">
                                                                    <ul style="font-size:small">
                                                                        <li>Only 1 Attendee is allowed</li>
                                                                        <li>Access notification 24 hrs before Event</li>
                                                                        <li>Access notification via. Email &amp; My Account</li>
                                                                        <li>Certificate of Participation for Attendee</li>
                                                                    </ul>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>

                                            <div>
                                                <hr>
                                                <p style="color:Black;font-size:18px"><i class="fa fa-asterisk" style="font-size:18px"></i> Couldn't find the option you're looking for? Don't worry, let us know your requirements and we will get back to you SOON! <a href="contact"><u><b> Contact Us Now</b></u></a></p>
                                            </div>
                                            <hr>
                                            <div>
                                                <h4 style="color:#1AB39A; text-align:center" id="output"><span>Total Fee:</span> $0.00</h4>
                                            </div>
                                            <form method="post">
                                                <input type="hidden" name="array" id="array">
                                                <input type="hidden" name="course_hash_id" value="<?php echo $c_row['hash_id'] ?>">
                                                <input type="hidden" name="course_id" value="<?php echo $c_row['id'] ?>">
                                                <input type="hidden" name="hash_id" value="<?php echo random(date('Y-m-d H:i:s')) ?>">
                                                <!-- <input type="hidden" name="user_id" value="<?php echo random(date('Y-m-d H:i:s')) ?>"> -->
                                                <div class="read-more-btn">
                                                    <input type="hidden" name="user_id" value="<?php echo $temp_hash_id ?>">
                                                    <button type="submit" class="edu-btn" style="font-size:x-large;font-weight:bold">Add To Cart <i class="icon-4"></i></button>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- <div class="content">
                                            <hr>
                                            <h3 class="text" style="text-align:center;color:Black">Live options</h3>
                                            <hr>

                                            <div class=" row edu-form-check" style="margin: 10px 0">
                                                <div class="edu-form-check">

                                                    <input type="checkbox" id="cat-check1" class="parentSpace">
                                                    <label for="cat-check1" class="text left" style="font-size:large;font-weight:bold">1 Attendee<span class="text center">-$199</span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 1 Attendee is allowed</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check2" class="parentSpace">
                                                    <label for="cat-check2" class="text left" style="font-size:large;font-weight:bold">2 Attendee (Save $69)<span class="text center">-$329 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 2 Attendee(s) are allowed</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check3" class="parentSpace">
                                                    <label for="cat-check3" class="text left" style="font-size:large;font-weight:bold">3 Attendee(Save $140) <span class="text center">-$457 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 3 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check4" class="parentSpace">
                                                    <label for="cat-check4" class="text left" style="font-size:large;font-weight:bold">4 Attendee (Save $180)<span class="text center">-$616 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 4 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class=" edu-form-check">
                                                    <input type="checkbox" id="cat-check5" class="parentSpace">
                                                    <label for="cat-check5" class="text left" style="font-size:large;font-weight:bold">5 Attendee (Save $220)<span class="text center">-$775 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 5 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <h3 class="widget-title" style="text-align:center">Super Saver Options<br><span style="font-size:16px;">(Get Recordings &amp; e-Transcripts FREE)</span></h3>
                                            <hr>
                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check6" class="parentSpace">
                                                    <label for="cat-check6" class="text left" style="font-size:large;font-weight:bold">6 Attendee (Save $300)<span class="text center">-$894 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 6 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Free e-Transcripts</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check7" class="parentSpace">
                                                    <label for="cat-check7" class="text left" style="font-size:large;font-weight:bold">7 Attendee (Save $393)<span class="text center">-$1000 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 7 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Free e-Transcripts</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>

                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check8" class="parentSpace">
                                                    <label for="cat-check8" class="text left" style="font-size:large;font-weight:bold">8 Attendee (Save $492)<span class="text center">-$1100 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 8 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Free e-Transcripts</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check9" class="parentSpace">
                                                    <label for="cat-check9" class="text left" style="font-size:large;font-weight:bold">9 Attendee (Save $591)<span class="text center">-$1200 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 9 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Free e-Transcripts</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check10" class="parentSpace">
                                                    <label for="cat-check10" class="text left" style="font-size:large;font-weight:bold">10 Attendee (Save $690)<span class="text center">-$1300 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>Only 10 Attendee is allowed</li>
                                                                <li>Free Recordings Training </li>
                                                                <li>Free e-Transcripts</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>
                                                                <li>Add/ Edit attendees using My Account</li>
                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <h3 class="widget-title" style="text-align:center">Recording &amp; Combos</h3>
                                            <hr>
                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check11" class="parentSpace">
                                                    <label for="cat-check11" class="text left" style="font-size:large;font-weight:bold">1 Recording (Save $300)<span class="text center">-$894 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">

                                                                <li>One Recordings Recording </li>


                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check12" class="parentSpace">
                                                    <label for="cat-check12" class="text left" style="font-size:large;font-weight:bold">2 Recordings (Save $393)<span class="text center">-$1000 </span></label>
                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">

                                                                <li>2 Recordings Recording </li>


                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>

                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check13" class="parentSpace">
                                                    <label for="cat-check13" class="text left" style="font-size:large;font-weight:bold">3 Recordings (Save $492)<span class="text center">-$1100 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">

                                                                <li>Recordings Training </li>


                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check14" class="parentSpace">
                                                    <label for="cat-check14" class="text left" style="font-size:large;font-weight:bold">e-Transcript (Save $591)<span class="text center">-$1200 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">

                                                                <li> e-Transcripts</li>

                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check15" class="parentSpace">
                                                    <label for="cat-check15" class="text left" style="font-size:large;font-weight:bold">Live + Recording (Save $690)<span class="text center">-$1300 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>1 Attendee is allowed</li>
                                                                <li>Live + Recordings Training </li>

                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check16" class="parentSpace">
                                                    <label for="cat-check16" class="text left" style="font-size:large;font-weight:bold">Live + e-Transcript (Save $690)<span class="text center">-$1300 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">

                                                                <li>1 Live Training </li>
                                                                <li>1 e-Transcript</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check17" class="parentSpace">
                                                    <label for="cat-check17" class="text left" style="font-size:large;font-weight:bold">Recording + e-Transcript (Save $690)<span class="text center">-$1300 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">

                                                                <li>1 Recordings Training </li>
                                                                <li>1 e-Transcripts</li>

                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin: 10px 0;">
                                                <div class="edu-form-check">
                                                    <input type="checkbox" id="cat-check18" class="parentSpace">
                                                    <label for="cat-check18" class="text left" style="font-size:large;font-weight:bold">Live + Recording + e-Transcript (Save $690)<span class="text center">-$1300 </span></label>

                                                    <div class="tooltip right" style="opacity:1"><i class="fa fa-question-circle-o" style="font-size:18px"></i>
                                                        <span class="tooltiptext">
                                                            <ul style="font-size:small">
                                                                <li>1 Live Training</li>
                                                                <li>1 Recordings Training </li>
                                                                <li>1 e-Transcripts</li>
                                                                <li>Access notification 24 hrs before Event</li>
                                                                <li>Access notification via. Email &amp; My Account</li>

                                                                <li>Certificate of Participation for Attendee</li>
                                                            </ul>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <hr>
                                                <p style="color:Black;font-size:18px"><i class="fa fa-asterisk" style="font-size:18px"></i> Couldn't find the option you're looking for? Don't worry, let us know your requirements and we will get back to you SOON! <a href="contact.aspx"><u><b> Contact Us Now</b></u></a></p>
                                            </div>
                                            <hr>
                                            <div>
                                                <h4 style="color:#1AB39A; text-align:center"><span>Total Fee:</span> $0.00</h4>
                                            </div>
                                            <div class="read-more-btn">
                                                <a href="checkout.php" class="edu-btn" style="font-size:x-large;font-weight:bold">Add To Cart <i class="icon-4"></i></a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script>
            // Update the count down every 1 second
            var x = setInterval(function() {
                // Set the date we're counting down to
                <?php
                $total = $c_row['date'] . " " . $c_row['time'];
                ?>
                var countDownDate = new Date("<?php echo $total; ?>").getTime();

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in the clockdiv
                document.getElementById("days").innerHTML = days;
                document.getElementById("hours").innerHTML = hours;
                document.getElementById("minutes").innerHTML = minutes;
                document.getElementById("seconds").innerHTML = seconds;

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);

                    document.getElementById("days").innerHTML = 0;
                    document.getElementById("hours").innerHTML = 0;
                    document.getElementById("minutes").innerHTML = 0;
                    document.getElementById("seconds").innerHTML = 0;
                }
            }, 1000);
        </script>


        <?php include "../footer.php" ?>

    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- JS
	============================================ -->
    <!-- Modernizer JS -->
    <script src="../assets/js/vendor/modernizr.min.js"></script>
    <!-- Jquery Js -->
    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/sal.min.js"></script>
    <script src="../assets/js/vendor/backtotop.min.js"></script>
    <script src="../assets/js/vendor/magnifypopup.min.js"></script>
    <script src="../assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="../assets/js/vendor/odometer.min.js"></script>
    <script src="../assets/js/vendor/isotop.min.js"></script>
    <script src="../assets/js/vendor/imageloaded.min.js"></script>
    <script src="../assets/js/vendor/lightbox.min.js"></script>
    <script src="../assets/js/vendor/paralax.min.js"></script>
    <script src="../assets/js/vendor/paralax-scroll.min.js"></script>
    <script src="../assets/js/vendor/jquery-ui.min.js"></script>
    <script src="../assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="../assets/js/vendor/svg-inject.min.js"></script>
    <script src="../assets/js/vendor/vivus.min.js"></script>
    <script src="../assets/js/vendor/tipped.min.js"></script>
    <script src="../assets/js/vendor/smooth-scroll.min.js"></script>
    <script src="../assets/js/vendor/isInViewport.jquery.min.js"></script>
    <!--Calender Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function() {
            // Array to store checkbox data
            var dataArray = [];

            // Update the div#output when a checkbox is clicked
            $('.parentSpace').on('change', function() {
                updateOutput();
            });

            // Function to update the div#output
            function updateOutput() {
                // Reset the dataArray at the beginning of the function
                dataArray = [];

                var totalAmount = 0;

                // Loop through all checkboxes and add up the selected amounts
                $('.parentSpace:checked').each(function() {
                    var amount = parseFloat($(this).data('amount'));
                    var cname = $(this).data('cname');
                    if (!isNaN(amount)) {
                        totalAmount += amount;
                    }

                    // Add checkbox data to the array
                    dataArray.push("'" + cname + "'=>'" + amount + "'");
                });

                var arrayString = 'array(' + dataArray.join(',') + ')';

                // Log the array in the desired format
                console.log('array(' + dataArray.join(',') + ')');

                // Update the div#output with the total amount
                $('#output').text('Total Fee: $' + totalAmount.toFixed(2));
                $('#array').val(arrayString);
            }
        });



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