<?php
require '../config/config.php';

// Proteksi role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'piket') {
    die('Akses ditolak');
}

// Header agar browser mengunduh sebagai Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_izin_valid_" . date('Ymd') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

// Query hanya data yang sudah disetujui
$query = mysqli_query($conn, "
    SELECT 
        siswa.nama,
        kelas.nama_kelas,
        izin.jenis_izin,
        izin.keterangan,
        izin.waktu_pengajuan,
        izin.waktu_keluar,
        izin.waktu_masuk,
        izin.catatan
    FROM izin
    JOIN siswa ON izin.siswa_id = siswa.id
    JOIN kelas ON siswa.kelas_id = kelas.id
    WHERE izin.status = 'disetujui'
    ORDER BY izin.waktu_pengajuan ASC
");
?>

<table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Jenis Izin</th>
            <th>Keterangan</th>
            <th>Waktu Pengajuan</th>
            <th>Waktu Keluar</th>
            <th>Waktu Masuk</th>
            <th>Catatan Validasi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['nama']}</td>";
            echo "<td>{$row['nama_kelas']}</td>";
            echo "<td>{$row['jenis_izin']}</td>";
            echo "<td>{$row['keterangan']}</td>";
            echo "<td>" . date('d-m-Y H:i', strtotime($row['waktu_pengajuan'])) . "</td>";
            echo "<td>" . ($row['waktu_keluar'] ? date('d-m-Y H:i', strtotime($row['waktu_keluar'])) : '-') . "</td>";
            echo "<td>" . ($row['waktu_masuk'] ? date('d-m-Y H:i', strtotime($row['waktu_masuk'])) : '-') . "</td>";
            echo "<td>{$row['catatan']}</td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </tbody>
</table>