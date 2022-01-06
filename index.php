<?php
include_once("functions.php");
include_once("CFG.php");
include_once("CYKGenerator.php");

if (isset($_POST['submit'])) {
    if (isset($_POST['stcInput']) && !empty($_POST['stcInput'])) {

        $sentence = $_POST['stcInput'];
        $cfg = new CFG(get_rules("./assets/rules.txt"), "K"); // buat cfg
        $cyk = new CYKGenerator($cfg); // buat cyk
        $cyk = $cyk->generate_table($sentence);
        $cyk = $cyk->solve();

        if ($cyk->validation()) {
            $message =  "Kalimat Bahasa Bali Yang Diinputkan Merupakan Kalimat Yang Valid";
            $color = "blueT";
        } else {
            $message = "Kalimat Bahasa Bali Yang Diinputkan Merupakan Kalimat Yang Tidak Valid";
            $color = "redT";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CYK Algorithm</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container">
        <div class="center">
            <!-- Judul -->
            <div class="row mt-3">
                <div class="form-group"></div>
                <h1 style="text-align: center">Teori Bahasa Dan Otomata</h1>
                <h2 style="text-align: center">Validasi Kalimat Bahasa Bali Menggunakan Algoritma Cocke–Younger–Kasami Algorithm</h2>
                <h4 style="text-align: left">Tata Cara Penggunaan</h4>
                <div>
                    <oL type="1" style="text-align: left">
                        <li>Masukan kalimat bahasa bali pada text field.</li>
                        <li>Tekan tombol submit untuk mengecek apakah kalimat bahasa bali tersebut valid atau tidak.</li>
                        <li>Setelah ditekan tombol submit, akan ditampilkan tulisan kalimat bahsa bali tersebut valid atau tidak valid.</li>
                        <li>Jika ingin memvalidasi kalimat lagi, hapus kalimat bahsa bali pada text field. Dan lakukan langkah-langkah dari awal.</li>
                    </ol>
                </div>
            </div>
            <hr size="10" style="background-color:rgb(5, 5, 5)">
            <!--  -->
            <div class="section1">
                <h2 style="text-align: center">Masukan Kalimat</h2>
                <div class="form">
                    <form action="./index.php" method="POST">
                        <label for="sentence">Kalimat : </label>
                        <input type="text" id="sentence" name="stcInput" value="<?php if (isset($sentence)) echo $sentence; ?>">
                        <button type="submit" name="submit" class="mybtn white">submit</button>
                    </form>
                </div>
            </div>
        </div>
        <hr size="10" style="background-color:rgb(0, 0, 0)">
        <div class="section2">
            <h2 style="text-align: center">Hasil Validasi Kalimat:</h2>
            <?php if (isset($sentence)) : ?>
                <h2 style="text-align: center" class="<?php echo $color; ?>"><?php echo $message; ?>.</h2>
            <?php endif; ?>
            <br>
        </div>
    </div>
</body>

</html>