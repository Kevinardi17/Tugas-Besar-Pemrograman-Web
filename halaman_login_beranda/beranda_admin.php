<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Jika user belum login, arahkan kembali ke login
    header("Location: loginadmin.php");
    exit();
}

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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Admin - Rentalin.com</title>
    <link rel="stylesheet" href="stylesberanda.css">
</head>
<body>
    <header>
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </header>
        <section id="info">
            <h2>Informasi Layanan</h2>
            <p>Anda dapat mengelola layanan dan pelanggan dari menu di atas.</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>