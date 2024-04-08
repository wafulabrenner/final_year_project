<?php
// Include the database connection file
include_once './database/connection.php';

// Fetch schedule based on the provided address
if (isset($_POST['address'])) {
    $address = $_POST['address'];

    $sql = "SELECT * FROM schedule WHERE address LIKE '%$address%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "Area: " . $row["area"] . "<br>";
            echo "Address: " . $row["address"] . "<br>";
            echo "Date: " . $row["date"] . "<br>";
            echo "Time: " . $row["time"] . "<br>";
            echo "Company In Charge: " . $row["company"] . "<br>";
            // Add more schedule details as needed
        }
    } else {
        echo "No schedule found for the address.";
    }
}

$conn->close();
?>
