<?php
require_once '../../config/database.php';

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO publishers (name, address, contact) VALUES ('$name', '$address', '$contact')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    }
} 

if ($aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM publishers WHERE id = $id");
    header("Location: index.php");
}
?>