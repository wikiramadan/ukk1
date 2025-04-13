<?php
$hargaawal = isset($_POST['hargaawal']) ? trim($_POST['hargaawal']):'';
$hargadiskon = isset($_POST['hargadiskon']) ? trim($_POST['hargadiskon']): '';

$hargaawal = 0;
$hargadiskon = 0;

// Proses perhitungan jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($hargaawal == "") {
        echo "<script>alert('Silahkan masukkan harga awal');
        window.location='index6.php';
        </script>";
    } elseif ($hargadiskon == "") {
        echo "<script>alert('Silahkan masukkan diskon barang');
        window.location='index6.php';
        </script>";
    } elseif ($hargadiskon > 100) {
        echo "<script>alert('Diskon Terlalu Banyak');
        window.location='index6.php';
        </script>";
    } elseif ($hargadiskon < 0) {
        echo "<script>alert('Diskon tidak valid');
        window.location='index6.php';
        </script>";
    } else {
        $hargadiskon = ($hargaawal * $hargadiskon) / 100;
        $hargatotal = $hargaawal - $hargadiskon;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>appukk</title>
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
                <center><h2></h2>Aplikasi menghitung diskon</center>
                <form action="" method="post">
                    <div class="row">
                       <div class="kolom1">
                        <label for="">hargaawal</label>
                       </div>
                      <div class="kolom2">
                        <input type="text" name="hargaawal" id="" value="<?php echo $hargaawal; ?>">
                      </div>
                    </div>
                    <div class="row">
                        <div class="kolom1">
                            <label for="">diskon</label>
                        </div>
                        <div class="kolom2">
                            <input type="number" name="hargadiskon" value="<?php echo $hargadiskon; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="kolom1"></div>
                        <div class="kolom2">
                            <input type="submit" value="hitung">
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="kolom1"><label>hargaawal</label></div>
                    <div class="kolom2">
                        <label>
                            : RP <?php echo isset($hargaawal) && $hargaawal !== '' ? number_format($hargaawal, 2) : '0.00'; ?>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="kolom1"><label>hargadiskon</label></div>
                    <div class="kolom2">
                        <label>
                            : RP <?php echo isset($hargadiskon) && $hargadiskon !== '' ? $hargadiskon . '%' : '0%';?>
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