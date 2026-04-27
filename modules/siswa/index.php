<?php require_once '../../config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between">
                <h5 class="mb-0">Daftar Siswa</h5>
                <a href="tambah.php" class="btn btn-sm btn-primary">Tambah Siswa</a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC");
                        $no = 1;
                        while($row = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nis']; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td>
                                <span class="badge <?= $row['status'] == 'active' ? 'bg-success' : 'bg-danger'; ?>">
                                    <?= ucfirst($row['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="proses.php?aksi=hapus&id=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus siswa ini?')">Hapus</a>
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