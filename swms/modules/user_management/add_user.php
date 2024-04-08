<?php
include '../connection.php';

// Check if the required fields are set in the $_POST array
if (!isset($_POST['username'], $_POST['password'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['address'], $_POST['role'])) {
    $response = array('success' => false, 'message' => 'Missing required fields');
    echo json_encode($response);
    exit;
}

// Sanitize input data
$username = mysqli_real_escape_string($conn, $_POST['username']);
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$role = mysqli_real_escape_string($conn, $_POST['role']);

// Check role and set additional fields accordingly
if ($role === 'Waste Personnel') {
    $workId = mysqli_real_escape_string($conn, $_POST['workId']);
    $companyName = mysqli_real_escape_string($conn, $_POST['companyName']);
} else if ($role === 'Resident') {
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
}

$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Prepare the query based on the role
if ($role === 'Waste Personnel') {
    $query = "INSERT INTO waste_personnel (username, password, first_name, last_name, email, address, work_id, company_name, accept_terms) VALUES ('$username', '$hashedPassword', '$firstname', '$lastname', '$email', '$address', '$workId', '$companyName', 0)";
} else if ($role === 'Resident') {
    $query = "INSERT INTO residents (username, password, first_name, last_name, email, address, notifications, phone_number) VALUES ('$username', '$hashedPassword', '$firstname', '$lastname', '$email', '$address', 0, '$phoneNumber')";
}

// Execute the query
if (mysqli_query($conn, $query)) {
    $response = array('success' => true, 'message' => 'User added successfully');
    echo json_encode($response);
} else {
    $response = array('success' => false, 'message' => 'Failed to add user');
    echo json_encode($response);
}

mysqli_close($conn);
?>

