<?php

include 'connect.php';
include 'functions.php';

if(!empty($_GET['course_id'])){
    mysqli_query($con,"UPDATE course_detail SET status='0' WHERE id='".$_GET['course_id']."' ");
}

if(!empty($_GET['industry_id'])){
    mysqli_query($con,"UPDATE `industry` SET `status`='0' WHERE `id`='".$_GET['industry_id']."' ");
    // echo "UPDATE `industry` SET `status`='0' WHERE `id`='$id' ";
}

if(!empty($_GET['speaker_id'])){
    mysqli_query($con,"UPDATE speaker_info SET status='0' WHERE id='".$_GET['speaker_id']."' ");
}

if(!empty($_GET['selling_id'])){
    mysqli_query($con,"UPDATE selling_options SET status='0' WHERE id='".$_GET['selling_id']."' ");
}

if(!empty($_GET['contact_id'])){
    mysqli_query($con,"UPDATE contact_details SET status='0' WHERE id='".$_GET['contact_id']."' ");
}

if(!empty($_GET['faq_id'])){
    mysqli_query($con,"UPDATE faq_category SET status='0' WHERE id='".$_GET['faq_id']."' ");
}

if(!empty($_GET['faq_que_id'])){
    mysqli_query($con,"UPDATE faq SET status='0' WHERE id='".$_GET['faq_que_id']."' ");
}

if(!empty($_GET['coupons_id'])){
    mysqli_query($con,"UPDATE sales_promotion_coupon SET status='0' WHERE id='".$_GET['coupons_id']."' ");
}

if(!empty($_GET['become_id'])){
    mysqli_query($con,"UPDATE speaker_info SET speaker_status='1' WHERE id='".$_GET['become_id']."' ");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>