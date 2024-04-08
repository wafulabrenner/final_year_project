<?php
include '../database/connection.php';

try {
    // Fetch upcoming schedules
    $sql = "SELECT date, time, address FROM schedule WHERE date >= CURDATE() ORDER BY date ASC LIMIT 3";
    $result = $conn->query($sql);

    $upcomingSchedules = [];
    while ($row = $result->fetch_assoc()) {
        $upcomingSchedules[] = [
            'date' => $row['date'],
            'time' => $row['time'],
            'address' => $row['address']
        ];
    }

    // Return the data as JSON
    echo json_encode($upcomingSchedules);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
