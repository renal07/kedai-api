<?php
// Header untuk semua method
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

// Jika request adalah OPTIONS, hentikan di sini (respon preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
include '../db.php';

$data = json_decode(file_get_contents("php://input"));

if (
  isset($data->nama) &&
  isset($data->harga) &&
  isset($data->gambar)
) {
  $nama = $data->nama;
  $harga = $data->harga;
  $gambar = $data->gambar;

  // Optional: deskripsi default jika tidak dikirim
  $deskripsi = isset($data->deskripsi) ? $data->deskripsi : "Deskripsi tidak tersedia";

  // SQL INSERT
  $sql = "INSERT INTO produk (nama, deskripsi, harga, gambar)
          VALUES ('$nama', '$deskripsi', '$harga', '$gambar')";

  // Eksekusi dan respon
  if ($conn->query($sql) === TRUE) {
    http_response_code(201); // Created
    echo json_encode(["message" => "Produk berhasil ditambahkan."]);
  } else {
    http_response_code(500); // Server error
    echo json_encode(["message" => "Gagal menambahkan produk.", "error" => $conn->error]);
  }
} else {
  http_response_code(400); // Bad Request
  echo json_encode(["message" => "Data tidak lengkap."]);
}
//ok
?>
