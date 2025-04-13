<?php
$harga=$_POST['hargaawal'];
$diskon=$_POST['diskon'];

$hargadiskon=($diskon/100)*$hargaawal;
$hargatotal=$hargaawal-$hargadiskon;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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