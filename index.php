<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Aplikasi Perhitungan Sederhana</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="style.css"> 
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Perhitungan Sederhana</h3>
            </div>
            <form role="form" method="post" action="proseshitung.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="NamaBarang">Nama Barang</label>
                  <input type="text" class="form-control" id="NamaBarang" name="nama_barang" placeholder="Masukan Nama Barang" required>
                </div>
                <div class="form-group">
                  <label for="HargaBarang">Harga Barang</label>
                  <input type="number" class="form-control" id="HargaBarang" name="harga_barang" placeholder="Masukan Harga Barang" min="0" required>
                </div>
                <div class="form-group">
                  <label for="JumlahBarang">Jumlah Barang</label>
                  <input type="number" class="form-control" id="JumlahBarang" name="jumlah_barang" placeholder="Masukan Jumlah Barang" min="1" required>
                </div>
                <div class="form-group">
                  <label for="PersentaseDiskon">Persentase Diskon (%)</label>
                  <input type="number" class="form-control" id="PersentaseDiskon" name="persentase_diskon" placeholder="Masukan Persentase Diskon" min="1" max="100">
                </div>
                <div class="form-group">
                  <label for="TotalHarga">Total Harga (Sebelum Diskon)</label>
                  <input type="text" class="form-control" id="TotalHarga" readonly>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Hitung</button>
                  <button type="reset" class="btn btn-danger">Ulangi</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <script>
      document.getElementById("PersentaseDiskon").addEventListener("input", function () {
        let diskon = parseFloat(this.value);
        if (diskon < 0) this.value = 0;
        if (diskon > 100) this.value = 100;
      });
      
      function hitungTotal() {
        let harga = parseFloat(document.getElementById("HargaBarang").value) || 0;
        let jumlah = parseInt(document.getElementById("JumlahBarang").value) || 0;
        let total = harga * jumlah;
        document.getElementById("TotalHarga").value = total.toLocaleString('id-ID');
      }
      
      document.getElementById("HargaBarang").addEventListener("input", hitungTotal);
      document.getElementById("JumlahBarang").addEventListener("input", hitungTotal);
    </script>
  </div>
</body>

</html>
