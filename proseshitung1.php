<?php

    $hargaawal=$_POST['hargaawal'];
    $diskon=$_POST['diskon'];

    if ($hargaawal=="") {
       echo "<script>alert('Harga Tidak boleh kosong');
       window.location='index1.php';
       </script>";
    }elseif($diskon==""){
        echo "<script>alert('Diskon Tidak boleh kosong');
        window.location='index1.php';
        </script>";
    }elseif($diskon=="100"){
        echo "<script>alert('Diskon Tidak boleh lebih dari 100%');
        window.location='index1.php';
        </script>";
    }elseif($hargaawal<=1){
        echo "<script>alert('Harga Tidak boleh lebih dari 0');
        window.location='index1.php';
        </script>";
    }else{
        $hargadiskon=($diskon/100)*$hargaawal;
        $hargatotal=$hargaawal-$hargadiskon;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Harga Awal : Rp <?php echo $hargaawal ?></h1>
    <h1>Diskon :    <?php echo $diskon ?>%</h1>
    <h1>jumlah harga diskon : <?php echo $hargadiskon ?></h1>
    <h1>jumlah yang harus dibayar : <?php echo $hargatotal ?></h1>
</body>
</html>