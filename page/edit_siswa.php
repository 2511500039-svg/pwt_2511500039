<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
$nis = isset($_GET['nis']) ? $_GET['nis'] : '';

$query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis = '$nis'");
$data = mysqli_fetch_array($query);

if(!$data){
    echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    exit;
}

if(isset($_POST['edit'])){

    $nm_siswa = $_POST['nm_siswa'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $kelas = $_POST['kelas'];

    $update = mysqli_query($koneksi, "
        UPDATE siswa SET 
        nm_siswa='$nm_siswa',
        jenkel='$jenkel',
        hp='$hp',
        kelas='$kelas'
        WHERE nis='$nis'
    ");

    if($update){
        echo "<div class='alert alert-success'>Berhasil update</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=siswa'>";
    } else {
        echo mysqli_error($koneksi);
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
        <input type="text" value="<?= $data['nis'] ?>" class="form-control" readonly>
    </div>

    <div class="form-group">
        <label>Nama Siswa</label>
        <input type="text" name="nm_siswa" value="<?= $data['nm_siswa'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Jenis Kelamin</label>
        <select name="jenkel" class="form-control">
            <option value="Laki-laki" <?= ($data['jenkel']=="Laki-laki")?"selected":""; ?>>Laki-laki</option>
            <option value="Perempuan" <?= ($data['jenkel']=="Perempuan")?"selected":""; ?>>Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label>HP</label>
        <input type="text" name="hp" value="<?= $data['hp'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Kelas</label>
        <input type="text" name="kelas" value="<?= $data['kelas'] ?>" class="form-control">
    </div>

    <button type="submit" name="edit" class="btn btn-primary">
        Update
    </button>

</form>

</div>
</div>
</div>
</section>