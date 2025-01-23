<?php
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$servername = "localhost"; // Nama host
$username = "root";        // Nama pengguna database
$password = "";            // Kata sandi database
$dbname = "ta_pwd"; // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>