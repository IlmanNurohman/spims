<?php
require '../config/config.php';

if (isset($_POST['simpan'])) {

    $nama_kelas = mysqli_real_escape_string($conn, $_POST['nama_kelas']);

    $query = "INSERT INTO kelas (nama_kelas)
              VALUES ('$nama_kelas')";

    if (mysqli_query($conn, $query)) {
       header("Location: indexkelas.php?status=success");
    } else {
        echo "Gagal menyimpan kelas";
    }
}