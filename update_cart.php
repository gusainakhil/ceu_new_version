<?php
include "connect.php";

$temp_hash_id="";
if(!empty($_SESSION['hash_id'])){
    $temp_hash_id=$_SESSION['hash_id'];
}elseif(!empty($_SESSION['ip_address'])){
    $temp_hash_id=$_SESSION['ip_address'];
}else{}
    // echo $temp_hash_id;
    
function cart($con, $id)
{
    $sql = mysqli_query($con, "SELECT COUNT(*) as num FROM cart WHERE user_id='$id' AND cart_status='1'");
    $row = mysqli_fetch_assoc($sql);
    return $row['num'];
}

// Assuming $temp_hash_id is available in your context
echo cart($con, $temp_hash_id);
?>
