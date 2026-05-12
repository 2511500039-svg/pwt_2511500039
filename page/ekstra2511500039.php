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
        $query = mysqli_query($koneksi, "DELETE FROM ekstra_2511500039 WHERE id_ekstra039 ='$id'");
        if ($query) {
            echo '
            <div class="alert alert-warning alert-dismissible">
            Berhasil di hapus</div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500039">';
        }
    }
}
?>
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <a href="index.php?page=tambah_ekstra2511500039" class="btn btn-primary btn-sm">Tambah Ekstrakulikuler</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Ekstrakulikuler</th>
                            <th>Nama Ekstrakulikuler</th>
                            <th>Keterangan</th>
                            <th>Semester</th>
                            <th>Tahun Ajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    $query = mysqli_query($koneksi, "SELECT * FROM ekstra_2511500039");
                    while ($result = mysqli_fetch_array($query) ) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no;?></td>
                                <td><?=$result['id_ekstra039']; ?></td>
                                <td><?=$result['nama_ekstra039']; ?></td>
                                <td><?=$result['ket039']; ?></td>
                                <td><?=$result['semester039']; ?></td>
                                <td><?=$result['thn_ajaran039']; ?></td>
                                <td>
                                    <a href="index.php?page=ekstra2511500039&action=hapus&id=<?= $result['id_ekstra039']?>" title="">
                                        <span class="badge badge-danger">Hapus</span></a>
                                    <a href ="index.php?page=edit_ekstra2511500039&id=<?= $result['id_ekstra039']?>" title="">
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