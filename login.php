<?php
include "config/koneksi.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>AdminLTE 3 | Log in</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">

<div class="login-logo">
<a href="#"><b>Admin</b>LTE</a>
</div>

<div class="card">
<div class="card-body login-card-body">
<p class="login-box-msg">Sign in to start your session</p>

<form action="" method="post">

<div class="input-group mb-3">
<input type="text" name="Username" id="Username" class="form-control" placeholder="Username" required>
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>

<div class="input-group mb-3">
<input type="password" name="Password" id="Password" class="form-control" placeholder="Password" required>
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>

<div class="row">
<div class="col-12">
<input type="submit" name="login" value="Login" class="btn btn-primary btn-block">
</div>
</div>

</form>

<?php
if(isset($_POST['Username']) && isset($_POST['Password'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];

    if(empty($Username) || empty($Password)) {
        echo '<div class="alert alert-warning">Data Tidak Boleh kosong</div>';
    } else {
        // Query login
        $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$Username' AND password='$Password' AND role='admin'");
        
        if($query) {
            $user = mysqli_fetch_array($query);
            if($user) {
                $_SESSION['level'] = $user['role'];
                $_SESSION['Username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                Username atau Password salah
                </div>';
            }
        } else {
            echo "Query gagal: " . mysqli_error($koneksi);
        }
    }
}
?>

</div>
</div>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>