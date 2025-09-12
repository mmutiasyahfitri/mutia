<?php
$host = "localhost"; // Ganti dengan host database Anda
$user = "root";      // Ganti dengan username database Anda
$pass = "";          // Ganti dengan password database Anda
$dbname = "umkm_muteg";     // Nama database

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>