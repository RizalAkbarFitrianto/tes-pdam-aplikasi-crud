<?php
// include 'db.php';
// header("Content-Type: application/json");

// $query = "SELECT * FROM pegawai";
// $stmt = $conn->prepare($query);
// $stmt->execute();

// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// echo json_encode($result);

include 'db.php';
header("Content-Type: application/json");

if(isset($_GET['nip'])) {
    // Fetch a single employee by NIP
    $query = "SELECT * FROM pegawai WHERE nip = :nip";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nip', $_GET['nip']);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode($result);
} else {
    // Fetch all employees
    $query = "SELECT * FROM pegawai";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
}

?>
