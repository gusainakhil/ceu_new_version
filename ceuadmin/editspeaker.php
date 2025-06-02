<?php
include "connect.php";
include "functions.php";
if(empty($_SESSION['username'])){
    header("Location: login.php");
}

// Include your database connection code here
$output = "";
if (isset($_POST['speaker_id'])) {
    $speaker_id = $_POST['speaker_id'];

    $a_query = mysqli_query($con, "SELECT * FROM speaker_info WHERE id='$speaker_id' ");
    $b_row = mysqli_fetch_assoc($a_query);
    $a = 0;
    $images="";
    if(!empty($b_row['images'])){
        $images.='assets/images/speaker/'.$b_row['images'];
    }else{
        $images.='assets/images/xs/avatar1.svg';
    }
    // Output the subjects as HTML
    $output .= "<div class='modal-header'>
    <h5 class='modal-title fw-bold' id='expaddLabel'>Add Speaker</h5>
    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
</div>
<form method='post' enctype='multipart/form-data'>
    <div class='modal-body'>
        <div class='deadline-form'>
            <div class='row g-3 mb-3'>
                <div class='col-sm-12'>
                    <div class='avatar-upload'>
                        <div class='avatar-edit'>
                            <input type='file' name='images12345' id='imageUpload12' accept='.png, .jpg, .jpeg' />
                            <label for='imageUpload12'></label>
                        </div>
                        <div class='avatar-preview'>
                            <div id='imagePreview12' style='background-image: url(".$images.");'>
                            </div>
                        </div>
                    </div>
                </div>
                <input type='hidden' name='id12' value='".$b_row['id']."'>
                <div class='col-sm-3'>
                    <label for='item' class='form-label'>Speaker Name</label>
                    <input type='text' class='form-control' name='name12' value='".$b_row['name']."'>
                </div>
                <div class='col-sm-3'>
                    <label for='depone' class='form-label'>Designation</label>
                    <input type='text' class='form-control' name='designation12' value='".$b_row['designation']."'>
                </div>
                <div class='col-sm-3'>
                    <label for='abc11' class='form-label'>Email Address</label>
                    <input type='email' class='form-control' name='email12' value='".$b_row['email']."'>
                    <input type='hidden' name='type12' value='upload'>
                </div> 
                <div class='col-sm-3'>
                    <label for='abc111' class='form-label'>Phone</label>
                    <input type='number' class='form-control' name='phone_no12' value='".$b_row['phone_no']."'>
                </div>
                <div class='col-sm-12'>
                    <label for='abc' class='form-label'>Bio</label>
                    <textarea name='bio12' id='editor1' required>".$b_row['bio']."</textarea>
                </div>
                <div class='col-sm-12'>
                    <label for='asdgbc' class='form-label'>Resume</label>
                    <input type='file' class='form-control w-100' name='resume12' id='imageUpload12' accept='.pdf' value='".$b_row['resume']."' />
                </div>
            </div>
        </div>
    </div>
    <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary'>Update</button>
    </div>
</form>
<script src='https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js'></script>
<script>
        
        CKEDITOR.replace('editor1').on('change', function(event) {
            var editorValue = event.editor.getData();
            console.log('CKEditor Value:', editorValue);
        });
        function readURLe(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview12').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview12').hide();
                    $('#imagePreview12').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $('#imageUpload12').change(function() {
            readURLe(this);
        });
        </script>";
}
echo $output;
?>