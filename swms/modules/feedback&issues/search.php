<?php
include '../connection.php'; // Include the database connection file

// Get the search term from the AJAX request
$searchTerm = $_GET['searchTerm'];

// Query to fetch feedback based on the search term
$query = "SELECT * FROM feedback WHERE address LIKE '%$searchTerm%'";
$result = mysqli_query($conn, $query);

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
