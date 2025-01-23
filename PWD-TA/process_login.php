<?php
session_start();
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
        // Login berhasil, menyimpan data ke session
        $_SESSION['username'] = $row['username'];  // Menyimpan username ke session
        $_SESSION['login_status'] = true;  // Menandakan pengguna sudah login
        $_SESSION['user_id'] = $row['id'];  // Menyimpan user_id ke session (opsional)

        // Arahkan ke dashboard.php setelah login berhasil
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Password salah.";
    }
} else {
    echo "Username atau email tidak ditemukan.";
}

$stmt->close();
$conn->close();
?>
