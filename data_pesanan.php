<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .order-history {
            margin-top: 20px;
        }
        .order-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }
        .order-card h3 {
            margin-top: 0;
            color: #007bff;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .order-card p {
            margin: 5px 0;
            font-size: 16px;
        }
        .order-card p strong {
            color: #555;
        }
        .link-data {
            text-align: center;
            margin-top: 20px;
        }
        .link-data a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }
        .link-data a:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Riwayat Pesanan</h2>
    <div class="order-history">
        <?php
        // Nama file yang akan dibaca
        $file = 'data_pesanan.json';

        // Memeriksa apakah file data_pesanan.json ada
        if (file_exists($file)) {
            // Membaca isi file JSON dan mengkonversinya menjadi array PHP
            $data = json_decode(file_get_contents($file), true);

            // Memeriksa apakah data berhasil dibaca dan tidak kosong
            if ($data && count($data) > 0) {
                // Melakukan loop untuk setiap pesanan dalam array data
                foreach ($data as $index => $pesanan) {
                    // Membuat "card" untuk setiap pesanan
                    echo '<div class="order-card">';
                    echo '<h3>Pesanan #' . ($index + 1) . '</h3>';
                    echo '<p><strong>Cabang:</strong> ' . htmlspecialchars($pesanan['cabang']) . '</p>';
                    echo '<p><strong>Menggunakan teknik speed fry:</strong> ' . htmlspecialchars($pesanan['menggunakan_speed_fry']) . '</p>';
                    echo '<p><strong>Jumlah Dada Ayam:</strong> ' . htmlspecialchars($pesanan['jumlah_dada_ayam']) . ' (Rp ' . number_format($pesanan['total_harga_dada_ayam'], 0, ',', '.') . ')</p>';
                    echo '<p><strong>Jumlah Paha Ayam:</strong> ' . htmlspecialchars($pesanan['jumlah_paha_ayam']) . ' (Rp ' . number_format($pesanan['total_harga_paha_ayam'], 0, ',', '.') . ')</p>';
                    echo '<p><strong>Jumlah Nasi:</strong> ' . htmlspecialchars($pesanan['jumlah_nasi']) . ' (Rp ' . number_format($pesanan['total_harga_nasi'], 0, ',', '.') . ')</p>';
                    echo '<p><strong>Total Harga Keseluruhan:</strong> Rp ' . number_format($pesanan['total_harga_keseluruhan'], 0, ',', '.') . '</p>';
                    echo '</div>';
                }
            } else {
                // Pesan jika file ada tapi kosong
                echo '<p>Belum ada data pesanan.</p>';
            }
        } else {
            // Pesan jika file tidak ditemukan
            echo '<p>File data_pesanan.json tidak ditemukan. Silakan lakukan pemesanan terlebih dahulu.</p>';
        }
        ?>
    </div>
    <div class="link-data">
        <a href="index.php">Kembali ke Form Pemesanan</a>
    </div>
</div>

</body>
</html>