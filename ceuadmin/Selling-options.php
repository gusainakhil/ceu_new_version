<?php
include "connect.php";
// include "functions.php";
if (empty($_SESSION['username'])) {
    header("Location: login.php");
}


function arrayToString($array)
{
    $string = var_export($array, true);
    // $string = str_replace("'", "", $string);
    return $string;
}

function stringToArray($string)
{
    return eval("return $string;");
}
function stringToArray2($string){
    $phpCode = str_replace('Array', '$array = array', $string);
    $phpCode .= ';';
    eval($phpCode);
    return $array;
}

function avatar($user)
{
    $first = "";
    if (!empty($user)) {
        $first = strtoupper(substr($user, 0, 1));
        return $first . ".webp";
    } else {
        return "user.webp";
    }
}

function color()
{
    $colorCodes = array('#55acee', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF');
    $randomIndex = rand(0, count($colorCodes) - 1);
    return $colorCodes[$randomIndex];
}

function random($name)
{
    return md5($name);
}



function classid($con, $id)
{
    $sql = mysqli_query($con, "SELECT class_title FROM class WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['class_title'];
}

function exam_title($con, $id)
{
    $sql = mysqli_query($con, "SELECT exam_title FROM add_exam WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['exam_title'];
}

function course($con,$id)
{
    $sql = mysqli_query($con, "SELECT title FROM course_detail WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['title'];
}

function array_check($array)
{
    return strtok($array," ");
}

function student($con, $id)
{
    $sql = mysqli_query($con, "SELECT name FROM s_detail WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['name'];
}

function industry($con, $id)
{
    $sql = mysqli_query($con, "SELECT industry_name FROM industry WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['industry_name']; 
}

function speaker($con, $id)
{
    $sql = mysqli_query($con, "SELECT name FROM speaker_info WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['name'];
}

function faq_category($con, $id)
{
    $sql = mysqli_query($con, "SELECT category FROM faq_category WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['category'];
}

$arr_sql = mysqli_query($con, "SELECT * FROM selling_options WHERE status='1' ");
$arr_row = mysqli_fetch_assoc($arr_sql);

$array = stringToArray($arr_row['array']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $subtitles = $_POST['subtitle'];
    $titles = $_POST['title'];
    $prices = $_POST['price'];

    $result_array = [];

    foreach ($_POST['title'] as $category => $title) {
        $options = [];
        foreach ($_POST['subtitle'][$category] as $index => $subtitle) {
            // echo $options[$subtitle];
            if(!empty($_POST['price'][$category][$index])){
                $price = $_POST['price'][$category][$index];
                $options[$subtitle] = $price;
            }
        }
        $result_array[$title] = $options;
    }

    $array1 = str_replace("'",'"',arrayToString($result_array));

    mysqli_query($con, "UPDATE selling_options SET array='$array1' WHERE status='1' ");
    header("Location: Selling-options.php");

}


?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Default Selling options </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <!--<link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">-->
    <!--<link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">-->

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

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <form method="post" class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold py-3 mb-0">Default Selling options</h3>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
                                    <button type="reset" class="btn btn-secondary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="list-view">
                            <div class="row clearfix g-3">
                                <?php
                                $a = 0;
                                $b=0;
                                foreach ($array as $category => $options) {
                                $b++; ?>

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 input-group">
                                                    <input type="text" class="form-control" name="title[<?php echo $category ?>]" id="titleInput" placeholder="Title comes here" value="<?php echo $category ?>" >
                                                    <!-- <span class="">https://ceutrainers.com/webinars/</span> -->
                                                    <input type="date" class=" form-control" name="date1[]" id="dateInput">

                                                </div>
                                                <div class="col-md-10 offset-md-2">
                                                    <div id="education_fields<?php echo $b ?>">
                                                        <?php
                                                        foreach ($options as $option => $price) {
                                                            $a++ ?>
                                                            <div class="row g-3 mt-1 align-items-center removeclass<?php echo $a ?>">
                                                                <div class="col-md-6">
                                                                    <label for="subtitleInput" class="form-label">Subtitle</label>
                                                                    <input type="text" class="form-control" name="subtitle[<?php echo $category ?>][]" id="subtitleInput" value="<?php echo $option ?>" >
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label id="priceInput" class="form-label">Price</label>
                                                                    <div class="input-group mb-3">
                                                                        <input type="number" class="form-control" id="priceInput" name="price[<?php echo $category ?>][]"  value="<?php echo $price ?>">
                                                                        <a class="btn btn-danger" id="delete-input-" onclick="remove_education_fields(<?php echo $a ?>);">
                                                                            <i class="fa fa-trash fa-lg text-white"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php } ?>
                                                    </div>
                                                    <div class="row g-3 align-items-center">
                                                        <div class="col-md-6">
                                                            <label for="subtitleInput" class="form-label">Subtitle</label>
                                                            <input type="text" class="form-control" name="subtitle[<?php echo $category ?>][]" id="subtitleInput" >
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label id="priceInput" class="form-label">Price</label>
                                                            <div class="input-group mb-3">
                                                                <input type="number" class="form-control" id="priceInput" name="price[<?php echo $category ?>][]" >
                                                                <a class="btn btn-success" id="delete-input-" onclick="education_fields('<?php echo $category ?>',<?php echo $b ?>);">
                                                                    <i class="fa fa-plus fa-lg text-white"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Edit Selling options -->
            <div class="modal fade" id="expedit" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content" id="edit_selling">

                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="deletemodalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletemodalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="confirmDelete">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <!--<script src="assets/bundles/dataTables.bundle.js"></script>-->

    <!-- Jquery Page Js -->
    <script src="assets/js/template.js"></script>

    <script>
        $('#deletemodal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var sellingId = button.data('selling-id'); // Extract data-id attribute from the button
            var deleteLink = 'delete.php?selling_id=' + sellingId;
            $('#confirmDelete').attr('href', deleteLink);
        });

        var room = <?php echo $a ?>;

        function education_fields(title,count) {

            room++;
            var edut='education_fields'+count;
            var objTo = document.getElementById(edut);
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = `<div class="row g-3 align-items-center">
                                                    <div class="col-md-6">
                                                        <label for="subtitleInput" class="form-label">Subtitle</label>
                                                        <input type="text" class="form-control" name="subtitle[`+title+`][]" id="subtitleInput" >
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label id="priceInput" class="form-label">Price</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" class="form-control" id="priceInput" name="price[`+title+`][]" >
                                                            <a class="btn btn-danger" onclick="remove_education_fields(` + room + `);">
                                                                <i class="fa fa-trash fa-lg text-white" ></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>`;

            objTo.appendChild(divtest);
        }

        function remove_education_fields(rid) {
            $('.removeclass' + rid).remove();
        }

        // project data table
        // $(document).ready(function() {
        //     $('#myProjectTable') 
        //         .addClass('nowrap')
        //         .dataTable({
        //             responsive: true,
        //             columnDefs: [{
        //                 targets: [-1, -3],
        //                 className: 'dt-body-right'
        //             }]
        //         });
        //     $('.deleterow').on('click', function() {
        //         var tablename = $(this).closest('table').DataTable();
        //         tablename
        //             .row($(this)
        //                 .parents('tr'))
        //             .remove()
        //             .draw();
        //     });
        // });

        $(document).ready(function() {
            $(".edit_selling").on("click", function() {
                var selling = $(this).data("selling-id");
                $.ajax({
                    url: "selling.php",
                    method: "POST",
                    data: {
                        selling_id: selling
                    },
                    success: function(response) {
                        $("#edit_selling").html(response);
                    },
                    error: function(response) {
                        alert(response);
                    }
                });
            });
        });

        // console.log(sellingOptions);
    </script>
</body>

</html>