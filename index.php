<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__ . "/config/koneksi.php");
if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
    $page = isset($_GET['page']) ? basename($_GET['page']) : "";
    function navActive($item) {
        global $page;
        return $page === $item ? 'active' : '';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Klinik Gizi</title>
  <meta name="description" content="Sistem Informasi Klinik Gizi untuk manajemen pasien, ahli gizi, konsultasi, dan laporan.">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .main-header .navbar { background: #289c6e; }
    .main-sidebar { background: #054d38; }
    .brand-link { background: #046a4a; }
    .brand-text { color: #ffffff !important; }
    .user-panel .info a { color: #ffffff; }
    .content-header h1, .card-header, .card-title { color: #0d6efd; }
    .table thead th { background: #e9f7ef; }
    .btn-primary { background-color: #007bff; border-color: #007bff; }
    .btn-info { background-color: #17a2b8; border-color: #17a2b8; }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Dashboard</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <span class="nav-link">Sistem Informasi Klinik Gizi</span>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" role="button">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Logo Klinik Gizi" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Klinik Gizi</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= htmlspecialchars($_SESSION['username']); ?></a>
        </div>
      </div>
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button>
          </div>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="index.php" class="nav-link <?= navActive(''); ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= in_array($page, ['guru','siswa','program_diet','monitoring_gizi','jadwal_konsultasi']) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>Master Data<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="index.php?page=ahli_gizi" class="nav-link <?= navActive('ahli_gizi'); ?>"><i class="far fa-circle nav-icon"></i><p>Data Ahli Gizi</p></a></li>
              <li class="nav-item"><a href="index.php?page=pasien" class="nav-link <?= navActive('pasien'); ?>"><i class="far fa-circle nav-icon"></i><p>Data Pasien</p></a></li>
              <li class="nav-item"><a href="index.php?page=jadwal_konsultasi" class="nav-link <?= navActive('jadwal_konsultasi'); ?>"><i class="far fa-circle nav-icon"></i><p>Data Jadwal Konsultasi</p></a></li>
              <li class="nav-item"><a href="index.php?page=program_diet" class="nav-link <?= navActive('program_diet'); ?>"><i class="far fa-circle nav-icon"></i><p>Data Program Diet</p></a></li>
              <li class="nav-item"><a href="index.php?page=monitoring_gizi" class="nav-link <?= navActive('monitoring_gizi'); ?>"><i class="far fa-circle nav-icon"></i><p>Monitoring Gizi</p></a></li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?= $page === 'ganti_password' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Pengaturan<i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="index.php?page=ganti_password" class="nav-link <?= navActive('ganti_password'); ?>"><i class="far fa-circle nav-icon"></i><p>Profil Klinik</p></a></li>
            </ul>
          </li>
          <li class="nav-item"><a href="logout.php" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0">Sistem Informasi Klinik Gizi</h1></div>
          <div class="col-sm-6"><ol class="breadcrumb float-sm-right"><li class="breadcrumb-item"><a href="index.php">Home</a></li><li class="breadcrumb-item active"><?= $page === '' ? 'Dashboard' : ucfirst(str_replace('_', ' ', $page)); ?></li></ol></div>
        </div>
      </div>
    </div>
    <div class="content"><div class="container-fluid"><?php if ($page == "") { include "page/dashboard.php"; } elseif (!file_exists("page/$page.php")) { echo "<div class=\"alert alert-danger\">File Tidak Ditemukan</div>"; } else { include "page/$page.php"; } ?></div></div>
  </div>
  <aside class="control-sidebar control-sidebar-dark"><div class="p-3"><h5>Info</h5><p>Sistem Klinik Gizi</p></div></aside>
  <footer class="main-footer"><div class="float-right d-none d-sm-inline">Klinik Gizi</div><strong>&copy; 2026 Sistem Informasi Klinik Gizi.</strong> Semua hak dilindungi.</footer>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
<?php } else { echo "<meta http-equiv='refresh' content='0; url=login.php'>"; } ?>
