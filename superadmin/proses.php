<?php
require '../config/config.php';

/* TAMBAH */
if (isset($_POST['tambah'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama_guru']);
    $kelas = $_POST['kelas_id'] ?: NULL;

    mysqli_query($conn, "
        INSERT INTO guru (nama_guru, kelas_id)
        VALUES ('$nama', " . ($kelas ? $kelas : 'NULL') . ")
    ");

    header("Location: indexguru.php?status=success");
}

/* EDIT */
if (isset($_POST['edit'])) {
    $id    = (int) $_POST['id'];
    $nama  = mysqli_real_escape_string($conn, $_POST['nama_guru']);
    $kelas = $_POST['kelas_id'] ?: NULL;

    mysqli_query($conn, "
        UPDATE guru SET
            nama_guru = '$nama',
            kelas_id = " . ($kelas ? $kelas : 'NULL') . "
        WHERE id = $id
    ");

    header("Location: indexguru.php");
}

/* HAPUS */
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM guru WHERE id = $id");
    header("Location: indexguru.php");
}