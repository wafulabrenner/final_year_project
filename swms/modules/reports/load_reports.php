<?php
// Include the connection file
include '../connection.php';

// Get the report type and date range from the AJAX request
$reportType = 'missed_pickups'; // Set report type to 'missed_pickups'
$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : null;
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : null;

// Modify the query based on the selected report type and date range
if (!$startDate || !$endDate) {
    $sql = "SELECT * FROM missed_pickups";
} else {
    $sql = "SELECT * FROM missed_pickups WHERE date BETWEEN '$startDate' AND '$endDate'";
}

$result = $conn->query($sql);

$reports = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reports[] = $row;
    }
}

// Return the report data as JSON
echo json_encode($reports);

$conn->close();
?>
