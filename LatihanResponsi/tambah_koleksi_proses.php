<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("Location: login.php?pesan=belum_login");
    exit();
}

include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $kode_buku = $_POST['kode_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    if ($stok == 0) {
        $status = "Habis";
    } else if ($stok > 0 && $stok <= 5) {
        $status = "Menipis";
    } else {
        $status = "Tersedia";
    }

    $cek = mysqli_query($conn, "SELECT * FROM buku WHERE kode_buku='$kode_buku' OR judul='$judul'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['message'] = "Kode buku atau judul sudah ada.";
        header("Location: koleksi.php");
        exit();
    }
    $query = "INSERT INTO buku (kode_buku, judul, pengarang, kategori, stok, status) VALUES ('$kode_buku', '$judul', '$pengarang', '$kategori', '$stok', '$status')";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Buku berhasil ditambahkan.";
        header("Location: koleksi.php");
        exit();
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        header("Location: koleksi.php");
        exit();
    }
}


?>