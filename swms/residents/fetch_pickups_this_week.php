<?php
include '../database/connection.php'; 

// Fetch the number of pickups scheduled for the current week
$query = "SELECT COUNT(*) AS pickups_this_week FROM schedule WHERE YEARWEEK(date) = YEARWEEK(NOW())";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$pickupsThisWeek = $row['pickups_this_week'];

// Close the database connection
mysqli_close($conn);

// Return the number of pickups this week as JSON
header('Content-Type: application/json');
echo json_encode($pickupsThisWeek);
?>
