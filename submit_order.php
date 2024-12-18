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
        <p>Pesanan Anda telah berhasil kami terima. Anda akan segera dihubungi untuk detail lebih lanjut.</p>

        <?php
        // Memeriksa apakah form telah dikirim
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Mengambil data dari form dengan pengecekan
            $name = isset($_POST['name']) ? $_POST['name'] : 'Tidak ada nama';
            $phone = isset($_POST['phone']) ? $_POST['phone'] : 'Tidak ada nomor telepon';
            $email = isset($_POST['email']) ? $_POST['email'] : 'Tidak ada email';
            $address = isset($_POST['address']) ? $_POST['address'] : 'Tidak ada alamat';
            $package = isset($_POST['package']) ? $_POST['package'] : 'Tidak ada paket';
            $weight = isset($_POST['weight']) ? $_POST['weight'] : 'Tidak ada berat';

            // Membuat nomor resi unik
            $resi = strtoupper(uniqid("RESI"));

            // Menyusun data pesanan
            $orderData = "Nama Pengirim: $name\nNomor Telepon: $phone\nEmail: $email\nAlamat: $address\nJenis Paket: $package\nBerat Paket: $weight kg\n\n";

            // Menyimpan data pesanan ke file 'orders.txt'
            file_put_contents("orders.txt", $orderData, FILE_APPEND);

            // Menampilkan nomor resi
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
