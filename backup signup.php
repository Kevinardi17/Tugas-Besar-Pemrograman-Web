
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Rentalin.com</title>
    <link rel="stylesheet" href="styleslogin.css">
</head>
<body>
    <header>
        <h1>Daftar Akun - Rentalin.com</h1>
    </header>
    <main>
        <section id="signup">
            <h2>Buat Akun Baru</h2>
            <form action="signup.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>

                <button type="submit">Sign Up</button>
            </form>
            <?php
            if (!empty($error)) {
                echo "<p style='color:red;'>$error</p>";
            }
            if (!empty($success)) {
                echo "<p style='color:green;'>$success</p>";
            }
            ?>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>