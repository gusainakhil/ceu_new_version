<?php
include "connect.php"; // Database connection

$ip_address = $_SERVER['REMOTE_ADDR'];

// Sirf wohi data fetch kare jo 2 din se purana na ho, aur latest data sabse pehle aaye
$query = "SELECT * FROM checkout_data WHERE created_at >= NOW() - INTERVAL 7 DAY ORDER BY id DESC";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' width='100%' cellpadding='10' cellspacing='0'>";
    echo "<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Company Name</th>
            <th>Job Profile</th>
            <th>Phone Number</th>
            <th>City</th>
            <th>State</th>
            <th>Pin Code</th>
            <th>Address 1</th>
            <th>Address 2</th>
        </tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['fname']}</td>
                <td>{$row['lname']}</td>
                <td>{$row['email']}</td>
                <td>{$row['company_name']}</td>
                <td>{$row['job_profile']}</td>
                <td>{$row['number']}</td>
                <td>{$row['city']}</td>
                <td>{$row['state']}</td>
                <td>{$row['pin_code']}</td>
                <td>{$row['address1']}</td>
                <td>{$row['address2']}</td>
            </tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No data found in the last 2 days!</p>";
}
?>
