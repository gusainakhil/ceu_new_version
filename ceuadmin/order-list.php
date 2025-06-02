<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<?php
include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login.php");
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>   Orders List </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">
  
</head>
<body>
    <div id="ebazar-layout" class="theme-blue">                          
        
        <!-- sidebar -->
        <?php include 'sidebar.php'?>     

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4"> 

            <!-- Body: Header -->
            <?php include 'header.php' ?>

            <!-- Body: Body -->
            <div class="body d-flex py-3">  
                <div class="container-xxl"> 
                    <div class="row align-items-center"> 
                        <div class="border-0 mb-4"> 
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Orders List</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="row g-3 mb-3"> 
                        <div class="col-md-12">
                            <div class="card"> 
                                <div class="card-body"> 
                                    <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">  
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>order id</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Webinar</th>
                                                <th>Selling option</th>
                                                <th>Amount</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $a=0;
                                        // $result = mysqli_query($con, "select user_info.*,order_details.*,course_detail.title from user_info, order_details, course_detail where 1=1 and user_info.id = order_details.user_id and order_details.id = course_detail.id");
                                        $result = mysqli_query($con, "select amount,selling_options,order_id,name,trans_date from order_details ORDER BY id DESC");
                                        while ($row = mysqli_fetch_assoc($result)) { 
                                            $a++; ?>
                                            <tr>
                                                <td><a href="order-details"><strong><?php echo $a ?></strong></a></td>
                                                <td><a href="order-details?order_detail=<?php echo $row['order_id']; ?> "><?php echo $row['order_id']; ?></td>
                                                <td> <?php echo $row['name']; ?></td>
                                                <td><?php echo $row['trans_date']; ?></td>
                                                <td>
                                                    <?php
                                                if(array_check($row['selling_options'])!="array"){
                                                    $array = stringToArray($row['selling_options']);
                                                    foreach ($array as $key => $value) {
                                                        echo "$key= <span class='fw-bold'>$$value</span>"; 
                                                    }
                                                }else{
                                                    $array = stringToArray($row['selling_options']);
                                                    foreach ($array as $key1 => $innerArray) {
                                                        echo "<span class='fw-bold'>$key1</span><br>";
                                                        foreach ($innerArray as $key => $value) {
                                                            echo "$key= <span class='fw-bold'>$$value</span><br>";
                                                        }
                                                        echo "<br>";
                                                    }
                                                } ?>
                                                </td>
                                                <td><?php echo "<span>$</span>".$row['amount']; ?></td>
                                            </tr>
                                           <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                </div>
            </div>
                                        

    </div> 

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js -->
    <!--<script src="assets/bundles/dataTables.bundle.js"></script>  -->

    <!-- Jquery Page Js -->
    <script src="assets/js/template.js"></script>
    <script>
        $('#myDataTable')
        .addClass('nowrap')
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
    </script>
</body>

</html> 