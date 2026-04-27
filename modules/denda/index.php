<?php require_once '../../config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Denda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">Daftar Denda Siswa</h5>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Keterlambatan</th>
                            <th>Total Denda</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT fines.*, students.name as student_name 
                                FROM fines 
                                JOIN borrowings ON fines.borrowing_id = borrowings.id 
                                JOIN students ON borrowings.student_id = students.id 
                                ORDER BY is_paid ASC, id DESC";
                        $query = mysqli_query($conn, $sql);
                        $no = 1;
                        while($row = mysqli_fetch_array($query)) {
                            $total_rp = $row['late_days'] * 1000;
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['student_name']; ?></td>
                            <td><?= $row['late_days']; ?> Hari</td>
                            <td>Rp <?= number_format($total_rp, 0, ',', '.'); ?></td>
                            <td>
                                <?= $row['is_paid'] 
                                    ? '<span class="badge bg-success">Lunas</span>' 
                                    : '<span class="badge bg-danger">Belum Bayar</span>'; ?>
                            </td>
                            <td>
                                <?php if(!$row['is_paid']): ?>
                                    <a href="proses.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-success" onclick="return confirm('Tandai denda sebagai Lunas?')">Bayar Sekarang</a>
                                <?php else: ?>
                                    <span class="text-muted small">Selesai</span>
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