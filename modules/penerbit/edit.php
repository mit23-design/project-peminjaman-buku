<?php
require_once '../../config/database.php';

// Menangkap aksi dari URL (tambah, edit, atau hapus)
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($aksi == 'tambah') {
    // Menangkap data dari form tambah
    $name    = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $query = "INSERT INTO publishers (name, address, contact) VALUES ('$name', '$address', '$contact')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?status=sukses_tambah");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} 

elseif ($aksi == 'edit') {
    // Menangkap data dari form edit
    $id      = $_POST['id'];
    $name    = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $query = "UPDATE publishers SET name='$name', address='$address', contact='$contact' WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?status=sukses_edit");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

elseif ($aksi == 'hapus') {
    // Menangkap ID dari link hapus
    $id = $_GET['id'];
    
    $query = "DELETE FROM publishers WHERE id=$id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php?status=sukses_hapus");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>