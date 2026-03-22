<?php

$db_host = "localhost"; 
$db_user = "root";      
$db_pass = "";          
$db_name = "jadwalguru"; 

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$koneksi) {
    die("Gagal melakukan koneksi ke database: " . mysqli_connect_error());
}
?>