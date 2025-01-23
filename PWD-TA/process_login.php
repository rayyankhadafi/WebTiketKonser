<?php
include 'koneksi.php';

// Mendapatkan data dari form
$username_or_email = $_POST['username'];
$password = $_POST['password'];

// Mencari pengguna berdasarkan username atau email
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username_or_email, $username_or_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Memeriksa password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Login berhasil, arahkan ke dashboard.php
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Password salah.";
    }
} else {
    echo "Username atau email tidak ditemukan.";
}
$stmt->close();

// Menutup koneksi
$conn->close();
?>