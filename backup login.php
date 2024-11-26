<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rentalin.com</title>
    <link rel="stylesheet" href="styleslogin.css">
</head>
<body>
    <header>
        <h1>Login ke Rentalin.com </h1>
    </header>
    <main>
        <section id="login">
            <h2>Masuk</h2>
            <form action="login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>
    
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>
    
                <button type="submit">Login</button>
                <?php if (!empty($error)) echo "<p>$error</p>"; ?>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>