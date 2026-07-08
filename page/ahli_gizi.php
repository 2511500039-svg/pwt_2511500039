<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 text-dark">Data Ahli Gizi</h1>
    </div>
</div>

<?php
if(isset($_GET['action']) && $_GET['action'] == "hapus") {
    $kd = mysqli_real_escape_string($koneksi, $_GET['kd']);
    $query_hapus = mysqli_query($koneksi, "DELETE FROM ahli_gizi WHERE Id_ahligizi = '$kd'");
    if ($query_hapus) {
        echo "<script>alert('Data ahli gizi berhasil dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?page=ahli_gizi'>";
    } else {
        echo "<div class='alert alert-danger'>Gagal hapus: ".mysqli_error($koneksi)."</div>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ahli_gizi" class="btn btn-primary btn-sm mb-3">
                    <i class="fas fa-plus"></i> Tambah Ahli Gizi
                </a>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Ahli Gizi</th>
                            <th>Nama Ahli Gizi</th>
                            <th>Spesialisasi</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM ahli_gizi ORDER BY Nm_ahligizi ASC");
                        while ($result = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($result['Id_ahligizi']); ?></td>
                            <td><?= htmlspecialchars($result['Nm_ahligizi']); ?></td>
                            <td><?= htmlspecialchars($result['Spesialisasi']); ?></td>
                            <td><?= htmlspecialchars($result['No_hp']); ?></td>
                            <td>
                                <a href="index.php?page=edit_ahli_gizi&kd=<?= urlencode($result['Id_ahligizi']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="index.php?page=ahli_gizi&action=hapus&kd=<?= urlencode($result['Id_ahligizi']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
