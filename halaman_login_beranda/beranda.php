<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Jika user belum login, arahkan kembali ke login
    header("Location: login.php");
    exit();
}
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
    </style>
</head>
<body>
    <header>
        <h1>Sewa PlayStation </h1>
        <p>Selamat datang <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </header>
    <header>
        <nav>
            <div class="logo">Rentalin.com</div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>
    <section id="home" class="hero">
        <!-- Tambahkan logo di sini -->
        <img src="moon-phase-3.png" alt="Rentalin Logo" class="logo-hero">
        <h1>Welcome to Rentalin.com PS</h1>
        <p>Experience gaming like never before!</p>
        <a href="#services" class="btn">View Services</a>
    </section>
    <section id="services" class="services">
        <h2>Our Services</h2>
        <div class="service">
            <h3>PlayStation Rentals</h3>
            <p>Rent the latest gaming consoles at affordable prices.</p>
            <ul>
                <li>Harga mulai dari <strong>Rp8.000</strong></li>
                <li>Game PS 4 terbaru</li>
                <li>TV 32 - 50 inci</li>
                <li>Free WiFi Pass: <strong>rentalinaja</strong></li>
                <li>Full AC</li>
            </ul>
        </div>
        <div class="service">
            <h3>Game Library</h3>
            <p>Access a wide range of games for all genres.</p>
        </div>
        <div class="service">
            <h3>Exclusive Gaming Events</h3>
            <p>Join our gaming events and tournaments.</p>
        </div>
        <!-- Cek Ketersediaan PlayStation -->
        <div class="availability-section">
            <h3>Cek Ketersediaan PlayStation</h3>
            <div class="playstation-container">
                <div class="playstation available">
                    <img src="https://cdn-icons-png.flaticon.com/512/5610/5610944.png" alt="Available" class="status-icon">
                    <p>PLAYSTATION 1</p>
                </div>
                <div class="playstation available">
                    <img src="https://cdn-icons-png.flaticon.com/512/5610/5610944.png" alt="Available" class="status-icon">
                    <p>PLAYSTATION 2</p>
                </div>
                <div class="playstation unavailable">
                    <img src="https://cdn-icons-png.flaticon.com/512/11443/11443297.png" alt="Unavailable" class="status-icon">
                    <p>SELESAI PUKUL 21:49</p>
                    <p>PLAYSTATION 3</p>
                </div>
                <div class="playstation available">
                    <img src="https://cdn-icons-png.flaticon.com/512/5610/5610944.png" alt="Available" class="status-icon">
                    <p>PLAYSTATION 4</p>
                </div>
                <div class="playstation unavailable">
                    <img src="https://cdn-icons-png.flaticon.com/512/11443/11443297.png" alt="Unavailable" class="status-icon">
                    <p>SELESAI PUKUL 23:00</p>
                    <p>PLAYSTATION 5</p>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="contact-box">
            <p>UNTUK BOOKING DAPAT MELALUI <a href="https://wa.me/6289654372986" target="_blank">WHATSAPP 089654372986</a></p>
        </div>
        
    </footer>
</body>
    <nav>
        <ul>
            <li><a href="#layanan">Layanan</a></li>
            <li><a href="#cara-pesan">Cara Pesan</a></li>
            <li><a href="#kontak">Kontak</a></li>
        </ul>
    </nav>
    <main>

    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
