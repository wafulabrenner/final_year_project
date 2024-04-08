<?php
// Include the connection file
include '../connection.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the feedback data from the POST request
    $address = $_POST['address'];
    $date = $_POST['date'];
    $feedback = $_POST['feedback'];

    // Prepare the SQL query to insert the feedback into the database
    $sql = "INSERT INTO feedback (address, date, feedback) VALUES ('$address', '$date', '$feedback')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Return success message
        echo json_encode(['status' => 'success', 'message' => 'Feedback submitted successfully']);
    } else {
        // Return error message
        echo json_encode(['status' => 'error', 'message' => 'Failed to submit feedback']);
    }

    // Close the database connection
    $conn->close();
}
?>
