<?php include 'connect.php';
include 'functions.php';

// Include your database connection code here
$output = "";
    $faq_id = $_POST['faq_id']; 

    $a_query = mysqli_query($con, "SELECT * FROM faq WHERE id='$faq_id' ");
    $b_row = mysqli_fetch_assoc($a_query);
    $a = 0;
    
    // Output the subjects as HTML
    $output .= "
    <div class='modal-header'>
    <h5 class='modal-title  fw-bold' id='expaddLabel'> Edit FAQ Content</h5>
    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
</div>
<div class='modal-body'>
    <div class='deadline-form'>
        <form id='add_faq' method='post'>
            <div class='row g-3 mb-3'>
                <div class='col-sm-12'>
                    <label class='form-label'>FAQ category</label>
                    <select name='category_id12' class='form-select'>";
                    $result = mysqli_query($con, 'SELECT id,category FROM faq_category where status = 1 ');
                    while ($row = mysqli_fetch_assoc($result)) {

                    $output .= "<option value='".$row['id']."' ";
                    if($row['id']==$b_row['id']){
                        $output.= "selected";
                    }
                    $output .= ">".$row['category']."</option>";
                    }
                    $output .= "</select>
                </div>
            </div>
            <div class='row g-3 mb-3'>
                <div class='col-sm-12'>
                    <label for='depone' class='form-label'>Title / Question</label>
                    <input type='text' class='form-control' name='question12' placeholder='Enter Title/Question...' value='".$b_row['question']."'>
                </div>
            </div>
            <div class='row g-3 mb-3'>
                <div class='col-sm-12'>
                    <label for='deptwo' class='form-label'>content/Answer</label>
                    <input type='text' class='form-control' name='answer12' placeholder='Enter content/Answer...'  value='".$b_row['answer']."'>
                    <input type='hidden' name='type12' value='upload'>
                    <input type='hidden' name='id' value='".$b_row['id']."'>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Done</button>
                <button type='submit' name='submit' value='submit' class='btn btn-primary'>Update</button>
            </div>
        </form>
    </div>
</div>";
echo $output;
?>