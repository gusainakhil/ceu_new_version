<?php

function attribute($att)
{
    switch ($att) {
        case "dob":
            echo "DOB";
            break;
        case "phone_no":
            echo "Contact Number!";
            break;
        case "email":
            echo "Email Address";
            break;
        case "address":
            echo "Address";
            break;
        case "aadhar":
            echo "Aadhar Number";
            break;
        case "address":
            echo "Address";
            break;
        case "passing_year_m":
            echo "Passing Year";
            break;
        case "tc":
            echo "TC";
            break;
        case "migration":
            echo "Migration";
            break;
        case "mother_n":
            echo "Mother Name";
            break;
        case "father_n":
            echo "Father Name";
            break;
        case "annual_income":
            echo "Annual Income";
            break;
        case "gender":
            echo "Gender";
            break;
        case "tc_status":
            echo "TC Status";
            break;
        case "parent_email":
            echo "Parent Email";
            break;
        case "student_email":
            echo "Student Email";
            break;
        case "parent_email":
            echo "Parent Email";
            break;
        case "city":
            echo "City";
            break;
        case "district":
            echo "District";
            break;
        case "pincode":
            echo "Pin Code";
            break;
        case "country":
            echo "Country";
            break;
        case "date":
            echo "Date of Joining";
            break;
        case "student_fee":
            echo "Student Fee";
            break;
        case "deleted":
            echo "Delete";
            break;
        case "status":
            echo "Status";
            break;
        default:
            echo "sfgfdhb";
    }
}
function arrayToString($array)
{
    $string = var_export($array, true);
    // $string = str_replace("'", "", $string);
    return $string;
}

function stringToArray($string) {
    $result = [];
    $lines = explode("\n", $string); // Split by new line if multiple entries exist

    foreach ($lines as $line) {
        $parts = explode("=", $line, 2); // Split by '=' to separate key and value
        if (count($parts) == 2) {
            $key = trim($parts[0]); // "1 Attendee"
            $value = trim(str_replace("$", "", $parts[1])); // Remove "$" sign and trim spaces
            $result[$key] = floatval($value); // Convert price to number
        }
    }

    return $result;
}

function stringToArray2($string){
    $phpCode = str_replace('Array', '$array = array', $string);
    $phpCode .= ';';
    eval($phpCode);
    return $array;
}

function avatar($user)
{
    $first = "";
    if (!empty($user)) {
        $first = strtoupper(substr($user, 0, 1));
        return $first . ".webp";
    } else {
        return "user.webp";
    }
}

function color()
{
    $colorCodes = array('#55acee', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF');
    $randomIndex = rand(0, count($colorCodes) - 1);
    return $colorCodes[$randomIndex];
}

function random($name)
{
    return md5($name);
}

function month($mon)
{
    switch ($mon) {
        case "1":
            return "January";
            break;
        case "2":
            return "February";
            break;
        case "3":
            return "March";
            break;
        case "4":
            return "April";
            break;
        case "5":
            return "May";
            break;
        case "6":
            return "June";
            break;
        case "7":
            return "July";
            break;
        case "8":
            return "August";
            break;
        case "9":
            return "September";
            break;
        case "10":
            return "October";
            break;
        case "11":
            return "November";
            break;
        case "12":
            return "December";
            break;
        default:
            return "sfgfdhb";
    }
}

function classid($con, $id)
{
    $sql = mysqli_query($con, "SELECT class_title FROM class WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['class_title'];
}

function exam_title($con, $id)
{
    $sql = mysqli_query($con, "SELECT exam_title FROM add_exam WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['exam_title'];
}

function course($con,$id)
{
    $sql = mysqli_query($con, "SELECT title FROM course_detail WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['title'];
}

function array_check($array)
{
    return strtok($array," ");
}

function student($con, $id)
{
    $sql = mysqli_query($con, "SELECT name FROM s_detail WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['name'];
}

function industry($con, $id)
{
    $sql = mysqli_query($con, "SELECT industry_name FROM industry WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['industry_name']; 
}

function speaker($con, $id)
{
    $sql = mysqli_query($con, "SELECT name FROM speaker_info WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['name'];
}

function faq_category($con, $id)
{
    $sql = mysqli_query($con, "SELECT category FROM faq_category WHERE id='$id' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['category'];
}
?>