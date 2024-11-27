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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = $_POST['service_id'];
    $customer_name = $_POST['customer_name'];
    $booking_date = $_POST['booking_date'];

    // Generate nomor booking unik
    $booking_number = 'BK' . time();

    $stmt = $pdo->prepare("INSERT INTO bookings (service_id, customer_name, booking_date, booking_number) VALUES (?, ?, ?, ?)");
    $stmt->execute([$service_id, $customer_name, $booking_date, $booking_number]);

    echo "Booking berhasil! Nomor Booking Anda: " . $booking_number;
    echo "<br><a href='beranda.php'>Kembali ke Beranda</a>";
}
?>