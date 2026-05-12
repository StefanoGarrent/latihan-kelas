<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    session_start();
    $_SESSION['status'] = 'login';
    header("Location: koleksi.php");
} else {
    header("Location: login.php?pesan=password_salah");
}