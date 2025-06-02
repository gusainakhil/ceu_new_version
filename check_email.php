<?php
include "connect.php";
include "functions.php";

$email = $_POST['email'];

$sql = "SELECT * FROM user_info WHERE email = '$email'";
$result = mysqli_query($con,$sql);

if (mysqli_num_rows($result) > 0) {
    echo "<label class='text-danger'>Email already exists. <a href='login'>Login Here?</label>";
}

?>
