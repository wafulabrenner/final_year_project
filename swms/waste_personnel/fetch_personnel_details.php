<?php
// Start the session
session_start();

// Include your database connection file
include_once '../database/connection.php';

// Check if username is set in session
if (!isset($_SESSION['work_id'])) {
    http_response_code(400);
    echo json_encode(array('message' => 'User not set in session'));
    exit();
}

// Fetch user details from the database
$stmt = $conn->prepare("SELECT * FROM waste_personnel WHERE work_id = ?");
$stmt->bind_param("s", $_SESSION['work_id']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    // If user not found in the database, return an error message
    http_response_code(404);
    echo json_encode(array('message' => 'User not found'));
    exit();
}

// Return user details as JSON
header('Content-Type: application/json');
echo json_encode($user);
?>
