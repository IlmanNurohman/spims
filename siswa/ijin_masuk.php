<?php
require '../config/config.php';

$data = $conn->query("
    SELECT i.*, s.nama_siswa
    FROM ijin i
    JOIN siswa s ON i.siswa_id = s.id
    WHERE status = 'menunggu'
");
?>

<table border="1">
    <tr>
        <th>Nama Siswa</th>
        <th>Jenis Izin</th>
        <th>Keterangan</th>
        <th>Waktu</th>
        <th>Aksi</th>
    </tr>

    <?php while ($row = $data->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['nama_siswa']; ?></td>
        <td><?= $row['jenis_izin']; ?></td>
        <td><?= $row['keterangan']; ?></td>
        <td><?= $row['waktu_pengajuan']; ?></td>
        <td>
            <a href="ijin_validasi.php?id=<?= $row['id']; ?>&aksi=terima">Terima</a> |
            <a href="ijin_validasi.php?id=<?= $row['id']; ?>&aksi=tolak">Tolak</a>
        </td>
    </tr>
    <?php } ?>
</table>