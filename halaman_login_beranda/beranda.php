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

// Ambil data layanan yang tersedia dan belum dipesan
$stmt = $pdo->query("SELECT ps.* FROM playstation_services ps LEFT JOIN bookings b ON ps.id = b.service_id WHERE ps.status = 'available' AND b.service_id IS NULL");
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
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #f1e6d1;
            /* Cream */
        }

        header {
            background-color: #3b6b3d;
            /* Hijau Daun */
            color: #f1e6d1;
            /* Cream */
            text-align: center;
            padding: 20px;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            text-decoration: none;
            background-color: #ff5c5c;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .hero {
            text-align: center;
            background-color: #a8d5ba;
            /* Hijau Mint */
            padding: 60px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 30px;
        }

        .hero img {
            max-width: 400px;
            margin-bottom: 2px;
        }

        .menu {
            background: #f1e6d1;
            /* Cream */
            padding: 10px;
            margin-top: 20px;
        }

        .menu ul {
            list-style: none;
            padding: 0;
            text-align: center;
        }

        .menu ul li {
            display: inline-block;
            margin-right: 20px;
        }

        .menu ul li a {
            text-decoration: none;
            color: #3b6b3d;
            font-weight: bold;
            font-size: 18px;
        }

        .menu ul li a:hover {
            color: #a8d5ba;
        }

        section {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .services h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .service-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .service-item {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            flex: 1 1 calc(33.333% - 20px);
            text-align: center;
        }

        .game-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            justify-items: center;
            margin-top: 20px;
        }

        .game-gallery .game img {
            width: 100%;
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #2e4d2e;
            /* Hijau Gelap */
            color: #f1e6d1;
            /* Cream */
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <h1>Sewa PlayStation</h1>
        <p>Selamat Datang <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>

    <section id="home" class="hero">
        <!-- Logo di tengah -->
        <img src="images/status/RENTALIN.COM_20241204_201717_0000.png" alt="Rentalin Logo" class="logo-hero">
        <h1>Welcome to rentalin.com</h1>
        <p>Experience gaming like never before!</p>
        <a href="#services" class="btn">View Services</a>
    </section>

    <div class="menu">
        <h3>Menu</h3>
        <ul>
            <li><a href="alamat.php">Alamat</a></li>
            <li><a href="cara_memesan.php">Cara Memesan</a></li>
        </ul>
    </div>

    <section id="services" class="services">
        <h2>Our Services</h2>
        <h1>Di bawah ini merupakan daftar game dan Playstation yang sedang tersedia di kantor kami:</h1>
        <div class="service-list">
            <?php foreach ($available_services as $service): ?>
                <div class="service-item">
                    <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                    <p><?php echo htmlspecialchars($service['description']); ?></p>
                    <p>Harga: Rp<?php echo number_format($service['price'], 2, ',', '.'); ?></p>
                    <img src="images/status/<?php echo $service['status'] === 'available' ? 'available.png' : 'unavailable.png'; ?>"
                        alt="<?php echo $service['status']; ?>" width="100">
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
    <section id="promo">
        <p class="center-text">Masih banyak lagi berbagai macam pilihan game ada di dalam Playstation 3, 4, dan 5</p>
        <br>
        <h3 class="center-text">AYO BOOKING SEKARANG!</h3>
    </section>

    <section id="ps3-games">
        <h2>PlayStation 3 Games</h2>
        <img src="https://upload.wikimedia.org/wikipedia/commons/d/d3/Sony-PlayStation-3-2001A-wController-L.jpg"
            width="400" style="margin-bottom: 20px;">
        <div class="game-gallery">
            <div class="game">
                <img src="https://assets.hongkiat.com/uploads/ps3-game-covers/God-of-War-3.jpg" alt="PS3 Game 1">
            </div>
            <div class="game">
                <img src="https://assets.hongkiat.com/uploads/ps3-game-covers/Alone-in-the-Dark.jpg" alt="PS3 Game 2">
            </div>
            <div class="game">
                <img src="https://assets.hongkiat.com/uploads/ps3-game-covers/Assassins-Creed-II.jpg" alt="PS3 Game 3">
            </div>
            <div class="game">
                <img src="https://i.pinimg.com/736x/a9/e9/01/a9e9018f7f8b77ebb350e7b5a3ad1aa8.jpg" alt="PS3 Game 4">
            </div>
            <div class="game">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQuFYiLQmM1iT-4V03-SNGckgPAf0UZY2p4pA&s" alt="PS3 Game 4">
        </div>    
    </section>
    <section id="ps4-games">
        <h2>PlayStation 4 Games</h2>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBwG0XkR2CbYZXQYM_jw_vCudaaQfuvOu5fA&s"
            width="400" style="margin-bottom: 20px;">
        <div class="game-gallery">
            <div class="game">
                <img src="https://i.pinimg.com/236x/d9/b2/9d/d9b29da8347554a7aa63cb947171aef8.jpg" alt="PS4 Game 1">
            </div>
            <div class="game">
                <img src="https://e0.pxfuel.com/wallpapers/690/561/desktop-wallpaper-grand-theft-auto-v-playstation-4-ps4-cover-games-gaming-ps4-rich-gta-5-thumbnail.jpg"
                    alt="PS4 Game 2">
            </div>
            <div class="game">
                <img src="https://static.fandomspot.com/images/10/20712/14-until-dawn-box-art-ps4.jpg" alt="PS4 Game 3">
            </div>
            <div class="game">
                <img src="https://i.pinimg.com/474x/78/35/13/78351378e0ec9385dd96fb45b8081bad.jpg" alt="PS3 Game 4">
            </div>
            <div class="game">
                <img src="https://i.pinimg.com/736x/08/78/31/08783142e6e76a5e511aab35db7ae1e0.jpg" alt="PS3 Game 4">
        </div>
    </section>

    <section id="ps5-games">
        <h2>PlayStation 5 Games</h2>
        <img src="https://atlas-content-cdn.pixelsquid.com/assets_v2/245/2452423176773178782/jpeg-600/G03.jpg?modifiedAt=1"
            width="400" alt="PS5 Console" style="margin-bottom: 20px;">
        <div class="game-gallery">
            <div class="game">
                <img src="https://www.vgstores.ng/wp-content/uploads/2024/05/Assassins-Creed-Shadows-PS5-469x600-1-300x400.webp"
                    alt="PS5 Game 1">
            </div>
            <div class="game">
                <img src="https://www.vgstores.ng/wp-content/uploads/2024/04/Avatar-Frontiers-of-Pandora-PS5-468x600-1-300x400.webp"
                    alt="PS5 Game 2">
            </div>
            <div class="game">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_G8uL6xc5i4VYnLRQuw84-kM1WwVF2lJtAQ&s"
                    alt="PS5 Game 3">
            </div>
            <div class="game">
                <img src="https://www.vgstores.ng/wp-content/uploads/2021/11/Ghost-Of-Tsushima-2-1.jpg"
                    alt="PS5 Game 4">
            </div>
            <div class="game">
                <img src="https://i.pinimg.com/474x/6a/58/84/6a5884622879ed7cf0dc268539b92d8d.jpg" alt="PS3 Game 4">
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>

</html>
<section id="ps4-games">