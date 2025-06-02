<?php
include 'connect.php';

//admin-profile.php
if ($_POST['type'] == '0') {
	$company_name = $_POST['company_name']; 
	$phone_number = $_POST['phone_number'];
	$email = $_POST['email'];
	$address = $_POST['address'];
	$query = mysqli_query($con, "UPDATE admin_login SET 
    company_name = '$company_name',
    phone_number = '$phone_number',
    email = '$email' 
    WHERE id = 1"); 
	echo "0";
}


//faq-categories-add.php
if ($_POST['type'] == '1') {
	$category = $_POST['category'];
	$query = mysqli_query($con, "INSERT INTO faq_category (category) VALUES ('$category')");
	echo "0";
}

// faq-categorie-list.php 
if ($_POST['type'] == '2') {
	$category_id = $_POST['category_id']; 
	$question = $_POST['question'];
	$answer = $_POST['answer'];
	$query = mysqli_query($con, "INSERT INTO faq (category_id, question,answer) VALUES ('$category_id','$question','$answer')");
	echo "0";
}

// speaker.php
if ($_POST['type'] == '3') {
	$Speaker_Name = $_POST['Speaker_Name']; 
	$designation = $_POST['designation'];
	$bio = $_POST['bio'];
	$email = $_POST['email'];
	$phone_no = $_POST['phone_no']; 

	$query = mysqli_query($con, "INSERT INTO speaker_info (	name, email,phone_no,bio,designation) VALUES ('$Speaker_Name','$email','$phone_no','$bio','$designation')");
	echo "0";
}

//admin-profile.php // modal updation
if ($_POST['type'] == '4') {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$query = mysqli_query($con, "UPDATE admin_login SET 
    username = '$username',
    password = '$password'
    WHERE id = 1");
	echo "0";
}
//industries.php // adding industries 

if ($_POST['type'] == '5') {
    $id=$_POST['id'];
    $industry_name=$_POST['industry_name'];
    mysqli_query($con,"UPDATE industry SET industry_name='$industry_name' WHERE id='$id' ");
	echo "0";

}


// COUPON-ADD.PHP
if ($_POST['type'] == '6') {
	$coupons_status = $_POST['coupons_status']; 
	$start_date = $_POST['start_date'];
	$expire_date = $_POST['expire_date'];
	$coupon_code = $_POST['coupon_code'];
	$coupons_limit = $_POST['coupons_limit']; 
	$discount = $_POST['discount']; 
	
	$query = mysqli_query($con, "INSERT INTO sales_promotion_coupon (coupons_status, start_date,expire_date,coupon_code,coupons_limit,discount) VALUES ('$coupons_status','$start_date','$expire_date','$coupon_code','$coupons_limit','$discount')");
	echo "0";
}

?>