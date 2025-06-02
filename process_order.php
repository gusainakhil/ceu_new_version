<?php
include "connect.php"; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['item_number'];
    $first_name = $_POST['fname'];
    $last_name = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['number'];
    $company_name = $_POST['company_name'];
    $job_title = $_POST['job_profile'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $state = $_POST['state'];
    $zip_code = $_POST['pin_code'];
    $course_id = $_POST['course_id'];
    $course_name = $_POST['item_name'];
    $selling_options = $_POST['selling_options'];
    $amount = $_POST['amount'];
    $payment_method = "PayPal";
    $status = "Pending";

    $sql = "INSERT INTO orders (order_id, first_name, last_name, email, phone, company_name, job_title, country, city, address1, address2, state, zip_code, course_id, course_name, selling_options, amount, payment_method, status) 
            VALUES ('$order_id', '$first_name', '$last_name', '$email', '$phone', '$company_name', '$job_title', '$country', '$city', '$address1', '$address2', '$state', '$zip_code', '$course_id', '$course_name', '$selling_options', '$amount', '$payment_method', '$status')";

    if (mysqli_query($con, $sql)) {
        echo "Order saved successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
