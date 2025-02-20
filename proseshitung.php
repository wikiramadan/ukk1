<?php

// Mengambil data yang dikirimkan dari form menggunakan metode POST
$nama_barang = $_POST['nama_barang']; // Menyimpan nama barang
$harga_barang = $_POST['harga_barang']; // Menyimpan harga barang
$jumlah_barang = $_POST['jumlah_barang']; // Menyimpan jumlah barang
$persentase_diskon = $_POST['persentase_diskon']; // Menyimpan persentase diskon

// Menghitung subtotal (harga barang * jumlah barang)
$subtotal = $harga_barang * $jumlah_barang;

// Menghitung diskon berdasarkan persentase diskon
$diskon = ($persentase_diskon / 100) * $subtotal;

// Menghitung total harga setelah diskon (subtotal - diskon)
$total = $subtotal - $diskon;
?>

<!DOCTYPE html>
<html lang="id"> <!-- Menentukan bahasa halaman sebagai Bahasa Indonesia -->
<head>
    <meta charset="UTF-8"> <!-- Menentukan encoding karakter untuk menghindari masalah tampilan karakter -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Membuat tampilan responsif di perangkat mobile -->
    <title>Hasil Perhitungan Harga Barang</title> <!-- Judul halaman -->
</head>

<body>

    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Hasil Perhitungan Sederhana</h3> <!-- Judul tabel hasil perhitungan -->
            </div>
            <div class="box-body no-padding">
                <table class="table table-striped"> <!-- Membuat tabel dengan gaya garis tepi -->
                    <tr> <!-- Baris pertama -->
                        <td>Nama Barang</td> <!-- Kolom pertama untuk Nama Barang -->
                        <td><span class="badge bg-red"><?php echo "$nama_barang"; ?></span></td> <!-- Menampilkan nama barang -->
                    </tr>
                    <tr> <!-- Baris kedua -->
                        <td>Harga Barang</td> <!-- Kolom pertama untuk Harga Barang -->
                        <td><span class="badge bg-light-blue"><?php echo "Rp. " . number_format($harga_barang); ?></span></td> <!-- Menampilkan harga barang, dengan format angka yang dipisahkan oleh ribuan -->
                    </tr>
                    <tr> <!-- Baris ketiga -->
                        <td>Jumlah Barang</td> <!-- Kolom pertama untuk Jumlah Barang -->
                        <td><span class="badge bg-red"><?php echo "$jumlah_barang"; ?></span></td> <!-- Menampilkan jumlah barang -->
                    </tr>
                    <tr> <!-- Baris keempat -->
                        <td>Subtotal</td> <!-- Kolom pertama untuk Subtotal -->
                        <td><span class="badge bg-light-blue"><?php echo "Rp. " . number_format($subtotal); ?></span></td> <!-- Menampilkan subtotal, dengan format angka yang dipisahkan oleh ribuan -->
                    </tr>
                    <tr> <!-- Baris kelima -->
                        <td>Persentase Diskon</td> <!-- Kolom pertama untuk Persentase Diskon -->
                        <td><span class="badge bg-red"><?php echo "$persentase_diskon%"; ?></span></td> <!-- Menampilkan persentase diskon -->
                    </tr>
                    <tr> <!-- Baris keenam -->
                        <td>Jumlah Diskon</td> <!-- Kolom pertama untuk Jumlah Diskon -->
                        <td><span class="badge bg-light-blue"><?php echo "Rp. " . number_format($diskon); ?></span></td> <!-- Menampilkan jumlah diskon, dengan format angka yang dipisahkan oleh ribuan -->
                    </tr>
                    <tr> <!-- Baris ketujuh -->
                        <td>Total</td> <!-- Kolom pertama untuk Total Harga Setelah Diskon -->
                        <td><span class="badge bg-red"><?php echo "Rp. " . number_format($total); ?></span></td> <!-- Menampilkan total harga setelah diskon, dengan format angka yang dipisahkan oleh ribuan -->
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
