<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class = "login" >
    <div class="container">
        <h1>Masuk ke akunmu</h1>
        <p>Tidak punya akun? <a href="regis.php">Daftar</a></p>
        <form action="process_login.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" placeholder="Masukkan email atau username" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            <div class="show-password">
                <input type="checkbox" id="togglePassword"> Tampilkan Password
            </div><br>
            <button type="submit" class="btn">Masuk</button>
        </form>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('change', function () {
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>