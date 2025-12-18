<?php
require '../config/config.php';

$id = (int) $_GET['id'];
$guru = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM guru WHERE id=$id"));
$kelas = mysqli_query($conn, "SELECT * FROM kelas");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Guru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3 class="mb-3">Edit Guru</h3>

        <form action="proses.php" method="post">
            <input type="hidden" name="id" value="<?= $guru['id'] ?>">

            <div class="mb-3">
                <label>Nama Guru</label>
                <input type="text" name="nama_guru" value="<?= htmlspecialchars($guru['nama_guru']) ?>"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kelas</label>
                <select name="kelas_id" class="form-control">
                    <option value="">-- Pilih Kelas --</option>
                    <?php while ($k = mysqli_fetch_assoc($kelas)) { ?>
                    <option value="<?= $k['id'] ?>" <?= $guru['kelas_id'] == $k['id'] ? 'selected' : '' ?>>
                        <?= $k['nama_kelas'] ?>
                    </option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" name="edit" class="btn btn-warning">Update</button>
            <a href="indexguru.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>