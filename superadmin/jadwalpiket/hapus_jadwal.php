<?php
require '../../config/config.php';

if ($_SESSION['role'] !== 'admin') {
    die('Akses ditolak');
}

$id = $_GET['id'];

mysqli_query($conn, "
    DELETE FROM jadwal_piket WHERE id = '$id'
");

header('Location: index.php?status=success');
exit;