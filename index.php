<?php
// Memanggil file koneksi database
require_once 'config/database.php';

// Menghitung data untuk dashboard
$count_books    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM books"))['total'];
$count_students = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM students WHERE status='active'"))['total'];
$count_borrow   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM borrowings WHERE returned_at IS NULL"))['total'];
$sum_fines      = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(late_days * 1000) as total FROM fines WHERE is_paid=0"))['total'];
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
        .card-box { padding: 20px; border-radius: 10px; color: white; transition: 0.3s; }
        .card-box:hover { opacity: 0.9; transform: translateY(-5px); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-0">
            <h4 class="text-center py-3">E-Library</h4>
            <hr class="mx-3">
            <nav>
                <a href="index.php">🏠 Dashboard</a>
                <a href="modules/siswa/index.php">👥 Data Siswa</a>
                <a href="modules/buku/index.php">📚 Data Buku</a>
                <a href="modules/penerbit/index.php">🏢 Data Penerbit</a>
                <a href="modules/peminjaman/index.php">📝 Peminjaman</a>
                <a href="modules/denda/index.php">💰 Denda</a>
            </nav>
        </div>

        <div class="col-md-10 p-4">
            <h2>Dashboard</h2>
            <p class="text-muted">Selamat datang di sistem manajemen perpustakaan.</p>
            
            <?php if($conn): ?>
                <div class="alert alert-success py-2">✅ Status: Database Terhubung!</div>
            <?php endif; ?>

            <div class="row mt-4">
            <div class="col-md-3">
                <div class="card-box bg-primary">
                    <h5>Total Buku</h5>
                    <h3><?= $count_books; ?></h3> 
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box bg-success">
                    <h5>Siswa Aktif</h5>
                    <h3><?= $count_students; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box bg-warning text-dark">
                    <h5>Pinjaman Aktif</h5>
                    <h3><?= $count_borrow; ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-box bg-danger">
                    <h5>Total Denda</h5>
                    <h3>Rp <?= number_format($sum_fines ?? 0, 0, ',', '.'); ?></h3>
                </div>
            </div>
            </div>
            
            <div class="mt-5 p-4 bg-white shadow-sm rounded">
                <h4>Petunjuk Singkat</h4>
                <ul>
                    <li>Pastikan input <strong>Data Penerbit</strong> sebelum menambah Buku.</li>
                    <li>Siswa dengan status <strong>Inactive</strong> tidak akan muncul di form peminjaman.</li>
                    <li>Denda otomatis terhitung <strong>Rp 1.000/hari</strong> saat buku dikembalikan lewat dari tenggat.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>