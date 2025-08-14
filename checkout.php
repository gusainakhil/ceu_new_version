<!DOCTYPE html>

<html>
<?php
include "connect.php";
include_once "config.php";
include "functions.php";
$coupon = 0;
if (!empty($_SESSION['couponPrice'])) {
    $coupon = $_SESSION['couponPrice'];
}
// echo $_GET;
if (empty($_GET['id'])) {
    header("Location: login");
}
$components = explode(",", $_GET['id']);

if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
    $update_sql = mysqli_query($con, "SELECT * FROM user_info WHERE email='" . $_SESSION['email'] . "' ");
    $update_row = mysqli_fetch_assoc($update_sql);
    $full_name = explode(" ", $update_row['name']);
}

?>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Checkout</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="author" content="CEUTrainers" />
    <meta name="keywords" content="CEUTrainers, CEU, Trainers, Continuing Education, Online Courses" />
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css" />
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css" />
    <link rel="stylesheet" href="assets/css/vendor/magnifypopup.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/odometer.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/animation.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui-min.css" />
    <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/tipped.min.css" />
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>
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

        .section-gap-equal {
            padding: 80px 0;
        }
    </style>
    <style>
        .ceu-dynamic-form-wrapper {
            background-color: #f9f9f9;
            padding: 10px 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: Arial, sans-serif;
        }

        .ceu-dynamic-form-wrapper h5 {
            margin: 0 0 8px 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1ab69d;
        }

        /* Flex container for inputs */
        .ceu-form-row {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
        }

        /* Each input group in flex container */
        .ceu-form-group {
            display: flex;
            flex-direction: column;
            flex: 1 1 0;
            min-width: 100px;
            /* minimum width for each input box */
        }

        /* Smaller labels */
        .ceu-form-group label {

            margin-bottom: 2px;
            color: #333;
        }

        /* Smaller inputs and textarea */
        .ceu-form-group input[type="text"],
        .ceu-form-group input[type="email"],
        .ceu-form-group textarea {
            padding: 4px 6px;
            font-size: 1.2rem;
            font-weight: bold;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            height: 30px;
            /* Set a fixed height for inputs */
            width: 100%;
            /* Make inputs full width */
            transition: border-color 0.3s ease;
        }

        /* Shrink textarea height */
    </style>
</head>

