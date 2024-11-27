<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: loginadmin.php");
    exit();
}

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

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("INSERT INTO playstation_services (name, description, price, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $description, $price, $status]);
    } elseif (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("UPDATE playstation_services SET name = ?, description = ?, price = ?, status = ? WHERE id = ?");
        $stmt->execute([$name, $description, $price, $status, $id]);
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("DELETE FROM playstation_services WHERE id = ?");
        $stmt->execute([$id]);
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
    
        $stmt = $pdo->prepare("DELETE FROM playstation_services WHERE id = ?");
        $stmt->execute([$id]);
    
        // Reorder IDs
        $pdo->exec("SET @num = 0;");
        $pdo->exec("UPDATE playstation_services SET id = @num := (@num + 1);");
        $pdo->exec("ALTER TABLE playstation_services AUTO_INCREMENT = 1;");
    }

    // Handle CRUD operations for Bookings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_booking'])) {
        $customer_name = $_POST['customer_name'];
        $service_id = $_POST['service_id'];
        $booking_date = $_POST['booking_date'];

        $stmt = $pdo->prepare("
            INSERT INTO bookings (booking_number, customer_name, service_id, booking_date) 
            VALUES (UUID_SHORT(), ?, ?, ?)");
        $stmt->execute([$customer_name, $service_id, $booking_date]);
    } elseif (isset($_POST['update_booking'])) {
        $booking_id = $_POST['booking_id'];
        $customer_name = $_POST['customer_name'];
        $service_id = $_POST['service_id'];
        $booking_date = $_POST['booking_date'];

        $stmt = $pdo->prepare("
            UPDATE bookings 
            SET customer_name = ?, service_id = ?, booking_date = ? 
            WHERE id = ?");
        $stmt->execute([$customer_name, $service_id, $booking_date, $booking_id]);
    } elseif (isset($_POST['delete_booking'])) {
        $booking_id = $_POST['booking_id'];

        $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->execute([$booking_id]);
    }

    // Redirect to prevent resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
    // Redirect to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch all services
$stmt = $pdo->query("SELECT * FROM playstation_services");
$services = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Rentalin.com</title>
    <link rel="stylesheet" href="stylesberanda.css">
</head>
<body>
    <header>
        <h1>Dashboard Admin</h1>
        <p>Selamat datang Icik Boss!</p>
    </header>
    <section id="crud">
        <h2>Kelola Layanan PlayStation</h2>
        
        <form method="POST">
            <input type="hidden" name="id" id="id">
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" required>
            
            <label for="description">Deskripsi:</label>
            <textarea name="description" id="description" required></textarea>
            
            <label for="price">Harga:</label>
            <input type="number" name="price" id="price" step="0.01" required>
            
            <label for="status">Status:</label>
            <select name="status" id="status" required>
                <option value="available">Tersedia</option>
                <option value="unavailable">Tidak Tersedia</option>
            </select>
            
            <button type="submit" name="create">Tambah</button>
            <button type="submit" name="update">Ubah</button>
            <button type="submit" name="delete">Hapus</button>
        </form>

        <h2>Daftar Layanan</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                <tr>
                    <td><?php echo $service['id']; ?></td>
                    <td><?php echo htmlspecialchars($service['name']); ?></td>
                    <td><?php echo htmlspecialchars($service['description']); ?></td>
                    <td><?php echo number_format($service['price'], 2, ',', '.'); ?></td>
                    <td><?php echo $service['status']; ?></td>
                    <td>
                        <button onclick="editService(<?php echo htmlspecialchars(json_encode($service)); ?>)">Edit</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

        <section id="booking-list">
    <h2>Daftar Booking</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nomor Booking</th>
                <th>Nama Pelanggan</th>
                <th>Layanan</th>
                <th>Tanggal Booking</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("
                SELECT b.booking_number, b.customer_name, s.name AS service_name, b.booking_date 
                FROM bookings b 
                JOIN playstation_services s ON b.service_id = s.id
            ");
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($bookings as $booking):
            ?>
            <tr>
                <td><?php echo htmlspecialchars($booking['booking_number']); ?></td>
                <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['service_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<section id="crud-booking">
    <h2>Kelola Daftar Booking</h2>

    <form method="POST">
        <input type="hidden" name="booking_id" id="booking_id">
        
        <label for="customer_name">Nama Pelanggan:</label>
        <input type="text" name="customer_name" id="customer_name" required>

        <label for="service_id">Pilih Layanan:</label>
        <select name="service_id" id="service_id" required>
            <?php
            $stmt = $pdo->query("SELECT id, name FROM playstation_services");
            $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($services as $service): ?>
                <option value="<?php echo $service['id']; ?>">
                    <?php echo htmlspecialchars($service['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="booking_date">Tanggal Booking:</label>
        <input type="date" name="booking_date" id="booking_date" required>
        
        <button type="submit" name="create_booking">Tambah</button>
        <button type="submit" name="update_booking">Ubah</button>
        <button type="submit" name="delete_booking">Hapus</button>
    </form>

    <h2>Daftar Booking</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Nomor Booking</th>
                <th>Nama Pelanggan</th>
                <th>Layanan</th>
                <th>Tanggal Booking</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $pdo->query("
                SELECT b.id AS booking_id, b.booking_number, b.customer_name, 
                       s.name AS service_name, b.booking_date 
                FROM bookings b 
                JOIN playstation_services s ON b.service_id = s.id
            ");
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($bookings as $booking): ?>
            <tr>
                <td><?php echo htmlspecialchars($booking['booking_number']); ?></td>
                <td><?php echo htmlspecialchars($booking['customer_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['service_name']); ?></td>
                <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                <td>
                    <button onclick="editBooking(<?php echo htmlspecialchars(json_encode($booking)); ?>)">Edit</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>


    <footer>
        <p>&copy; 2024 Rentalin.com. All rights reserved.</p>
    </footer>

    <script>
        function editService(service) {
            document.getElementById('id').value = service.id;
            document.getElementById('name').value = service.name;
            document.getElementById('description').value = service.description;
            document.getElementById('price').value = service.price;
            document.getElementById('status').value = service.status;
        }
        
    function editBooking(booking) {
        document.getElementById('booking_id').value = booking.booking_id;
        document.getElementById('customer_name').value = booking.customer_name;
        document.getElementById('service_id').value = booking.service_id;
        document.getElementById('booking_date').value = booking.booking_date;
    }
    </script>
</body>
</html>