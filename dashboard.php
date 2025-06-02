<!DOCTYPE html>

<?php
include "connect.php";
include "functions.php";

if (empty($_SESSION['email'])) {
    header("Location: login");
}

$u_sql = mysqli_query($con, "SELECT name,
       email,
       number,
       job_profile,
       address,
       address2,
       city,
       state,
       country,
       pin_code,
       password
FROM   user_info
WHERE  id='" . $_SESSION['user_id'] . "' ");
$u_row = mysqli_fetch_assoc($u_sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $number = $_POST['number'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $pin_code = $_POST['pin_code'];
    $address2 = $_POST['address2'];
    $job_profile = $_POST['job_profile'];
    $state = $_POST['state'];
    

    mysqli_query($con, "UPDATE user_info SET name='$name',country='$country',number='$number',city='$city', address='$address', pin_code='$pin_code', address2='$address2', job_profile='$job_profile', state='$state' WHERE id='".$_SESSION['user_id']."' ");
    // echo "UPDATE user_info SET name='$name', country='$country',number='$number',city='$city', address='$address', pin_code='$pin_code', address2='$address2', job_profile='$job_profile', state='$state' WHERE id='".$_SESSION['user_id']."' ";
    header("Location: dashboard.php");

}
?>
<html>

<head>
    <!-- Meta Data -->
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>User-<?php echo $u_row['name']; ?></title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="robots" content="noindex, nofollow">
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
    <link rel="canonical" href="login.php"/>
    <link rel="stylesheet" href="assets/css/vendor/tipped.min.css" />
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>
    <link rel="canonical" href="https://ceuservices.com/dashboard" />

   


   
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
</head>

<body>
    <div id="main-wrapper" class="main-wrapper">


        <?php include "header.php" ?>


        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">My Dashboard</h1>
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


        <section class="edu-section-gap faq-page-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="faq-page-nav">

                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#gn-ques" type="button" role="tab" aria-selected="true">My Dashboard</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rg-ques" type="button" role="tab" aria-selected="false">My Orders</button>
                                </li>
                              
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#com-policy" type="button" role="tab" aria-selected="false">Address</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pay-option" type="button" role="tab" aria-selected="false">Account Details</button>
                                </li>
                                     <li class="nav-item" role="presentation">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password" type="button" role="tab" aria-selected="false">Chnage password</button>
                                </li>
                                <a class="rn-btn edu-btn btn-medium submit-btn" style="font-size:large" href="logout.php" >Logout</a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="tab-content faq-page-tab-content" id="faq-accordion">
                            <div class="tab-pane fade show active" id="gn-ques" role="tabpanel">
                                <div class="faq-accordion">
                                    <div class="accordion">
                                        <div class="accordion-item">
                                            <div id="question-1">
                                                <div class="accordion-body">
                                                    <p style="font-size:16px">Hello <?php echo $u_row['name']; ?>, (Not UserName? <a href="logout.php"><u>Logout</u></a>)</p>
                                                    <p style="font-size:16px">From your dashboard, you can view your courses, manage your billing address, and edit your password and account details.</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                             <div class="tab-pane fade" id="password" role="tabpanel">
                                <div class="faq-accordion">
                                    <div class="accordion">
                                        <div class="accordion-item">

<div id="question-18">
    <div class="accordion-body">
        <h4>Update Your Password</h4>
        <form class="p-3 py-5" id="updatePasswordForm">
            <div class="row mt-2">
                <div class="col-md-12">
                    <label class="labels">Enter New Password</label>
                    <input type="password" class="form-control" placeholder="password" id="password" name="password" required>
                    <input type="hidden"  name="type" value="3" >
                </div>
            </div>
            <button class="rn-btn edu-btn btn-medium submit-btn mt-5" style="width:50%;font-size:large" type="submit">Save <i class="icon-4"></i></button>
        </form>
    </div>
</div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="rg-ques" role="tabpanel">
                                <div class="faq-accordion">
                                    <div class="accordion">
                                        <div class="accordion-item">
                                            <div id="question-8">
                                                <div class="accordion-body">
                                                    <table style="border:1px solid grey; text-align:center">
                                                        <tr style="font-size:large">
                                                            <td>Sr.No.</td>
                                                            <td>Order No</td>
                                                            <td>Purchased Date</td>
                                                            <td>Course Title</td>
                                                        </tr>
                                                        <?php
                                                        $a = 0;
                                                        $order_sql = mysqli_query($con, "SELECT order_details.order_id,
                                                               order_details.trans_date,
                                                               order_details.course_id,
                                                               course_detail.title
                                                        FROM   order_details
                                                               JOIN course_detail
                                                                 ON order_details.course_id = course_detail.id
                                                        WHERE  order_details.user_id = '" . $_SESSION['user_id'] . "' AND payment_status='Completed'
                                                        ORDER  BY course_id DESC  ");
                                                        while ($order_row = mysqli_fetch_assoc($order_sql)) {
                                                            $a++;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $a ?></td>
                                                         
                                                                <td><a href="invoice/invoice.php?order_detail=<?php echo $order_row['order_id']; ?>" target="blank"><?php echo $order_row['order_id']; ?></a></td>
                                                                <td><?php echo $order_row['trans_date'] ?></td>
                                                                <td><?php echo $order_row['title'] ?></td>
                                                            </tr>
                                                      
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                 
                            <div class="tab-pane fade" id="com-policy" role="tabpanel">
                                <div class="faq-accordion">
                                    <div class="accordion">
                                        <div class="accordion-item">

                                            <div id="question-18">
                                                <div class="accordion-body">
                                                    <h4>The following address will be used on the checkout by default.</h4>
                                                    <table style="border:1px solid grey; text-align:center">
                                                        <tr style="font-size:large">
                                                            <td>Address 1</td>
                                                            <td>Address 2</td>
                                                        </tr>
                                                        <tr>
                                                            <td><?php echo $u_row['address'] ?></td>
                                                            <td><?php echo $u_row['address2'] ?></td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pay-option" role="tabpanel">
                                <div class="faq-accordion">
                                    <div class="accordion">
                                        <div class="accordion-item">

                                            <div id="question-22">
                                                <div class="accordion-body">
                                                    <div class="container rounded bg-white mt-5 mb-5">
                                                        <div class="row">
                                                            <div class="col-md-3 border-right">
                                                                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="../ceuadmin/assets/images/avatar/<?php echo avatar($u_row['name']) ?>"><span class="font-weight-bold"><?php echo $u_row['name'] ?></span><span class="text-black-50"><?php echo $u_row['email'] ?></span><span> </span></div>
                                                            </div>
                                                            <div class="col-md-9 border-right">
                                                                <form class="p-3 py-5" method="POST">
                                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                                        <h4 class="text-right">Profile Settings</h4>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-6"><label class="labels">Name*</label><input type="text" class="form-control" name="name" placeholder="Full Name" value="<?php echo $u_row['name'] ?>" required></div>
                                                                        <div class="col-md-6"><label class="labels">Mobile Number*</label><input type="text" class="form-control" placeholder="Enter Mobile Number" name='number' value="<?php echo $u_row['number'] ?>" required></div>
                                                                    </div>
                                                                    <div class="row mt-2">
                                                                        <div class="col-md-6">
                                                                            <label class="labels">Email ID*</label>
                                                                            <input type="text" class="form-control" placeholder="Enter Email id" value="<?php echo $u_row['email'] ?>" readonly>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="labels">Job Profile</label>
                                                                            <input type="text" class="form-control" placeholder="Job Profile" name="job_profile" value="<?php echo $u_row['job_profile'] ?>">
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    <div class="row mt-3">

                                                                        
                                                                        <div class="col-md-12"><label class="labels">Address *</label><input type="text" class="form-control" name="address" placeholder="Enter Address Line 1" value="<?php echo $u_row['address'] ?>" required></div>
                                                       


                                                                    </div>
                                                                    <div class="row mt-2">

                                                                        <div class="col-md-6"><label class="labels">Town/City*</label><input type="text" class="form-control" placeholder="Enter Town/City" value="<?php echo $u_row['city'] ?>" name="city" required></div>
                                                                        <div class="col-md-6"><label class="labels">State*</label><input type="text" class="form-control" value="<?php echo $u_row['state'] ?>" name="state" placeholder="State" required></div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label>Country*</label>
                                                                                <select id="country" name="country" required>
                                                                                    <option>Select Option</option>
                                                                                    <option <?php if ($u_row['country'] == "Australia") {
                                                                                                echo "selected";
                                                                                            } ?> value="Australia">Australia</option>
                                                                                    <option <?php if ($u_row['country'] == "England") {
                                                                                                echo "selected";
                                                                                            } ?> value="England">England</option>
                                                                                    <option <?php if ($u_row['country'] == "New Zealand") {
                                                                                                echo "selected";
                                                                                            } ?> value="New Zealand">New Zealand</option>
                                                                                    <option <?php if ($u_row['country'] == "Switzerland") {
                                                                                                echo "selected";
                                                                                            } ?> value="Switzerland">Switzerland</option>
                                                                                    <option <?php if ($u_row['country'] == "United Kindom (UK)") {
                                                                                                echo "selected";
                                                                                            } ?> value="United Kindom (UK)">United Kindom (UK)</option>
                                                                                    <option <?php if ($u_row['country'] == "United States (USA)") {
                                                                                                echo "selected";
                                                                                            } ?> value="United States (USA)">United States (USA)</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-6"><label class="labels">Zipcode*</label><input type="text" class="form-control" placeholder="Enter Zip Code" name="pin_code" value="<?php echo $u_row['pin_code'] ?>"></div>
                                                                    </div>

                                                                    <button class="rn-btn edu-btn btn-medium submit-btn mt-5" style="width:50%;font-size:large" name="submit" type="submit">Save <i class="icon-4"></i></button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
  <?php } ?>

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
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Site Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    

     
      <script>
        $(document).ready(function() {
            $("#updatePasswordForm").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission
                $.ajax({
                    url: "signin_ajax.php",
                    method: "POST", 
                    data: $(this).serialize(),  
                    success: function(data) {
                         //alert(data);
                        if (data == "0") {
                            Swal.fire('Success!', 'password changed', 'success');
                            setTimeout(function() {
                            location.reload(true); 
                           }, 1500); 
    
                        } else {
                            Swal.fire('Error!', 'Please try again.', 'error');
                        }
                      
                    },
                    error: function() {
                        Swal.fire('Error!', 'Something went wrong. Please try again later.', 'error');
                    }

                });
            });
        });   
    </script>
     
<script>

// $(document).ready(function() {
//     $('#updatePasswordForm').on('submit', function(e) {
//         e.preventDefault();

//         var password = $('#password').val();

//         $.ajax({
//             url: 'update_password.php',
//             type: 'POST',
//             data: {
//                 password: password
//             },
//             success: function(response) {
//                 alert(response);
//             },
//             error: function(jqXHR, textStatus, errorThrown) {
//                 console.error('Error updating password:', textStatus, errorThrown);
//                 alert('There was an error updating your password. Please try again.');
//             }
//         });
//     });
// });
 </script>

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