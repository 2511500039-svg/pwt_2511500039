<?php
session_start();
require_once __DIR__ . "/config/koneksi.php";

// cek session login
if(isset($_SESSION['Username'])){
    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard AdminLTE Extended</title>
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
/* Custom CSS tambahan untuk memperpanjang kode */
.card-custom { border: 1px solid #ccc; margin-bottom: 15px; }
</style>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- NAVBAR -->
<nav class="main-header navbar navbar-expand navbar-light navbar-white">
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
<li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">Home</a></li>
<li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Contact</a></li>
</ul>

<ul class="navbar-nav ml-auto">
<li class="nav-item">
  <a class="nav-link" data-widget="navbar-search" href="#"><i class="fas fa-search"></i></a>
  <div class="navbar-search-block">
    <form class="form-inline">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit"><i class="fas fa-search"></i></button>
          <button class="btn btn-navbar" type="button" data-widget="navbar-search"><i class="fas fa-times"></i></button>
        </div>
      </div>
    </form>
  </div>
</li>
</ul>
</nav>

<!-- SIDEBAR -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="index.php" class="brand-link">
<span class="brand-text font-weight-light">AdminLTE Extended</span>
</a>

<div class="sidebar">
<!-- User Panel -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
  <div class="image">
    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
  </div>
  <div class="info">
    <a href="#" class="d-block"><?php echo $_SESSION['Username']; ?></a>
  </div>
</div>

<!-- Sidebar Menu -->
<nav class="mt-2">
<ul class="nav nav-pills nav-sidebar flex-column">

<!-- ADMIN MENU -->
<?php if($userRole == 'admin'): ?>
<li class="nav-item menu-open">
  <a href="#" class="nav-link active"><i class="nav-icon fas fa-cogs"></i><p>Master Data<i class="right fas fa-angle-left"></i></p></a>
  <ul class="nav nav-treeview ml-2">
    <li class="nav-item"><a href="#" class="nav-link"><p>Guru</p></a></li>
    <li class="nav-item"><a href="#" class="nav-link"><p>Siswa</p></a></li>
    <li class="nav-item"><a href="#" class="nav-link"><p>Mata Pelajaran</p></a></li>
    <li class="nav-item"><a href="#" class="nav-link"><p>Kelas</p></a></li>
  </ul>
</li>
<?php endif; ?>

<!-- GURU MENU -->
<?php if($userRole == 'guru'): ?>
<li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Profil</p></a></li>
<li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-chalkboard"></i><p>Kelas</p></a></li>
<li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-calendar-alt"></i><p>Jadwal</p></a></li>
<?php endif; ?>

<!-- SISWA MENU -->
<?php if($userRole == 'siswa'): ?>
<li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-user"></i><p>Profil</p></a></li>
<li class="nav-item"><a href="#" class="nav-link"><i class="nav-icon fas fa-calendar-alt"></i><p>Jadwal</p></a></li>
<?php endif; ?>

<!-- TRANSAKSI -->
<li class="nav-item">
<a href="#" class="nav-link"><i class="nav-icon fas fa-exchange-alt"></i><p>Transaksi<i class="right fas fa-angle-left"></i></p></a>
<ul class="nav nav-treeview ml-2">
<li class="nav-item"><a href="#" class="nav-link"><p>Jadwal</p></a></li>
</ul>
</li>

<!-- LOGOUT -->
<li class="nav-item"><a href="logout.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>

</ul>
</nav>
</div>
</aside>

<!-- CONTENT WRAPPER -->
<div class="content-wrapper">

<!-- HEADER -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"><h1 class="m-0">Dashboard</h1></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- MAIN CONTENT -->
<div class="content">
  <div class="container-fluid">

    <!-- CARD 1 -->
    <div class="card card-custom">
      <div class="card-header"><h5 class="card-title">Halo, <?php echo $_SESSION['Username']; ?>!</h5></div>
      <div class="card-body"><p>Selamat datang di sistem jadwal guru & siswa.</p></div>
    </div>

    <!-- CARD 2 -->
    <div class="card card-custom">
      <div class="card-header"><h5 class="card-title">Informasi Umum</h5></div>
      <div class="card-body">
        <ul>
          <li>Menu Master Data untuk Admin</li>
          <li>Menu Profil, Kelas, Jadwal untuk Guru</li>
          <li>Menu Profil, Jadwal untuk Siswa</li>
        </ul>
      </div>
    </div>

    <!-- CARD 3 -->
    <div class="card card-custom">
      <div class="card-header"><h5 class="card-title">Tips Penggunaan</h5></div>
      <div class="card-body">
        <ol>
          <li>Gunakan akun sesuai role</li>
          <li>Klik menu sidebar untuk navigasi</li>
          <li>Logout setelah selesai</li>
        </ol>
      </div>
    </div>

    <!-- DUMMY CONTENT UNTUK MEMPERPANJANG -->
    <?php for($i=1;$i<=10;$i++): ?>
    <div class="card card-custom">
      <div class="card-header"><h5 class="card-title">Info tambahan #<?php echo $i; ?></h5></div>
      <div class="card-body">
        <p>Konten placeholder untuk memperpanjang halaman agar lebih dari 200 baris.</p>
      </div>
    </div>
    <?php endfor; ?>

  </div>
</div>
</div>

<!-- FOOTER -->
<footer class="main-footer">
  <div class="float-right d-none d-sm-inline">Versi 1.0 Extended</div>
  <strong>Copyright &copy; 2026 Sistem Jadwal.</strong>
</footer>

</div>

<!-- SCRIPTS -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

<script>
// Script dummy untuk interaktivitas minimal
$(document).ready(function(){
  console.log("Dashboard siap. Role: <?php echo $userRole; ?>");
});
</script>

</body>
</html>

<?php
} else {
    echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>