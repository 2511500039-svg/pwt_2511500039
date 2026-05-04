<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Jadwal</h1>
            </div>
        </div>
    </div>
</div>

<?php
// HAPUS DATA
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $nis = $_GET['id_jadwal'];

    $hapus = mysqli_query($koneksi, "DELETE FROM jadwal WHERE id_jadwal='$id_jadwal'");

    if($hapus){
        echo "<div class='alert alert-warning'>Data berhasil dihapus</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=jadwal'>";
    } else {
        echo "<div class='alert alert-danger'>".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Jadwal</h3>
            </div>

            <div class="card-body">
                <a href="index.php?page=tambah_jadwal" class="btn btn-primary btn-sm mb-3">Tambah Jadwal</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Kode Guru</th>
                            <th>Kode Mapel</th>
                            <th>Kode Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;

                    $query = mysqli_query($koneksi, "SELECT * FROM jadwal");

                    if(mysqli_num_rows($query) > 0){
                        while($row = mysqli_fetch_assoc($query)){
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['id_jadwal']; ?></td>
                            <td><?= $row['hari']; ?></td>
                            <td><?= $row['jam']; ?></td>
                            <td><?= $row['kd_guru']; ?></td>
                            <td><?= $row['kd_mapel']; ?></td>
                            <td><?= $row['kd_kelas']; ?></td>

                            <td>
                                <a href="index.php?page=jadwal&action=hapus&nis=<?= $row['nis']; ?>" class="badge badge-danger">Hapus</a>
                                <a href="index.php?page=edit_jadwal&nis=<?= $row['nis']; ?>" class="badge badge-warning">Edit</a>
                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr>
                            <td colspan="7" class="text-center">Jadwal kosong</td>
                        </tr>
                    <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>