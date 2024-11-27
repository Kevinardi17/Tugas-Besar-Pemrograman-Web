<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
    exit();
}

require 'db_connect.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM playstations WHERE id = ?");
$stmt->execute([$id]);

header("Location: beranda_admin.php");
exit();
?>
