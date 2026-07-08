<?php
$kd = isset($_GET['kd']) ? mysqli_real_escape_string($koneksi, $_GET['kd']) : '';
$jadwal = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM jadwal_konsultasi WHERE Id_jadwal='$kd'"));
if(!$jadwal) {
    echo '<div class="alert alert-danger">Data jadwal konsultasi tidak ditemukan.</div>';
    return;
}
if(isset($_POST['simpan'])){
    $id_jadwal = mysqli_real_escape_string($koneksi, $_POST['id_jadwal']);
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $id_ahligizi = mysqli_real_escape_string($koneksi, $_POST['id_ahligizi']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
    $jam = mysqli_real_escape_string($koneksi, $_POST['jam']);
    $update = mysqli_query($koneksi, "UPDATE jadwal_konsultasi SET Id_pasien='$id_pasien', Id_ahligizi='$id_ahligizi', Tanggal='$tanggal', Jam='$jam' WHERE Id_jadwal='$id_jadwal'");
    if ($update) {
        echo "<script>alert('Jadwal konsultasi berhasil diupdate');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=jadwal_konsultasi'>";
        exit;
    } else {
        echo "<script>alert('Gagal update: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Jadwal Konsultasi</h1>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>ID Jadwal</label>
                        <input type="text" name="id_jadwal" value="<?= htmlspecialchars($jadwal['Id_jadwal']); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pasien</label>
                        <select name="id_pasien" class="form-control" required>
                            <option value="">-- Pilih Pasien --</option>
                            <?php
                            $pasien = mysqli_query($koneksi, "SELECT Id_pasien, Nm_pasien FROM pasien ORDER BY Nm_pasien ASC");
                            while($ps = mysqli_fetch_assoc($pasien)) {
                                $selected = $ps['Id_pasien'] === $jadwal['Id_pasien'] ? 'selected' : '';
                                echo "<option value='{$ps['Id_pasien']}' $selected>" . htmlspecialchars($ps['Nm_pasien']) . "</option>";
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
                                $selected = $ag['Id_ahligizi'] === $jadwal['Id_ahligizi'] ? 'selected' : '';
                                echo "<option value='{$ag['Id_ahligizi']}' $selected>" . htmlspecialchars($ag['Nm_ahligizi']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" value="<?= htmlspecialchars($jadwal['Tanggal']); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="time" name="jam" value="<?= htmlspecialchars($jadwal['Jam']); ?>" class="form-control" required>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=jadwal_konsultasi" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
