<?php
session_start();
require_once __DIR__ . "/config/koneksi.php";

if(isset($_SESSION['Username'])){
  $role = $_SESSION['role']; // ambil role
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AdminLTE 3 | Starter</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"/>
  <link rel="stylesheet" href="dist/css/adminlte.min.css"/>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <div class="sidebar">

      <!-- User -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['Username']; ?></a>
        </div>
      </div>

      <!-- Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column">

          <!-- MASTER (ADMIN ONLY) -->
          <?php if ($role == 'admin') : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>Master</p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p>Guru</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p>Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <p>Mata Pelajaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>

          <!-- MENU GURU -->
          <?php if ($role == 'guru') : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Profil</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>Kelas</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Jadwal</p>
            </a>
          </li>
          <?php endif; ?>

          <!-- MENU SISWA -->
          <?php if ($role == 'siswa') : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Profil</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>Jadwal</p>
            </a>
          </li>
          <?php endif; ?>

          <!-- LOGOUT -->
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <p>Logout</p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  <!-- CONTENT -->
  <div class="content-wrapper">
    <div class="content">
      <div class="container-fluid">
        <h3>Selamat datang, <?php echo $_SESSION['Username']; ?></h3>
      </div>
    </div>
  </div>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>

<?php
}else{
  echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>c<?php
session_start();
require_once __DIR__ . "/config/koneksi.php";
if(isset($_SESSION['Username'])){
  $role = $_SESSION['role']; // TAMBAHAN
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>AdminLTE 3 | Starter</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"/>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css"/>
  <link rel="stylesheet" href="dist/css/adminlte.min.css"/>
</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- NAVBAR (TETAP) -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>
</nav>

<!-- SIDEBAR -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <div class="sidebar">

    <!-- USER -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <!-- DIGANTI DINAMIS -->
        <a href="#" class="d-block"><?php echo $_SESSION['Username']; ?></a>
      </div>
    </div>

    <!-- MENU -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column">

        <!-- MASTER (ADMIN) -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Master</p>
          </a>

          <?php if ($role == 'admin') : ?>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>Guru</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>Siswa</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>Mata Pelajaran</p>
              </a>
            </li>
          </ul>
          <?php endif; ?>
        </li>

        <!-- MENU GURU -->
        <?php if ($role == 'guru') : ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Profil</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-school"></i>
            <p>Kelas</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar"></i>
            <p>Jadwal</p>
          </a>
        </li>
        <?php endif; ?>

        <!-- MENU SISWA -->
        <?php if ($role == 'siswa') : ?>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Profil</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar"></i>
            <p>Jadwal</p>
          </a>
        </li>
        <?php endif; ?>

        <!-- TRANSAKSI (TETAP DARI KAMU, TYPO DIPERBAIKI) -->
        <li class="nav-item">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Transaksi</p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link active">
                <p>Jadwal</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- LOGOUT -->
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <p>Logout</p>
          </a>
        </li>

      </ul>
    </nav>
  </div>
</aside>

<!-- CONTENT (TETAP) -->
<div class="content-wrapper">
  <div class="content">
    <div class="container-fluid">
      <h3>Selamat datang di sistem jadwal guru</h3>
    </div>
  </div>
</div>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>

<?php
}else{
  echo "<meta http-equiv='refresh' content='0; url=login.php'>";
}
?>