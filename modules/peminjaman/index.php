<?php require_once '../../config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <h5 class="mb-0">Transaksi Peminjaman</h5>
                <a href="tambah.php" class="btn btn-sm btn-primary">Tambah Peminjaman</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Siswa</th>
                            <th>Tgl Pinjam</th>
                            <th>Tenggat</th>
                            <th>Tgl Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT borrowings.*, students.name as student_name 
                                FROM borrowings 
                                JOIN students ON borrowings.student_id = students.id 
                                ORDER BY id DESC";
                        $query = mysqli_query($conn, $sql);
                        $no = 1;
                        while($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['student_name']; ?></td>
                            <td><?= $row['borrowed_at']; ?></td>
                            <td><?= $row['ended_at']; ?></td>
                            <td><?= $row['returned_at'] ?? '<span class="badge bg-warning">Belum Kembali</span>'; ?></td>
                            <td>
                                <a href="detail.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info text-white">Detail</a>
                                <?php if(!$row['returned_at']): ?>
                                    <a href="proses.php?aksi=kembali&id=<?= $row['id']; ?>" class="btn btn-sm btn-success" onclick="return confirm('Proses pengembalian buku?')">Kembalikan</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="../../index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>