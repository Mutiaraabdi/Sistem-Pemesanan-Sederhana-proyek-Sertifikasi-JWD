<?php
// File: index.php

// Atur array cabang dan urutkan
$cabang = ["Cikarang", "Bekasi", "Karawang", "Bogor"];
sort($cabang);

// Inisialisasi variabel
$totalHargaKeseluruhan = null;
$error = false;
$pesanError = '';

// Fungsi untuk menghitung total harga per item
function hitung_total_harga_item($jumlah, $hargaSatuan) {
    return $jumlah * $hargaSatuan;
}

// Proses form jika metode pengiriman adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $jmlDada = isset($_POST['jmlDada']) ? (int)$_POST['jmlDada'] : 0;
    $jmlPaha = isset($_POST['jmlPaha']) ? (int)$_POST['jmlPaha'] : 0;
    $jmlNasi = isset($_POST['jmlNasi']) ? (int)$_POST['jmlNasi'] : 0;
    $cabangTerpilih = $_POST['cabang'] ?? '';
    $isSpeedFry = ($_POST['teknikGoreng'] ?? '') == 'Speed fry';

    // Validasi input
    if ($jmlDada < 0 || $jmlPaha < 0 || $jmlNasi < 0) {
        $error = true;
        $pesanError = "Jumlah pesanan tidak boleh negatif.";
    } elseif (empty($cabangTerpilih)) {
        $error = true;
        $pesanError = "Anda harus memilih cabang.";
    } else {
        // Tentukan harga dasar
        $hrgDada = 11000;
        $hrgPaha = 8000;
        $hrgNasi = 5000;

        // Sesuaikan harga berdasarkan cabang
        if ($cabangTerpilih == "Cikarang") {
            $hrgDada += 1000;
            $hrgPaha += 1000;
            $hrgNasi += 1000;
        }

        // Sesuaikan harga berdasarkan teknik penggorengan
        if ($isSpeedFry) {
            $hrgDada += 3000;
            $hrgPaha += 3000;
        }

        // Hitung total harga per item
        $totalHrgDada = hitung_total_harga_item($jmlDada, $hrgDada);
        $totalHrgPaha = hitung_total_harga_item($jmlPaha, $hrgPaha);
        $totalHrgNasi = hitung_total_harga_item($jmlNasi, $hrgNasi);

        // Hitung total keseluruhan
        $totalHargaKeseluruhan = $totalHrgDada + $totalHrgPaha + $totalHrgNasi;

        // Siapkan data untuk disimpan
        $dataPesanan = [
            'cabang' => $cabangTerpilih,
            'menggunakan_speed_fry' => $isSpeedFry ? 'Ya' : 'Tidak',
            'jumlah_dada_ayam' => $jmlDada,
            'harga_satuan_dada_ayam' => $hrgDada,
            'total_harga_dada_ayam' => $totalHrgDada,
            'jumlah_paha_ayam' => $jmlPaha,
            'harga_satuan_paha_ayam' => $hrgPaha,
            'total_harga_paha_ayam' => $totalHrgPaha,
            'jumlah_nasi' => $jmlNasi,
            'harga_satuan_nasi' => $hrgNasi,
            'total_harga_nasi' => $totalHrgNasi,
            'total_harga_keseluruhan' => $totalHargaKeseluruhan,
            'timestamp' => date("Y-m-d H:i:s")
        ];

        // Simpan data ke JSON
        $file = 'data_pesanan.json';
        $current_data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $current_data[] = $dataPesanan;
        file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT));
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Memphis Fried Chicken</title>
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

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 120px;
            height: auto;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .logo h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #555;
        }

        .form-group input[type="number"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .form-group input[type="radio"] {
            margin-right: 8px;
        }

        .hitung-btn {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .hitung-btn:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: #d9534f;
            background-color: #f2dede;
            border: 1px solid #ebccd1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .result-container {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .result-item span:first-child {
            font-weight: 500;
            color: #333;
        }

        .total-price-final {
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px dashed #ccc;
        }

        hr {
            border: 0;
            border-top: 1px solid #eee;
            margin: 15px 0;
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
        <div class="logo">
            <img src="logo_mfc.JPG" alt="Memphis Fried Chicken Logo">
            <h1>Memphis Fried Chicken</h1>
        </div>

        <div class="form-container">
            <h2>Form Pemesanan</h2>
            <?php if ($error): ?>
                <div class="error-message"><?php echo $pesanError; ?></div>
            <?php endif; ?>
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="cabang">Cabang:</label>
                    <select name="cabang" id="cabang">
                        <option value="">- Cabang -</option>
                        <?php foreach ($cabang as $c): ?>
                            <option value="<?php echo $c; ?>" <?php echo ($cabangTerpilih ?? '') == $c ? 'selected' : ''; ?>>
                                <?php echo $c; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jmlDada">Jumlah dada ayam:</label>
                    <input type="number" id="jmlDada" name="jmlDada" value="<?php echo $jmlDada ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="jmlPaha">Jumlah paha ayam:</label>
                    <input type="number" id="jmlPaha" name="jmlPaha" value="<?php echo $jmlPaha ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label for="jmlNasi">Jumlah nasi:</label>
                    <input type="number" id="jmlNasi" name="jmlNasi" value="<?php echo $jmlNasi ?? ''; ?>">
                </div>
                <div class="form-group">
                    <label>Teknik penggorengan:</label>
                    <div>
                        <input type="radio" id="normal" name="teknikGoreng" value="Normal" <?php echo ($isSpeedFry ?? '') ? '' : 'checked'; ?>>
                        <label for="normal">Normal</label>
                    </div>
                    <div>
                        <input type="radio" id="speedFry" name="teknikGoreng" value="Speed fry" <?php echo ($isSpeedFry ?? '') ? 'checked' : ''; ?>>
                        <label for="speedFry">Speed fry</label>
                    </div>
                </div>
                <button type="submit" class="hitung-btn">Hitung</button>
            </form>
        </div>

        <?php if ($totalHargaKeseluruhan !== null && !$error): ?>
            <div class="result-container">
                <h2>Ringkasan Pesanan</h2>
                <div class="result-item">
                    <span>Cabang:</span>
                    <span><?php echo htmlspecialchars($cabangTerpilih); ?></span>
                </div>
                <div class="result-item">
                    <span>Menggunakan teknik speed fry:</span>
                    <span><?php echo $isSpeedFry ? 'Ya' : 'Tidak'; ?></span>
                </div>
                
                <hr>

                <div class="result-item">
                    <span>Jumlah Dada Ayam:</span>
                    <span><?php echo $jmlDada; ?></span>
                </div>
                <div class="result-item">
                    <span>Harga Satuan Dada Ayam:</span>
                    <span>Rp <?php echo number_format($hrgDada, 0, ',', '.'); ?></span>
                </div>
                <div class="result-item">
                    <span>Total Harga Dada Ayam:</span>
                    <span>Rp <?php echo number_format($totalHrgDada, 0, ',', '.'); ?></span>
                </div>
                
                <hr>

                <div class="result-item">
                    <span>Jumlah Paha Ayam:</span>
                    <span><?php echo $jmlPaha; ?></span>
                </div>
                <div class="result-item">
                    <span>Harga Satuan Paha Ayam:</span>
                    <span>Rp <?php echo number_format($hrgPaha, 0, ',', '.'); ?></span>
                </div>
                <div class="result-item">
                    <span>Total Harga Paha Ayam:</span>
                    <span>Rp <?php echo number_format($totalHrgPaha, 0, ',', '.'); ?></span>
                </div>
                
                <hr>

                <div class="result-item">
                    <span>Jumlah Nasi:</span>
                    <span><?php echo $jmlNasi; ?></span>
                </div>
                <div class="result-item">
                    <span>Harga Satuan Nasi:</span>
                    <span>Rp <?php echo number_format($hrgNasi, 0, ',', '.'); ?></span>
                </div>
                <div class="result-item">
                    <span>Total Harga Nasi:</span>
                    <span>Rp <?php echo number_format($totalHrgNasi, 0, ',', '.'); ?></span>
                </div>
                
                <hr>
                
                <div class="total-price-final">
                    <span>Total Harga Keseluruhan:</span>
                    <span>Rp <?php echo number_format($totalHargaKeseluruhan, 0, ',', '.'); ?></span>
                </div>
            </div>
        <?php endif; ?>

        <div class="link-data">
            <a href="data_pesanan.php">Lihat Riwayat Pesanan</a>
        </div>
    </div>

</body>
</html>