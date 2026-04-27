<?php
require_once '../../config/database.php';

$id = $_GET['id'];

// Update status denda menjadi lunas (1)
$query = "UPDATE fines SET is_paid = 1 WHERE id = $id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Pembayaran denda berhasil dicatat!'); window.location='index.php';</script>";
} else {
    echo "Gagal memproses pembayaran: " . mysqli_error($conn);
}
?>