<?php
include 'db.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

$query = "DELETE FROM pegawai WHERE nip = :nip";
$stmt = $conn->prepare($query);
$stmt->bindParam(':nip', $data->nip);

if($stmt->execute()) {
    echo json_encode(['message' => 'Data berhasil dihapus']);
} else {
    echo json_encode(['message' => 'Error gagal menghapus']);
}
?>
