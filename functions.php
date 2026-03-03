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

function captureCampaignParams()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return;
    }

    $allowed = [
        'utm_source',
        'utm_medium',
        'utm_campaign',
        'utm_term',
        'utm_content',
        'gclid',
        'fbclid',
        'msclkid',
        'campaign',
        'source',
        'medium'
    ];

    if (empty($_SESSION['campaign_params']) || !is_array($_SESSION['campaign_params'])) {
        $_SESSION['campaign_params'] = [];
    }

    foreach ($allowed as $key) {
        if (isset($_GET[$key]) && $_GET[$key] !== '') {
            $_SESSION['campaign_params'][$key] = test_input($_GET[$key]);
        }
    }
}

function getCampaignParams()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return [];
    }

    if (empty($_SESSION['campaign_params']) || !is_array($_SESSION['campaign_params'])) {
        return [];
    }

    return $_SESSION['campaign_params'];
}

function getCampaignQueryString($prefix = '?')
{
    $params = getCampaignParams();
    if (empty($params)) {
        return '';
    }

    return $prefix . http_build_query($params);
}

function appendCampaignToUrl($url)
{
    $params = getCampaignParams();
    if (empty($params)) {
        return $url;
    }

    $separator = (strpos($url, '?') !== false) ? '&' : '?';
    return $url . $separator . http_build_query($params);
}

function campaignParamValue($key)
{
    $params = getCampaignParams();
    return isset($params[$key]) ? htmlspecialchars($params[$key], ENT_QUOTES, 'UTF-8') : '';
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
    $subject = "Thank You for Joining us";
    $login_url = defined('SITE_URL') ? SITE_URL : 'https://ceuservices.com/login';
    $message = "
    <html>
    <head>
        <title>Welcome to CEU Trainers</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background-color: #0066cc; color: white; padding: 15px; text-align: center; }
            .content { padding: 20px; background-color: #f9f9f9; border: 1px solid #ddd; }
            .footer { font-size: 12px; text-align: center; margin-top: 20px; color: #666; }
            .button { display: inline-block; padding: 10px 20px; background-color: #0066cc; color: white; text-decoration: none; border-radius: 4px; }
            .credentials { background-color: #fff; padding: 15px; border-left: 4px solid #0066cc; margin: 15px 0; }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <h2>Welcome to CEU Trainers</h2>
            </div>
            <div class='content'>
                <p>Dear User,</p>
                <p>Thank you for registering with CEU Trainers! Your account has been successfully created.</p>
                
                <div class='credentials'>
                    <p><strong>Your Login Credentials:</strong></p>
                    <p>Username: <strong>{$email}</strong></p>
                    <p>Password: <strong>{$password}</strong></p>
                </div>
                
                <p>To access your account, please click the button below:</p>
                <p style='text-align: center;'>
                    <a href='{$login_url}' class='button'>Login Now</a>
                </p>
                <p>Or copy and paste this link in your browser: {$login_url}</p>
                
                <p>If you have any questions, please don't hesitate to contact our support team.</p>
                
                <p>Thanks & Regards,<br>CEU Trainers Team</p>
            </div>
            <div class='footer'>
                <p>© " . date('Y') . " CEU Trainers. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>";

    //Server settings
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging off for speed
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "mail.ceuservices.com"; // outgoing server
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "info@ceuservices.com"; // smtp username
    $mail->Password = "PWz=ox#}HO0W"; // smtp password
    $mail->SetFrom("info@ceuservices.com", "CEUservices Team");
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($email);

    $mail->Send();
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
        $mail->Host = "mail.info@ceuservices.com"; // outgoing server
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "info@ceuservices.com"; // smtp username
        $mail->Password = "PWz=ox#}HO0W"; // smtp password
        $mail->SetFrom("info@ceuservices.com", "CEUservices Team");
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