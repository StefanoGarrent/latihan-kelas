<?php
session_start();
include 'koneksi.php';

if(isset($_POST['submit'])){
    $nama_lengkap = $_POST['nama_lengkap'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $kelompok_umur = $_POST['kelompok_umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $hobi = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : '';
    $asal_daerah = $_POST['asal_daerah'];
    $alasan_bergabung = $_POST['alasan_bergabung'];

    $query1 = "SELECT * FROM pendaftaran WHERE nama_lengkap = '$nama_lengkap' AND tanggal_lahir = '$tanggal_lahir'";
    $query2 = "INSERT INTO pendaftaran (nama_lengkap, tanggal_lahir, kelompok_umur, jenis_kelamin, hobi, asal_daerah, alasan_bergabung) VALUES ('$nama_lengkap', '$tanggal_lahir', '$kelompok_umur', '$jenis_kelamin', '$hobi', '$asal_daerah', '$alasan_bergabung')";

    $result1 = mysqli_query($koneksi, $query1);

    if(mysqli_num_rows($result1) > 0){
        $_SESSION['status'] = "login";
        header('Location: login.php?message=akunSudahTerdaftar');
        exit();
    }
    else{
        $result2 = mysqli_query($koneksi, $query2);
        $_SESSION['status'] = "login";
        header('Location: login.php?message=berhasilDaftar');
        exit();
    }
}