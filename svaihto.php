<?php
session_start();
if (!isset($_SESSION['kirj'])) {
    $_SESSION['kirj'] = "";
}
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
    <img src="./img/xHYDLogo.png" class="kuva">
    <div class="perus">
        <?=$_SESSION['kirj']?>
    </div>
    <div class="hero">
        <div class="form-box">
            <form action="sv2.php" method="post">
                <input class="input" type="text" name="koodi" placeholder="Anna koodi">
                <input class="input" type="password" name="ss1" placeholder="Anna salasana">
                <input class="input" type="password" name="ss2" placeholder="Salasana toiseen kertaan">
                <button type="submit">Vaihda</button>
            </form>
        </div>
    </div>
    <section id="footer">
            
            <p><span style="font-size:12px">Copyright <img src="./img/ivv3.png" class="ivvlogo" width="5%"> 2022 </span></p>
                
        </section>
	</body>
</html>
