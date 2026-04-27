<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Tambah Siswa Baru</div>
                <div class="card-body">
                    <form action="proses.php?aksi=tambah" method="post">
                        <div class="mb-3">
                            <label class="form-label">NIS (Nomor Induk Siswa)</label>
                            <input type="text" name="nis" class="form-control" placeholder="Contoh: 2024001" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Siswa</label>
                            <select name="status" class="form-select">
                                <option value="active">Active (Aktif)</option>
                                <option value="inactive">Inactive (Tidak Aktif)</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">Simpan Siswa</button>
                            <a href="index.php" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>