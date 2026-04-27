<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penerbit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">Tambah Penerbit</div>
                <div class="card-body">
                    <form action="proses.php?aksi=tambah" method="post">
                        <div class="mb-3">
                            <label>Nama Penerbit</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Alamat</label>
                            <textarea name="address" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Kontak</label>
                            <input type="text" name="contact" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>