<?php
require '../config/config.php';

if (!isset($_GET['id'])) {
    die('Data tidak ditemukan');
}

$id = (int) $_GET['id'];

$query = mysqli_query($conn, "
    SELECT 
        izin.*,
        s.nama AS nama_siswa,
        u.username AS petugas
    FROM izin
    JOIN siswa s ON izin.siswa_id = s.id
    LEFT JOIN users u ON izin.validasi_oleh = u.id
    WHERE izin.id = $id
");

$data = mysqli_fetch_assoc($query);

$tanggal_pengajuan = '-';
if (!empty($data['waktu_pengajuan'])) {
    $tanggal_pengajuan = date('d F Y, H:i', strtotime($data['waktu_pengajuan']));
}


if (!$data) {
    die('Data tidak valid');
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Detail Izin Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
    body {
        margin: 0;
        padding: 0;
        background: #f1f3f6;
        font-family: Arial, Helvetica, sans-serif;
    }

    .wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .card {
        background: #ffffff;
        width: 100%;
        max-width: 420px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #28a745, #218838);
        color: #fff;
        text-align: center;
        padding: 18px;
    }

    .card-header h2 {
        margin: 0;
        font-size: 18px;
        letter-spacing: 1px;
    }

    .card-header p {
        margin-top: 6px;
        font-size: 13px;
        opacity: 0.9;
    }

    .card-body {
        padding: 20px;
    }

    .item {
        margin-bottom: 14px;
    }

    .label {
        font-size: 13px;
        color: #777;
        margin-bottom: 3px;
    }

    .value {
        font-size: 15px;
        font-weight: bold;
        color: #222;
    }

    .divider {
        height: 1px;
        background: #e5e5e5;
        margin: 15px 0;
    }

    .status {
        display: inline-block;
        background: #28a745;
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.5px;
    }

    .card-footer {
        background: #f8f9fa;
        text-align: center;
        padding: 12px;
        font-size: 12px;
        color: #555;
    }

    .valid {
        color: #28a745;
        font-weight: bold;
    }
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="card">

            <div class="card-header">
                <h2>DETAIL IZIN SISWA</h2>
                <p>Izin Resmi Telah Disetujui</p>
            </div>

            <div class="card-body">

                <div class="item">
                    <div class="label">Nama Siswa</div>
                    <div class="value"><?= htmlspecialchars($data['nama_siswa']) ?></div>
                </div>

                <div class="item">
                    <div class="label">Tanggal Pengajuan</div>
                    <div class="value"><?= $tanggal_pengajuan ?></div>
                </div>


                <div class="divider"></div>

                <div class="item">
                    <div class="label">Jenis Izin</div>
                    <div class="value"><?= htmlspecialchars($data['jenis_izin']) ?></div>
                </div>

                <div class="item">
                    <div class="label">Keterangan</div>
                    <div class="value"><?= htmlspecialchars($data['keterangan']) ?></div>
                </div>

                <div class="item">
                    <div class="label">Status</div>
                    <span class="status"><?= strtoupper($data['status']) ?></span>
                </div>

                <div class="item">
                    <div class="label">Disetujui Oleh</div>
                    <div class="value"><?= htmlspecialchars($data['petugas'] ?? '-') ?></div>
                </div>

            </div>

            <div class="card-footer">
                <span class="valid">✔ QR VALID</span> • Sistem Izin Siswa
            </div>

        </div>
    </div>

</body>

</html>