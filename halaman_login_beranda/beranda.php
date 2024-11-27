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
