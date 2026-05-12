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
// HAPUS DATA
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id_kelas = $_GET['id_kelas'];

    $hapus = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$id_kelas'");

    if($hapus){
        echo "<div class='alert alert-warning'>Data berhasil dihapus</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=kelas'>";
    } else {
        echo "<div class='alert alert-danger'>".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kelas</h3>
            </div>

            <div class="card-body">
                <a href="index.php?page=tambah_kelas" class="btn btn-primary btn-sm mb-3">Tambah Kelas</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;

                    $query = mysqli_query($koneksi, "SELECT * FROM kelas");

                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['id_kelas']; ?></td>
                            <td><?= $row['nm_kelas']; ?></td>
                            <td>>
                                <a href="index.php?page=kelas&action=hapus&id_kelas=<?= $row['id_kelas']; ?>" class="badge badge-danger">Hapus</a>
                                <a href="index.php?page=edit_kelas&id_kelas=<?= $row['id_kelas']; ?>" class="badge badge-warning">Edit</a>
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