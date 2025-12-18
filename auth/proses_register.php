<?php
require '../config/config.php';

if (isset($_POST['register'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $kelas_id = (int) $_POST['kelas_id'];
    $role     = 'siswa';

    mysqli_begin_transaction($conn);

    try {
        // 1️⃣ INSERT users
        mysqli_query($conn, "
            INSERT INTO users (username, password, role)
            VALUES ('$username', '$password', '$role')
        ");

        $user_id = mysqli_insert_id($conn);

        // 2️⃣ INSERT siswa
        mysqli_query($conn, "
            INSERT INTO siswa (user_id, nama, kelas_id)
            VALUES ($user_id, '$nama', $kelas_id)
        ");

        mysqli_commit($conn);
        // Redirect ke login setelah berhasil
        header("Location: login.php?status=success");
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Register gagal";
    }
}