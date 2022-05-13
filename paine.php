<?php
session_start();
include 'painelista.php';
include 'vplisays.php';
include 'functions.php';
check();

$vuosi = date("Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="paine.css? <?php echo time(); ?>">
    <title>Verenpaine</title>
</head>
<body>
    <header>
            <nav>
                <ul>
                    <li><a href="./paasivu.php">Etusivu</a></li>
                    <li><a href="./omasivumpi.php">Omasivu</a></li>
                    <li><a href="./terveystietoa.php">Terveystietoa</a></li>
                    <li><a href="./ohjeet.php">Sivuston ohjeet</a></li>
                    <?=$_SESSION['otsikko']?>
                    <li><form method="post" action="logout.php"><button>Kirjaudu ulos</button></form></li>
                </ul>
            </nav>
    </header>
    <div class="container"> 
        <div class="info-box">
            <div class="left"></div>
            <div class="right">
            <form method="POST" enctype="multipart/form-data" action="" name="arvioi">
                <h2>Verenpaine</h2>
                <input type="text" class="field" name="arvo" placeholder="Yläpaine/Alapaine" required>
                <button class="btn">Analysoi</button>
                <button class="btn" name="lisaa">Tallenna arvo</button>
            </form>
            </div>
        </div> 
        <div class="laatikko">
            <h3>Historia</h3>
            <p><?=$rmjono?></p>
            <br>
            <h3><?=$arvo?></h3>
            <?=$analyysi?>
        </div>

    </div>
</body>
</html>