<body>
    <div id="main-wrapper" class="main-wrapper">
        <?php include "header.php" ?>
        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">Checkout</h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ul>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape" style="transform: translate3d(-36.7px, 22.2px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
                <!-- <li class="shape-3 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape" style="transform: translate3d(9.9px, -4.7px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li> -->
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape" style="transform: translate3d(-24.3px, 22.8px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
            </ul>
        </div>
        <section class="checkout-page-area section-gap-equal">
            <div class="container">
                <form id="checkout_form" method="POST" action="checkout_process.php" onsubmit="disableBtn()">
                    <div class="checkout-notice">
                        <div class="coupn-box">
                            <h6 class="toggle-bar"> Have a coupon?
                                <a href="javascript:void(0)" class="toggle-btn">Click here to enter your code</a>
                            </h6>
                            <div class="toggle-open">
                                <p>If you have a coupon code, please apply it below.</p>
                                <div class="input-group">
                                    <input placeholder="Enter coupon code" type="text" id="couponCode" name="coupon_code">
                                    <div class="apply-btn">
                                        <button type="button" onclick="applyCoupon()" class="edu-btn btn-medium">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div id="result"></div>
                        </div>
                    </div>
                    <div class="row row--25">
                        <div class="col-lg-6">
                            <div class="checkout-billing">
                                <h3 class="title">Billing Details</h3>

                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>First Name*</label>
                                            <input type="text" id="fname" name="fname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Last Name*</label>
                                            <input type="text" id="lname" name="lname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Company Name*</label>
                                            <input type="text" id="company_name" name="company_name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Job Title*</label>
                                            <input type="text" id="job_profile" name="job_profile" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="tel" id="number" name="number" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email Address*</label>
                                            <input type="email" id="email" name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Country*</label>
                                            <select id="country" name="country" required>
                                                <option>Select Option</option>
                                                <option value="Australia">Australia</option>
                                                <option value="England">England</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="United Kindom (UK)">United Kindom (UK)</option>
                                                <option value="United States (USA)">United States (USA)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>City*</label>
                                            <input type="text" id="city" name="city" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address 1*</label>
                                    <input type="text" id="address1" name="address1" required>
                                </div>
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <input type="text" id="address2" name="address2">
                                </div>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>State*</label>
                                            <input type="text" id="state" name="state" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Zip Code*</label>
                                            <input type="number" id="pin_code" name='pin_code' required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="order-summery checkout-summery">
                                <div class="summery-table-wrap">
                                    <h4 class="title">Your Orders</h4>
                                    <?php
                                    $price = 0;
                                    $course_id = "";
                                    $selling_options = array();
                                    $course_name = "";

                                    foreach ($components as $component) {
                                        $checkout_sql = mysqli_query($con, "SELECT cart.*, course_detail.title, course_detail.id as checkout_course_id FROM cart JOIN course_detail ON cart.course_hash_id=course_detail.hash_id WHERE cart.hash_id='$component' ");
                                        while ($check_row = mysqli_fetch_assoc($checkout_sql)) {
                                            $course_id .= $check_row['course_id'] . ",";
                                            $selling_options[$check_row['title']] = stringToArray($check_row['array']);

                                            $cart_hash_id = $check_row['hash_id'] . ",";
                                            $course_name .= $check_row['title'] . ", "; ?>
                                            <p style="color: #1ab69d;margin-bottom:0;font-weight:bolder;" class="my-5"><?php echo course($con, $check_row['checkout_course_id']); ?></p>
                                            <table class="table summery-table">
                                                <tbody>
                                                    <?php
                                                    $array = stringToArray($check_row['array']);
                                                    $discount = extractKeys($array, '/\(Save \$(\d+)\)/');
                                                    foreach ($array as $key => $value) {
                                                        $price += $value; ?>
                                                        <tr id="tr_price">
                                                            <td style="font-weight: 100;"><?php echo $key; ?></td>
                                                            <td>$<?php echo $value; ?></td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                    <?php }
                                    }
                                    $course_id = rtrim($course_id, ',');
                                    $cart_hash_id = rtrim($cart_hash_id, ',');
                                    $course_name = rtrim($course_name, ',');

                                    ?>

                                    <?php
                                    $sanitized_selling_options = "";
                                    foreach ($selling_options as $key => $innerArray) {
                                        foreach ($innerArray as $innerKey => $innerValue) {
                                            $sanitized_key = htmlspecialchars($innerKey, ENT_QUOTES, 'UTF-8');
                                            $sanitized_value = htmlspecialchars($innerValue, ENT_QUOTES, 'UTF-8');
                                            $sanitized_selling_options .= "$sanitized_key = $$sanitized_value, ";
                                        }
                                    }
                                    $sanitized_selling_options = rtrim($sanitized_selling_options, ", ");
                                    ?>

                                    <input type="hidden" name="selling_options" id="selling_options" value="<?php echo $sanitized_selling_options; ?>">
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>">
                                    <table class="table summery-table">
                                        <tbody>
                                            <tr class="order-subtotal">
                                                <td>Sub Total</td>
                                                <td class="text-danger" style="font-weight:bold;">$<?php echo $price;
                                                                                                    $price -= $coupon; ?></td>
                                            </tr>
                                            <tr class="order-subtotal">
                                                <td>Coupon Applied</td>
                                                <td id="sub_total">$0</td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>Order Total</td>
                                                <td id="order_total" class="text-success">$<?php echo $price; ?></td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                            <input type="hidden" name="cart_hash_id" id="cart_hash_id" value="<?php echo $cart_hash_id; ?>">
                            <input type="hidden" name="coupon_price" id="coupon_price">
                            <input type="hidden" name="type" value="checkout">
                            <input type="hidden" name="item_name" value="<?php echo $course_name ?>" />
                            <input type="hidden" id="item_name" />
                            <input type="hidden" name="payer_email" id="payer_email" value="<?php echo !empty($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                            <!-- please build a $ord in unique way like today date + time  -->
                             <?php
                             $ord_id = date('YmdHis');
                             ?>
                            <input type="hidden" name="item_number" id="order_id" value='<?php echo $ord_id; ?>'>
                            <input type="hidden" name="amount" id="course_price" value="<?php echo $price ?>">
                            <input type="hidden" name="currency_code" id="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">



                            <!-- <div class="checkout-btn">
                                <a href="javascript:void(0)" class="edu-btn btn-medium" onclick="window.history.back()">Back</a>
                            </div> -->
                        </div>
                    </div>

                    <?php
                    // Loop through array key-value pair
                    foreach ($array as $key => $value) {
                        // Extract number from key (like "3 Attendees..." → 3)
                        preg_match('/\d+/', $key, $matches);
                        $form_count = isset($matches[0]) ? (int)$matches[0] : 1;

                        // Skip form generation if only 1 attendee
                        if ($form_count < 2) {
                            continue;
                        }

                        // Repeat form creation $form_count times
                        for ($i = 1; $i <= $form_count; $i++) {
                    ?>
                            <div class="ceu-dynamic-form-wrapper">
                                <h5><?php echo htmlspecialchars($key); ?> - Attendee <?php echo $i; ?> Details</h5>
                                <div class="ceu-form-row">
                                    <div class="ceu-form-group">
                                        <label for="name_<?php echo $i; ?>">Name</label>
                                        <input type="text" name="user_name[]" id="name_<?php echo $i; ?>" class="ceu-form-control" required>
                                    </div>
                                    <div class="ceu-form-group">
                                        <label for="email_<?php echo $i; ?>">Email</label>
                                        <input type="email" name="user_email[]" id="email_<?php echo $i; ?>" class="ceu-form-control" required>
                                    </div>
                                    <div class="ceu-form-group">
                                        <label for="phone_<?php echo $i; ?>">Phone</label>
                                        <input type="text" name="user_phone[]" id="phone_<?php echo $i; ?>" class="ceu-form-control" required>
                                    </div>
                                    <div class="ceu-form-group">
                                        <label for="jobtitle_<?php echo $i; ?>">Job Title</label>
                                        <input type="text" name="jobtitle[]" id="jobtitle_<?php echo $i; ?>" class="ceu-form-control">
                                    </div>
                                </div>


                            </div>
                    <?php
                        } // end for
                    } // end foreach
                    ?>
                    <div class="checkout-btn">
                        <button type="submit" form="checkout_form" class="edu-btn btn-medium">Proceed to Payment</button>
                    </div>
                </form>
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
        <?php if (empty($_SESSION['email']) && empty($_SESSION['password'])) { ?>
            $(document).ready(function() {
                $("#email").keyup(function() {
                    checkEmail();
                });
            });

        <?php } ?>



        function applyCoupon() {
            var couponCode = $('#couponCode').val();

            $.ajax({
                type: 'POST',
                url: 'coupon_ajax.php',
                data: {
                    coupon_code: couponCode
                },
                dataType: 'json', // Expecting JSON response
                success: function(response) {
                    if (response.couponPrice !== "0") {
                        // Update the coupon statement
                        if (response.statement == "Coupon applied successfully!") {
                            var text = "success";
                        } else {
                            var text = "danger";
                        }
                        $('#result').html("<label class='text-" + text + "'>" + response.statement + "</label>");

                        // Update the coupon subtotal
                        $('#sub_total').text('$' + response.couponPrice);

                        // Update the order total
                        var originalTotal = parseFloat('<?php echo $price; ?>');
                        var newTotal = originalTotal - parseFloat(response.couponPrice);
                        $('#order_total').text('$' + newTotal.toFixed(2));
                        var newTotal = parseFloat($('#order_total').text().replace('$', ''));
                        $('#course_price').val(newTotal.toFixed(2));
                        $('#coupon_price').val(response.couponPrice);

                    } else {
                        console.log(response);
                    }
                },
                error: function(error) {
                    console.log(error);
                    $('#result').html("<label class='text-danger'><strong>Invalid</strong> coupon code. Please try again.</label>");
                }
            });
        }


        function updateTotalPrice(couponPrice) {
            // Update the total price dynamically based on the received coupon price
            var totalPrice = <?php echo $price; ?>; // Fetch the initial total price from PHP
            totalPrice -= couponPrice; // Apply the coupon discount

            // Update the displayed total price on the webpage
            $('#orderTotal').text('$' + totalPrice);
        }


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

        // $(document).ready(function() {
        //     $("#checkout_form").submit(function(e) {
        //         e.preventDefault(); // Prevent the default form submission

        //         $.ajax({
        //             url: "signin_ajax.php",
        //             method: "POST",
        //             data: $(this).serialize(),
        //             success: function(data) {
        //                 console.log(data);
        //                 // if (data == "0") {
        //                 //     Swal.fire('Success!', 'Your message has been submitted.', 'success');
        //                 // } else {
        //                 //     Swal.fire('Error!', 'Please try again. Your form was not submitted.', 'error');
        //                 // }
        //             },
        //             error: function(error) {
        //                 console.log(error);
        //                 // Swal.fire('Error!', 'Something went wrong. Please try again later.', 'error');
        //             }
        //         });
        //     });
        // });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
function disableBtn() {
  document.getElementById('submitBtn').disabled = true;
}
</script>
    <!-- <script>
        $(document).ready(function() {
            $(".auto-save").on("input", function() {
                var field_name = $(this).attr("name"); // Input field ka name
                var field_value = $(this).val(); // Input field ka value

                $.ajax({
                    url: "auto_save.php", // Backend PHP file
                    type: "POST",
                    data: {
                        field: field_name,
                        value: field_value
                    },
                    success: function(response) {
                        console.log(response); // Debugging ke liye
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script> -->


</body>

</html>