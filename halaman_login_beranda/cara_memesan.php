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
        }

        h1, h2 {
            color: #0078d7;
        }

        ol {
            padding-left: 20px;
            list-style: none;
            counter-reset: list-counter;
        }

        ol li {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        ol li::before {
            counter-increment: list-counter;
            content: counter(list-counter) ".";
            font-size: 18px;
            font-weight: bold;
            margin-right: 10px;
            color: #0078d7;
        }

        .step-icon {
            width: 30px;
            height: 30px;
            background-color: #0078d7;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
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
            color: white;
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
        <h2>Panduan Pemesanan</h2>
        <ol>
            <li>
                <div class="step-icon">1</div>
                Kunjungi halaman <a href="beranda.php#services">layanan</a>.
            </li>
            <li>
                <div class="step-icon">2</div>
                Pilih layanan yang ingin disewa.
            </li>
            <li>
                <div class="step-icon">3</div>
                Lakukan booking sesuai dengan menu yang tertera.
            </li>
            <li>
                <div class="step-icon">4</div>
                Anda akan mendapat nomor booking.
            </li>
            <li>
                <div class="step-icon">5</div>
                Hubungi kami melalui <a href="https://wa.me/6285764425294" target="_blank">WhatsApp</a> untuk konfirmasi.
            </li>
            <li>
                <div class="step-icon">6</div>
                Silahkan menuju kantor kami untuk mengambil Playstation.
            </li>
            <li>
                <div class="step-icon">7</div>
                <strong>ENJOY THE GAME!!</strong>
            </li>
        </ol>
    </section>

    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
