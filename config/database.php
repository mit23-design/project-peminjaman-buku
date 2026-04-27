<?php
// Konfigurasi Database
$host     = "localhost";
$username = "root";
$password = "";
$database = "db_perpus_sekolah"; // Sesuaikan dengan nama database yang kamu buat tadi

// Membuat koneksi menggunakan MySQLi
$conn = mysqli_connect($host, $username, $password, $database);

// Cek Koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>