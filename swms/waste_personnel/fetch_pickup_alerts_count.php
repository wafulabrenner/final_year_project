<?php
require_once '../database/connection.php';

// Get the current year and month
$currentYear = date('Y');
$currentMonth = date('m');

// Construct the SQL query with a condition to filter by the current month
$sql = "SELECT COUNT(*) as count FROM missed_pickups WHERE YEAR(date) = ? AND MONTH(date) = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $currentYear, $currentMonth);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

echo $count;
?>
