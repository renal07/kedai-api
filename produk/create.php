<?php
include '../db.php';

// Ambil input dari request body (JSON)
$data = json_decode(file_get_contents("php://input"));

if (
  isset($data->nama) &&
  isset($data->deskripsi) &&
  isset($data->harga) &&
  isset($data->gambar)
) {
  $nama = $data->nama;
  $deskripsi = $data->deskripsi;
  $harga = $data->harga;
  $gambar = $data->gambar;

  $sql = "INSERT INTO produk (nama, deskripsi, harga, gambar)
          VALUES ('$nama', '$deskripsi', '$harga', '$gambar')";

  if ($conn->query($sql) === TRUE) {
    http_response_code(201); // Created
    echo json_encode(["message" => "Produk berhasil ditambahkan."]);
  } else {
    http_response_code(500);
    echo json_encode(["message" => "Gagal menambahkan produk.", "error" => $conn->error]);
  }
} else {
  http_response_code(400); // Bad Request
  echo json_encode(["message" => "Data tidak lengkap."]);
}
?>
