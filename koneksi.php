<?php
// Konfigurasi database
$db_host = "localhost"; // host database
$db_user = "root";      // username database
$db_pass = "";          // password database
$db_name = "jadwalguru"; // nama database

// Membuat koneksi
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Cek koneksi
if (!$koneksi) {
    die("Gagal melakukan koneksi ke database: " . mysqli_connect_error());
}
?>