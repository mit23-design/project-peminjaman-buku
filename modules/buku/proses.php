<?php
require_once '../../config/database.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($aksi == 'tambah') {
    $title        = $_POST['title'];
    $isbn         = $_POST['isbn'];
    $publisher_id = $_POST['publisher_id'];
    $total_qty    = $_POST['total_qty'];
    
    // Saat buku baru ditambah, stok tersedia sama dengan total stok
    $available_qty = $total_qty;

    $query = "INSERT INTO books (title, isbn, publisher_id, total_qty, available_qty) 
              VALUES ('$title', '$isbn', '$publisher_id', '$total_qty', '$available_qty')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} 

elseif ($aksi == 'hapus') {
    $id = $_GET['id'];
    // Gunakan query delete standar
    $query = "DELETE FROM books WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>