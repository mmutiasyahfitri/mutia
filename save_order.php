<?php
include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);

$nama = $data['nama'];
$alamat = $data['alamat'];
$produk = $data['produk'];
$total = $data['total'];

// Simpan ke database
$stmt = $conn->prepare("INSERT INTO riwayat_pemesanan (nama_pemesan, alamat_pemesan, isi_pesanan, total) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $nama, $alamat, $produk, $total);

if ($stmt->execute()) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
}
?>
