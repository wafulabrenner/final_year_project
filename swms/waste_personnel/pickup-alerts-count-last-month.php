<?php
require_once '../database/connection.php';

// Get the current year and month
$currentYear = date('Y');
$currentMonth = date('m');

// Calculate the previous month
$previousYear = $currentYear;
$previousMonth = $currentMonth - 1;
if ($previousMonth == 0) {
    $previousMonth = 12;
    $previousYear--;
}

// Construct the SQL query with a condition to filter by the previous month
$sql = "SELECT COUNT(*) as count FROM missed_pickups WHERE YEAR(date) = ? AND MONTH(date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $previousYear, $previousMonth);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

echo $count;
?>
