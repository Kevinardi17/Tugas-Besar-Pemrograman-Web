<?php
session_start();
if (!isset($_SESSION['username'])) {
    // Jika user belum login, arahkan kembali ke login
    header("Location: loginadmin.php");
    exit();
}

// Konfigurasi database
$host = 'localhost';
$dbname = 'rentalin.com';
$username = 'root';
$password = '';

// Hubungkan ke database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Ambil data pelanggan (contoh)
$stmt = $pdo->query("SELECT COUNT(*) as total_pelanggan FROM data_pelanggan");
$totalPelanggan = $stmt->fetch(PDO::FETCH_ASSOC)['total_pelanggan'];

// Ambil data penyewaan (contoh)
$stmt = $pdo->query("SELECT COUNT(*) as total_penyewaan FROM penyewaan");
$totalPenyewaan = $stmt->fetch(PDO::FETCH_ASSOC)['total_penyewaan'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0