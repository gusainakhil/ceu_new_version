<?php

    
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';


    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
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

function cart($con, $id)
{
    $sql = mysqli_query($con, "SELECT COUNT(cart_id) as num FROM cart WHERE user_id='$id' AND cart_status='1' ");
    $row = mysqli_fetch_assoc($sql);
    return $row['num'];
}

function extractKeys($data, $pattern)
{
    $keysToExtract = array_keys(array_filter($data, function ($value, $key) use ($pattern) {
        return preg_match($pattern, $key);
    }, ARRAY_FILTER_USE_BOTH));

    $extractedValues = array_map(function ($key) {
        preg_match('/\$(\d+)/', $key, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }, $keysToExtract);
    $totalSum = array_sum($extractedValues);
    return $totalSum;
}

function arrayToString($array)
{
     $jsonString = json_encode($array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    // $string = str_replace("'", "", $string);
     return htmlspecialchars($jsonString, ENT_QUOTES, 'UTF-8');
}

function stringToArray($string)
{
    return eval("return $string;");
}

function password()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
        $randomIndex = rand(0, $charLength - 1);
        $randomString .= $characters[$randomIndex];
    }
    return $randomString;
}

function username()
{
    $randomNumber = rand(100000, 999999);
    $password = "CEU" . $randomNumber;
    return $password;
}

function course($con, $id)
{
    $sql = mysqli_query($con, "SELECT title FROM course_detail WHERE id='$id'");
    $row = mysqli_fetch_assoc($sql);
    return $row['title'];
}

function generateorder($length = 6, $prefix = 'CEU')
{
    // Generate a random number with the specified length
    $randomNumber = '';
    for ($i = 0; $i < $length; $i++) {
        $randomNumber .= rand(0, 9);
    }

    // Combine the prefix, random number, and a suffix if needed
    $orderID = $prefix . $randomNumber;

    return $orderID;
}

function sendemail($con, $email, $password)
{
    
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        $cont="https://ceuservices.com/email.php?email=".$email."&password=".$password;
        $message = file_get_contents($cont);
        $subject = "Thank You for Joining us";
        //Server settings
        
        $mail->IsSMTP(); // enable SMTP
    
        $mail->SMTPDebug = true; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "mail.ceu-trainers.com"; // outgoing server
        $mail->Port = 587; // or 587
        $mail->IsHTML(true);
        $mail->Username = "work@ceu-trainers.com"; // smtp username
        $mail->Password = "PWz=ox#}HO0W"; // smtp password
        $mail->SetFrom("work@ceu-trainers.com", "CEUTrainers Team");
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($email);
    
        if($mail->Send()){
            
        }
    
        
        //   $mail->addAddress($to,$name); 
}

function order_email($con, $order_id,$email)
{
    
    
    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        
        $cont="https://ceuservices.com/orderpdf.php?order_id=$order_id";
        $message = file_get_contents($cont);
        $subject = "Order Successful";
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->IsSMTP(); // enable SMTP
    
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "mail.ceu-trainers.com"; // outgoing server
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "work@ceu-trainers.com"; // smtp username
        $mail->Password = "PWz=ox#}HO0W"; // smtp password
        $mail->SetFrom("work@ceu-trainers.com", "CEUTrainers Team");
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->AddAddress($email);
    
        if($mail->Send()){}
}

function convertTimezones($datetime){
    $inputTimezone = new DateTimeZone('America/New_York'); // Central Standard Time

    // Create a DateTime object with the input datetime and timezone
    $inputDatetime = new DateTime($datetime, $inputTimezone);
    
    // Eastern Standard Time
    $inputDatetime->setTimezone($inputTimezone);
    $est = $inputDatetime->format('H:i:s A');

    // Convert the datetime to Eastern Standard Time (EST)
    $estTimezone = new DateTimeZone('America/Chicago'); // Eastern Standard Time
    $inputDatetime->setTimezone($estTimezone);
    $cst = $inputDatetime->format('H:i:s A');

    // Convert the datetime to Mountain Standard Time (MST)
    $mstTimezone = new DateTimeZone('America/Denver'); // Mountain Standard Time
    $inputDatetime->setTimezone($mstTimezone);
    $mst = $inputDatetime->format('H:i:s A');

    // Convert the datetime to Pacific Standard Time (PST)
    $pstTimezone = new DateTimeZone('America/Los_Angeles'); // Pacific Standard Time
    $inputDatetime->setTimezone($pstTimezone);
    $pst = $inputDatetime->format('H:i:s A');

    // Output the results
    echo $est." (EST) | ". $cst." (CST) | ". $mst." (MST) | " . $pst." (PST) ";
    
}


function user_last_id($con)
{
    $sql = mysqli_query($con, "SELECT MAX(id) AS id FROM user_info");
    $row = mysqli_fetch_assoc($sql);
    return $row['id'];
}