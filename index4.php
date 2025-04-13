<?php
session_start();

// Fungsi untuk format mata uang
function formatMataUang($angka, $mata_uang) {
    if ($mata_uang == 'USD') {
        return '$' . number_format($angka, 2);
    } elseif ($mata_uang == 'EUR') {
        return '€' . number_format($angka, 2);
    } else {
        return 'Rp ' . number_format($angka, 2);
    }
}

// Inisialisasi variabel
$hargaawal = '';
$diskon = '';
$hargadiskon = 0;
$hargatotal = 0;
$mata_uang = 'IDR'; // Default mata uang IDR

// Periksa apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi hargaawal
    if (!empty($_POST['hargaawal']) && is_numeric($_POST['hargaawal']) && $_POST['hargaawal'] > 0) {
        $hargaawal = $_POST['hargaawal'];
    }

    // Validasi diskon
    if (!empty($_POST['diskon']) && is_numeric($_POST['diskon']) && $_POST['diskon'] >= 0 && $_POST['diskon'] <= 100) {
        $diskon = $_POST['diskon'];
    }

    // Pilihan mata uang
    if (isset($_POST['mata_uang'])) {
        $mata_uang = $_POST['mata_uang'];
    }

    // Proses perhitungan jika valid
    if ($hargaawal && $diskon !== '') {
        $hargadiskon = ($hargaawal * $diskon) / 100;
        $hargatotal = $hargaawal - $hargadiskon;

        // Simpan riwayat perhitungan ke session
        $riwayat = [
            'hargaawal' => $hargaawal,
            'diskon' => $diskon,
            'hargadiskon' => $hargadiskon,
            'hargatotal' => $hargatotal,
            'mata_uang' => $mata_uang,
        ];

        $_SESSION['riwayat'][] = $riwayat;
    }
}

// Menghapus riwayat perhitungan
if (isset($_POST['hapus_riwayat'])) {
    unset($_SESSION['riwayat']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Menghitung Diskon</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Reset margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: url('img\\mall.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .kotak1 {
            width: 100%;
            max-width: 600px;
            background-color: rgb(17, 203, 172);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 20px rgb(0, 0, 0, 0.2);
        }

        .kotak2 {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .kotak3 {
            text-align: center;
        }

        .row {
            margin: 10px 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
        }

        .kolom1 {
            font-weight: bold;
            color: #333;
            width: 40%;
        }

        .kolom2 {
            width: 60%;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"],
        input[type="reset"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: rgb(68, 71, 70);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: rgb(17, 203, 203);
        }

        input[type="reset"] {
            background-color: rgb(255, 94, 77);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="reset"]:hover {
            background-color: rgb(255, 141, 124);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
        }

        .hasil {
            margin-top: 20px;
            padding: 20px;
            background-color: rgb(18, 141, 150);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hasil label {
            font-size: 18px;
        }

        .riwayat {
            margin-top: 30px;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .riwayat h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .riwayat ul {
            list-style: none;
        }

        .riwayat ul li {
            margin-bottom: 10px;
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.05);
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="kotak1">
        <div class="kotak2">
            <center>
                <img src="img/logorpl2.jpg" width="100" alt="logo">
            </center>
            <div class="kotak3">
                <center>
                    <h2>Aplikasi Menghitung Diskon</h2>
                </center>
                <form action="" method="post">
                    <div class="row">
                        <div class="kolom1">
                            <label for="hargaawal">Harga Awal</label>
                        </div>
                        <div class="kolom2">
                            <input type="number" name="hargaawal" id="hargaawal" value="<?php echo $hargaawal; ?>" min="0" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1">
                            <label for="diskon">Diskon</label>
                        </div>
                        <div class="kolom2">
                            <input type="number" name="diskon" id="diskon" value="<?php echo $diskon; ?>" min="1" max="100" placeholder="Masukkan diskon dalam persen">
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1">
                            <label for="mata_uang">Mata Uang</label>
                        </div>
                        <div class="kolom2">
                            <select name="mata_uang" id="mata_uang">
                                <option value="IDR" <?php echo $mata_uang == 'IDR' ? 'selected' : ''; ?>>IDR (Rp)</option>
                                <option value="USD" <?php echo $mata_uang == 'USD' ? 'selected' : ''; ?>>USD ($)</option>
                                <option value="EUR" <?php echo $mata_uang == 'EUR' ? 'selected' : ''; ?>>EUR (€)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom2">
                            <input type="submit" value="Hitung">
                            <input type="reset" value="Reset">
                        </div>
                    </div>
                </form>

                <div class="hasil">
                    <center>
                        <h3>Hasil Perhitungan</h3>
                    </center>
                    <div class="row">
                        <div class="kolom1"><label>Harga Awal</label></div>
                        <div class="kolom2">
                            <label>: <?php echo isset($hargaawal) ? formatMataUang($hargaawal, $mata_uang) : 'Rp 0.00'; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"><label>Jumlah Diskon</label></div>
                        <div class="kolom2">
                            <label>: <?php echo isset($diskon) ? $diskon . '%' : '0%'; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"><label>Harga Diskon</label></div>
                        <div class="kolom2">
                            <label>: <?php echo isset($hargadiskon) ? formatMataUang($hargadiskon, $mata_uang) : 'Rp 0.00'; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"><label>Harga Akhir</label></div>
                        <div class="kolom2">
                            <label>: <?php echo isset($hargatotal) ? formatMataUang($hargatotal, $mata_uang) : 'Rp 0.00'; ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['riwayat']) && count($_SESSION['riwayat']) > 0): ?>
        <div class="riwayat">
            <h3>Riwayat Perhitungan</h3>
            <form action="" method="post">
                <button type="submit" name="hapus_riwayat" style="background-color: #f44336; color: white; padding: 10px; border: none; border-radius: 5px;">Hapus Riwayat</button>
            </form>
            <ul>
                <?php foreach ($_SESSION['riwayat'] as $item): ?>
                    <li>
                        Harga Awal: <?php echo formatMataUang($item['hargaawal'], $item['mata_uang']); ?><br>
                        Diskon: <?php echo $item['diskon']; ?>%<br>
                        Harga Diskon: <?php echo formatMataUang($item['hargadiskon'], $item['mata_uang']); ?><br>
                        Harga Akhir: <?php echo formatMataUang($item['hargatotal'], $item['mata_uang']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>
</html>
