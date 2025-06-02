<?php
include "connect.php";
include "functions.php";


// Include your database connection code here
$output = "";
    $faq_id = $_POST['faq_id']; 

    $a_query = mysqli_query($con, "SELECT * FROM faq_category WHERE id='$faq_id' ");
    $b_row = mysqli_fetch_assoc($a_query);
    $a = 0;
    
    // Output the subjects as HTML
    $output .= "      
<div class='modal-header'>
    <h5 class='modal-title  fw-bold' id='expeditLabel'> Edit category</h5>
    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
</div>
<div class='modal-body'>
    <div class='deadline-form'>
        <form method='post'>
            <div class='row g-3 align-items-center'>
                <div class='col-12 mx-auto'>
                    <label for='category' class='form-label'>Category Name</label>
                    <input type='text' class='form-control' id='category' name='category12' value='".$b_row['category']."' required>
                    <input type='hidden' name='id' value='".$b_row['id']."'>
                    <input type='hidden' name='type12' value='upload'>
                </div>
                <div class='col-12'>
                    <button type='submit' class='btn btn-primary mt-4 mx-auto'>Update</button>
                </div>
            </div>
        </form>
    </div>
</div>";
echo $output;
?>