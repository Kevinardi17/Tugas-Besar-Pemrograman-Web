<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Memesan - Rentalin.com</title>
    <link rel="stylesheet" href="stylesberanda.css">
</head>
<body>
    <header>
        <h1>Cara Memesan</h1>
        <a href="beranda.php" class="logout-btn">Kembali ke Beranda</a>
    </header>

    <section>
        <h2>Panduan Pemesanan</h2>
        <ol>
            <li>Kunjungi halaman <a href="beranda.php#services">layanan</a>.</li>
            <li>Pilih layanan yang ingin disewa.</li>
            <li>Lakukan booking sesuai dengan menu yang tertera.</li>
            <li>Anda akan mendapat nomor booking.</li>
            <li>Hubungi kami melalui <a href="https://wa.me/6285764425294" target="_blank">WhatsApp</a> untuk konfirmasi.</li>
            <li>Silahkan menuju kantor kami untuk mengambil Playstation</li>
            <li>ENJOY THE GAME!!</li>
        </ol>
    </section>

    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
