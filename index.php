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
            $message =  "The sentence is valid";
            $color = "blueT";
        } else {
            $message = "Invalid sentence";
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
        <div class="section1">
            <h2>Teori Bahasa Dan Otomata</h2>
            <h2>Cocke–Younger–Kasami Algorithm</h2>
            <div class="form">
                <form action="./index.php" method="POST">
                    <label for="sentence">Kalimat : </label>
                    <input type="text" id="sentence" name="stcInput" value="<?php if (isset($sentence)) echo $sentence; ?>">

                    <button type="submit" name="submit" class="mybtn red">submit</button>
                </form>
            </div>
        </div>
        <hr class="line">
        <div class="section2">
            <?php if (isset($sentence)) : ?>
                <h2 class="<?php echo $color; ?>"><?php echo $message; ?>.</h2>
            <?php endif; ?>
        </div>
    </div>

</body>

</html>