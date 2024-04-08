<?php
include '../database/connection.php'; 

// Fetch the number of missed pickups for the current month
$query = "SELECT COUNT(*) AS missed_pickups_this_month FROM missed_pickups WHERE MONTH(date) = MONTH(NOW()) AND YEAR(date) = YEAR(NOW())";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$missedPickupsThisMonth = $row['missed_pickups_this_month'];

// Close the database connection
mysqli_close($conn);

// Return the number of missed pickups this month as JSON
header('Content-Type: application/json');
echo json_encode($missedPickupsThisMonth);
?>
