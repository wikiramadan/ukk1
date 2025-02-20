<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penghitung Diskon</title>
    <style>
        .kotak1 {
            width: 700px;
            height: 900px;
            background-color: darkseagreen;
            border-radius: 10px;
            display: grid;
            margin: 0 auto;
            justify-content: center;
            box-shadow: 20px 10px 40px;

        }

        .kotak2 {
            width: 500px;
            height: 600px;
            background-color: aqua;
            border-radius: 5px;
            margin-top: 50px;
        }

        .kotak3 {
            width: 400px;
            height: 300px;
            margin: 0 auto;
            display: grid;
            background-color: aquamarine;
        }

        .row {
            width: 400px;
        }

        .kolom1 {
            width: 40px;
            float: left;
            padding: 15px;
        }

        .kolom2 {
            width: 60px;
            float: left;
            padding: 15px;

        }
    </style>
</head>

<body>
    <div class="kotak1">
    <h2>Aplikasi Penghitung Diskon<h2>
        <div class="kotak2">
            <center> <img src="img/wiki.jpg" alt="" width="100"> </center>
            <div class="kotak3">
                <form action="proseshitung1.php" method="post">

                    <div class="row">
                        <div class="kolom1">
                            <label for="">Harga awal:</label>
                        </div>

                        <div class="kolom2">
                            <input type="text" name="hargaawal" id="">

                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
    <h2>Aplikasi Penghitung Diskon<h2>

            <form action="proseshitung1.php" method="post">
                <label for="">Input Harga awal : </label>
                <input type="text" name="hargaawal" id="">
                <label for="">Input Diskon : </label>
                <input type="text" name="diskon" id="">
                <input type="submit" value="Hitung">
            </form>
</body>

</html>