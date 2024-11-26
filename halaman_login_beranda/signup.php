<?php
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

// Proses sign up
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = trim($_POST['username']);
    $inputPassword = trim($_POST['password']);
    $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT); // Gunakan password_hash

    // Cek apakah username sudah ada
    $stmt = $pdo->prepare("SELECT * FROM data_pelanggan WHERE username = :username");
    $stmt->execute(['username' => $inputUsername]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $error = "Username sudah terdaftar. Gunakan username lain.";
    } else {
        // Simpan data pengguna baru
        $stmt = $pdo->prepare("INSERT INTO data_pelanggan (username, password) VALUES (:username, :password)");
        if ($stmt->execute(['username' => $inputUsername, 'password' => $hashedPassword])) {
            $success = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error = "Terjadi kesalahan. Silakan coba lagi.";
        }
    }
}
?>
