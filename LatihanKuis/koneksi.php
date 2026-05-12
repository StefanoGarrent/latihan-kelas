<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'meow';

$koneksi = new mysqli($hostname, $username, $password, $database);

if($koneksi -> connect_error){
    die();
}