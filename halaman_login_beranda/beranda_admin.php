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

// Ambil data pelanggan (contoh)
$stmt = $pdo->query("SELECT COUNT(*) as total_pelanggan FROM data_pelanggan");
$totalPelanggan = $stmt->fetch(PDO::FETCH_ASSOC)['total_pelanggan'];

// Ambil data penyewaan (contoh)
$stmt = $pdo->query("SELECT COUNT(*) as total_penyewaan FROM penyewaan");
$totalPenyewaan = $stmt->fetch(PDO::FETCH_ASSOC)['total_penyewaan'];
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
    <nav>
        <ul>
            <li><a href="beranda_admin.php">Beranda</a></li>
            <li><a href="kelola_pelanggan.php">Kelola Pelanggan</a></li>
            <li><a href="kelola_layanan.php">Kelola Layanan</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <main>
        <section id="statistik">
            <h2>Statistik</h2>
            <p>Total Pelanggan: <strong><?php echo $totalPelanggan; ?></strong></p>
            <p>Total Penyewaan: <strong><?php echo $totalPenyewaan; ?></strong></p>
        </section>
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