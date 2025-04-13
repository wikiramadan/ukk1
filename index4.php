<?php
session_start();

function formatMataUang($angka, $mata_uang)
{
    if ($mata_uang == 'USD') {
        return '$' . number_format($angka, 2);
    } elseif ($mata_uang == 'EUR') {
        return '€' . number_format($angka, 2);
    } else {
        return 'Rp ' . number_format($angka, 2, ',', '.');
    }
}

// Inisialisasi
$hargaawal = '';
$diskon = '';
$hargadiskon = 0;
$hargatotal = 0;
$mata_uang = 'IDR';
$batas_riwayat = 5;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['hargaawal']) && is_numeric($_POST['hargaawal']) && $_POST['hargaawal'] > 0) {
        $hargaawal = $_POST['hargaawal'];
    }

    if (!empty($_POST['diskon']) && is_numeric($_POST['diskon']) && $_POST['diskon'] >= 0 && $_POST['diskon'] <= 100) {
        $diskon = $_POST['diskon'];
    }

    if (isset($_POST['mata_uang'])) {
        $mata_uang = $_POST['mata_uang'];
    }

    if ($hargaawal && $diskon !== '') {
        $hargadiskon = ($hargaawal * $diskon) / 100;
        $hargatotal = $hargaawal - $hargadiskon;

        $riwayat = [
            'hargaawal' => $hargaawal,
            'diskon' => $diskon,
            'hargadiskon' => $hargadiskon,
            'hargatotal' => $hargatotal,
            'mata_uang' => $mata_uang,
        ];

        $_SESSION['riwayat'][] = $riwayat;

        if (count($_SESSION['riwayat']) > $batas_riwayat) {
            array_shift($_SESSION['riwayat']);
        }
    }
}

if (isset($_POST['hapus_riwayat'])) {
    unset($_SESSION['riwayat']);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Diskon Kalkulator</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #1e1e2f;
            color: #f1f1f1;
            transition: background-color 0.3s, color 0.3s;
        }

        body.light-mode {
            background-color: #fff;
            color: #000;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .form-container,
        .riwayat-container {
            padding: 30px;
            flex: 1;
        }

        .form-container {
            background-color: #2c2c3e;
        }

        .riwayat-container {
            background-color: #1a1a2b;
            border-left: 2px solid #444;
        }

        body.light-mode .form-container {
            background-color: #f5f5f5;
        }

        body.light-mode .riwayat-container {
            background-color: #e0e0e0;
        }

        h2,
        h3 {
            color: #00ffd9;
        }

        body.light-mode h2,
        body.light-mode h3 {
            color: #000;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            background-color: #333;
            color: #fff;
            border: 1px solid #555;
            border-radius: 5px;
        }

        body.light-mode input,
        body.light-mode select {
            background-color: #fff;
            color: #000;
            border-color: #ccc;
        }

        .buttons {
            margin-top: 20px;
        }

        input[type="submit"],
        input[type="reset"],
        button {
            background-color: #00ffd9;
            color: #000;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            border: none;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover,
        button:hover {
            background-color: #00bba3;
        }

        .hasil {
            margin-top: 20px;
            padding: 15px;
            background-color: #333;
            border-radius: 5px;
        }

        body.light-mode .hasil {
            background-color: #f5f5f5;
            color: #000;
        }

        .riwayat-item {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #2a2a3d;
            border-radius: 5px;
        }

        body.light-mode .riwayat-item {
            background-color: #ddd;
            color: #000;
        }

        .dark-toggle {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .dark-toggle button {
            background-color: #555;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        body.light-mode .dark-toggle button {
            background-color: #ccc;
            color: #000;
        }
    </style>
    <script>
        function toggleDarkMode() {
            document.body.classList.toggle("light-mode");
        }
    </script>
</head>

<body>
    <div class="dark-toggle">
        <button onclick="toggleDarkMode()">🌗 Ganti Mode</button>
    </div>
    <div class="container">
        <div class="form-container">
            <h2>Kalkulator Diskon</h2>
            <form method="post">
                <label>Harga Awal:</label>
                <input type="number" name="hargaawal" value="<?= $hargaawal ?>" required min="0">
                <label>Diskon (%):</label>
                <input type="number" name="diskon" value="<?= $diskon ?>" required min="0" max="100">
                <label>Mata Uang:</label>
                <select name="mata_uang">
                    <option value="IDR" <?= $mata_uang == 'IDR' ? 'selected' : '' ?>>IDR (Rp)</option>
                    <option value="USD" <?= $mata_uang == 'USD' ? 'selected' : '' ?>>USD ($)</option>
                    <option value="EUR" <?= $mata_uang == 'EUR' ? 'selected' : '' ?>>EUR (€)</option>
                </select>
                <div class="buttons">
                    <input type="submit" value="Hitung">
                    <input type="reset" value="Reset">
                </div>
            </form>

            <?php if ($hargatotal > 0): ?>
                <div class="hasil">
                    <h3>Hasil:</h3>
                    <p>Harga Awal: <?= formatMataUang($hargaawal, $mata_uang) ?></p>
                    <p>Diskon: <?= $diskon ?>%</p>
                    <p>Harga Diskon: <?= formatMataUang($hargadiskon, $mata_uang) ?></p>
                    <p>Harga Akhir: <?= formatMataUang($hargatotal, $mata_uang) ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="riwayat-container">
            <h3>Riwayat (Max <?= $batas_riwayat ?>)</h3>
            <form method="post">
                <button type="submit" name="hapus_riwayat">🗑️ Hapus Semua</button>
            </form>
            <?php if (!empty($_SESSION['riwayat'])): ?>
                <?php foreach (array_reverse($_SESSION['riwayat']) as $item): ?>
                    <div class="riwayat-item">
                        Harga Awal: <?= formatMataUang($item['hargaawal'], $item['mata_uang']) ?><br>
                        Diskon: <?= $item['diskon'] ?>%<br>
                        Harga Diskon: <?= formatMataUang($item['hargadiskon'], $item['mata_uang']) ?><br>
                        Harga Akhir: <?= formatMataUang($item['hargatotal'], $item['mata_uang']) ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Belum ada riwayat.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>