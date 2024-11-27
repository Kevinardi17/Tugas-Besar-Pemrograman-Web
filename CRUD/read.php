<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
    exit();
}

require 'db_connect.php';

$stmt = $pdo->query("SELECT * FROM playstations");
$playstations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Daftar PlayStation</h1>
    <a href="create.php">Tambah PlayStation</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Waktu Selesai</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($playstations as $ps): ?>
            <tr>
                <td><?php echo htmlspecialchars($ps['id']); ?></td>
                <td><?php echo htmlspecialchars($ps['nama']); ?></td>
                <td><?php echo htmlspecialchars($ps['status']); ?></td>
                <td><?php echo htmlspecialchars($ps['waktu_selesai']); ?></td>
                <td>
                    <a href="update.php?id=<?php echo $ps['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $ps['id']; ?>" onclick="return confirm('Hapus data?');">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
