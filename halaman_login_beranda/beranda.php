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
</head>
<body>
    <header>
        <h1>Sewa PlayStation</h1>
        <p>Selamat datang <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <div class="menu">
    <h3>Menu</h3>
    <ul>
        <li><a href="alamat.php">Alamat</a></li>
        <li><a href="cara_memesan.php">Cara Memesan</a></li>
    </ul>
</div>


   <section id="services" class="services">
    <h2>Our Services</h2>
    <h1>Di bawah ini merupakan daftar game dan playstation yang tersedia di kantor kami:</h1>
    <div class="service-list">
        <?php foreach ($available_services as $service): ?>
            <div class="service-item">
                <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
                <p>Harga: Rp<?php echo number_format($service['price'], 2, ',', '.'); ?></p>
                <img src="images/status/<?php echo $service['status'] === 'available' ? 'available.png' : 'unavailable.png'; ?>" alt="<?php echo $service['status']; ?>" width="100">
            </div>
        <?php endforeach; ?>
    </div>
</section>


    <section id="booking">
    <h2>Booking Sekarang</h2>
    <form action="proses_booking.php" method="POST">
        <label for="service_id">Pilih Layanan:</label>
        <select name="service_id" id="service_id" required>
            <?php foreach ($available_services as $service): ?>
                <option value="<?php echo $service['id']; ?>">
                    <?php echo htmlspecialchars($service['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label for="customer_name">Nama Anda:</label>
        <input type="text" name="customer_name" id="customer_name" required>
        
        <label for="booking_date">Tanggal Booking:</label>
        <input type="date" name="booking_date" id="booking_date" required>
        
        <button type="submit">Booking Sekarang</button>
    </form>
</section>

<hr style="border: 3px solid #333;">

<h2 style="text-align: center;">List game dan Playstation</h2>



    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
