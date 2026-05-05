<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Ekstrakurikuler</h1>
            </div>
        </div>
    </div>
</div>

<?php
// HAPUS DATA
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $id_ekstra = $_GET['id_ekstra'];

    $hapus = mysqli_query($koneksi, "DELETE FROM ekstra WHERE id_ekstra='$id_ekstra'");

    if($hapus){
        echo "<div class='alert alert-warning'>Data berhasil dihapus</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=ekstra'>";
    } else {
        echo "<div class='alert alert-danger'>".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Ekstrakurikuler</h3>
            </div>

            <div class="card-body">
                <a href="index.php?page=tambah_ekstra" class="btn btn-primary btn-sm mb-3">Tambah Ekstrakurikuler</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;

                    $query = mysqli_query($koneksi, "SELECT * FROM ekstra");

                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['id_ekstra']; ?></td>
                            <td><?= $row['nama_ekstra']; ?></td>
                            <td><?= $row['keterangan']; ?></td>
                            <td><?= $row['semester']; ?></td>
                            <td><?= $row['thn_ajaran']; ?></td>

                            <td>
                                <a href="index.php?page=ekstra&action=hapus&id_ekstra=<?= $row['id_ekstra']; ?>" class="badge badge-danger">Hapus</a>
                                <a href="index.php?page=edit_ekstra&id_ekstra=<?= $row['id_ekstra']; ?>" class="badge badge-warning">Edit</a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Ekstrakurikuler kosong</td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>