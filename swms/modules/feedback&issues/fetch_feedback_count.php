<?php
// Include the connection file
include '../connection.php';

// Fetch the count of feedbacks from the database
$sql = "SELECT COUNT(*) AS count FROM feedback";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $count = $row['count'];
    echo $count;
} else {
    echo 0;
}

$conn->close();
?>
