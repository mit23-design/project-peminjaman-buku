<?php
require_once '../../config/database.php';

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $student_id  = $_POST['student_id'];
    $book_id     = $_POST['book_id'];
    $borrowed_at = $_POST['borrowed_at'];
    $ended_at    = $_POST['ended_at'];

    // 1. Simpan ke tabel borrowings
    $sql_bor = "INSERT INTO borrowings (student_id, borrowed_at, ended_at) VALUES ('$student_id', '$borrowed_at', '$ended_at')";
    
    if (mysqli_query($conn, $sql_bor)) {
        $borrowing_id = mysqli_insert_id($conn); // Ambil ID barusan

        // 2. Simpan ke tabel borrowing_details
        $sql_det = "INSERT INTO borrowing_details (borrowing_id, book_id, status) VALUES ('$borrowing_id', '$book_id', 'borrowed')";
        mysqli_query($conn, $sql_det);

        // 3. Kurangi stok buku
        mysqli_query($conn, "UPDATE books SET available_qty = available_qty - 1 WHERE id = '$book_id'");

        header("Location: index.php");
    }
}

if ($aksi == 'kembali') {
    $id = $_GET['id'];
    $today = date('Y-m-d');

    // Ambil data peminjaman untuk cek tenggat
    $query = mysqli_query($conn, "SELECT * FROM borrowings WHERE id = $id");
    $data = mysqli_fetch_array($query);
    $ended_at = $data['ended_at'];

    // 1. Update tgl kembali di tabel borrowings
    mysqli_query($conn, "UPDATE borrowings SET returned_at = '$today' WHERE id = $id");

    // 2. Update status di borrowing_details & kembalikan stok buku
    $query_det = mysqli_query($conn, "SELECT book_id FROM borrowing_details WHERE borrowing_id = $id");
    $det = mysqli_fetch_array($query_det);
    $book_id = $det['book_id'];

    mysqli_query($conn, "UPDATE borrowing_details SET status = 'returned' WHERE borrowing_id = $id");
    mysqli_query($conn, "UPDATE books SET available_qty = available_qty + 1 WHERE id = $book_id");

    // 3. LOGIKA DENDA
    if ($today > $ended_at) {
        $tgl1 = new DateTime($ended_at);
        $tgl2 = new DateTime($today);
        $selisih = $tgl2->diff($tgl1)->days;
        $total_denda = $selisih * 1000;

        mysqli_query($conn, "INSERT INTO fines (borrowing_id, late_days, is_paid) VALUES ('$id', '$selisih', 0)");
    }

    header("Location: index.php");
}
?>