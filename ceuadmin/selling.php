<?php include 'connect.php';
include 'functions.php';

// Include your database connection code here
$output = "";
if (isset($_POST['selling_id'])) {
    $selling_id = $_POST['selling_id'];

    $a_query = mysqli_query($con, "SELECT * FROM selling_options WHERE id='$selling_id' ");
    $b_row = mysqli_fetch_assoc($a_query);
    $a = 0;
    // Output the subjects as HTML
    $output .= "
    <div class='modal-header'>
        <h5 class='modal-title fw-bold' id='expaddLabel'>Edit Selling</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <form method='Post'>
        <div class='modal-body'> 
            <div class='deadline-form'>
                <div class='row g-3 align-items-center'>
                    <div class='col-sm-12'>
                        <label class='form-label'>Category</label>
                        <select class='form-select' name='selling_category12' required>
                            <option selected>Choose</option>";
                            $c_sql = mysqli_query($con, 'SELECT name FROM selling_category');
                            while ($c_row = mysqli_fetch_assoc($c_sql)) {
                                $output.="<option value='".$c_row['name']."'";
                                if($c_row['name']==$b_row['selling_category']){
                                    $output.=" selected ";
                                }
                                $output.=">".$c_row['name']."</option>";
                            }
                            $output.="</select>
                    </div>
                    <div class='col-sm-12'>
                        <label for='depone' class='form-label'> Name</label>
                        <input type='text' class='form-control' id='depone' name='name12' value='".$b_row['name']."'>
                        <input type='hidden' name='id' value='".$b_row['id']."'>
                        <input type='hidden' name='type12' value='upload'>
                    </div>
                    <div class='col-sm-12'>
                        <label for='deptwo' class='form-label'>Price</label>
                        <input type='number' class='form-control' id='deptwo' name='price12' value='".$b_row['price']."'>
                    </div>
                </div>
            </div>
        </div>
        <div class='modal-footer'>
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
            <button type='submit' class='btn btn-primary'>Update</button>
        </div>
    </form>";
}
echo $output;
?>