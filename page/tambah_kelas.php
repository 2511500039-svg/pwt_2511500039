<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Kelas</h1>
            </div>
        </div>
    </div>
</div>
<?php
//kode ootmtis
$carikode = mysqli_query($koneksi,"select max(id_kelas) from kelas") or die ( mysqli_error($koneksi));
$datakode = mysqli_fetch_array($carikode);
if($datakode) {
    $nilaikode = substr($datakode[0], 2);
    $kode = (int) $nilaikode;
    $kode = $kode + 1;
    $hasilkode ="M-".str_pad($kode, 3, "0", STR_PAD_LEFT);
} else { $hasilkode ="M-"; }
$_SESSION['KODE'] = $hasilkode;

if(isset($_POST['tambah'])){
    $id_kelas = $_POST['id_kelas'];
    $nm_kelas = $_POST['nm_kelas'];
    
    $insert = mysqli_query($koneksi,"INSERT INTO kelas values ('$id_kelas','$nm_kelas')");
    if ($insert) {
        echo "<div class='alert alert-info-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
        <h5><i class='icon fas fa-info'></i> Info </h5>
        <h4>Berhasil Disimpan</h4></div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=kelas'>";
    }else{
        echo "<div class='alert alert-warning alert-dismissible'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
        <h5><i class='icon fas fa-info'></i> Info </h5>
        <h4>Gagal Disimpan</h4></div>";
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
                            <label for="id_kelas">Id Kelas</label>
                            <input type="text" name="id_kelas" id="id_kelas" placeholder="Id Kelas" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="nm_kelas">Nama Kelas</label>
                            <input type="text" name="nm_kelas" id="nm_kelas" placeholder="Nama Kelas" class="form-control">
                        </div>
                        <div class="card-footer">
                            <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>