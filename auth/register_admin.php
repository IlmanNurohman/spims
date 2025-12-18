<?php
require '../config/config.php';

if (isset($_POST['register'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = 'admin';

    mysqli_begin_transaction($conn);

    try {
        // INSERT users (admin)
        mysqli_query($conn, "
            INSERT INTO users (username, password, role)
            VALUES ('$username', '$password', '$role')
        ");

        mysqli_commit($conn);

        // Redirect setelah berhasil
        header("Location: login.php?status=admin_created");
        exit;

    } catch (Exception $e) {
        mysqli_rollback($conn);
        echo "Register admin gagal";
    }
}