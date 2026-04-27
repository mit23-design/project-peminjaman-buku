<?php
require_once '../../config/database.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Penerbit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h5 class="mb-0">Daftar Penerbit</h5>
                <a href="tambah.php" class="btn btn-sm btn-light">Tambah Penerbit</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penerbit</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM publishers ORDER BY id DESC");
                        $no = 1;
                        while($data = mysqli_fetch_array($query)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data['name']; ?></td>
                            <td><?= $data['address']; ?></td>
                            <td><?= $data['contact']; ?></td>
                            <td>
                                <a href="edit.php?id=<?= $data['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="proses.php?aksi=hapus&id=<?= $data['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="../../index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>