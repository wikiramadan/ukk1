<?php
// Inisialisasi variabel awal
$hargaawal = '';
$diskon = '';
$hargadiskon = 0;
$hargatotal = 0;
$error = '';

// Fungsi untuk menghitung diskon
function hitungDiskon($harga, $diskonPersen) {
    return ($harga * $diskonPersen) / 100;
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hargaawal = isset($_POST['hargaawal']) ? trim($_POST['hargaawal']) : '';
    $diskon = isset($_POST['diskon']) ? trim($_POST['diskon']) : '';

    // Validasi input harga
    if ($hargaawal === '' || !is_numeric($hargaawal) || $hargaawal <= 0) {
        $error = "Silakan masukkan harga awal yang valid (angka lebih dari 0).";
    }
    // Validasi input diskon
    elseif ($diskon === '' || !is_numeric($diskon) || $diskon < 0 || $diskon > 100) {
        $error = "Diskon harus berupa angka antara 0% sampai 100%.";
    } else {
        // Lakukan perhitungan
        $hargadiskon = hitungDiskon($hargaawal, $diskon);
        $hargatotal = $hargaawal - $hargadiskon;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Menghitung Diskon</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('img/mall.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            width: 500px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: 600;
        }

        input[type="number"], input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #2980b9;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #1abc9c;
        }

        .hasil {
            margin-top: 20px;
            background-color: #ecf0f1;
            padding: 15px;
            border-radius: 5px;
        }

        .hasil label {
            display: block;
            margin: 8px 0;
            font-weight: 500;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Aplikasi Menghitung Diskon</h2>

        <!-- Menampilkan pesan error jika ada -->
        <?php if ($error !== ''): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Form Input -->
        <form method="post">
            <div class="form-group">
                <label for="hargaawal">Harga Awal (Rp)</label>
                <input type="number" name="hargaawal" id="hargaawal" value="<?php echo htmlspecialchars($hargaawal); ?>" required min="0">
            </div>
            <div class="form-group">
                <label for="diskon">Diskon (%)</label>
                <input type="number" name="diskon" id="diskon" value="<?php echo htmlspecialchars($diskon); ?>" required min="0" max="100">
            </div>
            <input type="submit" value="Hitung Diskon">
        </form>

        <!-- Menampilkan Hasil -->
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && $error === ''): ?>
            <div class="hasil">
                <label>Harga Awal: Rp <?php echo number_format($hargaawal, 2, ',', '.'); ?></label>
                <label>Diskon: <?php echo $diskon; ?>%</label>
                <label>Potongan Harga: Rp <?php echo number_format($hargadiskon, 2, ',', '.'); ?></label>
                <label><strong>Harga Akhir: Rp <?php echo number_format($hargatotal, 2, ',', '.'); ?></strong></label>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
