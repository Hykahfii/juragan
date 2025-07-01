<?php
$host = "localhost";
$port = "3306";
$user = "root";
$pass = "root"; // ← ubah dari kosong menjadi 'root'
$db   = "saw_siswa";

$koneksi = new mysqli($host, $user, $pass, $db, $port);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
