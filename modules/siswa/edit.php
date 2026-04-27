<?php
require_once '../../config/database.php';

$id = $_GET['id'];
$query_ambil = mysqli_query($conn, "SELECT * FROM students WHERE id = $id");
$data = mysqli_fetch_array($query_ambil);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis    = $_POST['nis'];
    $name   = $_POST['name'];
    $status = $_POST['status'];

    $query_update = "UPDATE students SET nis='$nis', name='$name', status='$status' WHERE id=$id";
    
    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Data siswa berhasil diupdate!'); window.location='index.php';</script>";
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
    <title>Edit Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="col-md-6 mx-auto shadow-sm">
            <div class="card border-0">
                <div class="card-header bg-warning fw-bold">Edit Data Siswa</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="text" name="nis" class="form-control" value="<?= $data['nis']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" name="name" class="form-control" value="<?= $data['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="active" <?= $data['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $data['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">Update Data</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>