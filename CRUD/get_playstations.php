<?php
// get_playstations.php
require 'db_connect.php';

$stmt = $pdo->query("SELECT * FROM playstations");
$playstations = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($playstations);
?>
