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
    <title> Live tracking</title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dat¯aTables.bootstrap5.min.css">


    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/ceu.style.min.css">

</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- sidebar -->
        <?php include 'sidebar.php' ?>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <?php include 'header.php' ?>


                    
    <h2>Live Checkout Data</h2>
    <div id="live-data"></div>

        
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/dataTables.bundle.js"></script>
    <script src="assets/js/template.js"></script>

    <script>
        // project data table
        $(document).ready(function () {
            $('#myProjectTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [
                        { targets: [-1, -3], className: 'dt-body-right' }
                    ]
                });
            $('.deleterow').on('click', function () {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });
        });
    </script>
        <script>
        function fetchLiveData() {
            $.ajax({
                url: "fetch_live_tracking.php",
                type: "GET",
                success: function (data) {
                    $("#live-data").html(data);
                }
            });
        }

        setInterval(fetchLiveData, 1000); // Fetch data every 3 seconds
        fetchLiveData(); // Load data initially
    </script>

</body>


</html>






