<?php 
include "connect.php";
include "functions.php";

$user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $course_hash_id = $_POST['course_hash_id'];
    $course_title = $_POST['course_title'];
    $hash_id = random(date('Y-m-d H:i:s'));
    $array = str_replace("'", '"', $_POST['array']);
    $cart_counter=cart($con,$user_id);
    $old_sql = mysqli_query($con, "SELECT course_hash_id FROM cart WHERE course_hash_id='$course_hash_id' and user_id='$user_id' AND cart_status='1' ");
    if(mysqli_num_rows($old_sql)>0){
     $old_row = mysqli_fetch_assoc($old_sql);

        if ($course_hash_id == $old_row['course_hash_id']) {
            mysqli_query($con, "UPDATE cart SET course_id='$course_id',course_hash_id='$course_hash_id',hash_id='$hash_id',array='$array' WHERE course_hash_id='$course_hash_id' AND user_id='$user_id' AND cart_status='1'  ");
            
            $response = [
                'status' => 'Updated',
                'courseName' => $course_title,
                'cart_counter' => $cart_counter
            ];
        }
    }else{
        mysqli_query($con, "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','$array')");
        // echo "INSERT INTO cart (user_id,course_id,course_hash_id,hash_id,array) VALUES ('$user_id','$course_id','$course_hash_id','$hash_id','".$array."')";
        $response = [
            'status' => 'Added to Cart',
            'courseName' => $course_title,
            'cart_counter' => $cart_counter
        ];
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;

    ?>

