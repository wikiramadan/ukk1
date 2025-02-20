<?php
    $hargaawal = isset($_POST['hargaawal']) ? $_POST['hargaawal'] : '';
    $diskon = isset($_POST['diskon']) ? $_POST['diskon'] : '';

    $hargadiskon = 0;
    $hargatotal = 0;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($hargaawal == "") {
            echo "<script>alert('Silahkan masukkan harga awal');
            window.location='index.php';
            </script>";
        } elseif ($diskon == "") {
            echo "<script>alert('Silahkan masukkan diskon barang');
            window.location='index.php';
            </script>";
        } elseif ($diskon > 100) {
            echo "<script>alert('Diskon Terlalu Banyak');
            window.location='index.php';
            </script>";
        } elseif ($diskon < 0) {
            echo "<script>alert('Diskon tidak valid');
            window.location='index.php';
            </script>";
        } else {
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
    <title>Document</title>
    <style>
        .kotak1 {
            width: 600px;
            height:750px; 
            background-color: rgb(20, 240, 237);
            border-radius: 10px;
            display: grid;
            margin: 0 auto;
            justify-content: center;
            box-shadow: 20px 10px 40px;
            padding: 20px;
        }
        .kotak2 {
            width: 500px;
            height: 650px;
            background-color: rgb(7, 147, 154);
            border-radius: 5px;
            margin-top: 20px;
            padding: 20px;
        }
        .kotak3 {
            width: 400px;
            height: 500px;
            margin: 0 auto;
            display: grid;
            background-color: rgb(8, 100, 97);
            padding: 10px;
            border-radius: 5px;
        }
        .row {
            width: 100%;
        }
        .kolom1 {
            width: 30%;
            float: left;
            padding: 10px;
        }
        .kolom2 {
            width: 50%;
            float: left;
            padding: 10px;
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
                            <label for="">Harga Awal</label>
                        </div>
                        <div class="kolom2">
                            <input type="text" name="hargaawal" id="" value="<?php echo $hargaawal; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1">
                            <label for="">Diskon</label>
                        </div>
                        <div class="kolom2">
                            <input type="number" name="diskon" id="" value="<?php echo $diskon; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"></div>  
                        <div class="kolom2">
                            <input type="submit" value="Hitung">
                        </div>
                    </div>
                </form>

                <center><h3>Hasil</h3></center>
                <div class="row">
                    <div class="kolom1"><label>Harga Awal</label></div>
                    <div class="kolom2">
                        <label>
                            : Rp <?php echo isset($hargaawal) && $hargaawal !== '' ? number_format($hargaawal, 2) : '0.00'; ?>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="kolom1"><label>Jumlah Diskon</label></div>
                    <div class="kolom2">
                        <label>
                            : <?php echo isset($diskon) && $diskon !== '' ? $diskon . '%' : '0%'; ?>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="kolom1"><label>Harga Diskon</label></div>
                    <div class="kolom2">
                        <label>
                            : Rp <?php echo isset($hargadiskon) ? number_format($hargadiskon, 2) : '0.00'; ?>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="kolom1"><label>Harga Akhir</label></div>
                    <div class="kolom2">
                        <label>
                            : Rp <?php echo isset($hargatotal) ? number_format($hargatotal, 2) : '0.00'; ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>