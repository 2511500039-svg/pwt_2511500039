<?php
include "config/koneksi.php";
$query_kd = mysqli_query($koneksi, "SELECT MAX(Id_ahligizi) as kd FROM ahli_gizi");
$data_kd = mysqli_fetch_assoc($query_kd);
$kd_lama = $data_kd['kd'];
if($kd_lama){
    $urutan = (int) substr($kd_lama, 2);
    $urutan++;
    $id_ahli = "AG" . sprintf("%03d", $urutan);
} else {
    $id_ahli = "AG001";
}
if(isset($_POST['simpan'])){
    $id_ahli = mysqli_real_escape_string($koneksi, $_POST['id_ahli']);
    $nm_ahli = mysqli_real_escape_string($koneksi, $_POST['nm_ahli']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    if(empty($nm_ahli) || empty($spesialisasi)){
        echo "<script>alert('Data tidak boleh kosong');</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO ahli_gizi (Id_ahligizi, Nm_ahligizi, Spesialisasi, No_hp) VALUES ('$id_ahli','$nm_ahli','$spesialisasi','$no_hp')");
        if($query){
            echo "<script>alert('Data ahli gizi berhasil ditambahkan');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=ahli_gizi'>";
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
                <label>ID Ahli Gizi</label>
                <input type="text" name="id_ahli" value="<?= htmlspecialchars($id_ahli); ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Nama Ahli Gizi</label>
                <input type="text" name="nm_ahli" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Spesialisasi</label>
                <input type="text" name="spesialisasi" class="form-control" required>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=ahli_gizi" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
