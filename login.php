<?php
session_start();
include "config/koneksi.php";
$error_msg = "";
if(isset($_POST['login'])) {
    $user = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $pass = mysqli_real_escape_string($koneksi, trim($_POST['password']));
    if(empty($user) || empty($pass)) {
        $error_msg = "Username dan Password tidak boleh kosong.";
    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM user WHERE Username = '$user' AND Password = '$pass'");
        $data = mysqli_fetch_array($query);
        if($data) {
            $_SESSION['username'] = $data['Username'];
            $_SESSION['level']    = $data['Role'];
            header("location:index.php");
            exit();
        } else {
            $error_msg = "Login gagal: Username atau Password salah.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Klinik Gizi | Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        body { background: linear-gradient(135deg, #f0fcff, #dff7eb); }
        .login-box, .card { border-radius: 1rem; }
        .login-logo a { color: #0b6e4f; }
        .btn-primary { background-color: #0b6e4f; border-color: #0b6e4f; }
    </style>
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo"><a href="#"><b>Sistem Informasi</b><br>Klinik Gizi</a></div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masuk untuk melanjutkan ke sistem</p>
                <?php if($error_msg != ""): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        <?= htmlspecialchars($error_msg); ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
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
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
</body>
</html>
