<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Ekstrakulikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id = $_GET['id'];
$edit = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * FROM ekstra_2511500015 WHERE id_ekstra015='$id'"));

if(isset($_POST['tambah'])){
    $id_ekstra015 = $_POST['id_ekstra015'];
    $nama_ekstra015 = $_POST['nama_ekstra015'];
    $ket015 = $_POST['ket015'];
    $semester015 = $_POST['semester015'];
    $thn_ajaran015 = $_POST['thn_ajaran015'];

    $insert = mysqli_query($koneksi, "UPDATE ekstra_2511500015 SET nama_ekstra015='$nama_ekstra015', ket015='$ket015', semester015='$semester015', thn_ajaran015='$thn_ajaran015' WHERE id_ekstra015='$id_ekstra015'");
    if($insert){
        echo '<div class="alert alert-info-dismissible">
        <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
        <h5><i class="icon fas fa-info"></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>';
        echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500015">';
    }else {
       echo '<div class="alert alert-warning-dismissible">
       <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
       <h5><i class="icon fas fa-info"></i> Info </h5>
       <h4>Gagal Disimpan</h4></div>';
    }
}
?>
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="card-body p-2">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="id_ekstra015">Id Ekstrakulikuler</label>
                            <input type="text" name="id_ekstra015" value="<?=$edit['id_ekstra015']; ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_ekstra015">Nama Ekstrakulikuler</label>
                            <input type="text" name="nama_ekstra015" value="<?=$edit['nama_ekstra015']; ?>" id="nama_ekstra015" placeholder="Nama Ekstrakulikuler" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="ket015">Keterangan</label>
                            <input type="text" name="ket015" value="<?=$edit['ket015']; ?>" id="ket015" placeholder="Keterangan" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="semester015">Semester</label>
                            <select name="semester015" id="semester015" class="form-control">
                                    <option value="">Pilih Semester</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="thn_ajaran015">Tahun Ajaran</label>
                            <select name="thn_ajaran015" id="thn_ajaran015" class="form-control">
                                    <option value="">Pilih Tahun Ajaran</option>
                                    <option value="2022/2023">2024/2025</option>
                                    <option value="2023/2024">2025/2026</option>
                            </select>
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>