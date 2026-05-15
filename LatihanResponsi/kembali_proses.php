<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("Location: login.php?pesan=belum_login");
    exit();
}

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $queryCek = "SELECT * FROM peminjaman WHERE id='$id'";
    $resultCek = mysqli_query($conn, $queryCek);
    if (mysqli_num_rows($resultCek) > 0) {
        $data = mysqli_fetch_assoc($resultCek);
    } else {
        $_SESSION['message'] = "ID peminjaman tidak ditemukan.";
        header("Location: peminjaman.php");
        exit();
    }

    $status = $data['status'];
    $tanggal_hari_ini = date('Y-m-d');
    $tanggal_kembali = $data['tanggal_kembali'];
    $resultTerlambat = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id='$id' AND status='Dipinjam' AND tanggal_kembali < '$tanggal_hari_ini'");    

    if (mysqli_num_rows($resultTerlambat) > 0) {
        $id_buku = $data['id_buku'];
        $updateStok = "UPDATE buku SET stok = stok + 1 WHERE id='$id_buku'";
        mysqli_query($conn, $updateStok);
        
        $updateStatusBuku = "UPDATE buku SET status = CASE 
                            WHEN stok = 0 THEN 'Habis' 
                            WHEN stok > 0 AND stok <= 5 THEN 'Menipis' 
                            ELSE 'Tersedia' 
                            END WHERE id='$id_buku'";
        mysqli_query($conn, $updateStatusBuku);
        
        $status = "Terlambat";
        $updateStatus = "UPDATE peminjaman SET status='$status' WHERE id='$id'";
        mysqli_query($conn, $updateStatus);

        if (mysqli_query($conn, $updateStatus)) {
            $_SESSION['message'] = "Buku berhasil dikembalikan dengan status Terlambat.";
            header("Location: peminjaman.php");
            exit();
        } else {
            $_SESSION['message'] = "Error: " . mysqli_error($conn);
            header("Location: peminjaman.php");
            exit();
        }           
    }

     $id_buku = $data['id_buku'];
     $updateStok = "UPDATE buku SET stok = stok + 1 WHERE id='$id_buku'";
     mysqli_query($conn, $updateStok);

     $updateStatusBuku = "UPDATE buku SET status = CASE 
                        WHEN stok = 0 THEN 'Habis' 
                        WHEN stok > 0 AND stok <= 5 THEN 'Menipis' 
                        ELSE 'Tersedia' 
                        END WHERE id='$id_buku'";
     mysqli_query($conn, $updateStatusBuku);
    
    $query = "UPDATE peminjaman SET status='Dikembalikan' WHERE id='$id'";
    
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Buku berhasil dikembalikan.";
        header("Location: peminjaman.php");
        exit();
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        header("Location: peminjaman.php");
        exit();
    }
} else {
    $_SESSION['message'] = "ID peminjaman tidak ditemukan.";
    header("Location: peminjaman.php");
    exit();
}

?>