<?php
// Include your database connection file
include '../connection.php';

// Query to fetch data from the schedule table
$query = "SELECT * FROM schedule";
$result = mysqli_query($conn, $query);

// Fetch data and output it as JSON
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Close the database connection
mysqli_close($conn);

// Output data as JSON
echo json_encode($data);
?>
