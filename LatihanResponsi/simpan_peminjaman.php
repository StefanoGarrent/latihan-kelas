<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != 'login') {
    header("Location: login.php?pesan=belum_login");
    exit();
}

include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $kode_peminjaman = $_POST['kode_peminjaman'];
    $nama_peminjam = $_POST['nama_peminjam'];
    $judul_buku = $_POST['judul_buku'];
    $tanggal_peminjaman = $_POST['tanggal_peminjaman'];
    $tanggal_kembali = $_POST['tanggal_kembali'];

    $cekIDBuku = mysqli_query($conn, "SELECT id FROM buku WHERE judul='$judul_buku' AND stok > 0");

    if (mysqli_num_rows($cekIDBuku) > 0) {
        $dataBuku = mysqli_fetch_assoc($cekIDBuku);
        $id_buku = $dataBuku['id'];
        $buku = $judul_buku;
    } else {
        $_SESSION['message'] = "Buku tidak tersedia untuk dipinjam.";
        header("Location: catat_peminjaman.php");
        exit();
    }

    $cek = mysqli_query($conn, "SELECT * FROM peminjaman WHERE kode_peminjaman = '$kode_peminjaman'");

    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['message'] = "Kode peminjaman sudah digunakan.";
        header("Location: catat_peminjaman.php");
        exit();
    }

    if ($tanggal_kembali < $tanggal_peminjaman) {
        $_SESSION['message'] = "Tanggal kembali tidak valid.";
        header("Location: catat_peminjaman.php");
        exit();
    }

    $tanggal_hari_ini = date('Y-m-d');
    if ($tanggal_peminjaman > $tanggal_hari_ini) {
        $_SESSION['message'] = "Tanggal peminjaman tidak boleh lebih dari hari ini.";
        header("Location: catat_peminjaman.php");
        exit();
    }

    $query = "INSERT INTO peminjaman (kode_peminjaman, peminjam, id_buku, tanggal_pinjam, tanggal_kembali, status) VALUES ('$kode_peminjaman', '$nama_peminjam', '$id_buku', '$tanggal_peminjaman', '$tanggal_kembali', 'Dipinjam')";    
    $result = mysqli_query($conn, $query);

    if ($result) {
        $kurangStok = "UPDATE buku SET stok = stok - 1 WHERE id='$id_buku'";
        mysqli_query($conn, $kurangStok);

        $updateStatusBuku = "UPDATE buku SET status = CASE 
                        WHEN stok = 0 THEN 'Habis' 
                        WHEN stok > 0 AND stok <= 5 THEN 'Menipis' 
                        ELSE 'Tersedia' 
                    END WHERE id='$id_buku'";
        mysqli_query($conn, $updateStatusBuku);

        $_SESSION['message'] = "Peminjaman berhasil disimpan.";
        header("Location: peminjaman.php");
        exit();
    } else {
        $_SESSION['message'] = "Peminjaman gagal disimpan.";
        header("Location: catat_peminjaman.php");
        exit();
    }
}