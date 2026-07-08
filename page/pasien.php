<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Pasien</h1>
    </div>
</div>

<?php
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);
    $query_hapus = mysqli_query($koneksi, "DELETE FROM pasien WHERE Id_pasien = '$kd'");
    if ($query_hapus) {
        echo "<script>alert('Data pasien berhasil dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=pasien'>";
    } else {
        echo "<div class='alert alert-danger'>Gagal hapus: ".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_pasien" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-plus"></i> Tambah Pasien
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY Nm_pasien ASC");
                        while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($result['Id_pasien']); ?></td>
                            <td><?= htmlspecialchars($result['Nm_pasien']); ?></td>
                            <td><?= htmlspecialchars($result['Jenkel']); ?></td>
                            <td><?= htmlspecialchars($result['Tgl_lahir']); ?></td>
                            <td><?= htmlspecialchars($result['Alamat']); ?></td>
                            <td><?= htmlspecialchars($result['No_hp']); ?></td>
                            <td>
                                <a href="index.php?page=edit_pasien&kd=<?= urlencode($result['Id_pasien']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=pasien&action=hapus&kd=<?= urlencode($result['Id_pasien']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
