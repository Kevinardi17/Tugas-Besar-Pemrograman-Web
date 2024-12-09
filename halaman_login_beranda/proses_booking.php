<?php
session_start();

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4ece6;
            color: #4a2c2a;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff8f0;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: 1px solid #d7ccc8;
        }

        h1 {
            text-align: center;
            color: #6d4c41;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #bca29a;
            border-radius: 5px;
            background-color: #f9f3ef;
        }

        input[type="submit"], .back-button {
            background-color: #8d6e63;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }

        input[type="submit"]:hover, .back-button:hover {
            background-color: #6d4c41;
        }

        a {
            color: #8d6e63;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .message {
            text-align: center;
            margin-top: 20px;
            padding: 15px;
            background-color: #e6cebd;
            color: #4a2c2a;
            border-radius: 5px;
            border: 1px solid #d7ccc8;
        }

        .thank-you {
            text-align: center;
            font-size: 24px;
            color: #6d4c41;
            font-weight: bold;
            margin-top: 30px;
            letter-spacing: 1.5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Booking Service</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service_id = $_POST['service_id'];
            $customer_name = $_POST['customer_name'];
            $booking_date = $_POST['booking_date'];

            // Generate nomor booking unik
            $booking_number = 'BK' . time();

            $stmt = $pdo->prepare("INSERT INTO bookings (service_id, customer_name, booking_date, booking_number) VALUES (?, ?, ?, ?)");
            $stmt->execute([$service_id, $customer_name, $booking_date, $booking_number]);

            echo "<div class='message'>Booking berhasil! <br>Nomor Booking Anda: <strong>" . $booking_number . "</strong></div>";
            echo "<div class='message'>Untuk pemesanan selanjutnya silahkan hubungi admin</div>";
            echo "<div class='thank-you'>Terima Kasih telah mempercayai layanan kami!</div>";
        } else {
            ?>
            <form method="POST">
                <label for="service_id">ID Service</label>
                <input type="text" id="service_id" name="service_id" required>

                <label for="customer_name">Nama Pelanggan</label>
                <input type="text" id="customer_name" name="customer_name" required>

                <label for="booking_date">Tanggal Booking</label>
                <input type="date" id="booking_date" name="booking_date" required>

                <input type="submit" value="Booking Sekarang">
            </form>
            <?php
        }
        ?>
        <div class="button-container">
            <a href="beranda.php" class="back-button">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
