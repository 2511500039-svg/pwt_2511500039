<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Siswa</h1>
            </div>
        </div>
    </div>
</div>

<?php
// HAPUS DATA
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $nis = $_GET['nis'];

    $hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE nis='$nis'");

    if($hapus){
        echo "<div class='alert alert-warning'>Data berhasil dihapus</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=siswa'>";
    } else {
        echo "<div class='alert alert-danger'>".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Siswa</h3>
            </div>

            <div class="card-body">
                <a href="index.php?page=tambah_siswa" class="btn btn-primary btn-sm mb-3">Tambah Siswa</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama</th>
                            <th>JK</th>
                            <th>HP</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;

                    $query = mysqli_query($koneksi, "SELECT * FROM siswa");

                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nis']; ?></td>
                            <td><?= $row['nm_siswa']; ?></td>
                            <td><?= $row['jenkel']; ?></td>
                            <td><?= $row['hp']; ?></td>
                            <td><?= $row['kelas']; ?></td>
                            <td>
                                <a href="index.php?page=siswa&action=hapus&nis=<?= $row['nis']; ?>" class="badge badge-danger">Hapus</a>
                                <a href="index.php?page=edit_siswa&nis=<?= $row['nis']; ?>" class="badge badge-warning">Edit</a>
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