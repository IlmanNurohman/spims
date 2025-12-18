<?php
require '../config/config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'piket') {
    die('Akses ditolak');
}

$id = (int) $_GET['id'];

$data = mysqli_query($conn, "
    SELECT izin.*, siswa.nama
    FROM izin
    JOIN siswa ON izin.siswa_id = siswa.id
    WHERE izin.id = $id
");

$izin = mysqli_fetch_assoc($data);

if (!$izin) {
    die('Data tidak ditemukan');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Validasi Izin</title>
</head>

<body>

    <h3>Validasi Izin</h3>

    <p>Nama Siswa: <b><?= htmlspecialchars($izin['nama']) ?></b></p>
    <p>Jenis Izin: <?= htmlspecialchars($izin['jenis_izin']) ?></p>
    <p>Keterangan: <?= htmlspecialchars($izin['keterangan']) ?></p>

    <form method="post" action="proses_validasi.php">
        <input type="hidden" name="id" value="<?= $izin['id'] ?>">

        <label>Status</label><br>
        <select name="status" required>
            <option value="disetujui">Setujui</option>
            <option value="ditolak">Tolak</option>
        </select><br><br>

        <label>Catatan</label><br>
        <textarea name="catatan" required></textarea><br><br>

        <button type="submit">Simpan Validasi</button>
    </form>

</body>

</html>