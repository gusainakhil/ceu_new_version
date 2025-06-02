<?php 
 $result = mysqli_query($con, "SELECT company_name, email FROM admin_login  ");
while ($row = mysqli_fetch_assoc($result)) { 
?>
<div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="index  " class="mb-0 brand-icon">
            <span class="logo-icon">
                <i class="bi icofont-education fs-4"></i>
            </span>
            <span class="logo-text"><?php echo $row['company_name']; ?></span>
        </a>
        <?php } ?>
         <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
            <li><a class="m-link" href="index"><i class="icofont-home fs-5"></i> <span>Dashboard</span></a></li>
            <li><a class="m-link" href="Industries"><i class="icofont-certificate-alt-1 fs-5"></i><span>Industries</span></a></li>
            <li><a class="m-link" href="Selling-options"><i class="icofont-money-bag fs-5"></i><span>Selling options</span></a></li>
            <li><a class="m-link" href="attendees"><i class="icofont-users-social fs-5"></i><span>Attendees</span></a></li>
            </li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#course" href="#">
                    <i class="icofont-book-alt fs-5"></i> <span>Courses</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="course">
                    <!-- <li><a class="ms-link" href="product-grid  ">Product Grid</a></li> -->

                    <li><a class="ms-link" href="course-list">Course List</a></li>
                    <li><a class="ms-link" href="course-add"> Add Course</a></li>

                </ul>
            <li>


            </li>
            <li class="collapsed">
                <a class="m-link " data-bs-toggle="collapse" data-bs-target="#speaker" href="#">
                    <i class="icofont-teacher fs-5"></i> <span>Speakers</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse " id="speaker">
                    <li><a class="ms-link" href="speaker">Speakers list</a></li>
                    <li><a class="ms-link " href="Become-A-speaker">Become A speaker</a></li>
                </ul>
            </li>

            <li class="collapsed">
                <a class="m-link " data-bs-toggle="collapse" data-bs-target="#customers-info" href="#">
                    <i class="icofont-users-social fs-5"></i> <span>Users</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse " id="customers-info">
                    <li><a class="ms-link" href="customers"> All Users</a></li>
                </ul>
            </li>


            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#">
                    <i class="icofont-notepad fs-5"></i> <span>Orders </span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="menu-order">
                    <li><a class="ms-link" href="order-list">Orders List</a></li>
                    <!-- <li><a class="ms-link" href="Failed-order">Failed order</a></li> -->
                    
                    <li><a class="ms-link" href="order-invoices">Order Invoices</a></li>
                </ul>
            </li>

            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#FAQcategories" href="#">
                    <i class="icofont-support-faq fs-5"></i> <span>FAQ</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>

                <ul class="sub-menu collapse" id="FAQcategories">
                    <li><a class="ms-link" href="faq-categories-add">Add category</a></li>
                    <li><a class="ms-link" href="faq-categorie-list">FAQ List</a></li>
                </ul>
            </li>
            <li>
                <a class="m-link" href="coupons-list">
                    <i class="icofont-sale-discount fs-5" ></i> <span>Sales Promotion</span></a>
                <!-- Menu: Sub menu ul -->
                <!-- <ul class="sub-menu collapse" id="menu-sale"> -->
                    <!-- <li><a class="ms-link" >Coupons List</a></li> -->
                    <!-- <li><a class="ms-link" href="coupon-add">Coupons Add</a></li> -->
                
                <!-- </ul> -->
            </li>
            <li><a class="m-link" href="contact"><i class="icofont-address-book fs-5"></i> <span>Contact form</span></a></li>
            <li><a class="m-link" href="wp_order_details"><i class="icofont-address-book fs-5"></i> <span>order_details Wp</span></a></li>
            <li><a class="m-link" href="raw_data"><i class="icofont-address-book fs-5"></i> <span>raw data php </span></a></li>
            <li><a class="m-link" href="cancel_orders"><i class="icofont-address-book fs-5"></i> <span>cancel order react</span></a></li>
              <li><a class="m-link" href="live-tracking.php"><i class="icofont-address-book fs-5"></i> <span>Live tracking </span></a></li>
            <!-- <li><a class="m-link" href="Expenses"><i class="icofont-brand-aliexpress"></i> <span>Expenses</span></a></li> -->

            

            <!-- <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Componentsone" href="#"><i
                                class="icofont-ui-calculator"></i> <span>Accounts</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                     
                        <ul class="sub-menu collapse" id="menu-Componentsone">
                            <li><a class="ms-link" href="invoices">Invoices </a></li>
                            <li><a class="ms-link" href="expenses ">Expenses </a></li>
                            <li><a class="ms-link" href="salaryslip">Salary Slip </a></li>
                            <li><a class="ms-link" href="create-invoice">Create Invoice </a></li>
                        </ul>
                    </li> -->
            <!--               
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#page" href="#">
                        <i class="icofont-page fs-5"></i> <span>Other Pages</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        
                        <ul class="sub-menu collapse" id="page">
                            <li><a class="ms-link" href="admin-profile  ">Profile Page</a></li>
                            <li><a class="ms-link" href="purchase-plan  ">Price Plan Example</a></li>
                            <li><a class="ms-link" href="charts  ">Charts Example</a></li>
                            <li><a class="ms-link" href="table  ">Table Example</a></li>
                            <li><a class="ms-link" href="forms  ">Forms Example</a></li>
                            <li><a class="ms-link" href="icon  ">Icons</a></li>
                            <li><a class="ms-link" href="contact  ">Contact Us</a></li>
                            <li><a class="ms-link" href="todo-list  ">Todo List</a></li>
                        </ul>
                    </li> -->
        </ul>
        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>