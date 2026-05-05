<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['tambah'])){

    $id_ekstra = $_POST['id_ekstra'];
    $nama_ekstra = $_POST['nama_ekstra'];
    $keterangan = $_POST['keterangan'];
    $semester = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];

    $insert = mysqli_query($koneksi, "
        INSERT INTO ekstra (id_ekstra, nama_ekstra, keterangan, semester, thn_ajaran)
        VALUES ('$id_ekstra', '$nama_ekstra', '$keterangan', '$semester', '$thn_ajaran')
    ");

    if($insert){
        echo "<div class='alert alert-success'>
                Data berhasil disimpan
              </div>";

        echo "<meta http-equiv='refresh' content='1;url=index.php?page=ekstra'>";
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
                        <label>Id Ekstrakurikuler</label>
                        <input type="text" name="id_ekstra" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Nama Ekstrakurikuler</label>
                        <input type="text" name="nama_ekstra" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Semester</label>
                        <select name="semester" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="1">Ganjil</option>
                            <option value="2">Genap</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tahun Ajaran</label>
                        <select name="thn_ajaran" class="form-control" required>
                            <option value="">-- Pilih --</option>
                            <option value="2022/2023">2022/2023</option>
                            <option value="2023/2024">2023/2024</option>
                        </select>
                    </div>

                    <button type="submit" name="tambah" class="btn btn-primary">
                        Simpan
                    </button>

                </form>

            </div>
        </div>
    </div>
</section>