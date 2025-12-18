<?php
require '../../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die('Akses ditolak');
}
$user_id = $_POST['user_id'];
$tanggal = $_POST['tanggal_piket'];
$keterangan = $_POST['keterangan'] ?? null;

// Cegah jadwal ganda di tanggal yang sama
$cek = mysqli_query($conn, "
    SELECT id FROM jadwal_piket
    WHERE user_id = '$user_id'
    AND tanggal_piket = '$tanggal'
");

if (mysqli_num_rows($cek) > 0) {
    header('Location: index.php?status=duplicate');
    exit;
}

mysqli_query($conn, "
    INSERT INTO jadwal_piket (user_id, tanggal_piket, keterangan)
    VALUES ('$user_id', '$tanggal', '$keterangan')
");

header('Location: index.php?status=success');
exit;