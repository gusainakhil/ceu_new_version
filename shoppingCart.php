<!DOCTYPE html>

<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SHOPPING CART</title>
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
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/app.css" />
</head>

<body>
        <div id="main-wrapper" class="main-wrapper">


        <?php include "header.php" ?>


            <div class="edu-breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-inner">
                        <div class="page-title">
                            <h1 class="title">Shopping Cart</h1>
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

            <!--=====================================-->
            <!--=           Cart Area Start         =-->
            <!--=====================================-->
            <section class="cart-page-area edu-section-gap">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-thumbnail"></th>
                                    <th scope="col" class="product-title">Product Name</th>
                                    <th scope="col" class="product-price">Price</th>
                                    <th scope="col" class="product-quantity">Quantity</th>
                                    <th scope="col" class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-remove">
                                        <a href="#" class="remove-wishlist"><i class="icon-73"></i></a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="course-details.php"><img src="assets/images/shop/product-02.jpg" alt="Books"></a>
                                    </td>
                                    <td class="product-title">
                                        <a href="course-details.php">Natural Science Project</a>
                                    </td>
                                    <td class="product-price" data-title="Price"><span class="currency-symbol">$</span>70.30</td>
                                    <td class="product-quantity" data-title="Qty">
                                        <div class="pro-qty">
                                            <input type="number" class="quantity-input" value="1">
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal"><span class="currency-symbol">$</span>70.30</td>
                                </tr>
                                <tr>
                                    <td class="product-remove"><a href="#" class="remove-wishlist"><i class="icon-73"></i></a></td>
                                    <td class="product-thumbnail"><a href="course-details.php"><img src="assets/images/shop/product-03.jpg" alt="Digital Product"></a></td>
                                    <td class="product-title"><a href="course-details.php">The King of Drugs</a></td>
                                    <td class="product-price" data-title="Price"><span class="currency-symbol">$</span>70.00</td>
                                    <td class="product-quantity" data-title="Qty">
                                        <div class="pro-qty">
                                            <input type="number" class="quantity-input" value="1">
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal"><span class="currency-symbol">$</span>70.00</td>
                                </tr>
                                <tr>
                                    <td class="product-remove"><a href="#" class="remove-wishlist"><i class="icon-73"></i></a></td>
                                    <td class="product-thumbnail"><a href="course-details.php"><img src="assets/images/shop/product-06.jpg" alt="Digital Product"></a></td>
                                    <td class="product-title"><a href="course-details.php">The Silver Chair</a></td>
                                    <td class="product-price" data-title="Price"><span class="currency-symbol">$</span>70.00</td>
                                    <td class="product-quantity" data-title="Qty">
                                        <div class="pro-qty">
                                            <input type="number" class="quantity-input" value="1">
                                        </div>
                                    </td>
                                    <td class="product-subtotal" data-title="Subtotal"><span class="currency-symbol">$</span>70.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="cart-update-btn-area">
                        <div class="input-group product-cupon">
                            <input placeholder="Coupon code..." type="text">
                            <button type="submit" class="submit-btn"><i class="icon-4"></i></button>
                        </div>
                        <div class="update-btn">
                            <a href="#" class="edu-btn btn-border btn-medium disabled">Update Cart <i class="icon-4"></i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                            <div class="order-summery">
                                <h4 class="title">Cart Totals</h4>
                                <table class="table summery-table">
                                    <tbody>
                                        <tr class="order-subtotal">
                                            <td>Subtotal</td>
                                            <td>$210.90</td>
                                        </tr>
                                        <tr class="order-total">
                                            <td>Order Total</td>
                                            <td>$210.90</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="checkout.php" class="edu-btn btn-medium checkout-btn">Process to Checkout <i class="icon-4"></i></a>
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