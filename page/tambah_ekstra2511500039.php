<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Ekstrakulikuler</h1>
        </div>
        </div>
    </div>
    </div>
    <?php
    //kode otomatis
    $carikode = mysqli_query($koneksi, "select max(id_ekstra039) from ekstra_2511500039") or die (mysqli_error());
    $datakode = mysqli_fetch_array($carikode);
    if ($datakode) {
        $nilaikode = substr($datakode[0], 2);
        $kode = (int) $nilaikode;
        $kode = $kode + 1;
        $hasilkode = "E".str_pad($kode, 3, "0", STR_PAD_LEFT);
    } else {$hasilkode = "E-"; }
    $_SESSION["KODE"] = $hasilkode;

    if(isset($_POST['tambah'])){
        $id_ekstra039 = $_POST['id_ekstra039'];
        $nama_ekstra039 = $_POST['nama_ekstra039'];
        $ket039 = $_POST['ket039'];
        $semester039 = $_POST['semester039'];
        $thn_ajaran039 = $_POST['thn_ajaran039'];


        $insert = mysqli_query($koneksi, "INSERT INTO ekstra_2511500039 values ('$id_ekstra039', '$nama_ekstra039', '$ket039', '$semester039', '$thn_ajaran039')");
        if($insert){
            echo '<div class="alert alert-info-dismissible">
            <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
            <h5><i class="icon fas fa-info"></i> Info </h5>
            <h4>Berhasil Disimpan</h4></div>';
            echo '<meta http-equiv="refresh" content="1;url=index.php?page=ekstra2511500039">';
        }else {
           echo '<div class="alert alert-warning-dismissible">
           <button type="button" class="close" data-dismiss="alert"aria-hidden="true">X</button>
           <h5><i class="icon fas fa-info"></i> Info </h5>
           <h4>Gagal Disimpan</h4></div>';
        }
    }
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="card-body p-2">
                        <form method="POST" action="">
                            <div class="form-group">
                                <label for="id_ekstra039">Id Ekstrakulikuler</label>
                                <input type="text" name="id_ekstra039" value="<?=$hasilkode; ?>" placeholder="Id Ekstrakulikuler" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_ekstra039">Nama Ekstrakulikuler</label>
                                <input type="text" name="nama_ekstra039" id="nama_ekstra039" placeholder="Nama Ekstrakulikuler" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="ket039">Keterangan</label>
                                <input type="text" name="ket039" id="ket039" placeholder="Keterangan" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="semester039">Semester</label>
                                <select name="semester039" id="semester039" class="form-control">
                                    <option value="">Pilih Semester</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="thn_ajaran039">Tahun Ajaran</label>
                                <select name="thn_ajaran039" id="thn_ajaran039" class="form-control">
                                    <option value="">Pilih Tahun Ajaran</option>
                                    <option value="2022/2023">2024/2025</option>
                                    <option value="2023/2024">2025/2026</option>
                                </select>
                            </div>
                            <div class="card-footer">
                                <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>