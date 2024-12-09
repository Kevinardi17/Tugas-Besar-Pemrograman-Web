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
    <style>
        /* Gaya umum */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #436E5B;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .logout-btn {
            position: absolute;
            right: 20px;
            top: 20px;
            color: white;
            text-decoration: none;
            background-color: #ff5c5c;
            padding: 10px 15px;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: #e04141;
        }

        section {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: justify;
        }

        h1 {
            color:white
        }

        h2 {
            color:#333
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            color: #0078d7;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #436E5B;
            color: #f5deb3; /* Warna krem untuk teks footer */
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Cara Memesan</h1>
        <a href="beranda.php" class="logout-btn">Kembali ke Beranda</a>
    </header>

    <section>
        <h2>Peraturan Pemesanan</h2>
        <ul>
            <li>Menyerahkan KTP/KTM asli.</li>
            <li>Uang jaminan sebesar Rp. 50.000.</li>
            <li>Menyerahkan SIM motor atau mobil.</li>
        </ul>

        <h2>Panduan Pemesanan</h2>
        <ul>
            <li>Kunjungi halaman <a href="beranda.php#services">layanan</a> di situs kami untuk melihat berbagai pilihan layanan yang tersedia.</li>
            <li>Pilih layanan yang ingin Anda gunakan dan lakukan proses booking melalui menu yang telah kami sediakan.</li>
            <li>Setelah booking berhasil, Anda akan menerima nomor booking sebagai bukti pemesanan.</li>
            <li>Hubungi kami melalui <a href="https://wa.me/6285764425294" target="_blank">WhatsApp</a> untuk melakukan konfirmasi pemesanan.</li>
            <li>Kunjungi kantor kami untuk mengambil perangkat yang telah dipesan, dengan membawa nomor booking dan dokumen yang diperlukan.</li>
            <li>Terakhir, nikmati layanan kami dan rasakan pengalaman bermain yang menyenangkan. <strong>ENJOY THE GAME!</strong></li>
        </ul>
    </section>

    <footer>
        <p>&copy; 2024 <span style="color: #f5deb3;">Rentalin.com</span>. All rights reserved.</p>
    </footer>
</body>
</html>
