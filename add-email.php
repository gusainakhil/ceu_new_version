<!DOCTYPE html>

<?php
include "connect.php";
include "functions.php";
$hash_id = $_GET['id'];

if(empty($hash_id)){
    header("Location: index");
}

$order_sql = mysqli_query($con, "SELECT users_arr, course_id,selling_options,amount, hash_id FROM order_details WHERE hash_id='$hash_id' ");

if(mysqli_num_rows($order_sql)==0){
    header("Location: index");
}

$order_row = mysqli_fetch_assoc($order_sql);

if($order_row['users_arr']!=""){
    header("Location: index");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $names = $_POST['name'];
    $emails = $_POST['email'];
    $contacts = $_POST['contact'];
    $job_profiles = $_POST['job_profile'];

    $attendees = [];

    for ($i = 0; $i < count($names); $i++) {
        $attendees[] = array($names[$i], $emails[$i], $contacts[$i], $job_profiles[$i]);
    }

    $array= str_replace("'",'"',arrayToString($attendees));
    mysqli_query($con,"UPDATE order_details SET users_arr='$array' WHERE hash_id='$hash_id' ");
    header("Location: index");
    
}
?>
<html>


<head>
    <!-- Meta Data -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>
        Add Attendees Information
    </title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />

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
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
    <style type="text/css">
        #double li {
            width: 50%;
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
                        <h1 class="title">Attendees Information</h1>
                        <h3 class="heading-title">We're Always <span class="color-secondary">Eager to Hear</span> From You!</h3>
                        <span class="shape-line" style="color:#1ab69d"><i class="icon-19"></i></span>
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


        <div style="padding:50px 0px 0px 0px"></div>
        <form class="offset-lg-1 col-lg-10 mt-5 mb-5"  method="POST" >
        <?php $course_id = $order_row['course_id'];
        $selling_options = stringToArray($order_row['selling_options']);
        $course_ids = explode(',', $course_id);
        $total_price = 0;

        foreach ($selling_options as $key1 => $innerArray) {
            // $price_info = eval("return $course_price_str;");
            ?>
            <div class="contact-form">
                <div class="section-title" style="text-align:center">
                    <p style="font-size:x-large;color:black"><?php echo $key1; ?></p>
                </div>
                <div class="rnt-contact-form rwt-dynamic-form">
                    <div class="row row--10">
                    <?php
                        foreach ($innerArray as $key => $value) {
                            echo "<p style='color:black'>".$key."</p>";
                            
                            $firstWord = strtok($key, ' ');
                            if(is_numeric($firstWord)){
                                $firstWord = strtok($key, ' ');
                            }else{
                                $firstWord = '1';
                            }
                            $a=0;
                            for ($i=0; $i < $firstWord; $i++) { 
                            $a++;
                        ?>
                        <div class="col-12">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <input type="text" name="name[]" id="name" placeholder="Attendee Name <?php echo $a ?>" required />
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="text" name="job_profile[]" id="job_profile" placeholder="Enter Job Profile" required />
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="email" name="email[]" id="email" placeholder="Email Address" required />
                                </div>
                                <div class="form-group col-md-3">
                                    <input type="number" name="contact[]" id="contact" placeholder="Contact No." required />
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                        
                    </div>
                </div>
            </div>
        <?php } ?>
        <center>
                            <div class="form-group" style="max-width: 400px;">
                                <button type="submit" class="rn-btn edu-btn btn-medium submit-btn" style="font-size:large" name="submit" value="submit">Submit <i class="icon-4"></i></button>
                            </div>
                        </center>
            
        </form>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/js/app.js"></script>

</body>


</html>