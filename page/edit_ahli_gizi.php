<?php
$kd = isset($_GET['kd']) ? mysqli_real_escape_string($koneksi, $_GET['kd']) : '';
$edit = mysqli_fetch_array(mysqli_query($koneksi,"SELECT * FROM ahli_gizi WHERE Id_ahligizi='$kd'"));
if(!$edit) {
    echo '<div class="alert alert-danger">Data ahli gizi tidak ditemukan.</div>';
    return;
}
if(isset($_POST['simpan'])){
    $id_ahli = mysqli_real_escape_string($koneksi, $_POST['id_ahli']);
    $nm_ahli = mysqli_real_escape_string($koneksi, $_POST['nm_ahli']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $update = mysqli_query($koneksi,"UPDATE ahli_gizi SET Nm_ahligizi='$nm_ahli', Spesialisasi='$spesialisasi', No_hp='$no_hp' WHERE Id_ahligizi='$id_ahli'");
    if ($update) {
        echo "<script>alert('Data berhasil diupdate');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=ahli_gizi'>";
        exit;
    } else {
        echo "<script>alert('Gagal update: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>
<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Edit Ahli Gizi</h1>
    </div>
</div>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label>ID Ahli Gizi</label>
                        <input type="text" name="id_ahli" value="<?= htmlspecialchars($edit['Id_ahligizi']); ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Ahli Gizi</label>
                        <input type="text" name="nm_ahli" value="<?= htmlspecialchars($edit['Nm_ahligizi']); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Spesialisasi</label>
                        <input type="text" name="spesialisasi" value="<?= htmlspecialchars($edit['Spesialisasi']); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="no_hp" value="<?= htmlspecialchars($edit['No_hp']); ?>" class="form-control">
                    </div>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <a href="index.php?page=ahli_gizi" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</section>
