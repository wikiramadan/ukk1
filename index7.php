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

$hargaawal = '';
$diskon = '';
$hargadiskon = 0;
$hargatotal = 0;
$mata_uang = 'IDR';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['hapus_riwayat'])) {
        unset($_SESSION['riwayat']);
    } else {
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

            if (count($_SESSION['riwayat']) > 5) {
                array_shift($_SESSION['riwayat']);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Diskon Kalkulator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-light: #f5f5f5;
            --bg-dark: #121212;
            --box-light: #ffffff;
            --box-dark: #1e1e1e;
            --text-light: #000000;
            --text-dark: #ffffff;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-light);
            transition: background 0.4s, color 0.4s;
        }

        .dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 30px;
            gap: 20px;
        }

        .box {
            flex: 1 1 400px;
            background-color: var(--box-light);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background 0.4s, color 0.4s;
        }

        .dark-mode .box {
            background-color: var(--box-dark);
        }

        h2,
        h3 {
            margin-top: 0;
        }

        label {
            font-weight: 500;
            display: block;
            margin-top: 15px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            font-weight: bold;
            border: none;
            margin-top: 20px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3e8e41;
        }

        .toggle-container {
            text-align: center;
            margin: 15px 0;
        }

        .riwayat-item {
            border-bottom: 1px dashed #aaa;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .reset-btn {
            background-color: #f44336;
            margin-top: 10px;
        }

        .reset-btn:hover {
            background-color: #c62828;
        }
    </style>
</head>

<body>

    <div class="toggle-container">
        <button onclick="toggleDarkMode()">🌙 / ☀️ Ganti Mode</button>
    </div>

    <div class="container">
        <div class="box">
            <h2>Hitung Diskon</h2>
            <form method="post">
                <label for="hargaawal">Harga Awal</label>
                <input type="number" name="hargaawal" id="hargaawal" value="<?= $hargaawal ?>" required>

                <label for="diskon">Diskon (%)</label>
                <input type="number" name="diskon" id="diskon" min="0" max="100" value="<?= $diskon ?>" required>

                <label for="mata_uang">Mata Uang</label>
                <select name="mata_uang" id="mata_uang">
                    <option value="IDR" <?= $mata_uang == 'IDR' ? 'selected' : '' ?>>IDR (Rp)</option>
                    <option value="USD" <?= $mata_uang == 'USD' ? 'selected' : '' ?>>USD ($)</option>
                    <option value="EUR" <?= $mata_uang == 'EUR' ? 'selected' : '' ?>>EUR (€)</option>
                </select>

                <button type="submit">Hitung</button>
            </form>

            <h3>Hasil:</h3>
            <p>Harga Awal: <?= formatMataUang($hargaawal, $mata_uang) ?></p>
            <p>Diskon: <?= $diskon ?>%</p>
            <p>Harga Diskon: <?= formatMataUang($hargadiskon, $mata_uang) ?></p>
            <p>Harga Akhir: <?= formatMataUang($hargatotal, $mata_uang) ?></p>
        </div>

        <div class="box">
            <h2>Riwayat</h2>
            <?php if (isset($_SESSION['riwayat'])): ?>
                <?php foreach (array_reverse($_SESSION['riwayat']) as $item): ?>
                    <div class="riwayat-item">
                        <p><strong>Harga Awal:</strong> <?= formatMataUang($item['hargaawal'], $item['mata_uang']) ?></p>
                        <p><strong>Diskon:</strong> <?= $item['diskon'] ?>%</p>
                        <p><strong>Harga Diskon:</strong> <?= formatMataUang($item['hargadiskon'], $item['mata_uang']) ?></p>
                        <p><strong>Harga Akhir:</strong> <?= formatMataUang($item['hargatotal'], $item['mata_uang']) ?></p>
                    </div>
                <?php endforeach; ?>
                <form method="post">
                    <button type="submit" name="hapus_riwayat" class="reset-btn">Hapus Riwayat</button>
                </form>
            <?php else: ?>
                <p>Belum ada riwayat.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            document.body.classList.toggle('dark-mode');
        }
    </script>

</body>

</html>