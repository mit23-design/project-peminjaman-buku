<?php 
require_once '../../config/database.php'; 

// Ambil ID dari URL
$id = $_GET['id'];

// Query 1: Ambil data Induk (Siswa & Tanggal)
$sql_bor = "SELECT borrowings.*, students.name as student_name, students.nis 
            FROM borrowings 
            JOIN students ON borrowings.student_id = students.id 
            WHERE borrowings.id = $id";
$query_bor = mysqli_query($conn, $sql_bor);
$data = mysqli_fetch_array($query_bor);

// Query 2: Ambil data Buku dari tabel detail
$sql_det = "SELECT borrowing_details.*, books.title, books.isbn 
            FROM borrowing_details 
            JOIN books ON borrowing_details.book_id = books.id 
            WHERE borrowing_details.borrowing_id = $id";
$query_det = mysqli_query($conn, $sql_det);

// Query 3: Cek apakah ada denda
$sql_fine = mysqli_query($conn, "SELECT * FROM fines WHERE borrowing_id = $id");
$data_fine = mysqli_fetch_array($sql_fine);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi #<?= $id; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Detail Peminjaman #<?= $id; ?></h5>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6>Informasi Siswa:</h6>
                        <p class="mb-1"><strong>Nama:</strong> <?= $data['student_name']; ?></p>
                        <p><strong>NIS:</strong> <?= $data['nis']; ?></p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h6>Status Tanggal:</h6>
                        <p class="mb-1"><strong>Pinjam:</strong> <?= $data['borrowed_at']; ?></p>
                        <p class="mb-1"><strong>Tenggat:</strong> <?= $data['ended_at']; ?></p>
                        <p><strong>Kembali:</strong> <?= $data['returned_at'] ?? '-'; ?></p>
                    </div>
                </div>

                <h6>Buku yang Dipinjam:</h6>
                <table class="table table-bordered mb-4">
                    <thead class="table-light">
                        <tr>
                            <th>ISBN</th>
                            <th>Judul Buku</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($item = mysqli_fetch_array($query_det)) : ?>
                        <tr>
                            <td><?= $item['isbn']; ?></td>
                            <td><?= $item['title']; ?></td>
                            <td>
                                <span class="badge <?= $item['status'] == 'returned' ? 'bg-success' : 'bg-warning'; ?>">
                                    <?= ucfirst($item['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <?php if($data_fine): ?>
                <div class="alert alert-danger">
                    <h6>Informasi Denda:</h6>
                    <p class="mb-0">Keterlambatan: <strong><?= $data_fine['late_days']; ?> Hari</strong></p>
                    <p class="mb-0">Total Denda: <strong>Rp <?= number_format($data_fine['late_days'] * 1000, 0, ',', '.'); ?></strong></p>
                    <p class="mb-0">Status: <?= $data_fine['is_paid'] ? '<span class="badge bg-success">Lunas</span>' : '<span class="badge bg-danger">Belum Dibayar</span>'; ?></p>
                </div>
                <?php endif; ?>

                <hr>
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Kembali ke Daftar</a>
                    <button onclick="window.print()" class="btn btn-primary">Cetak Detail</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>