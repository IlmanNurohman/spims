<?php
require '../config/config.php';
?>

<h3>Tambah Kelas</h3>

<form method="post" action="kelas_simpan.php">
    <label>Nama Kelas</label><br>
    <input type="text" name="nama_kelas" placeholder="Contoh: X RPL 1" required>
    <br><br>
    <button type="submit" name="simpan">Simpan</button>
</form>