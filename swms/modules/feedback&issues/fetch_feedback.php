<?php
include '../connection.php'; // Include the database connection file

$query = "SELECT * FROM feedback";
$result = mysqli_query($conn, $query); // Use the $conn variable for the database connection

if (!$result) {
    die('Query failed: ' . mysqli_error($conn));
}

$feedbackData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $feedbackData[] = $row;
}

echo json_encode($feedbackData);

mysqli_close($conn);
?>
