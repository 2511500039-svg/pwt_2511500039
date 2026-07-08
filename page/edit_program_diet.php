<?php
$kd = isset($_GET['kd']) ? mysqli_real_escape_string($koneksi, $_GET['kd']) : '';
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM program_diet WHERE Id_program='$kd'"));
if(!$edit) {
    echo '<div class="alert alert-danger">Data program diet tidak ditemukan.</div>';
    return;
}
if(isset($_POST['simpan'])){
    $id_program = mysqli_real_escape_string($koneksi, $_POST['id_program']);
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $nm_program = mysqli_real_escape_string($koneksi, $_POST['nm_program']);
    $durasi = mysqli_real_escape_string($koneksi, $_POST['durasi']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    $update = mysqli_query($koneksi,"UPDATE program_diet SET Id_pasien='$id_pasien', Nm_program='$nm_program', Durasihari='$durasi', Keterangan='$keterangan' WHERE Id_program='$id_program'");
    if ($update) {
        echo "<script>alert('Program diet berhasil diupdate');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=program_diet'>";
        exit;
    } else {
        echo "<script>alert('Gagal update: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Program Diet</h1>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>ID Program</label>
                        <input type="text" name="id_program" value="<?= htmlspecialchars($edit['Id_program']); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Pasien</label>
                        <select name="id_pasien" class="form-control" required>
                            <option value="">-- Pilih Pasien --</option>
                            <?php
                            $pasien = mysqli_query($koneksi, "SELECT Id_pasien, Nm_pasien FROM pasien ORDER BY Nm_pasien ASC");
                            while($ps = mysqli_fetch_assoc($pasien)) {
                                $selected = ($ps['Id_pasien'] == $edit['Id_pasien']) ? 'selected' : '';
                                echo "<option value='{$ps['Id_pasien']}' $selected>" . htmlspecialchars($ps['Nm_pasien']) . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Program Diet</label>
                        <input type="text" name="nm_program" value="<?= htmlspecialchars($edit['Nm_program']); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Durasi (Hari)</label>
                        <input type="number" name="durasi" value="<?= htmlspecialchars($edit['Durasihari']); ?>" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control"><?= htmlspecialchars($edit['Keterangan']); ?></textarea>
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=program_diet" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
