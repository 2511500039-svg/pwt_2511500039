<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Ektstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
$id_ekstra = isset($_GET['id_ekstra']) ? $_GET['id_ekstra'] : '';

$query = mysqli_query($koneksi, "SELECT * FROM ekstra WHERE id_ekstra = '$id_ekstra'");
$data = mysqli_fetch_array($query);

if(!$data){
    echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    exit;
}

if(isset($_POST['edit'])){

    $id_ekstra = $_POST['id_ekstra'];
    $nama_ekstra = $_POST['nama_ekstra'];
    $keterangan = $_POST['keterangan'];
    $semester = $_POST['semester'];
    $thn_ajaran = $_POST['thn_ajaran'];

    $update = mysqli_query($koneksi, "
        UPDATE ekstra SET 
        nama_ekstra='$nama_ekstra',
        keterangan='$keterangan',
        semester='$semester',
        thn_ajaran='$thn_ajaran'
        WHERE id_ekstra='$id_ekstra'
    ");

    if($update){
        echo "<div class='alert alert-success'>Berhasil update</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=ekstra'>";
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
        <label>Id Ekstrakurikuler</label>
        <input type="text" value="<?= $data['id_ekstra'] ?>" class="form-control" readonly>
    </div>

    <div class="form-group">
        <label>Nama Ekstrakurikuler</label>
        <input type="text" name="nama_ekstra" value="<?= $data['nama_ekstra'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="keterangan" value="<?= $data['keterangan'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Semester</label>
        <input type="text" name="semester" value="<?= $data['semester'] ?>" class="form-control">
    </div>

    <div class="form-group">
        <label>Tahun Ajaran</label>
        <input type="text" name="thn_ajaran" value="<?= $data['thn_ajaran'] ?>" class="form-control">
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