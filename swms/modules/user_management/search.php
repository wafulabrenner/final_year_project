<?php
// Include the database connection file
include '../connection.php';

// Initialize variables
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchCondition = '';

// Prepare search condition
if (!empty($search)) {
    $searchCondition = "WHERE username LIKE '%$search%' OR email LIKE '%$search%' OR address LIKE '%$search%'";
}

// Fetch user data
$sql = "SELECT id, username, email, address, NULL AS company_name FROM residents
        UNION ALL
        SELECT id, username, email, address, company_name FROM waste_personnel
        $searchCondition";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode(array()); // No users found
}

$conn->close();
?>
