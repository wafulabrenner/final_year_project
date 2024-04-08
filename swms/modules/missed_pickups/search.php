<?php
include_once '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];

    // Perform a database query based on the search query
    $sql = "SELECT * FROM missed_pickups WHERE area LIKE '%$search%' OR address LIKE '%$search%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output table rows
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['area']}</td>";
            echo "<td>{$row['address']}</td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['complaint']}</td>";
            
           
           
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No results found</td></tr>";
    }

    $conn->close();
}
?>
