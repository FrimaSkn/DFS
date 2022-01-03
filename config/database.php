

<?php
// deklarasi parameter koneksi database
$server   = "localhost";
$username = "root";
$password = "root";
$database = "dfs_native";

// koneksi database
$config = new mysqli($server, $username, $password, $database);

// cek koneksi
if ($config->connect_error) {
    die('Koneksi Database Gagal : '.$config->connect_error);
}
?>