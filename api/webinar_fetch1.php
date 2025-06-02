<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow all HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With"); // Allow specific headers
header('Content-Type: application/json');

include 'connect.php'; // Include your database connection file

// Fetch the API key from the Authorization header
$headers = getallheaders();
$authKey = isset($headers['Authorization']) ? trim($headers['Authorization']) : '';

// Validate the API key
if (empty($authKey)) {
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized: API key is missing."]);
    exit;
}

$sql = "SELECT * FROM api_clients WHERE api_key = ? AND status = 1";
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $authKey);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(403);
    echo json_encode(["error" => "Forbidden: Invalid API key."]);
    exit;
}

// Proceed with the API logic
$sql = "SELECT course_detail.id, course_detail.title, course_detail.date, course_detail.duration, 
        course_detail.slug, course_detail.course_thumbail, speaker_info.name AS speaker_name 
        FROM course_detail 
        JOIN speaker_info ON course_detail.speaker = speaker_info.id 
        WHERE course_detail.status = '1' 
        ORDER BY STR_TO_DATE(course_detail.date, '%M %e, %Y') DESC";

$result = mysqli_query($con, $sql);

$courses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['thumbnail_url'] = !empty($row['course_thumbail']) 
        ? "ceuadmin/assets/images/course/" . $row['course_thumbail'] 
        : "ceuadmin/assets/images/course/ceutrainers.webp";
    $row['timestamp'] = strtotime($row['date']);
    $courses[] = $row;
}

echo json_encode($courses);
