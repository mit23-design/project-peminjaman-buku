<?php
require_once '../../config/database.php';

$id = $_GET['id'];
$query_ambil = mysqli_query($conn, "SELECT * FROM books WHERE id = $id");
$data_buku = mysqli_fetch_array($query_ambil);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title        = $_POST['title'];
    $isbn         = $_POST['isbn'];
    $publisher_id = $_POST['publisher_id'];
    $total_qty    = $_POST['total_qty'];
    
    // Logika sederhana: jika total stok diubah, kita sesuaikan stok tersedia 
    // (Dalam aplikasi nyata, ini lebih kompleks, tapi ini cukup untuk project sekolah)
    $available_qty = $_POST['total_qty']; 

    $query_update = "UPDATE books SET 
                     title = '$title', 
                     isbn = '$isbn', 
                     publisher_id = '$publisher_id', 
                     total_qty = '$total_qty', 
                     available_qty = '$available_qty' 
                     WHERE id = $id";
    
    if (mysqli_query($conn, $query_update)) {
        echo "<script>alert('Data buku berhasil diupdate!'); window.location='index.php';</script>";
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
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning fw-bold">Edit Data Buku</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" name="title" class="form-control" value="<?= $data_buku['title']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" name="isbn" class="form-control" value="<?= $data_buku['isbn']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <select name="publisher_id" class="form-select" required>
                                <?php
                                $penerbit = mysqli_query($conn, "SELECT * FROM publishers");
                                while($p = mysqli_fetch_array($penerbit)) {
                                    // Cek apakah ini penerbit milik buku tersebut
                                    $select = ($p['id'] == $data_buku['publisher_id']) ? 'selected' : '';
                                    echo "<option value='".$p['id']."' $select>".$p['name']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total Stok</label>
                            <input type="number" name="total_qty" class="form-control" value="<?= $data_buku['total_qty']; ?>" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">Update Buku</button>
                            <a href="index.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>