<?php
include '../db.php';

// Ambil input dari request body (JSON)
$data = json_decode(file_get_contents("php://input"));

if (isset($data->id)) {
  $id = $data->id;

  $sql = "DELETE FROM produk WHERE id = $id";

  if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Produk berhasil dihapus."]);
  } else {
    http_response_code(500);
    echo json_encode(["message" => "Gagal menghapus produk.", "error" => $conn->error]);
  }
} else {
  http_response_code(400); // Bad Request
  echo json_encode(["message" => "ID produk tidak ditemukan."]);
}
?>
