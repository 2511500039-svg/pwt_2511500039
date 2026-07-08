<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Monitoring Gizi</h1>
    </div>
</div>

<?php
if(isset($_GET['action']) && $_GET['action'] === 'hapus') {
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);
    $hapus = mysqli_query($koneksi, "DELETE FROM monitoring_gizi WHERE Id_monitoring = '$kd'");
    if ($hapus) {
        echo "<script>alert('Data monitoring gizi berhasil dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=monitoring_gizi'>";
    } else {
        echo "<div class='alert alert-danger'>Gagal hapus: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_monitoring_gizi" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-plus"></i> Tambah Monitoring Gizi
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Monitoring</th>
                            <th>Pasien</th>
                            <th>Tanggal</th>
                            <th>Berat Badan</th>
                            <th>Catatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT m.*, p.Nm_pasien FROM monitoring_gizi m LEFT JOIN pasien p ON m.Id_pasien = p.Id_pasien ORDER BY m.Tanggal DESC");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Id_monitoring']); ?></td>
                            <td><?= htmlspecialchars($row['Nm_pasien']); ?></td>
                            <td><?= htmlspecialchars($row['Tanggal']); ?></td>
                            <td><?= htmlspecialchars($row['Berat_badan']); ?> kg</td>
                            <td><?= htmlspecialchars($row['Catatan']); ?></td>
                            <td>
                                <a href="index.php?page=edit_monitoring_gizi&kd=<?= urlencode($row['Id_monitoring']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=monitoring_gizi&action=hapus&kd=<?= urlencode($row['Id_monitoring']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
