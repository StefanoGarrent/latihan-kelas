<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("Location: login.php?pesan=belum_login");
    exit();
}

include 'koneksi.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryCek = "SELECT * FROM buku WHERE id='$id'";
    $resultCek = mysqli_query($conn, $queryCek);
    if (mysqli_num_rows($resultCek) > 0) {
        $data = mysqli_fetch_assoc($resultCek);
    } else {
        $_SESSION['message'] = "ID buku tidak ditemukan.";
        header("Location: koleksi.php");
        exit();
    }
    
    $cekBukuDipinjam = "SELECT * FROM peminjaman WHERE id_buku='$id' AND status='Dipinjam'";
    $resultCekBukuDipinjam = mysqli_query($conn, $cekBukuDipinjam);
    if (mysqli_num_rows($resultCekBukuDipinjam) > 0) {
        $_SESSION['message'] = "Buku tidak dapat dihapus karena sedang dipinjam.";
        header("Location: koleksi.php");
        exit();
        }
        
    $query = "DELETE FROM buku WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Buku berhasil dihapus.";
        header("Location: koleksi.php");
        exit();
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        header("Location: koleksi.php");
        exit();
    }
} else {
    $_SESSION['message'] = "ID buku tidak ditemukan.";
    header("Location: koleksi.php");
    exit();
}

