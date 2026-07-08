<?php
$id = '';
$carikode = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(Id_jadwal, 4) AS UNSIGNED)) AS max_kode FROM jadwal_konsultasi") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_assoc($carikode);
$kode = $datakode && $datakode['max_kode'] !== null ? (int) $datakode['max_kode'] + 1 : 1;
$id_jadwal = 'JDK' . str_pad($kode, 3, '0', STR_PAD_LEFT);

if(isset($_POST['simpan'])){
    $id_jadwal = mysqli_real_escape_string($koneksi, $_POST['id_jadwal']);
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $id_ahligizi = mysqli_real_escape_string($koneksi, $_POST['id_ahligizi']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jam = mysqli_real_escape_string($koneksi, $_POST['jam']);

    if(empty($id_pasien) || empty($id_ahligizi) || empty($tanggal) || empty($jam)) {
        echo "<script>alert('Semua field wajib diisi');</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO jadwal_konsultasi (Id_jadwal, Id_pasien, Id_ahligizi, Tanggal, Jam) VALUES ('$id_jadwal', '$id_pasien', '$id_ahligizi', '$tanggal', '$jam')");
        if($query){
            echo "<script>alert('Jadwal konsultasi berhasil ditambahkan');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=jadwal_konsultasi'>";
            exit;
        } else {
            echo "<script>alert('Gagal menambahkan data: " . mysqli_error($koneksi) . "');</script>";
        }
    }
}
?>
<div class="card">
    <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label>ID Jadwal</label>
                <input type="text" name="id_jadwal" value="<?= htmlspecialchars($id_jadwal); ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Pasien</label>
                <select name="id_pasien" class="form-control" required>
                    <option value="">-- Pilih Pasien --</option>
                    <?php
                    $pasien = mysqli_query($koneksi, "SELECT Id_pasien, Nm_pasien FROM pasien ORDER BY Nm_pasien ASC");
                    while($ps = mysqli_fetch_assoc($pasien)) {
                        echo "<option value='{$ps['Id_pasien']}'>" . htmlspecialchars($ps['Nm_pasien']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Ahli Gizi</label>
                <select name="id_ahligizi" class="form-control" required>
                    <option value="">-- Pilih Ahli Gizi --</option>
                    <?php
                    $ahli = mysqli_query($koneksi, "SELECT Id_ahligizi, Nm_ahligizi FROM ahli_gizi ORDER BY Nm_ahligizi ASC");
                    while($ag = mysqli_fetch_assoc($ahli)) {
                        echo "<option value='{$ag['Id_ahligizi']}'>" . htmlspecialchars($ag['Nm_ahligizi']) . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jam</label>
                <input type="time" name="jam" value="08:00" class="form-control" required>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=jadwal_konsultasi" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
