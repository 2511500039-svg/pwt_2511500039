<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
$kd_guru = isset($_GET['kd']) ? $_GET['kd'] : '';

if($kd_guru == ''){
    echo '<div class="alert alert-danger">Parameter tidak ditemukan</div>';
    echo '<script>setTimeout(function(){ window.location="index.php?page=guru"; }, 1000);</script>';
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru = '$kd_guru'");
$data = mysqli_fetch_array($query);

if(!$data){
    echo '<div class="alert alert-danger">Data tidak ditemukan</div>';
    echo '<script>setTimeout(function(){ window.location="index.php?page=guru"; }, 1000);</script>';
    exit;
}

// update
if(isset($_POST['edit'])){
    $nm_guru = mysqli_real_escape_string($koneksi, $_POST['nm_guru']);
    $jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $pend_terakhir = mysqli_real_escape_string($koneksi, $_POST['pend_terakhir']);
    $hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $update = mysqli_query($koneksi, "UPDATE guru SET 
        nm_guru='$nm_guru',
        jenkel='$jenkel',
        pend_terakhir='$pend_terakhir',
        hp='$hp',
        alamat='$alamat'
        WHERE kd_guru='$kd_guru'
    ");

    if($update){
        echo '<div class="alert alert-success">Berhasil Diupdate</div>';
        echo '<script>setTimeout(function(){ window.location="index.php?page=guru"; }, 1000);</script>';
    } else {
        echo '<div class="alert alert-danger">Gagal Update: '.mysqli_error($koneksi).'</div>';
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit data guru ✏️</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST">

                    <div class="form-group">
                        <label>Kode Guru</label>
                        <input type="text" value="<?= $data['kd_guru']; ?>" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input type="text" name="nm_guru" value="<?= $data['nm_guru']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenkel" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" <?= ($data['jenkel']=='Laki-laki')?'selected':''; ?>>Laki-laki</option>
                            <option value="Perempuan" <?= ($data['jenkel']=='Perempuan')?'selected':''; ?>>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <input type="text" name="pend_terakhir" value="<?= $data['pend_terakhir']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>No HP</label>
                        <input type="text" name="hp" value="<?= $data['hp']; ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control"><?= $data['alamat']; ?></textarea>
                    </div>

                    <div class="card-footer">
                        <input type="submit" name="edit" class="btn btn-primary" value="Update">
                        <a href="index.php?page=guru" class="btn btn-default">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>