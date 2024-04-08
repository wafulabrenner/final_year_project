<?php
// Include your connection.php file
include_once '../database/connection.php';

// Get current date
$currentDate = date('Y-m-d');

// Query to fetch pickups for the day
$sql = "SELECT * FROM schedule WHERE date = '$currentDate'";
$result = $conn->query($sql);

$pickupData = array();

if ($result->num_rows > 0) {
    // Fetching rows as associative arrays
    while ($row = $result->fetch_assoc()) {
        $pickupData[] = $row;
    }
}

// Close database connection (assuming $conn is your database connection variable)
$conn->close();

// Return pickup data as JSON
header('Content-Type: application/json');
echo json_encode($pickupData);
?>
