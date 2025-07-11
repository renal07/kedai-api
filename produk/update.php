<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
include '../db.php';


// Ambil input dari request body (JSON)
$data = json_decode(file_get_contents("php://input"));

if (
  isset($data->id) &&
  isset($data->nama) &&
  isset($data->deskripsi) &&
  isset($data->harga) &&
  isset($data->gambar)
) {
  $id = $data->id;
  $nama = $data->nama;
  $deskripsi = $data->deskripsi;
  $harga = $data->harga;
  $gambar = $data->gambar;

  $sql = "UPDATE produk SET 
            nama = '$nama',
            deskripsi = '$deskripsi',
            harga = '$harga',
            gambar = '$gambar'
          WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Produk berhasil diubah."]);
  } else {
    http_response_code(500);
    echo json_encode(["message" => "Gagal mengubah produk.", "error" => $conn->error]);
  }
} else {
  http_response_code(400); // Bad Request
  echo json_encode(["message" => "Data tidak lengkap."]);
}
?>
