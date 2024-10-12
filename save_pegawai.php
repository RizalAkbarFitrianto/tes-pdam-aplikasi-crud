<?php
include 'db.php';
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nip)) {
    // Kalau NIP ada, maka update data
    $query = "UPDATE pegawai SET nama = :nama, alamat = :alamat, tgl_lahir = :tgl_lahir, id_ruangan = :id_ruangan WHERE nip = :nip";
} else {
    // Kalau NIP tidak ada, maka tambah data
    $query = "INSERT INTO pegawai (nama, alamat, tgl_lahir, id_ruangan) VALUES (:nama, :alamat, :tgl_lahir, :id_ruangan)";
}

$stmt = $conn->prepare($query);
$stmt->bindParam(':nama', $data->nama);
$stmt->bindParam(':alamat', $data->alamat);
$stmt->bindParam(':tgl_lahir', $data->tgl_lahir);
$stmt->bindParam(':id_ruangan', $data->id_ruangan);

if(!empty($data->nip)) {
    $stmt->bindParam(':nip', $data->nip);
}

if($stmt->execute()) {
    echo json_encode(['message' => 'Data berhasil disimpan']);
} else {
    echo json_encode(['message' => 'Error gagal menyimpan']);
}
?>
