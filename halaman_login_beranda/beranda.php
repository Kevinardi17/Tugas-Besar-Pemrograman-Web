<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Koneksi database
$host = 'localhost';
$dbname = 'rentalin.com';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Ambil data layanan yang tersedia
$stmt = $pdo->query("SELECT * FROM playstation_services WHERE status = 'available'");
$available_services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentalin.com</title>
    <link rel="stylesheet" href="stylesberanda.css">
    <style>
        /* Tambahkan gaya untuk tombol logout di pojok kanan atas */
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #e60000;
        }

    .service-list {
        display: grid;
        grid-auto-flow: column; /* Data akan mengalir secara kolom */
        grid-auto-rows: minmax(150px, auto); /* Set tinggi minimum untuk setiap item */
        gap: 20px; /* Jarak antar item */
    }

    .service-item {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .service-item h3 {
        margin-top: 0;
    }

    .service-item p {
        margin: 5px 0;
    }

    @media (max-width: 768px) {
        .service-list {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Sesuaikan layout pada layar kecil */
            grid-auto-flow: row; /* Pada layar kecil, data disusun kembali secara horizontal */
        }
    }
</style>

</style>
    </style>
</head>
<body>
    <header>
        <h1>Sewa PlayStation</h1>
        <p>Selamat datang <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <section id="services" class="services">
    <h2>Our Services</h2>
    <div class="service-list">
        <?php foreach ($available_services as $service): ?>
            <div class="service-item">
                <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
                <p>Harga: Rp<?php echo number_format($service['price'], 2, ',', '.'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>


    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
