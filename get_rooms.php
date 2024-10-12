<?php
include 'db.php';
header("Content-Type: application/json");

$query = "SELECT * FROM ruangan";
$stmt = $conn->prepare($query);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
