<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include '../koneksi.php';

// sisanya tetap...


$data = json_decode(file_get_contents("php://input"), true);
$id = $data['id'];

$sql = "DELETE FROM login WHERE id=$id";
if (mysqli_query($conn, $sql)) {
  echo json_encode(["message" => "Akun berhasil dihapus"]);
} else {
  echo json_encode(["message" => "Gagal menghapus akun"]);
}
?>
