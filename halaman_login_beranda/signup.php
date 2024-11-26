<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'rentalin.com';  // Nama database
$username = 'root';
$password = ''; // Ubah jika menggunakan password

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
    $hashedPassword = hash("sha256", $inputPassword); // Hash password dengan SHA-256

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

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Rentalin.com</title>
    <link rel="stylesheet" href="styleslogin.css">
</head>
<body>
    <header>
        <h1>Daftar Akun - Rentalin.com</h1>
    </header>
    <main>
        <section id="signup">
            <h2>Buat Akun Baru</h2>
            <form action="signup.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required>

                <button type="submit">Sign Up</button>
            </form>
            <?php
            if (!empty($error)) {
                echo "<p style='color:red;'>$error</p>";
            }
            if (!empty($success)) {
                echo "<p style='color:green;'>$success</p>";
            }
            ?>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>
</body>
</html>
