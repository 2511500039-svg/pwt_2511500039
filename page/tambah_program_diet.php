<?php
include "config/koneksi.php";
$query_kd = mysqli_query($koneksi, "SELECT MAX(Id_program) as kode FROM program_diet");
$data_kd = mysqli_fetch_assoc($query_kd);
$kd_lama = $data_kd['kode'];
if($kd_lama){
    $urutan = (int) substr($kd_lama, 2);
    $urutan++;
    $id_program = "PD" . sprintf("%03d", $urutan);
} else {
    $id_program = "PD001";
}
if(isset($_POST['simpan'])){
    $id_program = mysqli_real_escape_string($koneksi, $_POST['id_program']);
    $id_pasien = mysqli_real_escape_string($koneksi, $_POST['id_pasien']);
    $nm_program = mysqli_real_escape_string($koneksi, $_POST['nm_program']);
    $durasi = mysqli_real_escape_string($koneksi, $_POST['durasi']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);
    if(empty($nm_program) || empty($id_pasien)){
        echo "<script>alert('Data tidak boleh kosong');</script>";
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO program_diet (Id_program, Id_pasien, Nm_program, Durasihari, Keterangan) VALUES ('$id_program','$id_pasien','$nm_program','$durasi','$keterangan')");
        if($query){
            echo "<script>alert('Program diet berhasil ditambahkan');</script>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=program_diet'>";
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
                <label>ID Program</label>
                <input type="text" name="id_program" value="<?= htmlspecialchars($id_program); ?>" class="form-control" readonly>
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
                <label>Nama Program Diet</label>
                <input type="text" name="nm_program" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Durasi (Hari)</label>
                <input type="number" name="durasi" class="form-control" min="1" value="30" required>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            <a href="index.php?page=program_diet" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
