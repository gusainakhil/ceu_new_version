<!DOCTYPE html>

<html>
<?php
include "connect.php";
include_once "config.php";
include "functions.php";
if(empty($_GET['order_id'])){
    header("Location: dashboard");
}
$id = $_GET['order_id'];
$sql=mysqli_query($con,"SELECT order_id FROM order_details WHERE cart_hash_id='$id' ");
$row=mysqli_fetch_assoc($sql);
?>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>CEUTrainers | Online Education Platform</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
    
</head>

<body>
    <div id="main-wrapper" class="main-wrapper">

        <section class="checkout-page-area section-gap-equal">
            <div class="container">
                <div class="row">
                    <div class="jumbotron" style="box-shadow: 2px 2px 4px #000000;">
                        <h2 class="text-center">YOUR ORDER HAS BEEN RECEIVED</h2>
                        <h3 class="text-center">Thank you for your payment, it’s processing</h3>

                        <p class="text-center">Your order # is: <?php echo $row['order_id']; ?></p>
                        <p class="text-center">Just wait for a while. You will receive an order confirmation email with details of your order and a link to track your process.</p>
                        <p class="text-center">Link will be sent on your mail for adding attendees information.</p>
                        <center>
                            <div class="btn-group" style="margin-top:50px;">
                                <a href="index.php" class="btn btn-lg btn-warning">CONTINUE</a>
                            </div>
                        </center>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
</body>

</html>