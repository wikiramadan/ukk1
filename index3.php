<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>apkdis</title>
    <!-- <style>
        .kotak1 {
            width: 1000px;
            height: 800;
            background-color: slateblue;
            border-radius: 11px;
            display: grid;
            margin: 0 auto;
            justify-content: center;
            box-shadow: 20px 30px 40px;
            padding: 21px;
        }

        .kotak2 {
            width: 700px;
            height: 500px;
            background-color: aquamarine;
            border-radius: 5px;
            margin-top: 20px;
            padding: 20px;

        }

        .kotak3 {
            width: 500px;
            height: 300px;
            margin: 0 auto;
            display: grid;
            background-color: rgb(8, 100, 97);
            padding: 10px;
            border-radius: 5px;
        }

        .row {
            width: 101%;
        }

        .kolom1 {
            width: 30%;
            float: left;
            padding: 50px;


        }

        .kolom2 {
            width: 50%;
            float: left;
            padding: 10px;
        }
    </style> -->
</head>

<body>
    <div class="kotak1">
        <div class="kotak2">
            <div class="kotak3">
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
                            <label for="">Diskon</label>
                        </div>
                        <div class="kolom2">
                            <input type="number" name="diskon" id="" value="<?php echo $diskon; ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>