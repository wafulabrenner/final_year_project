<?php
include '../database/connection.php';

try {
    // Get the current month name
    $currentMonth = date('F'); // Full month name (e.g., January, February, etc.)

    // Calculate the start and end dates of the current month
    $startDate = date('Y-m-01'); // First day of the current month
    $endDate = date('Y-m-t'); // Last day of the current month

    // Fetch daily missed pickups for each week from Monday to Friday in the current month
    $sql = "SELECT WEEK(date) as week, DAYNAME(date) as day, COUNT(*) as missed_pickups FROM missed_pickups WHERE date BETWEEN '$startDate' AND '$endDate' AND DAYOFWEEK(date) >= 2 AND DAYOFWEEK(date) <= 6 GROUP BY WEEK(date), DAY(date)";
    $result = $conn->query($sql);

    $chartData = [];
    while ($row = $result->fetch_assoc()) {
        $week = 'Week ' . $row['week'];
        switch ($row['day']) {
            case 'Monday':
                $day = 'Mon';
                break;
            case 'Tuesday':
                $day = 'Tue';
                break;
            case 'Wednesday':
                $day = 'Wed';
                break;
            case 'Thursday':
                $day = 'Thu';
                break;
            case 'Friday':
                $day = 'Fri';
                break;
            default:
                $day = '';
        }
        $chartData[$week][$day] = $row['missed_pickups'];
    }

    // Prepare data for Chart.js
    $labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
    $datasets = [];
    foreach ($chartData as $week => $data) {
        $formattedData = [];
        foreach ($labels as $label) {
            $formattedData[] = isset($data[$label]) ? $data[$label] : 0;
        }
        $datasets[] = [
            'label' => $week,
            'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
            'borderColor' => 'rgba(54, 162, 235, 1)',
            'borderWidth' => 1,
            'data' => $formattedData
        ];
    }

    $chartData = [
        'labels' => $labels,
        'datasets' => $datasets
    ];

    // Return the data as JSON
    echo json_encode($chartData);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
