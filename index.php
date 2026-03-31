<?php
session_start();
require_once("config/koneksi.php");

// Login handling
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        if ($password === $user['password']) { // ganti dengan password_verify jika pakai hash
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}

// Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Redirect ke login jika belum login
if (!isset($_SESSION['role'])) {
    $show_login = true;
} else {
    $show_login = false;
    $role = $_SESSION['role'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition <?php echo $show_login ? 'login-page' : 'sidebar-mini'; ?>">

<?php if($show_login): ?>
<div class="login-box">
  <div class="login-logo"><b>Admin</b>LTE</div>
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php if($error): ?><div class="alert alert-danger"><?php echo $error; ?></div><?php endif; ?>
      <form method="post" action="index.php">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-user"></span></div></div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append"><div class="input-group-text"><span class="fas fa-lock"></span></div></div>
        </div>
        <div class="row"><div class="col-12"><button type="submit" name="login" class="btn btn-primary btn-block">Login</button></div></div>
      </form>
    </div>
  </div>
</div>

<?php else: ?>

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a></li>
      <li class="nav-item d-none d-sm-inline-block"><a href="index.php" class="nav-link">Home</a></li>
      <li class="nav-item d-none d-sm-inline-block"><a href="#" class="nav-link">Contact</a></li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#"><i class="fas fa-search"></i></a>
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
        <div class="image"><img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2"></div>
        <div class="info"><a href="#" class="d-block"><?php echo $_SESSION['username']; ?></a></div>
      </div>

      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search">
          <div class="input-group-append"><button class="btn btn-sidebar"><i class="fas fa-search fa-fw"></i></button></div>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item menu-open">
            <a href="#" class="nav-link active"><i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Master<i class="right fas fa-angle-left"></i></p></a>

            <?php if ($role == 'admin') : ?>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="guru.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Guru</p></a></li>
              <li class="nav-item"><a href="siswa.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Siswa</p></a></li>
              <li class="nav-item"><a href="mata_pelajaran.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Mata Pelajaran</p></a></li>
              <li class="nav-item"><a href="kelas.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Kelas</p></a></li>
            </ul>
            <?php endif; ?>

            <?php if ($role == 'guru') : ?>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="guru.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Guru</p></a></li>
              <li class="nav-item"><a href="kelas.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Kelas</p></a></li>
            </ul>
            <?php endif; ?>

            <?php if ($role == 'siswa') : ?>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="siswa.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Siswa</p></a></li>
            </ul>
            <?php endif; ?>

          </li>

          <li class="nav-item">
            <a href="#" class="nav-link active"><i class="nav-icon fas fa-tachometer-alt"></i><p>Transaksi<i class="right fas fa-angle-left"></i></p></a>
            <ul class="nav nav-treeview">
              <li class="nav-item"><a href="jadwal.php" class="nav-link"><i class="far fa-circle nav-icon"></i><p>Jadwal</p></a></li>
            </ul>
          </li>

          <li class="nav-item"><a href="index.php?action=logout" class="nav-link"><i class="nav-icon fas fa-th"></i><p>Logout</p></a></li>

        </ul>
      </nav>
    </div>
  </aside>

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
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Dashboard</h5>
                <p class="card-text">
                <?php
                  if (isset($_GET['page'])) {
                      $page = $_GET['page'];
                  } else {
                      $page = "";
                  }
                  if ($page == "") {
                      include "page/dashboard.php";
                  } elseif (!file_exists("page/$page.php")) {
                      echo "File Tidak Ditemukan";
                  } else {
                    include "page/$page.php";
                  }
                  ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3"><h5>Title</h5><p>Sidebar content</p></div>
  </aside>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">Myodarrrr sia</div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

</div>

<?php endif; ?>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>