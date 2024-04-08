<?php
include '../database/connection.php'; 

// Fetch upcoming schedule data from the database
$query = "SELECT date, time, address, company FROM schedule WHERE date >= CURDATE() ORDER BY date ASC LIMIT 5";
$result = mysqli_query($conn, $query);

$scheduleData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $scheduleData[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Return the upcoming schedule data as JSON
header('Content-Type: application/json');
echo json_encode($scheduleData);
?>
