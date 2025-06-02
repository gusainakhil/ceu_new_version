<?php include 'connect.php';
include 'functions.php';

// Include your database connection code here
$output = "";
if (isset($_POST['industry_id'])) {
    $industry_id = $_POST['industry_id']; 

    $a_query = mysqli_query($con, "SELECT * FROM industry WHERE id='$industry_id'");
    $b_row = mysqli_fetch_assoc($a_query);
    $a = 0;
    $images="";
    if(!empty($b_row['image'])){
        $images.='assets/images/industry/'.$b_row['image'];
    }else{
        $images.='assets/images/xs/avatar1.svg';
    }
    // Output the subjects as HTML
    $output .= "
             
    <div class='modal-header'> 
    <h5 class='modal-title  fw-bold' id='expeditLabel'> Edit " . $b_row['industry_name'] . "</h5>
    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
</div>
<div class='modal-body'>
    <div class='deadline-form'>
        <form method='post' enctype='multipart/form-data'>
            <div class='row g-3 align-items-center'>
                <div class='col-12 mx-auto'>
                    <div class='avatar-upload'>
                        <div class='avatar-edit'>
                            <input type='file' name='images12345' id='imageUpload12' accept='.png, .jpg, .jpeg' value='sdfsdfgdfsgdfgdfg' />
                            <label for='imageUpload12'></label>
                        </div>
                        <div class='avatar-preview'>
                            <div id='imagePreview12' style='background-image: url($images);'>
                            </div>
                        </div>
                    </div>
                    <label for='firstname' class='form-label'>Industry Name</label>
                    <input type='text' class='form-control' id='firstname' name='industry_name12' value='" . $b_row['industry_name'] . "' required>
                    <input type='hidden' name='id12' value='" . $b_row['id'] . "'>
                    <input type='hidden' name='type' value='5'>
                    <div class='col-12'>
                        <button type='submit' class='btn btn-primary mt-4 mx-auto'>Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>
<script>
function readURL12(input) {
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
    readURL12(this);
});
</script>
";
}
echo $output;
?>