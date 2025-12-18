<form action="ijin_submit.php" method="post">
    <input type="hidden" name="siswa_id" value="<?= $_SESSION['siswa_id']; ?>">

    <label>Jenis Izin</label>
    <select name="jenis_izin" required>
        <option value="">-- Pilih Jenis Izin --</option>
        <option value="Sakit">Sakit</option>
        <option value="Izin Keluarga">Izin Keluarga</option>
        <option value="Keperluan Mendesak">Keperluan Mendesak</option>
        <option value="Keperluan Lain">Keperluan Lain</option>
    </select>

    <label>Keterangan</label>
    <textarea name="keterangan" required></textarea>

    <button type="submit">Ajukan Izin</button>

    <a href="index.php">kembali</a>
</form>