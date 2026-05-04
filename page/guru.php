<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Data Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == "hapus") {
        $kd = $_GET['kd'];
        $query = mysqli_query($koneksi, "DELETE FROM guru WHERE kd_guru ='$kd'");

        if ($query) {
            echo "<div class='alert alert-warning alert-dismissible'>
                    Berhasil Di Hapus
                  </div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?page=guru'>";
        } else {
            die("Query Error (DELETE): " . mysqli_error($koneksi));
        }
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_guru" class="btn btn-primary btn-sm">Tambah Guru</a>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>KD Guru</th>
                            <th>Nama Guru</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM guru");

                    if (!$query) {
                        die("Query Error (SELECT): " . mysqli_error($koneksi));
                    }

                    while ($result = mysqli_fetch_array($query)) {
                        $no++;
                    ?>

                    <tbody>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $result['kd_guru']; ?></td>
                            <td><?php echo $result['nm_guru']; ?></td>
                            <td>
                                <a href="index.php?page=edit_guru&kd=<?= $result['kd_guru']; ?>">
                                    <span class="badge badge-warning">Edit</span>
                                </a>

                                <a href="index.php?page=guru&action=hapus&kd=<?= $result['kd_guru']; ?>">
                                    <span class="badge badge-danger">Hapus</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>

                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>