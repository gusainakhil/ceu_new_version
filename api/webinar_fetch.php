<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allow all HTTP methods
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With"); // Allow specific headers
header('Content-Type: application/json');
include 'connect.php'; // Include your database connection file

$sql = "SELECT course_detail.id , course_detail.title ,course_detail.date,course_detail.duration , course_detail.slug , course_detail.time, course_detail.course_thumbail , speaker_info.name speaker_name , speaker_info.images speaker_image FROM course_detail JOIN speaker_info on course_detail.speaker= speaker_info.id WHERE course_detail.status = '1' ORDER BY STR_TO_DATE(course_detail.date, '%M %e, %Y') DESC";
$result = mysqli_query($con, $sql);

$courses = [];
while ($row = mysqli_fetch_assoc($result)) {
    $row['thumbnail_url'] = !empty($row['course_thumbail']) 
        ? "ceuadmin/assets/images/course/" . $row['course_thumbail'] 
        : "ceuadmin/assets/images/course/ceutrainers.webp";
    $row['timestamp'] = strtotime($row['date']);
    
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

    $courses[] = $row;
    
}

echo json_encode($courses);
