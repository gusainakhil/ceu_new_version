<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    pre {
        background-color: #f4f4f4;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        overflow-x: auto;
    }
    h3 {
        color: #333;
    }
</style>


<?php
include "connect.php";

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch the data from your table
$sql = "SELECT raw FROM rawdata ORDER BY `rawdata`.`sno` DESC LIMIT 4";
$result = $con->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
    // Get raw data
    $rawData = $row['raw'];

    // Attempt to decode JSON
    $jsonData = json_decode($rawData, true);

    // Debugging: Display raw data if decoding fails
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "<h3>Raw Data (Invalid JSON):</h3>";
        echo "<pre>" . htmlspecialchars($rawData) . "</pre>";
        echo "<p style='color: red;'>Error: " . json_last_error_msg() . "</p>";
    } else {
        echo "<h3>Decoded JSON Data:</h3>";
        echo "<pre>";
        print_r($jsonData);
        echo "</pre>";
    }
}

} else {
    echo "No records found.";
}

$con->close();
?>
