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


function resizeAndCompressImage($sourcePath, $destinationPath)
{
    list($width, $height) = getimagesize($sourcePath);
    $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));
    $newHeight = (900 / $width) * $height;

    $resizedImage = imagecreatetruecolor(900, $newHeight);
    imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, 900, $newHeight, $width, $height);
    imagejpeg($resizedImage, "assets/images/course/" . $destinationPath . ".webp", 100);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $industries = mysqli_real_escape_string($con,$_POST['industries']);
    $speaker = mysqli_real_escape_string($con,$_POST['speaker']);
    $title = mysqli_real_escape_string($con,$_POST['title']);
    $description = mysqli_real_escape_string($con,$_POST['description']);
    $date = date('F j, Y', strtotime($_POST['date']));
    $time = date("H:i:s", strtotime($_POST['time']));
    $duration = mysqli_real_escape_string($con,$_POST['duration']);
    $certificate = mysqli_real_escape_string($con, $_POST['certificate']);
    $status = mysqli_real_escape_string($con,$_POST['status']);
    $slug = mysqli_real_escape_string($con,$_POST['slug']);
    $hash_id = random($_POST['title']);
    if (!empty($_FILES['course_thumbail']['tmp_name'])) {

        $course_thumbail = $hash_id . '.webp';
        resizeAndCompressImage($_FILES['course_thumbail']['tmp_name'], $hash_id);
    }else{
        $course_thumbail="";
    }

    // // print($_POST['description']);
    $subtitles = $_POST['subtitle'];
    $titles = $_POST['title1'];
    $prices = $_POST['price'];

    $result_array = [];

    foreach ($titles as $category => $title2) {
        $options = [];
        foreach ($subtitles[$category] as $index => $subtitle) {
            // echo $options[$subtitle];
            if (!empty($prices[$category][$index])) {
                $price = $prices[$category][$index];
                $options[$subtitle] = $price;
            }
        }
        $result_array[$title2] = $options;
    }
    
    $selling_option =  str_replace("'", '"', arrayToString($result_array));

    
    $dates = $_POST['date1'];
    $titles1 = $_POST['title1'];
    $array_date = array();
    
    $ab=0;
    foreach ($titles1 as $category12 => $title22) {
        if (!empty($dates[$ab])) {
            $array_date[$category12] = $dates[$ab];
        }
        $ab++;
    }

    // print_r($array_date);
    $array_date =  str_replace("'", '"', arrayToString($array_date));

    mysqli_query($con, "INSERT INTO course_detail (industries,speaker,title,description,date,time,duration,certificate,status,slug,hash_id,array_date,course_thumbail,selling_option) VALUES ('$industries','$speaker','$title','$description','$date','$time','$duration','$certificate','$status','$slug','$hash_id','$array_date','$course_thumbail','$selling_option') ");

    // echo "INSERT INTO course_detail (industries,speaker,title,description,date,time,duration,certificate,status,slug,hash_id,array_date,course_thumbail,selling_option) VALUES ('$industries','$speaker','$title','$description','$date','$time','$duration','$certificate','$status','$slug','$hash_id','$array_date','$course_thumbail','$selling_option') ";

    header("Location: course-list.php");
}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Course Add </title>
    <link rel="icon" href="favicon.png" type="image/x-icon"> <!-- Favicon-->

    <!--plugin css file -->
    <link rel="stylesheet" href="assets/plugin/multi-select/css/multi-select.css"><!-- Multi Select Css -->
    <link rel="stylesheet" href="assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.css"><!-- Bootstrap Tagsinput Css -->
    <link rel="stylesheet" href="assets/plugin/cropper/cropper.min.css"><!--Cropperer Css -->
    <link rel="stylesheet" href="assets/plugin/dropify/dist/css/dropify.min.css" /><!-- Dropify Css -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css"><!-- Datatable Css -->
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css"><!-- Datatable Css -->

    <!-- Project css file  -->
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
                <div class="container-xxl">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row align-items-center">
                            <div class="border-0 mb-4">
                                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                    <h3 class="fw-bold mb-0">Course Add</h3>
                                    <div>
                                        <button type="submit" class="btn btn-primary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Save</button>
                                        <button type="reset" class="btn btn-secondary btn-set-task w-sm-100 py-2 px-5 text-uppercase">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Row end  -->

                        <div class="row g-3 mb-3">

                            <div class="col-xl-3 col-lg-3">
                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Industry and Speaker</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 mb-2 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label ">Select Industry</label>
                                                <select name="industries" class="form-control w-100" required>
                                                    <option>Select an Industries</option>
                                                    <?php
                                                    $i_sql = mysqli_query($con, "SELECT id,industry_name FROM industry WHERE status='1' ");
                                                    while ($i_row = mysqli_fetch_assoc($i_sql)) {
                                                    ?>
                                                        <option value="<?php echo $i_row['id'] ?>"><?php echo $i_row['industry_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <label class="form-label">Select Speaker</label>
                                                <select name="speaker" class="form-control w-100" required>
                                                    <option>Select a Speaker</option>
                                                    <?php
                                                    $s_sql = mysqli_query($con, "SELECT id,name FROM speaker_info WHERE status='1' AND speaker_status='1' ");
                                                    while ($s_row = mysqli_fetch_assoc($s_sql)) {
                                                    ?>
                                                        <option value="<?php echo $s_row['id'] ?>"><?php echo $s_row['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Visibility Status</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" value="1" checked>
                                                    <label class="form-check-label">
                                                        Published
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status" value="0">
                                                    <label class="form-check-label">
                                                        Hidden
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Publish Schedule</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label">Publish Date</label>
                                                <input type="date" name="date" class="form-control w-100" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Publish Time</label>
                                                <input type="time" name="time" class="form-control w-100" required>
                                                <?php
                                                // $formattedDate = date('F j, Y', strtotime($date));
                                                // $dateTime = $formattedDate . ' ' . $time;
                                                // $dateTimeForSQL = date('Y-m-d H:i:s', strtotime($dateTime));
                                                ?>
                                            </div>
                                            <label class="form-label">Duration</label>
                                            <div class="col-md-12">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="duration" class="form-control" placeholder="Duration" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="basic-addon2">minutes</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Tags</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group demo-tagsinput-area">
                                            <div class="form-line">
                                                <input type="text" class="form-control" data-role="tagsinput">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                            <div class="col-xl-9 col-lg-9">

                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Course Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label">Course Name</label>
                                                <input type="text" class="form-control" name="title" id="titleInput" oninput="updateSlug()" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Course Identifier URL <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">https://ceutrainers.com/webinars/</span>
                                                    <input type="text" class="form-control" id="slugInput" name="slug" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Course Description</label>
                                                <textarea name="description" id="editor" required>

                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Course Image</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label">Course Image Upload</label>
                                                <small class="d-block text-muted mb-2">Only portrait or square images, 2M max and 2000px max-height.</small>
                                                <input type="file" name="course_thumbail" id="input-file-to-destroy" class="dropify" data-allowed-formats="portrait square" data-max-file-size="2M" data-max-height="2000" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <div class="card mb-3">
                                    <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                                        <h6 class="m-0 fw-bold">Certificate Information</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label class="form-label">Certificate Description</label>
                                                <textarea class="ckeditor" name="certificate" id="editor1" required>

                                                </textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12  col-lg-12">

                                <div class="row clearfix g-3">
                                    <h2 class="accordion-header" id="flush-headingOne">
                                        <b>Selling Options</b>
                                    </h2>
                                    <?php
                                    $sell_sql = mysqli_query($con, "SELECT array from selling_options where status='1' ");
                                    $sell_row = mysqli_fetch_assoc($sell_sql);
                                    $array = stringToArray($sell_row['array']);
                                    $a = 0;
                                    $b=0;
                                    foreach ($array as $category => $options) {
                                        $b++;
                                        ?>

                                        <div class="card mb-3">

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 input-group">
                                                        <input type="text" class="form-control" name="title1[<?php echo $category ?>]" id="titleInput" placeholder="Title comes here" value="<?php echo $category ?>">
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
                                                                        <input type="text" class="form-control" name="subtitle[<?php echo $category ?>][]" id="subtitleInput" value="<?php echo $option ?>">
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <label id="priceInput" class="form-label">Price</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="number" class="form-control" id="priceInput" name="price[<?php echo $category ?>][]" value="<?php echo $price ?>">
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
                                                                <input type="text" class="form-control" name="subtitle[<?php echo $category ?>][]" id="subtitleInput">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label id="priceInput" class="form-label">Price</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="number" class="form-control" id="priceInput" name="price[<?php echo $category ?>][]">
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
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Jquery Plugin -->
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="assets/plugin/multi-select/js/jquery.multi-select.js"></script>
    <script src="assets/plugin/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
    <script src="assets/plugin/cropper/cropper.min.js"></script>
    <script src="assets/plugin/cropper/cropper-init.js"></script>
    <script src="assets/bundles/dropify.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <script src="assets/js/template.js"></script>

    <script>
        var room = <?php echo $a ?>;

        function education_fields(title,count) {

            room++;
            var edut='education_fields'+count;
            console.log(edut);
            var objTo = document.getElementById(edut);
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = `<div class="row g-3 align-items-center">
                                            <div class="col-md-6">
                                                <label for="subtitleInput" class="form-label">Subtitle</label>
                                                <input type="text" class="form-control" name="subtitle[` + title + `][]" id="subtitleInput" >
                                            </div>
                                            <div class="col-md-6">
                                                <label id="priceInput" class="form-label">Price</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" id="priceInput" name="price[` + title + `][]" >
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

        function convertToSlug(title) {
            return title
                .toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
        }

        function updateSlug() {
            const titleInput = document.getElementById('titleInput');
            const slugInput = document.getElementById('slugInput');
            const title = titleInput.value;
            const slug = convertToSlug(title);
            slugInput.value = slug;
        }

        CKEDITOR.replace('editor').on('change', function(event) {
            var editorValue = event.editor.getData();
            console.log("CKEditor Value:", editorValue);
        });
        CKEDITOR.replace('editor1').on('change', function(event) {
            var editorValue = event.editor.getData();
            console.log("CKEditor Value:", editorValue);
        });

        $(document).ready(function() {

            //Ch-editer
            ClassicEditor
                .create(document.querySelector('#editor'))
                .catch(error => {
                    console.error(error);
                });
            //Datatable
            $('#myCartTable')
                .addClass('nowrap')
                .dataTable({
                    responsive: true,
                    columnDefs: [{
                        targets: [-1, -3],
                        className: 'dt-body-right'
                    }]
                });
            $('.deleterow').on('click', function() {
                var tablename = $(this).closest('table').DataTable();
                tablename
                    .row($(this)
                        .parents('tr'))
                    .remove()
                    .draw();

            });
            //Multiselect
            $('#optgroup').multiSelect({
                selectableOptgroup: true
            });
        });

        $(function() {
            $('.dropify').dropify();

            var drEvent = $('#dropify-event').dropify();
            drEvent.on('dropify.beforeClear', function(event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function(event, element) {
                alert('File deleted');
            });

            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-dÃ©posez un fichier ici ou cliquez',
                    replace: 'Glissez-dÃ©posez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'DÃ©solÃ©, le fichier trop volumineux'
                }
            });
        });
    </script>
</body>

</html>