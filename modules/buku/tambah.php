<?php require_once '../../config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-success text-white">Input Data Buku</div>
                <div class="card-body">
                    <form action="proses.php?aksi=tambah" method="post">
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <select name="publisher_id" class="form-select" required>
                                <option value="">-- Pilih Penerbit --</option>
                                <?php
                                $penerbit = mysqli_query($conn, "SELECT * FROM publishers");
                                while($p = mysqli_fetch_array($penerbit)) {
                                    echo "<option value='".$p['id']."'>".$p['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok</label>
                            <input type="number" name="total_qty" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Simpan Buku</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>