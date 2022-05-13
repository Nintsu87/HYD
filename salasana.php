<?php
// Ninan touhuama salasananvaihtosivu, Meeri auttoi
session_start();
include("functions.php");

// jos väliaikaista sessiomuuttujaa ei ole jo luotu, luo tyhjän
if (!isset($_SESSION['note'])) {
    $_SESSION['note'] = "";
}
$vuosi = date('Y');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="salasana.css?<?php echo time(); ?>">
    <title>How You Doin'</title>
</head>
<body style="background-color: #e1f7ed;">
    <p id="yla">Nina | Minna | Meeri</p>
    <header class="otsikko">
        <h1 class="ekaotsikko">How You Doin'</h1>
        <h3 class="tokaotsikko">eli Kuis kulkee kultasein</h3>
        <img src="./img/question.png" class="merkki">
    </header>
    <img src="./img/xHYDLogo.png" class="kuva" title="How you doin'? -projekti">
    <div class="perus">
        
    </div>
    <div class="hero">
        <div class="form-box">
            <form method="POST" enctype="multipart/form-data" action="salasanamail.php">
                <label for="mail"> Sähköpostiosoite salasanan resetointi-viestiä varten.</label>
                <input class="input-field" placeholder="Email" type="text" name="mail" title="Email, jota käytit kirjautuessasi" required><br>
                <button type="submit" title="Lähetä salasananvaihtokoodi emailiin">Lähetä</button>
                </br>
                
            </form>
            <a href="ivv.php" title="Etusivulle">Takaisin etusivulle</a>
            <p style='color:red;'><?=$_SESSION['note']?></p>
        </div>
    </div>
        <section id="footer">
            
            <p><span style="font-size:12px">Copyright <img src="./img/ivv3.png" class="ivvlogo" width="5%" title="Ihan-vaan-Viisi: Meeri, Minna ja Nina"> <?=$vuosi?> </span></p>
                
        </section>
	</body>
</html>
