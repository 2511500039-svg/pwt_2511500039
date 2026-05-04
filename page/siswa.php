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
// Proses hapus data siswa
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus") {
        $nis = $_GET['nis'];
        $query = mysqli_query($koneksi, "DELETE FROM siswa WHERE Nis = '$nis'");
        if ($query){
            echo '
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-trash"></i> Data Berhasil Dihapus
            </div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=siswa">';
        } else {
            echo '
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fas fa-ban"></i> Gagal Menghapus Data: '.mysqli_error($koneksi).'
            </div>';
        }
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
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>NO</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Jenis Kelamin</th>
                            <th>HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $query = mysqli_query($koneksi, "SELECT * FROM siswa ORDER BY Nis ASC");

                        if (!$query) {
                            echo '<tr><td colspan="6" class="text-center text-danger">Query Error: '.mysqli_error($koneksi).'</td></tr>';
                        } else if(mysqli_num_rows($query) > 0) {
                            while ($result = mysqli_fetch_array($query)) {
                                $no++;
                        ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $result['Nis']; ?></td>
                                <td><?= $result['Nm_siswa']; ?></td>
                                <td><?= $result['Jenkel']; ?></td>
                                <td><?= $result['Hp']; ?></td>
                                <td>
                                    <a href="index.php?page=siswa&action=hapus&nis=<?= $result['Nis'] ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus siswa <?= $result['Nm_siswa']; ?>?')" 
                                       title="Hapus">
                                        <span class="badge badge-danger">Hapus</span>
                                    </a>
                                    <a href="index.php?page=edit_siswa&nis=<?= $result['Nis'] ?>" 
                                       title="Edit">
                                        <span class="badge badge-warning">Edit</span>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="6" class="text-center">Belum ada data siswa</td>
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>