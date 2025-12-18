<?php
require '../../config/config.php';

if ($_SESSION['role'] !== 'admin') {
    die('Akses ditolak');
}

$id = $_POST['id'];
$tanggal = $_POST['tanggal_piket'];
$keterangan = $_POST['keterangan'];

mysqli_query($conn, "
    UPDATE jadwal_piket
    SET tanggal_piket = '$tanggal',
        keterangan = '$keterangan'
    WHERE id = '$id'
");

header('Location: index.php?status=success');
exit;