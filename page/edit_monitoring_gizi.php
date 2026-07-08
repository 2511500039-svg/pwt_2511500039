<?php
$kd = isset($_GET['kd']) ? mysqli_real_escape_string($koneksi, $_GET['kd']) : '';
$edit = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM monitoring_gizi WHERE Id_monitoring='$kd'"));
if(!$edit) {
    echo '<div class="alert alert-danger">Data monitoring gizi tidak ditemukan.</div>';
    return;
}
if(isset($_POST['simpan'])){
    $id_monitoring = mysqli_real_escape_string($koneksi, $_POST['id_monitoring']);
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $berat_badan = mysqli_real_escape_string($koneksi, $_POST['berat_badan']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);
    $update = mysqli_query($koneksi, "UPDATE monitoring_gizi SET Id_pasien='$id_pasien', Tanggal='$tanggal', Berat_badan='$berat_badan', Catatan='$catatan' WHERE Id_monitoring='$id_monitoring'");
    if ($update) {
        echo "<script>alert('Monitoring gizi berhasil diupdate');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=monitoring_gizi'>";
        exit;
    } else {
        echo "<script>alert('Gagal update: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Monitoring Gizi</h1>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>ID Monitoring</label>
                        <input type="text" name="id_monitoring" value="<?= htmlspecialchars($edit['Id_monitoring']); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pasien</label>
                        <select name="id_pasien" class="form-control" required>
                            <option value="">-- Pilih Pasien --</option>
                            <?php
                            $pasien = mysqli_query($koneksi, "SELECT Id_pasien, Nm_pasien FROM pasien ORDER BY Nm_pasien ASC");
                            while($ps = mysqli_fetch_assoc($pasien)) {
                                $selected = $ps['Id_pasien'] === $edit['Id_pasien'] ? 'selected' : '';
                                echo "<option value='{$ps['Id_pasien']}' $selected>" . htmlspecialchars($ps['Nm_pasien']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="<?= htmlspecialchars($edit['Tanggal']); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Berat Badan (kg)</label>
                        <input type="number" step="0.01" name="berat_badan" value="<?= htmlspecialchars($edit['Berat_badan']); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea name="catatan" class="form-control"><?= htmlspecialchars($edit['Catatan']); ?></textarea>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=monitoring_gizi" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
