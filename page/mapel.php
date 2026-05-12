<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Mata Pelajaran</h1>
            </div>
        </div>
    </div>
</div>

<?php
// HAPUS DATA
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd_mapel = $_GET['kd_mapel'];

    $hapus = mysqli_query($koneksi, "DELETE FROM mapel WHERE kd_mapel='$kd_mapel'");

    if($hapus){
        echo "<div class='alert alert-warning'>Data berhasil dihapus</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=mapel'>";
    } else {
        echo "<div class='alert alert-danger'>".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Mata Pelajaran</h3>
            </div>

            <div class="card-body">
                <a href="index.php?page=tambah_mapel" class="btn btn-primary btn-sm mb-3">Tambah Mata Pelajaran</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Mata Pelajaran</th>
                            <th>Nama Pelajaran</th>
                            <th>KKM</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;

                    $query = mysqli_query($koneksi, "SELECT * FROM mapel");

                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['kd_mapel']; ?></td>
                            <td><?= $row['nm_mapel']; ?></td>
                            <td><?= $row['kkm']; ?></td>
                            <td>
                                <a href="index.php?page=mapel&action=hapus&kd_mapel=<?= $row['kd_mapel']; ?>" class="badge badge-danger">Hapus</a>
                                <a href="index.php?page=edit_mapel&kd_mapel=<?= $row['kd_mapel']; ?>" class="badge badge-warning">Edit</a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Data kosong</td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>