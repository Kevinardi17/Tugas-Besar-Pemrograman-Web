<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'rentalin.com';
$username = 'root';
$password = '';

// Hubungkan ke database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Proses login
$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Periksa pengguna di database
    $stmt = $pdo->prepare("SELECT * FROM data_admin WHERE username = :username");
    $stmt->execute(['username' => $inputUsername]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($inputPassword, $user['password'])) {
        // Login berhasil, simpan session
        $_SESSION['username'] = $user['username'];
        header("Location: beranda_admin.php");
        exit();
    } else {
        // Login gagal
        $error = "Username atau password salah.";
    }
}
?>

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
        <h1>Login Admin </h1>
    </header>
    <main>
        <section id="login">
            <h2>Masuk</h2>
            <form action="loginadmin.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>

                <button type="submit">Login</button>
                <?php if (!empty($error)) echo "<p style='color: red;'>$error</p>"; ?>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
