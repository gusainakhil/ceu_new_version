<!DOCTYPE html>
<?php
include "connect.php";
include "functions.php";

if (empty($_GET['id'])) {
    header("Location: index");
    exit();
}
$id = mysqli_real_escape_string($con, test_input($_GET['id']));
$sql = mysqli_query($con, "SELECT 
        course_detail.id as course_id,
        course_detail.title,
        course_detail.duration,
        course_detail.date as date,
        course_detail.time, 
        course_detail.course_thumbail,
        course_detail.selling_option,
        course_detail.description,
        course_detail.certificate,
        course_detail.hash_id,
        speaker_info.images,
        speaker_info.bio,
        speaker_info.designation,
        speaker_info.id as speaker_id,
        speaker_info.name
    FROM course_detail JOIN speaker_info ON course_detail.speaker = speaker_info.id WHERE course_detail.slug = '$id';");

if (mysqli_num_rows($sql) == 0) {
    header("Location: index");
    exit(); // Add exit() after header to stop further execution
}

if (empty($_SESSION['ip_address'])) {
    $_SESSION['ip_address'] = md5($_SERVER['REMOTE_ADDR'] . " " . date("Y-m-d H:i:s"));
}
$temp_hash_id = "";
if (!empty($_SESSION['hash_id'])) {
    $temp_hash_id = $_SESSION['hash_id'];
}
if (!empty($_SESSION['ip_address'])) {
    $temp_hash_id = $_SESSION['ip_address'];
}

$c_row = mysqli_fetch_assoc($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $course_hash_id = $_POST['course_hash_id'];
    $hash_id = $_POST['hash_id'];
    $array = str_replace("'", '"', $_POST['array']);
    $old_sql = mysqli_query($con, "SELECT * FROM cart WHERE user_id='$user_id' AND course_id='$course_id' AND cart_status='1' ");
    if (mysqli_num_rows($old_sql) > 0) {
        $old_row = mysqli_fetch_assoc($old_sql);
        if ($course_hash_id == $old_row['course_hash_id']) {
            mysqli_query($con, "UPDATE cart SET course_id='$course_id',course_hash_id='$course_hash_id',hash_id='$hash_id',array='$array' WHERE course_hash_id='$course_hash_id' ");
            // echo "UPDATE cart SET course_id='$course_id',course_hash_id='$course_hash_id',hash_id='$hash_id',array='$array' WHERE course_hash_id='$course_hash_id' ";
        } else {
            mysqli_query($con, "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','$array')");
            // echo "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','".$array."')";
        }
    } else {
        mysqli_query($con, "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','$array')");
        // echo "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','".$array."')";
    }
    header("Refresh:0");
}

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $c_row['title'] ?></title>
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
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <link rel="canonical" href="https://ceuservices.com/course-details.php?id=<?php echo $id; ?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
    <style type="text/css">
        .progress {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 3px;
            width: 100%;
        }

        .progress:before {
            content: "";
            position: absolute;
            bottom: 0;
            height: 100%;
            width: 100%;
            background-color: #2770ff;
        }

        .progress.active:before {
            animation: progress 5s linear forwards;
        }

        @keyframes progress {
            100% {
                width: 0%;
            }

            0% {
                width: 100%;
            }
        }

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
        <?php include "header.php" ?>
        <div class="online-academy-cta-wrapper edu-cta-banner-area bg-image">
            <div class="container">
                <div class="edu-cta-banner">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-breadcrumb-area" style="background-color: transparent;padding: 15px 0 15px;">
                                    <h2 class="title"><?php echo $c_row['title'] ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="section-title section-center" data-sal-delay="150" data-sal="slide-up" data-sal-duration="800">
                                <div class="edu-breadcrumb-area" style="background-color: transparent;padding: 15px 0 15px;">

                                    <div class="breadcrumb-inner">
                                        <ul class="course-meta">
                                            <li><i class="icon-58"></i> <?php echo $c_row['name'] ?></li>
                                            <li><i class="fa fa-hourglass-start"></i><?php echo $c_row['duration'] ?> minutes</li>
                                            <li><i class="fa fa-calendar"></i><?php echo $c_row['date'] ?></li>
                                        </ul>
                                        <ul class="course-meta">
                                            <li><i class="icon-61"></i>
                                                <?php convertTimezones($c_row['time']); ?>
                                                
                                                <!--13:00:00 PM (EST) | 12:00:00 PM (CST) | 11:00:00 AM (MST) | 10:00:00 AM (PST)-->
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
                                            <img src="ceuadmin/assets/images/course/<?php echo $c_row['course_thumbail'] ?>" alt="Courses">
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
                                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="true">Description
                                     

                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="instructor-tab" data-bs-toggle="tab" data-bs-target="#instructor" type="button" role="tab" aria-controls="instructor" aria-selected="false">Speaker</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="carriculam-tab" data-bs-toggle="tab" data-bs-target="#carriculam" type="button" role="tab" aria-controls="carriculam" aria-selected="false">Credits</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="false">FAQs</button>
                                </li>


                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                    <div class="course-tab-content" style="text-align: justify;text-justify: inter-word; color: black;">
                                        <?php echo  $c_row['description']; ?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="carriculam" role="tabpanel" aria-labelledby="carriculam-tab">
                                    <div class="course-tab-content">
                                        <div class="course-curriculam">
                                            <?php echo $c_row['certificate'] ?>
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
                                                    $images .= "ceuadmin/assets/images/speaker/" . $c_row['images'];
                                                } else {
                                                    $images .= "ceuadmin/assets/images/xs/avatar6.svg";
                                                }
                                                ?>
                                                <img src="<?php echo $images ?>" alt="Author Images">
                                            </div>
                                            <div class="author-content">
                                                <h6 class="title"><?php echo $c_row['name'] ?></h6>
                                                <span class="subtitle"><?php echo $c_row['designation'] ?></span>
                                                <div style="text-align: justify;text-justify: inter-word;"><?php echo $c_row['bio'] ?></div>
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
                                <!--faq section fot the -->
                                <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="course-tab-content">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">

                        <div class="container legend">
                            <div class="course-sidebar-3 sidebar-top-position">
                                <div class="edu-course-widget widget-course-summery">
                                    <div class="inner">

                                        <h3 style="text-align:center;padding-top:15px;color:#1AB69D"><u style="padding-bottom:6px;text-decoration:none;
                                        border-bottom:2px solid #1AB69D;">Registration Options</u></h3>
                                        <hr style="margin-top:-18px">

                                        <div class="content">
                                            <?php
                                            if (!empty($_SESSION['ip_address'])) {
                                                $cart_sql = mysqli_query($con, "SELECT array FROM cart WHERE user_id='$temp_hash_id' AND course_id='" . $c_row['course_id'] . "' and cart_status='1' ");
                                                if (mysqli_num_rows($cart_sql) >= 1) {
                                                    $cart_row = mysqli_fetch_assoc($cart_sql);
                                                    $cart_array = stringToArray($cart_row['array']);
                                                }
                                            }
                                            $sell_array = $c_row['selling_option'];
                                            $data = stringToArray($sell_array);
                                            $timestamp = strtotime($c_row['date']);
                                            // $current_timestamp = time();
                                            $current_timestamp = date("F j, Y");

                                            $current_timestamp_timestamp = strtotime($current_timestamp);

                                            // if ($timestamp >= $current_timestamp_timestamp) {
                                            //     unset($data['Live Options']);
                                            // }

                                            $a = 0;
                                            foreach ($data as $key => $innerArray) {
                                                if ($a != 0) {
                                                    echo "<hr>";
                                                }
                                            ?>
                                                <h3 class="text" style="text-align:center;color:Black"><?php echo $key ?></h3>
                                                <hr>
                                                <?php foreach ($innerArray as $name => $amount) {
                                                    static $count = 0;
                                                    $count++;
                                                    $a++; ?>

                                                    <div class=" row edu-form-check" style="margin: 10px 0">
                                                        <div class="edu-form-check">
                                                            <input type="checkbox" id="cat-check<?php echo $a; ?>" class="parentSpace" data-cname="<?php echo $name; ?>" data-amount="<?php echo $amount; ?>" <?php
                                                                                                                                                                                                                if (!empty($_SESSION['ip_address']) && mysqli_num_rows($cart_sql) >= 1) {
                                                                                                                                                                                                                    if (array_key_exists($name, $cart_array) && $cart_array[$name] == $amount) {
                                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                } ?>>

                                                            <label for="cat-check<?php echo $a; ?>" class="text left" style="font-size:large;">
                                                                <?php echo $name ?><strong><span style=" text-align: right;" class="text center">$<?php echo $amount ?></span></strong>
                                                            </label>
                                                            <!-- <div id="input-fields-<?php echo $count; ?>"></div> -->

                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>

                                            <div id="all-inputs-container"></div>

                                            <div>
                                                <hr>
                                                <p style="color:Black;font-size:16px"><i class="fa fa-asterisk" style="font-size:18px"></i> Couldn't find the option you're looking for? Don't worry, let us know your requirements and we will get back to you SOON! <a style="color:#1AB39A;" href="contact.php"><u><b> Contact Us Now</b></u></a></p>
                                            </div>
                                            <hr>
                                            <div>
                                                <h4 style="color:#1AB39A; text-align:center" id="output"><span>Total Fee:</span> $0.00</h4>
                                            </div>
                                            <form method="post">
                                                <input type="hidden" name="array" id="array" required>
                                                <input type="hidden" name="course_hash_id" value="<?php echo $c_row['hash_id'] ?>">
                                                <input type="hidden" name="course_id" value="<?php echo $c_row['course_id'] ?>">
                                                <input type="hidden" name="course_title" value="<?php echo $c_row['title'] ?>">
                                                <input type="hidden" name="hash_id" value="<?php echo random(date('Y-m-d H:i:s')) ?>">
                                                <div class="read-more-btn">
                                                    <input type="hidden" name="user_id" value="<?php echo $temp_hash_id ?>">
                                                    <button type="button" class="edu-btn" style="font-size:x-large;font-weight:bold" id="basicToastBtn" data-course-id="<?php echo $c_row['course_id'] ?>">Add To Cart <i class="icon-4"></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="toast-container">
                                    <div id="basicToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-header" style="background:#1ab69d;">
                                            <h5 class="my-0" id="cart_h2" style="color:white;">Successfully Added To Cart</h5>
                                        </div>
                                        <div class="toast-body p-3">
                                            <strong id="courseName"></strong><span id="cart_add"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
    <script src="assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function createInputFields(id) {
            var checkbox = document.getElementById('cat-check' + id);
            var container = document.getElementById('input-fields-' + id);
            var allInputsContainer = document.getElementById('all-inputs-container');
            container.innerHTML = ''; // Clear previous inputs
            allInputsContainer.innerHTML = ''; // Clear all previous inputs
            if (checkbox.checked) {
                var labelName = checkbox.getAttribute('data-cname');
                var numAttendees = labelName.match(/\d+/); // Extract number from the data-cname
                if (numAttendees) {
                    for (var i = 0; i < numAttendees; i++) {
                        var input = document.createElement('input');
                        input.type = 'text';
                        input.name = 'attendee-' + id + '-' + (i + 1);
                        input.placeholder = labelName + ' - Attendee ' + (i + 1) + ' Name';

                        var clonedInput = input.cloneNode(true);
                        allInputsContainer.appendChild(clonedInput);
                        allInputsContainer.appendChild(document.createElement('br'));
                    }
                }
            }
        }
        document.querySelector("#basicToastBtn").onclick = function() {
            var user_id = document.querySelector("[name='user_id']").value;
            var course_id = document.querySelector("#basicToastBtn").getAttribute("data-course-id");
            var hash_id = document.querySelector("[name='hash_id']").value;
            var course_title = document.querySelector("[name='course_title']").value;
            var course_hash_id = document.querySelector("[name='course_hash_id']").value;
            var array = document.querySelector("#array").value;
            if (array.trim() === "") {
                alert("Please select the selling option.");
                return;
            } else if (array === "array()") {
                alert("Please select the selling option.");
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "add_to_cart.php",
                    data: {
                        user_id: user_id,
                        course_id: course_id,
                        hash_id: hash_id,
                        course_hash_id: course_hash_id,
                        course_title: course_title,
                        array: array
                    },
                    success: function(response) {
                        document.getElementById("courseName").textContent = response.courseName;
                        // document.getElementById("cart_count").textContent = response.cart_counter;
                        document.getElementById("cart_h2").textContent = "Successfully " + response.status;

                        new bootstrap.Toast(document.querySelector("#basicToast")).show();
                        // console.log(response);
                        setTimeout(function() {
                            window.location.href = "cart.php";
                        }, 1000);
                    },
                    error: function(error) {
                        console.error("Error adding course to cart", error);
                        // Handle error if needed
                    }
                });
            }
        };
        var x = setInterval(function() {
            <?php
            $total = $c_row['date'] . " " . $c_row['time'];
            ?>
            var countDownDate = new Date("<?php echo $total; ?>").getTime();
            var now = new Date().getTime();
            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
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

                    dataArray.push("'" + cname + "'=>'" + amount + "'");
                });

                var arrayString = 'array(' + dataArray.join(',') + ')';

                // console.log('array(' + dataArray.join(',') + ')');

                // Update the div#output with the total amount
                $('#output').text('Total Fee: $' + totalAmount.toFixed(2));
                $('#array').val(arrayString);
            }
        })

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