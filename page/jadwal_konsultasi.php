<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Jadwal Konsultasi</h1>
    </div>
</div>

<?php
if(isset($_GET['action']) && $_GET['action'] === 'hapus') {
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);
    $hapus = mysqli_query($koneksi, "DELETE FROM jadwal_konsultasi WHERE Id_jadwal = '$kd'");
    if ($hapus) {
        echo "<script>alert('Jadwal konsultasi berhasil dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=jadwal'>";
    } else {
        echo "<div class='alert alert-danger'>Gagal hapus: " . mysqli_error($koneksi) . "</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_jadwal_konsultasi" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-plus"></i> Tambah Jadwal Konsultasi
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Jadwal</th>
                            <th>Pasien</th>
                            <th>Ahli Gizi</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT j.*, ps.Nm_pasien, ag.Nm_ahligizi FROM jadwal_konsultasi j LEFT JOIN pasien ps ON j.Id_pasien = ps.Id_pasien LEFT JOIN ahli_gizi ag ON j.Id_ahligizi = ag.Id_ahligizi ORDER BY j.Tanggal DESC, j.Jam ASC");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['Id_jadwal']); ?></td>
                            <td><?= htmlspecialchars($row['Nm_pasien']); ?></td>
                            <td><?= htmlspecialchars($row['Nm_ahligizi']); ?></td>
                            <td><?= htmlspecialchars($row['Tanggal']); ?></td>
                            <td><?= htmlspecialchars($row['Jam']); ?></td>
                            <td>
                                <a href="index.php?page=edit_jadwal_konsultasi&kd=<?= urlencode($row['Id_jadwal']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=jadwal_konsultasi&action=hapus&kd=<?= urlencode($row['Id_jadwal']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
