<?php
session_start();
require_once("config/koneksi.php"); // jika ada koneksi database
if(isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $_SESSION['username'] = $_POST['username'] ?: 'Guest';
    $_SESSION['role'] = $_POST['role'] ?? 'siswa'; // default role
    header('Location: index.php');
    exit;
}

$logged_in = isset($_SESSION['username']);
$role = $_SESSION['role'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition <?php echo $logged_in ? 'sidebar-mini' : 'login-page'; ?>">

<?php if (!$logged_in): ?>
<div class="login-box">
  <div class="login-logo"><b>Admin</b>LTE</div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form method="post" action="index.php">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-envelope"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>
        <div class="row mb-3">
          <div class="col-12">
            <select name="role" class="form-control">
              <option value="admin">Admin</option>
              <option value="guru">Guru</option>
              <option value="siswa" selected>Siswa</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<?php else: ?>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
      <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#"><i class="fas fa-search"></i></a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search">
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

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info"><a href="#" class="d-block"><?= $_SESSION['username'] ?></a></div>
      </div>

      <!-- Sidebar Search -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-book"></i><p>Master<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <?php if($role=='admin'): ?>
                <li class="nav-item"><a href="#" class="nav-link"><p>Guru</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><p>Siswa</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><p>Mata Pelajaran</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><p>Kelas</p></a></li>
              <?php elseif($role=='guru'): ?>
                <li class="nav-item"><a href="#" class="nav-link"><p>Guru</p></a></li>
                <li class="nav-item"><a href="#" class="nav-link"><p>Kelas</p></a></li>
              <?php elseif($role=='siswa'): ?>
                <li class="nav-item"><a href="#" class="nav-link"><p>Siswa</p></a></li>
              <?php endif; ?>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link"><i class="nav-icon fas fa-calendar"></i><p>Transaksi<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview"><li class="nav-item"><a href="#" class="nav-link"><p>Jadwal</p></a></li></ul>
          </li>

          <li class="nav-item"><a href="index.php?action=logout" class="nav-link"><i class="nav-icon fas fa-sign-out-alt"></i><p>Logout</p></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"><h1 class="m-0">Starter Page</h1></div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Dashboard</h5>
            <p class="card-text">Selamat datang, <?= $_SESSION['username'] ?>!</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">Anything you want</div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>