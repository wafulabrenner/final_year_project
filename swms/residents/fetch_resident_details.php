<?php
// Start the session
session_start();

// Include your database connection file
include_once '../database/connection.php';

// Check if username is set in session
if (!isset($_SESSION['username'])) {
    http_response_code(400);
    echo json_encode(array('message' => 'Username not set in session'));
    exit();
}

// Fetch user details from the database
$stmt = $conn->prepare("SELECT username, email, address, profile_pic FROM residents WHERE username = ?");
$stmt->bind_param("s", $_SESSION['username']);
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
