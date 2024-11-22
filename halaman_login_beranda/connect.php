<?php
$conn = new mysqli("localhost", "root", "", "rentalin.com");

if ($conn->connect_error) {
    die("koneksi gagal: " . $conn->connect_error);
}
?>