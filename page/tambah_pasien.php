<?php
include "config/koneksi.php";
$query_nis = mysqli_query($koneksi, "SELECT MAX(Id_pasien) as kode FROM pasien");
$data_nis = mysqli_fetch_assoc($query_nis);
$nis_lama = $data_nis['kode'];
if($nis_lama){
    $urutan = (int) substr($nis_lama, 2);
    $urutan++;
    $id_pasien = "PS" . sprintf("%03d", $urutan);
} else {
    $id_pasien = "PS001";
}
if(isset($_POST['simpan'])){
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $nm_pasien = mysqli_real_escape_string($koneksi, $_POST['nm_pasien']);
    $jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    if(empty($nm_pasien) || empty($jenkel)){
        echo "<script>alert('Data tidak boleh kosong');</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pasien (Id_pasien, Nm_pasien, Jenkel, Tgl_lahir, Alamat, No_hp) VALUES ('$id_pasien','$nm_pasien','$jenkel','$tgl_lahir','$alamat','$no_hp')");
        if($query){
            echo "<script>alert('Data pasien berhasil ditambahkan');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=pasien'>";
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
                <label>ID Pasien</label>
                <input type="text" name="id_pasien" value="<?= htmlspecialchars($id_pasien); ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Nama Pasien</label>
                <input type="text" name="nm_pasien" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenkel" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=pasien" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
