<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Daftar</title>
</head>
<body class = "regis">
    <div class="container">
        <h1>Buat akun kamu</h1>
        <p>Sudah punya akun? <a href="index.php">Masuk</a></p>
        <form action="process_register.php" method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Masukkan email Anda" required>
            </div>
            <div class="form-group">
                <input type="text" name="username" placeholder="Pilih username" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Buat password" required>
            </div>
            <div class="form-group">
                <input type="password" id="confirmPassword" name="confirm_password" placeholder="Masukkan kembali password" required>
            </div>
            <div class="show-password">
                <input type="checkbox" id="togglePassword"> Tampilkan Password
            </div><br>
            <button type="submit" class="btn">Daftar</button>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        togglePassword.addEventListener('change', function () {
            passwordInput.type = this.checked ? 'text' : 'password';
            confirmPasswordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>