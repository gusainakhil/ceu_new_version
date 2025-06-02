<!--<script type="text/javascript">-->
<!--    (function (c, l, a, r, i, t, y) {-->
<!--        c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments) };-->
<!--        t = l.createElement(r); t.async = 1; t.src = "https://www.clarity.ms/tag/" + i;-->
<!--        y = l.getElementsByTagName(r)[0]; y.parentNode.insertBefore(t, y);-->
<!--    })(window, document, "clarity", "script", "kksy4gt91l");-->
<!--</script>-->


<?php
$temp_hash_id = "";
if (!empty($_SESSION['hash_id'])) {
    $temp_hash_id = $_SESSION['hash_id'];
} 
if (!empty($_SESSION['ip_address'])) {
    $temp_hash_id = $_SESSION['ip_address'];
}

?>
<header class="edu-header header-style-3">
    <div class="header-top-bar">
        <div class="container">
            <div class="header-top">
                <div class="header-top-left">
                    <ul class="header-info">
                        <li><a href="tel:(+1)-432-755-5553"><i class="icon-phone"></i>Call:
                                (+1)-432-755-5553</a></li>
                        <li><a href="mailto:info@ceutrainers.com" target="_blank"><i class="icon-envelope"></i>Email:
                                support@ceutrainers.com</a></li>
                    </ul>
                </div>
                <div class="header-top-right">
                    <ul class="header-info">
                        <?php
                        if (!empty($_SESSION['user_id'])) { ?>
                            <li><a href="dashboard">Dashboard</a></li>
                            <li><a href="logout">Logout</a></li>
                        <?php } else { ?>
                            <li><a href="login">Login</a></li>
                           
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="edu-sticky-placeholder"></div>
    <div class="header-mainmenu">
        <div class="container">
            <div class="header-navbar">
                <div class="header-brand">
                    <div class="logo">
                        <a href="https://ceuservices.com">
                            <img class="logo-light" src="assets/img/Logo.png" alt="CEUTrainers Logo" width="50%" />
                            <img class="logo-dark" src="assets/img/Logo.png" alt="CEUTrainers Logo" width="50%" />
                        </a>
                    </div>
                </div>
                <div class="header-mainnav">
                    <nav class="mainmenu-nav">
                        <ul class="mainmenu">
                            <li><a href="about">About Us</a>
                            <li class="has-droupdown"><a href="#">Industry</a>
                                <ul class="submenu">
                                    <li><a href="webinar">Human Resource</a></li>
                                    <li><a href="webinar">Payroll & Taxation</a></li>
                                    <li><a href="webinar">BFSI & Accounting</a></li>
                                    <li><a href="webinar">Housing & Construction</a></li>
                                </ul>
                            </li>
                            <li class="has-droupdown"><a href="#">Webinar</a>
                                <ul class="submenu">
                                    <li><a href="webinar">Live</a></li>
                                    <li><a href="webinar">On Demand</a></li>
                                    <li><a href="webinar">eTranscript</a></li>
                                </ul>
                            </li>
                            <li class="has-droupdown"><a href="#">Speakers</a>
                                <ul class="submenu">
                                    <li><a href="speakers">Our Speakers</a></li>
                                    <li><a href="becomeSpeaker">Become a Speaker</a></li>

                                </ul>
                            </li>


                            <li class="has-droupdown"><a href="#">Help</a>
                                <ul class="submenu">
                                    <li><a href="contact">Contact Us</a></li>
                                    <li><a href="faq">FAQs</a></li>
                                    <li><a href="dashboard">Dashboard</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="header-right">
                    <ul class="header-action">

                        <li class="icon cart-icon">
                            <a href="cart" class="cart-icon" id="cartLink">
                                <i class="icon-3"></i>
                                <span class="count" id="cart_count">
                                    <?php if (!empty($_SESSION['ip_address'])) { echo cart($con, $temp_hash_id);}else{echo "0";} ?>
                                </span>
                            </a>
                        </li>

                        <li class="mobile-menu-bar d-block d-xl-none">
                            <button class="hamberger-button">
                                <i class="icon-54"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-mobile-menu">
        <div class="inner">
            <div class="header-top">
                <div class="logo">
                    <a href="https://ceuservices.com">
                        <img class="logo-light" src="assets/img/Logo.png" alt="Corporate Logo" width="50%" />
                        <img class="logo-dark" src="assets/img/Logo.png" alt="Corporate Logo" width="50%" />
                    </a>
                </div>
                <div class="close-menu">
                    <button class="close-button">
                        <i class="icon-73"></i>
                    </button>
                </div>
            </div>
            <ul class="mainmenu">
                <li class="has-droupdown"><a href="index">Home</a>
                    <ul class="mega-menu mega-menu-one">
                        <li><a href="about">About Us</a>
                        <li class="has-droupdown"><a href="webinar">Webinar</a>
                            <ul class="mega-menu">
                                <li>
                                    <h6 class="menu-title">Industry</h6>
                                    <ul class="submenu mega-sub-menu-01">
                                        <li><a href="webinar">Human Resource</a></li>
                                        <li><a href="webinar">Payroll & Taxation</a></li>
                                        <li><a href="webinar">BFSI & Accounting</a></li>
                                        <li><a href="webinar">Housing & Construction</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <h6 class="menu-title">Format</h6>
                                    <ul class="submenu mega-sub-menu-01">
                                        <li><a href="webinar">Live</a></li>
                                        <li><a href="webinar">On Demand</a></li>
                                        <li><a href="webinar">eTranscript</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="has-droupdown"><a href="#">Speakers</a>
                            <ul class="submenu">
                                <li><a href="speakers">Our Speakers</a></li>
                                <li><a href="becomeSpeaker">Become a Speaker</a></li>

                            </ul>
                        </li>


                        <li class="has-droupdown"><a href="#">Contact</a>
                            <ul class="submenu">
                                <li><a href="contact">Contact Us</a></li>
                                <li><a href="faq">FAQs</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="edu-search-popup">
        <div class="content-wrap">
            <div class="site-logo">
                <img class="logo-light" src="assets/img/Logo.png" alt="Corporate Logo" width="50%" />
                <img class="logo-dark" src="assets/img/Logo.png" alt="Corporate Logo" width="50%" />
            </div>
            <div class="close-button">
                <button class="close-trigger"><i class="icon-73"></i></button>
            </div>
            <div class="inner">
                <form class="search-form" action="#">
                    <input type="text" class="edublink-search-popup-field" placeholder="Search Our Courses...">
                    <button class="submit-button"><i class="icon-2"></i></button>
                </form>
            </div>
        </div>
    </div>
   
</header>