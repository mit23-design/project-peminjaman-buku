<?php require_once '../../config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between">
                <h5 class="mb-0">Daftar Koleksi Buku</h5>
                <a href="tambah.php" class="btn btn-sm btn-light">Tambah Buku</a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>ISBN</th>
                            <th>Penerbit</th>
                            <th>Stok (Total/Tersedia)</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Query JOIN untuk mengambil nama penerbit
                        $sql = "SELECT books.*, publishers.name as publisher_name 
                                FROM books 
                                JOIN publishers ON books.publisher_id = publishers.id 
                                ORDER BY books.id DESC";
                        $query = mysqli_query($conn, $sql);
                        $no = 1;
                        while($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['title']; ?></td>
                            <td><?= $row['isbn']; ?></td>
                            <td><?= $row['publisher_name']; ?></td>
                            <td><?= $row['total_qty']; ?> / <strong><?= $row['available_qty']; ?></strong></td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="proses.php?aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus buku ini?')">Hapus</a>
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