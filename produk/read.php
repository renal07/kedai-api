<?php
include '../db.php';

$sql = "SELECT * FROM produk";
$result = $conn->query($sql);

$produk = [];

while($row = $result->fetch_assoc()) {
  $produk[] = $row;
}

header('Content-Type: application/json');
echo json_encode($produk);
?>
