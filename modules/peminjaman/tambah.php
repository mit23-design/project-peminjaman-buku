<?php require_once '../../config/database.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pinjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">Form Peminjaman</div>
                <div class="card-body">
                    <form action="proses.php?aksi=tambah" method="post">
                        <div class="mb-3">
                            <label>Siswa (Hanya yang Aktif)</label>
                            <select name="student_id" class="form-select" required>
                                <option value="">-- Pilih Siswa --</option>
                                <?php
                                $students = mysqli_query($conn, "SELECT * FROM students WHERE status='active'");
                                while($s = mysqli_fetch_array($students)) {
                                    echo "<option value='".$s['id']."'>".$s['nis']." - ".$s['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Buku (Hanya yang Tersedia)</label>
                            <select name="book_id" class="form-select" required>
                                <option value="">-- Pilih Buku --</option>
                                <?php
                                $books = mysqli_query($conn, "SELECT * FROM books WHERE available_qty > 0");
                                while($b = mysqli_fetch_array($books)) {
                                    echo "<option value='".$b['id']."'>".$b['title']." (Stok: ".$b['available_qty'].")</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Tanggal Pinjam</label>
                            <input type="date" name="borrowed_at" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label>Batas Kembali (Tenggat)</label>
                            <input type="date" name="ended_at" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Proses Pinjam</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>