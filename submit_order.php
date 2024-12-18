<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Diterima</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Pastikan path CSS benar -->
</head>
<body>
    <header>
        <h1>Terima Kasih, Pesanan Anda Telah Diterima!</h1>
    </header>

   <main>
        <?php
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.html"); // Redirect jika halaman diakses langsung
            exit;
        }

        // Mengambil data dari form
        $name = !empty($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Tidak ada nama';
        $phone = preg_match('/^[0-9]{10,15}$/', $_POST['phone']) ? $_POST['phone'] : 'Nomor telepon tidak valid';
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : 'Email tidak valid';
        $address = !empty($_POST['address']) ? htmlspecialchars($_POST['address']) : 'Tidak ada alamat';
        $package = !empty($_POST['package']) ? htmlspecialchars($_POST['package']) : 'Tidak ada paket';
        $weight = is_numeric($_POST['weight']) && $_POST['weight'] > 0 ? $_POST['weight'] : 'Berat tidak valid';

        // Membuat nomor resi unik
        $resi = "RESI" . date("YmdHis") . rand(1000, 9999);

        // Menyusun data pesanan
        $orderData = "=== PESANAN ===\n";
        $orderData .= "Nama Pengirim: $name\n";
        $orderData .= "Nomor Telepon: $phone\n";
        $orderData .= "Email: $email\n";
        $orderData .= "Alamat: $address\n";
        $orderData .= "Jenis Paket: $package\n";
        $orderData .= "Berat Paket: $weight kg\n";
        $orderData .= "Nomor Resi: $resi\n";
        $orderData .= "Waktu Pesanan: " . date("Y-m-d H:i:s") . "\n";
        $orderData .= "=================\n\n";

        // Menyimpan data ke file
        $filePath = __DIR__ . "/data/orders.txt";
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true); // Membuat folder jika belum ada
        }
        if (file_put_contents($filePath, $orderData, FILE_APPEND) === false) {
            echo "<p>Gagal menyimpan data pesanan. Silakan coba lagi nanti.</p>";
        } else {
            echo "<p>Pesanan Anda telah berhasil kami terima.</p>";
            echo "<p><strong>Nomor Resi Anda: </strong>$resi</p>";
        }
        ?>

        <!-- Tombol untuk kembali ke halaman Home -->
        <a href="index.html" class="btn-home">Kembali ke Home</a>
    </main>

    <footer>
        <p>&copy; 2024 Jasa Pengiriman Paket. Semua hak cipta dilindungi.</p>
    </footer>
</body>
</html>
