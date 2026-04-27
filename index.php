<?php
// Memanggil file koneksi
require_once 'config/database.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Buku Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #343a40; color: white; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px 20px; }
        .sidebar a:hover { background: #495057; }
        .card-box { padding: 20px; border-radius: 10px; color: white; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h4 class="text-center">E-Library</h4>
            <hr>
            <a href="index.php">Dashboard</a>
            <a href="modules/siswa/index.php">Data Siswa</a>
            <a href="modules/buku/index.php">Data Buku</a>
            <a href="modules/penerbit/index.php">Data Penerbit</a>
            <a href="modules/peminjaman/index.php">Peminjaman</a>
            <a href="modules/denda/index.php">Denda</a>
        </div>

        <div class="col-md-10 p-4">
            <h2>Dashboard</h2>
            <p>Selamat datang di sistem manajemen perpustakaan.</p>
            
            <?php 
            // Cek status koneksi
            if($conn) {
                echo '<div class="alert alert-success">Status Koneksi: Database Terhubung!</div>';
            }
            ?>

            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card-box bg-primary">
                        <h5>Total Buku</h5>
                        <h3>0</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box bg-success">
                        <h5>Siswa Aktif</h5>
                        <h3>0</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box bg-warning">
                        <h5>Pinjaman Aktif</h5>
                        <h3>0</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-box bg-danger">
                        <h5>Total Denda</h5>
                        <h3>Rp 0</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>