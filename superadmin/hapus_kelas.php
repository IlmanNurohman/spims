<?php
require '../config/config.php';

// HAPUS KELAS
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    mysqli_query($conn, "DELETE FROM kelas WHERE id = $id");

    header("Location: indexkelas.php?status=success");
    exit;
}