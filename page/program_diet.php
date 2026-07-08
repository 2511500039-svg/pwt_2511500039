<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Program Diet</h1>
    </div>
</div>

<?php
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);
    $query_hapus = mysqli_query($koneksi, "DELETE FROM program_diet WHERE Id_program = '$kd'");
    if ($query_hapus) {
        echo "<script>alert('Program diet berhasil dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=program_diet'>";
    } else {
        echo "<div class='alert alert-danger'>Gagal hapus: ".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_program_diet" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-plus"></i> Tambah Program Diet
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Program</th>
                            <th>Nama Program</th>
                            <th>Durasi (Hari)</th>
                            <th>Pasien</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT p.*, ps.Nm_pasien FROM program_diet p LEFT JOIN pasien ps ON p.Id_pasien = ps.Id_pasien ORDER BY p.Nm_program ASC");
                        while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($result['Id_program']); ?></td>
                            <td><?= htmlspecialchars($result['Nm_program']); ?></td>
                            <td><?= htmlspecialchars($result['Durasihari']); ?></td>
                            <td><?= htmlspecialchars($result['Nm_pasien']); ?></td>
                            <td><?= htmlspecialchars($result['Keterangan']); ?></td>
                            <td>
                                <a href="index.php?page=edit_program_diet&kd=<?= urlencode($result['Id_program']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=program_diet&action=hapus&kd=<?= urlencode($result['Id_program']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
