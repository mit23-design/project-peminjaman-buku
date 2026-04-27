<?php
require_once '../../config/database.php';

// 1. Ambil ID dari URL untuk menampilkan data lama
$id = $_GET['id'];
$query_ambil = mysqli_query($conn, "SELECT * FROM publishers WHERE id = $id");
$data = mysqli_fetch_array($query_ambil);

// 2. LOGIKA PROSES (Akan jalan hanya jika tombol 'Update' diklik)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name    = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $query_update = "UPDATE publishers SET name='$name', address='$address', contact='$contact' WHERE id=$id";
    
    if (mysqli_query($conn, $query_update)) {
        // Jika berhasil, langsung pindah ke index
        echo "<script>alert('Data berhasil diupdate!'); window.location='index.php';</script>";
        exit();
    } else {
        echo "Gagal Update: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Penerbit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="card col-md-6 mx-auto shadow border-0">
            <div class="card-header bg-warning text-dark fw-bold">Edit Data Penerbit</div>
            <div class="card-body">
                
                <form action="" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Penerbit</label>
                        <input type="text" name="name" class="form-control" value="<?= $data['name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="address" class="form-control" rows="3"><?= $data['address']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kontak</label>
                        <input type="text" name="contact" class="form-control" value="<?= $data['contact']; ?>">
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-warning px-4">Update Data</button>
                        <a href="index.php" class="btn btn-secondary px-4">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>