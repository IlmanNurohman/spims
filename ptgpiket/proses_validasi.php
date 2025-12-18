<?php
require '../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'piket') {
    die('Akses ditolak');
}

$id     = (int) $_POST['id'];
$status = $_POST['status'];
$catatan = $_POST['catatan'];

$petugas_id = $_SESSION['user_id']; // users.id

$query = "UPDATE izin SET
    status = ?,
    catatan = ?,
    validasi_oleh = ?
WHERE id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ssii", $status, $catatan, $petugas_id, $id);
$stmt->execute();

header("Location: index.php?status=success");