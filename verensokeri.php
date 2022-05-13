<?php
session_start();
include 'sokeriarvolista.php';
include 'lisays.php';
include 'functions.php';
check();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="verensokeri.css?<?php echo time(); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Luxurious+Roman&family=Raleway&display=swap" rel="stylesheet">
    <title>How you doin'?</title>
</head>
<body>
    <header>
        <div class="perus">
            <div class="logo">
                <img src="./img/xHYDLogo.png" width="25%">
            </div>
    
            <nav>
                <ul>
                    <li><a href="./paasivu.php">Etusivu</a></li>
                    <li><a href="./omasivumpi.php">Omasivu</a></li>
                    <li><a href="./terveystietoa.php">Terveystietoa</a></li>
                    <!--<li><a href="#">Asetukset</a></li>-->
                    <li><a href="./ohjeet.php">Sivuston ohjeet</a></li>
                    <?=$_SESSION['otsikko']?>
                    <li><form method="post" action="logout.php"><button>Kirjaudu ulos</button></form></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="raita">
        <img class="omppu" src="./img/omppu.png" width="120px" height="120px">
        <h1>Verensokeri</h1>
    </div>
    <section id="laatikot">
        <div class="container">
            <div class="laatikko">
                <form method="post" enctype="multipart/form-data" action="" name="arvioi">
                    <input type="text" class="arvo" name="arvo" placeholder="Syötä arvo" required>
                    <input type="checkbox" class="check" action="" name="lisaa"><span>Tallenna arvo</span>
                    <button type="submit">Analysoi</button>
                </form>
                
            </div>
            <div class="laatikko">
                <h3>Historia</h3>
                <p><?=$rmjono?></p>
            </div>
        </div>
    </section>
    <section class="perus">
        <div class="analyysi">
            <h2><?=$arvo?></h2>
            <?=$analyysi?>
        </div>
    </section>
    <div class="muut">
        <button><a href="./paine.php"><img src="./img/sydan.png" width="115px" height="115px"></a></button>
        <button><a href="./bmi.php"><img src="./img/BMI.png" width="120px" height="120px"></a></button>
        </ul>
    </div>
    <section id="footer">
        <p><span style="font-size:12px">Copyright <img src="./img/ivv3.png" class="ivvlogo" width="5%"> <?=$_SESSION['vuosi']?> </span></p> 
    </section>
</body>
</html>
