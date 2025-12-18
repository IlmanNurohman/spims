<?php
require '../config/config.php';

if (!isset($_SESSION['siswa_id'])) {
    die('Akses tidak valid');
}

$id = (int) $_POST['id'];

$stmt = $conn->prepare("
    UPDATE izin 
    SET waktu_masuk = NOW()
    WHERE id = ? AND waktu_masuk IS NULL
");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: index.php");