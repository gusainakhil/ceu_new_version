<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');

include 'connect.php';

// Get the ID from the POST request
$data = json_decode(file_get_contents('php://input'), true); // Get POST body as JSON
$id = isset($data['id']) ? (int)$data['id'] : 0;  // Make sure it's an integer

// Check if ID is valid
if ($id <= 0) {
    echo json_encode([
        "error" => "Invalid ID"
    ]);
    exit;
}

// SQL query to fetch the course details using the passed ID
$sql = "SELECT course_detail.id , course_detail.title ,course_detail.date, course_detail.duration , course_detail.slug , course_detail.time, course_detail.course_thumbail , course_detail.selling_option , course_detail.description, course_detail.certificate, speaker_info.name as speaker_name , speaker_info.bio as speaker_bio, speaker_info.designation , speaker_info.images FROM course_detail JOIN speaker_info on course_detail.speaker= speaker_info.id WHERE course_detail.status = '1' AND course_detail.id = $id";

$query_result = mysqli_query($con, $sql);

if (!$query_result) {
    echo json_encode([
        "error" => "Query execution failed",
        "message" => mysqli_error($con)
    ]);
    exit;
}

if (mysqli_num_rows($query_result) === 0) {
    echo json_encode([
        "error" => "No data found",
        "query" => $sql
    ]);
    exit;
}

$result = [];

while ($row = mysqli_fetch_assoc($query_result)) {
    // Decode selling_option
    if (isset($row['selling_option']) && !empty($row['selling_option'])) {
        $selling_option_string = str_replace(["\n", "  "], "", $row['selling_option']);
        eval('$selling_option = ' . $selling_option_string . ';');
        $row['selling_option'] = json_encode($selling_option);
    }

    // Time conversion to multiple zones in 24-hour format
    try {
        $ist_time = new DateTime($row['time'], new DateTimeZone('Asia/Kolkata'));

        $row['time'] = [
            'ist' => $ist_time->format('H:i:s'),
            'est' => (clone $ist_time)->setTimezone(new DateTimeZone('America/New_York'))->format('H:i:s'),
            'cst' => (clone $ist_time)->setTimezone(new DateTimeZone('America/Chicago'))->format('H:i:s'),
            'mst' => (clone $ist_time)->setTimezone(new DateTimeZone('America/Denver'))->format('H:i:s'),
            'pst' => (clone $ist_time)->setTimezone(new DateTimeZone('America/Los_Angeles'))->format('H:i:s'),
        ];
    } catch (Exception $e) {
        $row['time'] = [
            'error' => 'Invalid time format',
            'original' => $row['time']
        ];
    }

    $result[] = $row;
}


echo json_encode($result);  // Output the final result in JSON format
?>