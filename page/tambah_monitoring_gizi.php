<?php
$carikode = mysqli_query($koneksi, "SELECT MAX(CAST(SUBSTRING(Id_monitoring, 3) AS UNSIGNED)) AS max_kode FROM monitoring_gizi") or die(mysqli_error($koneksi));
$datakode = mysqli_fetch_assoc($carikode);
$kode = $datakode && $datakode['max_kode'] !== null ? (int) $datakode['max_kode'] + 1 : 1;
$id_monitoring = 'MG' . str_pad($kode, 3, '0', STR_PAD_LEFT);

if(isset($_POST['simpan'])){
    $id_monitoring = mysqli_real_escape_string($koneksi, $_POST['id_monitoring']);
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $berat_badan = mysqli_real_escape_string($koneksi, $_POST['berat_badan']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);

    if(empty($id_pasien) || empty($tanggal) || empty($berat_badan)) {
        echo "<script>alert('Field Pasien, Tanggal, dan Berat Badan wajib diisi');</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO monitoring_gizi (Id_monitoring, Id_pasien, Tanggal, Berat_badan, Catatan) VALUES ('$id_monitoring', '$id_pasien', '$tanggal', '$berat_badan', '$catatan')");
        if($query){
            echo "<script>alert('Monitoring gizi berhasil ditambahkan');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=monitoring_gizi'>";
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
                <label>ID Monitoring</label>
                <input type="text" name="id_monitoring" value="<?= htmlspecialchars($id_monitoring); ?>" class="form-control" readonly>
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
                <label>Tanggal</label>
                <input type="date" name="tanggal" value="<?= date('Y-m-d'); ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Berat Badan (kg)</label>
                <input type="number" step="0.01" name="berat_badan" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=monitoring_gizi" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
