<?php

include 'connect.php';
include 'functions.php';

if(!empty($_GET['cart_id'])){
    mysqli_query($con,"UPDATE cart SET cart_status='0' WHERE cart_id='".$_GET['cart_id']."' ");
}

if(!empty($_GET['faq_que_id'])){
    mysqli_query($con,"UPDATE faq SET status='0' WHERE id='".$_GET['faq_que_id']."' ");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);

?>