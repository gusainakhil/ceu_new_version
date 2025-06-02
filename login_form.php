<?php
include "connect.php";
include "functions.php";


    if ($_POST['type'] == "login") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $log_query = mysqli_query($con, "SELECT * FROM user_info WHERE email='$email' AND status='1' ");
        if (mysqli_num_rows($log_query) == 1) {
            $log_row = mysqli_fetch_assoc($log_query);
            if ($log_row['password'] == $password) {
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['user_id'] = $log_row['id'];
                $_SESSION['name'] = $log_row['name'];
                $_SESSION['hash_id'] = $log_row['hash_id'];
                // header("Location: dashboard.php");
                echo "1";
            } else {
                // header("Location: login.php");
                echo "0";
            }
        } else {
            // header("Location: login.php");
            echo "2";
        }
    }else{
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

?>