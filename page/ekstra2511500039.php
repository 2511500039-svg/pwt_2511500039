<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data Ekstrakulikuler</h1>
      </div>
    </div>
  </div>
</div>

<?php
if(isset($_GET['action'])) {
    if($_GET['action'] == "hapus") {
        $id =$_GET['id'];
        $query = mysqli_query($koneksi, "DELETE FROM ekstra_2511500015 WHERE id_ekstra015 ='$id'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil di hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500015">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ekstra2511500015" class="btn btn-primary btn-sm">Tambah Ekstrakulikuler</a>
                <table class="table table-striped">
                    <tread>
                        <tr>
                            <th>No</th>
                            <th>Id Ekstrakulikuler</th>
                            <th>Nama Ekstrakulikuler</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </tread>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500015");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?=$result['id_ekstra015']; ?></td>
                                <td><?=$result['nama_ekstra015']; ?></td>
                                <td><?=$result['ket015']; ?></td>
                                <td><?=$result['semester015']; ?></td>
                                <td><?=$result['thn_ajaran015']; ?></td>
                                <td>
                                    <a href="index.php?page=ekstra2511500015&action=hapus&id=<?= $result['id_ekstra015']?>" title="">
                                        <span class="badge badge-danger">Hapus</span></a>
                                    <a href ="index.php?page=edit_ekstra2511500015&id=<?= $result['id_ekstra015']?>" title="">
                                        <span class="badge badge-warning">Edit</span></a>
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  