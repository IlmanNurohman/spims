<?php
require '../config/config.php';

if (!isset($_SESSION['siswa_id'])) {
    die('Akses tidak valid');
}

$siswa_id   = $_SESSION['siswa_id'];
$jenis_izin = $_POST['jenis_izin'];
$keterangan = $_POST['keterangan'];

$fotoName = null;

// ================= UPLOAD FOTO (OPSIONAL) =================
if (!empty($_FILES['foto']['name'])) {

    $allowedExt = ['jpg', 'jpeg', 'png'];
    $fileExt = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));

    if (!in_array($fileExt, $allowedExt)) {
        die('Format foto tidak diizinkan');
    }

    if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
        die('Ukuran foto maksimal 2MB');
    }

    $uploadDir = '../uploads/izin/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fotoName = uniqid('izin_') . '.' . $fileExt;
    move_uploaded_file($_FILES['foto']['tmp_name'], $uploadDir . $fotoName);
}
// ==========================================================

$query = "INSERT INTO izin 
    (siswa_id, jenis_izin, keterangan, foto, waktu_pengajuan, status)
    VALUES (?, ?, ?, ?, NOW(), 'menunggu')";

$stmt = $conn->prepare($query);
$stmt->bind_param("isss", $siswa_id, $jenis_izin, $keterangan, $fotoName);
$stmt->execute();

header("Location: index.php?status=success");
exit;