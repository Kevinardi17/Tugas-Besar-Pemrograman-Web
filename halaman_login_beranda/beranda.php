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
</head>
<body>
    <header>
        <h1>Sewa PlayStation </h1>
        <p>Seru-seruan main PS kapan saja, di mana saja!</p>
    </header>
    <nav>
        <ul>
            <li><a href="#layanan">Layanan</a></li>
            <li><a href="#cara-pesan">Cara Pesan</a></li>
            <li><a href="#kontak">Kontak</a></li>
        </ul>
    </nav>
    <main>
        <section id="layanan">
            <h2>Layanan Kami</h2>
            <p>Kami menyediakan PlayStation lengkap dengan berbagai pilihan game favorit untuk menemani waktu santai Anda.</p>
        </section>
        <section id="cara-pesan">
            <h2>Cara Pesan</h2>
            <ol>
                <li>Pilih paket yang diinginkan.</li>
                <li>Hubungi kami melalui WhatsApp atau telepon.</li>
                <li>Pesanan akan segera dikirim ke lokasi Anda.</li>
            </ol>
        </section>
        <section id="kontak">
            <h2>Kontak Kami</h2>
            <p>Hubungi kami di: <strong>0812-3456-7890</strong></p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
