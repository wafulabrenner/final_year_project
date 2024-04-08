<?php
// Include your database connection file
include '../database/connection.php';

// Get the address from the AJAX request
$address = $_POST['address'];

// Prepare the query to fetch user details based on the address
$query = "SELECT * FROM schedule WHERE address = '$address'";
$result = mysqli_query($connection, $query);

// Check if any results were found
if (mysqli_num_rows($result) > 0) {
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    // No results found
    echo json_encode(array());
}

// Close the database connection
mysqli_close($connection);
?>
