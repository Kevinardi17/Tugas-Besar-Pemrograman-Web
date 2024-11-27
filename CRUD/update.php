<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
    exit();
}

require 'db_connect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM playstations WHERE id = ?");
$stmt->execute([$id]);
$ps = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $status = $_POST['status'];
    $waktu_selesai = !empty($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : NULL;

    $stmt = $pdo->prepare("UPDATE playstations SET nama = ?, status = ?, waktu_selesai = ? WHERE id = ?");
    $stmt->execute([$nama, $status, $waktu_selesai, $id]);

    header("Location: beranda_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit PlayStation</title>
</head>
<body>
    <h1>Edit Data PlayStation</h1>
    <form method="POST">
        <label for="nama">Nama PlayStation:</label>
        <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($ps['nama']); ?>" required><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="available" <?php echo $ps['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
            <option value="unavailable" <?php echo $ps['status'] == 'unavailable' ? 'selected' : ''; ?>>Unavailable</option>
        </select><br>

        <label for="waktu_selesai">Waktu Selesai:</label>
        <input type="datetime-local" id="waktu_selesai" name="waktu_selesai" value="<?php echo htmlspecialchars($ps['waktu_selesai']); ?>"><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
