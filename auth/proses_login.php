<?php
require '../config/config.php';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        switch ($user['role']) {

            case 'admin':
                header("Location: ../superadmin/index.php");
                break;

            case 'piket':
                header("Location: ../ptgpiket/dashboard.php");
                break;

            case 'wali':
                header("Location: ../guru/index.php");
                break;

            case 'siswa':

                // 🔑 AMBIL siswa.id
                $user_id = $user['id'];

                $qSiswa = mysqli_query($conn, "SELECT id FROM siswa WHERE user_id = $user_id");
                $siswa  = mysqli_fetch_assoc($qSiswa);

                if (!$siswa) {
                    die("Akun siswa belum terdaftar di tabel siswa");
                }

                $_SESSION['siswa_id'] = $siswa['id'];

                header("Location: ../siswa/dashboard.php");
                break;
        }

    } else {
        echo "<script>alert('Username atau password salah'); window.location='../login.php';</script>";
    }
}