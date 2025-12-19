<?php
require '../config/config.php';

if (isset($_POST['update'])) {

    $id = (int) $_POST['id'];
    $nama_kelas = mysqli_real_escape_string($conn, $_POST['nama_kelas']);

    $query = "UPDATE kelas SET nama_kelas = '$nama_kelas' WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: indexkelas.php?status=success");
        exit;
    } else {
        echo "Gagal update kelas";
    }
}