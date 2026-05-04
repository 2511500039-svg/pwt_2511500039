<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['tambah'])){

    $nis = $_POST['nis'];
    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $kelas = $_POST['kelas'];

    $insert = mysqli_query($koneksi, "
        INSERT INTO siswa (nis, nm_siswa, jenkel, hp, kelas)
        VALUES ('$nis', '$nm_siswa', '$jenkel', '$hp', '$kelas')
    ");

    if($insert){
        echo "<div class='alert alert-success'>
                Data berhasil disimpan
              </div>";

        echo "<meta http-equiv='refresh' content='1;url=index.php?page=siswa'>";
    } else {
        echo "<div class='alert alert-danger'>
                ".mysqli_error($koneksi)."
              </div>";
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form method="POST">

                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="nm_siswa" class="form-control" required>
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
                        <label>No HP</label>
                        <input type="text" name="hp" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="Contoh: Abu Bakar">
                    </div>

                    <button type="submit" name="tambah" class="btn btn-primary">
                        Simpan
                    </button>

                </form>

            </div>
        </div>
    </div>
</section>