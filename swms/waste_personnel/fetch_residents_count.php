<?php
require_once '../database/connection.php';

$sql = "SELECT COUNT(*) as count FROM residents";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

echo $count;
