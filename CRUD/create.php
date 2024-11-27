<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
    exit();
}

require 'db_connect.php'; // File ini berisi koneksi database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $waktu_selesai = !empty($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : NULL;

    $stmt = $pdo->prepare("INSERT INTO playstations (nama, status, waktu_selesai) VALUES (?, ?, ?)");
    $stmt->execute([$nama, $status, $waktu_selesai]);

    header("Location: beranda_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah PlayStation</title>
</head>
<body>
    <h1>Tambah Data PlayStation</h1>
    <form method="POST" action="create.php">
        <label for="nama">Nama PlayStation:</label>
        <input type="text" id="nama" name="nama" required><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select><br>

        <label for="waktu_selesai">Waktu Selesai (jika tidak available):</label>
        <input type="datetime-local" id="waktu_selesai" name="waktu_selesai"><br>

        <button type="submit">Tambah</button>
    </form>
</body>
</html>
