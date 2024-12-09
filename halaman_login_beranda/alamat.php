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
    <title>Alamat - Rentalin.com</title>
    <link rel="stylesheet" href="stylesberanda.css">
    <style>
        /* Warna awal */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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
            text-decoration: none;
            color: white;
            background-color: #FF5E5E;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #E04E4E;
        }

        section {
            padding: 20px;
            text-align: center;
        }

        section h2 {
            margin-bottom: 15px;
            font-size: 28px;
            color: #007BFF;
        }

        .address {
            font-size: 18px;
            margin: 10px 0;
        }

        .maps-link {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 25px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .maps-link:hover {
            background-color: #218838;
            transform: scale(1.05);
        }

        footer {
            background-color: #f4f4f4;
            color: #666;
            text-align: center;
            padding: 15px 0;
            border-top: 1px solid #ddd;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <header>
        <h1>Alamat Kami</h1>
        <a href="beranda.php" class="logout-btn">Kembali ke Beranda</a>
    </header>

    <section>
        <h2>Lokasi Kami</h2>
        <p class="address">Jl. Scorpio No.18, Rajabasa, Kec. Rajabasa, Kota Bandar Lampung, Lampung</p>
        <p class="address">Telepon: <a href="tel:085764425294"
                style="color: #3b6b3d; text-decoration: none;">0857-6442-5294 (Admin)</a></p>

        <!-- Tautan ke Google Maps -->
        <a href="https://www.google.com/maps/search/?api=1&query=Jl.+Scorpio+No.18,+Rajabasa,+Kec.+Rajabasa,+Kota+Bandar+Lampung,+Lampung"
            target="_blank" class="maps-link">
            Lihat Lokasi di Google Maps
        </a>
    </section>

    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>

</html>