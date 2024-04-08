<?php
// Include the database connection file
include '../connection.php';

// Check if the id parameter is set
if(isset($_POST['id'])) {
    // Escape user input for security
    $id = $conn->real_escape_string($_POST['id']);

    // Determine the table based on the ID format
    $table = '';
    if (strpos($id, 'R') === 0) {
        $table = 'residents';
    } elseif (strpos($id, 'W') === 0) {
        $table = 'waste_personnel';
    }

    // Check if the table is determined
    if (!empty($table)) {
        // SQL query to delete user from the determined table
        $sql = "DELETE FROM $table WHERE id = '$id'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // User deleted successfully
            echo json_encode(array("success" => true));
        } else {
            // Failed to delete user
            echo json_encode(array("success" => false));
        }
    } else {
        // Invalid ID format
        echo json_encode(array("success" => false, "message" => "Invalid ID format"));
    }
} else {
    // No ID parameter provided
    echo json_encode(array("success" => false, "message" => "No ID provided"));
}

// Close the database connection
$conn->close();
?>
