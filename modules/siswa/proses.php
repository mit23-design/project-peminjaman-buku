<?php
require_once '../../config/database.php';

$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : '';

if ($aksi == 'tambah') {
    $nis    = $_POST['nis'];
    $name   = $_POST['name'];
    $status = $_POST['status'];

    $query = "INSERT INTO students (nis, name, status) VALUES ('$nis', '$name', '$status')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} 

elseif ($aksi == 'hapus') {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM students WHERE id=$id");
    header("Location: index.php");
    exit();
}
?>