<?php
    // Mengambil nilai dari POST dan sanitasi input
    $hargaawal = isset($_POST['hargaawal']) ? trim($_POST['hargaawal']) : '';
    $diskon = isset($_POST['diskon']) ? trim($_POST['diskon']) : '';

    // Inisialisasi variabel
    $hargadiskon = 0;
    $hargatotal = 0;

    // Proses perhitungan jika form disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Validasi hargaawal
        if ($hargaawal == "" || !is_numeric($hargaawal) || $hargaawal <= 0) {
            echo "<script>alert('Silahkan masukkan harga awal yang valid');
            window.location='index.php';
            </script>";
        }
        // Validasi diskon
        elseif ($diskon == "" || !is_numeric($diskon) || $diskon < 0 || $diskon > 100) {
            echo "<script>alert('Silahkan masukkan diskon yang valid antara 0% dan 100%');
            window.location='index.php';
            </script>";
        } else {
            // Perhitungan diskon dan harga total
            $hargadiskon = ($hargaawal * $diskon) / 100;
            $hargatotal = $hargaawal - $hargadiskon;
        }
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
            background: linear-gradient(135deg, #6A11CB, #2575FC);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .kotak1 {
            width: 600px;
            background-color: rgb(25, 25, 255, 0.8);
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

        input[type="text"], input[type="number"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #2575FC;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #6A11CB;
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
            background-color: #f4f4f9;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .hasil label {
            font-size: 18px;
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
                <center><h2>Aplikasi Menghitung Diskon</h2></center>
                <form action="" method="post">
                    <div class="row">
                        <div class="kolom1">
                            <label for="hargaawal">Harga Awal</label>
                        </div>
                        <div class="kolom2">
                            <input type="text" name="hargaawal" id="hargaawal" value="<?php echo $hargaawal; ?>" placeholder="Masukkan harga awal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1">
                            <label for="diskon">Diskon</label>
                        </div>
                        <div class="kolom2">
                            <input type="number" name="diskon" id="diskon" value="<?php echo $diskon; ?>" placeholder="Masukkan diskon dalam persen">
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom2">
                            <input type="submit" value="Hitung">
                        </div>
                    </div>
                </form>

                <div class="hasil">
                    <center><h3>Hasil Perhitungan</h3></center>
                    <div class="row">
                        <div class="kolom1"><label>Harga Awal</label></div>
                        <div class="kolom2">
                            <label>: Rp <?php echo isset($hargaawal) && $hargaawal !== '' ? number_format($hargaawal, 2) : '0.00'; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"><label>Jumlah Diskon</label></div>
                        <div class="kolom2">
                            <label>: <?php echo isset($diskon) && $diskon !== '' ? $diskon . '%' : '0%'; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"><label>Harga Diskon</label></div>
                        <div class="kolom2">
                            <label>: Rp <?php echo isset($hargadiskon) ? number_format($hargadiskon, 2) : '0.00'; ?></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"><label>Harga Akhir</label></div>
                        <div class="kolom2">
                            <label>: Rp <?php echo isset($hargatotal) ? number_format($hargatotal, 2) : '0.00'; ?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
