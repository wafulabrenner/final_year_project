<?php
// Include the database connection file
include '../connection.php';

// Fetch user data
$sql = "SELECT id, username, email, address FROM residents
        UNION ALL
        SELECT id, username, email, address FROM waste_personnel";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    $users = array();
    while ($row = $result->fetch_assoc()) {
        // Assign role based on ID prefix
        $role = substr($row['id'], 0, 1) === 'R' ? 'Resident' : 'Waste Personnel';
        $row['role'] = $role;
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo json_encode(array()); // No users found
}

$conn->close();
?>
