<?php
$kd = isset($_GET['kd']) ? mysqli_real_escape_string($koneksi, $_GET['kd']) : '';
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM pasien WHERE Id_pasien='$kd'"));
if(!$edit) {
    echo '<div class="alert alert-danger">Data pasien tidak ditemukan.</div>';
    return;
}
if(isset($_POST['simpan'])){
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $nm_pasien = mysqli_real_escape_string($koneksi, $_POST['nm_pasien']);
    $jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $update = mysqli_query($koneksi,"UPDATE pasien SET Nm_pasien='$nm_pasien', Jenkel='$jenkel', Tgl_lahir='$tgl_lahir', Alamat='$alamat', No_hp='$no_hp' WHERE Id_pasien='$id_pasien'");
    if ($update) {
        echo "<script>alert('Data berhasil diupdate');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=pasien'>";
        exit;
    } else {
        echo "<script>alert('Gagal update: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Pasien</h1>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>ID Pasien</label>
                        <input type="text" name="id_pasien" value="<?= htmlspecialchars($edit['Id_pasien']); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Pasien</label>
                        <input type="text" name="nm_pasien" value="<?= htmlspecialchars($edit['Nm_pasien']); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenkel" class="form-control" required>
                            <option value="Laki-laki" <?= ($edit['Jenkel']=='Laki-laki')?'selected':''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($edit['Jenkel']=='Perempuan')?'selected':''; ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" value="<?= htmlspecialchars($edit['Tgl_lahir']); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"><?= htmlspecialchars($edit['Alamat']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" value="<?= htmlspecialchars($edit['No_hp']); ?>" class="form-control">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=pasien" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
