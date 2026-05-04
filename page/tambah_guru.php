<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Tambah Guru</h1>
            </div>
        </div>
    </div>
</div>

<?php
// Proses simpan data guru
if(isset($_POST['tambah'])){
    $kd_guru = mysqli_real_escape_string($koneksi, $_POST['kd_guru']);
    $id_users = mysqli_real_escape_string($koneksi, $_POST['id_users']);
    $nm_guru = mysqli_real_escape_string($koneksi, $_POST['nm_guru']);
    $jenkel = mysqli_real_escape_string($koneksi, $_POST['jenkel']);
    $pend_terakhir = mysqli_real_escape_string($koneksi, $_POST['pend_terakhir']);
    $hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    
    // Cek apakah kode guru sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM guru WHERE kd_guru = '$kd_guru'");
    if(mysqli_num_rows($cek) > 0) {
        echo '<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
            Kode Guru sudah ada! Gunakan kode yang berbeda.
        </div>';
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO guru 
        (kd_guru, id_users, nm_guru, jenkel, pend_terakhir, hp, alamat) 
        VALUES 
        ('$kd_guru', '$id_users', '$nm_guru', '$jenkel', '$pend_terakhir', '$hp', '$alamat')");
        
        if ($insert){
            echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                Data Berhasil Disimpan
            </div>';
            echo '<script>setTimeout(function(){ window.location="index.php?page=guru"; }, 1000);</script>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Gagal!</h5>
                Data Gagal Disimpan: '.mysqli_error($koneksi).'
            </div>';
        }
    }
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tambahkan data guru 👨‍🏫👩‍🏫</h3>
            </div>
            <div class="card-body p-2">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="kd_guru">Kode Guru</label>
                        <input type="text" name="kd_guru" placeholder="Kode Guru" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="id_users">Id Users</label>
                        <input type="text" name="id_users" placeholder="Id Users" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="nm_guru">Nama Guru</label>
                        <input type="text" name="nm_guru" id="nm_guru" placeholder="Nama Lengkap Guru" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="jenkel">Jenis Kelamin</label>
                        <select name="jenkel" id="jenkel" class="form-control" required>
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pend_terakhir">Pendidikan Terakhir</label>
                        <select name="pend_terakhir" id="pend_terakhir" class="form-control" required>
                            <option value="">-- Pilih Pendidikan Terakhir --</option>
                            <option value="SMA/Sederajat">SMA/Sederajat</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hp">Nomor HP</label>
                        <input type="text" name="hp" id="hp" placeholder="Contoh: 08123456789" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" placeholder="Alamat lengkap guru" class="form-control"></textarea>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
                        <a href="index.php?page=guru" class="btn btn-default">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>