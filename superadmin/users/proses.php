<?php
require '../../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die('Akses ditolak');
}

/* TAMBAH */
if (isset($_POST['tambah'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'];

    mysqli_query($conn, "
        INSERT INTO users (username, password, role)
        VALUES ('$username', '$password', '$role')
    ");

    header("Location: index.php");
}

/* EDIT */
if (isset($_POST['edit'])) {

    $id = (int) $_POST['id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$id";
    } else {
        $sql = "UPDATE users SET username='$username', role='$role' WHERE id=$id";
    }

    mysqli_query($conn, $sql);

    header("Location: index.php?status=success");
    exit;
}


/* HAPUS */
if (isset($_GET['hapus'])) {

    $id = (int) $_GET['hapus'];

    // cek apakah user dipakai di tabel siswa
    $cek = mysqli_query($conn, "SELECT id FROM siswa WHERE user_id = $id");

    if (mysqli_num_rows($cek) > 0) {
        header("Location: index.php?status=used");
        exit;
    }

    mysqli_query($conn, "DELETE FROM users WHERE id = $id");

    header("Location: index.php?status=deleted");
    exit;
}